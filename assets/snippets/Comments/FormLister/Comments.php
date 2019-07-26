<?php namespace FormLister;

use DocumentParser;
use RuntimeSharedSettings;

/**
 * Class Comments
 * @package FormLister
 */
class Comments extends Core
{
    use SubmitProtection;
    /*
     * var Comments\Comments $comments
     */
    public $comments = null;
    protected $mode = 'create';

    /**
     * Core constructor.
     * @param DocumentParser $modx
     * @param array $cfg
     */
    public function __construct (DocumentParser $modx, array $cfg = array())
    {
        parent::__construct($modx, $cfg);
        $this->comments = $this->loadModel(
            $this->getCFGDef('model', '\Comments\Comments'),
            $this->getCFGDef('modelPath', 'assets/snippets/Comments/model/Comments.php')
        );
        $comment = $this->getCFGDef('id', 0);
        if ($comment) {
            $this->mode = 'edit';
        } else {
            $this->mode = 'create';
        }
        $this->lexicon->fromFile('form');
        $this->lexicon->config->setConfig(array(
            'langDir' => 'assets/snippets/Comments/lang/'
        ));
        $this->lexicon->fromFile('comments');
        $this->log('Lexicon loaded', array('lexicon' => $this->lexicon->getLexicon()));

    }

    /**
     * Загружает класс капчи
     */
    public function initCaptcha ()
    {
        $useCaptchaForGuestsOnly = $this->getCFGDef('useCaptchaForGuestsOnly', 1);
        $uid = $this->modx->getLoginUserID('web');
        $flag = (!$useCaptchaForGuestsOnly)
            || (!$uid && $useCaptchaForGuestsOnly);

        return $flag ? parent::initCaptcha() : $this;
    }


    /**
     * Сохраняет настройки
     */
    protected function saveSettings ()
    {
        $rtss = RuntimeSharedSettings::getInstance($this->getMODX());
        $rtss->save(
            $this->getCFGDef('rtssElement', 'CommentsForm') . $this->getCFGDef('thread', 0),
            $this->getCFGDef('context', 'site_content'),
            $this->config->getConfig()
        );
    }

    /**
     * @return string|array
     */
    public function render ()
    {
        if (!$this->isSubmitted()) {
            $this->saveSettings();
        } elseif ($this->checkSubmitLimit() || $this->checkSubmitProtection()) {
            $this->renderForm();
        }

        return $this->mode == 'create' ? $this->renderCreate() : $this->renderEdit();
    }

    /**
     * @return string|array
     */
    protected function renderCreate ()
    {
        $parent = (int)$this->getField('parent', 0);
        $this->setField('parent', $parent);
        $disableGuests = $this->getCFGDef('disableGuests', 1);
        $uid = $this->modx->getLoginUserID('web');
        if ($disableGuests) {
            if (!$uid) {
                $this->setValid(false);
                $this->renderTpl = $this->getCFGDef('skipTpl');
            }
        } else {
            if (!$uid) {
                $this->renderTpl = $this->getCFGDef('guestFormTpl');
            }
        }

        return parent::render();
    }

    /**
     * Загрузка правил валидации
     * @param string $param
     * @return array
     */
    public function getValidationRules ($param = 'rules')
    {
        $disableGuests = $this->getCFGDef('disableGuests', 1);
        $uid = $this->modx->getLoginUserID('web');
        if (!$disableGuests && !$uid && $param === 'rules') {
            $param = 'guestRules';
        }
        if ($this->mode == 'edit' && $this->getCFGDef('editRules')) {
            $param = 'editRules';
        }

        return parent::getValidationRules($param); // TODO: Change the autogenerated stub
    }


    /**
     * @return string|array
     */
    protected function renderEdit ()
    {
        $comment = $this->getCFGDef('id', 0);
        $uid = $this->modx->getLoginUserID('web');
        $flag = false;
        if (!$uid) {
            $this->addMessage($this->translate('comments.only_users_can_edit'));
        } elseif ($this->comments->edit($comment)->getID()) {
            $fields = $this->comments->toArray();
            if ($fields['createdby'] != $uid || $fields['deleted'] || !$fields['published']) {
                $this->addMessage($this->translate('comments.cannot_edit'));
            } elseif (count($this->comments->getBranchIds($fields['id'])) > 1) {
                $this->addMessage($this->translate('comments.comment_is_answered'));
            } elseif (!$this->checkEditTime($fields['createdon'])) {
                $this->addMessage($this->translate('comments.edit_time_expired'));
            } elseif (!$this->isSubmitted()) {
                $flag = true;
                $editableFields = $this->allowedFields;
                $editableFields[] = 'rawcontent';
                foreach ($editableFields as $key) {
                    $this->setField($key, $fields[$key]);
                }
                $this->setField('comment', $this->getField('rawcontent'));
            } else {
                $flag = true;
            }
        } else {
            $this->addMessage($this->translate('comments.cannot_edit'));
        }
        $this->setValid($flag);
        if ($tpl = $this->getCFGDef('editFormTpl')) {
            $this->renderTpl = $tpl;
        };

        return parent::render();
    }

    /**
     * @param $createdon
     * @return bool
     */
    public function checkEditTime ($createdon)
    {
        $editTime = $this->getCFGDef('editTime', 180);
        $out = $editTime == 0 || time() + $this->modx->getConfig('server_offset_time') - strtotime($createdon) < $editTime;

        return $out;
    }

    /**
     * Обработка формы, определяется контроллерами
     *
     * @return mixed
     */

    public function process ()
    {
        return $this->mode == 'create' ? $this->processCreate() : $this->processEdit();
    }

    /**
     * Создание комментария
     * @return mixed|void
     */
    public function processCreate ()
    {
        $disableGuests = $this->getCFGDef('disableGuests', 1);
        $uid = $this->modx->getLoginUserID('web');
        $result = false;
        if ($disableGuests && !$uid) {
            $this->addMessage($this->translate('comments.only_users_can_edit'));
        } else {
            $context = $this->getCFGDef('context', 'site_content');
            $thread = (int)$this->getField('thread', 0);
            $parent = (int)$this->getField('parent', 0);
            $fields = $this->getFormData('fields');
            $fields['parent'] = $parent;
            $fields['thread'] = $thread;
            $fields['context'] = $context;
            if (!empty($context) && $thread) {
                $result = $this->comments->create($fields)->save(true, true);
            }
        }
        $extMessages = $this->addMessagesFromModel();
        if ($result) {
            $this->setFields($this->comments->toArray());
            $this->setFormStatus(true);
            if (empty($this->getCFGDef('successTpl')) && !$extMessages) {
                $this->addMessage($this->translate('comments.comment_saved'));
            }
        } elseif (!$extMessages) {
            $this->addMessage($this->translate('comments.unable_to_save'));
        }
    }

    /**
     * Редактирование комментария
     * @return mixed|void
     */
    public function processEdit ()
    {
        $result = false;
        $uid = $this->modx->getLoginUserID('web');
        if (!$uid) {
            $this->addMessage($this->translate('comments.only_users_can_edit'));
        } else {
            if (!empty($this->allowedFields)) {
                $this->allowedFields[] = 'comment';
            }
            $fields = $this->filterFields($this->getFormData('fields'), $this->allowedFields, $this->forbiddenFields);
            $result = $this->comments->fromArray($fields)->save();
        }
        if ($result) {
            $this->setFormStatus(true);
            $this->setFields($this->comments->toArray());
            $this->setField('comment', $this->comments->get('content'));
            if (empty($this->getCFGDef('successTpl'))) {
                $this->addMessage($this->translate('comments.comment_saved'));
            }
        } else {
            $this->addMessage($this->translate('comments.unable_to_save'));
        }
    }

    /**
     * @return bool
     */
    public function addMessagesFromModel ()
    {
        $messages = $this->comments->getMessages();
        foreach ($messages as $message) {
            $this->addMessage($message);
        }

        return !empty($messages);
    }
}
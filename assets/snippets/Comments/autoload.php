<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'apihelpers' => '/../../lib/APIHelpers.class.php',
                'assetshelper' => '/../../lib/Helpers/Assets.php',
                'autotable' => '/../../lib/MODxAPI/autoTable.abstract.php',
                'comments\\actions' => '/controller/Actions.php',
                'comments\\attachments' => '/model/Attachments.php',
                'comments\\comments' => '/model/Comments.php',
                'comments\\extendedfields' => '/model/ExtendedFields.php',
                'comments\\lastview' => '/model/LastView.php',
                'comments\\moderation' => '/model/Moderation.php',
                'comments\\plugin' => '/model/Plugin.php',
                'comments\\rating' => '/model/Rating.php',
                'comments\\stat' => '/model/Stat.php',
                'comments\\subscriptions' => '/model/Subscriptions.php',
                'comments\\traits\\doclister' => '/DocLister/DocLister.php',
                'comments\\traits\\messages' => '/model/Messages.php',
                'content_dl_filter' => '/../DocLister/core/filter/content.filter.php',
                'customuser' => '/../../lib/MODxAPI/customUser.php',
                'dlcollection' => '/../DocLister/lib/DLCollection.class.php',
                'dldebug' => '/../DocLister/lib/DLdebug.class.php',
                'dlfixedprepare' => '/../DocLister/lib/DLFixedPrepare.class.php',
                'dlpaginate' => '/../DocLister/lib/DLpaginate.class.php',
                'dlpaginatereversed' => '/../DocLister/lib/DLpaginateReversed.class.php',
                'dlphx' => '/../DocLister/lib/DLphx.class.php',
                'dlreflect' => '/../DocLister/lib/DLReflect.class.php',
                'dlsitemap' => '/../DocLister/snippet.DLSitemap.php',
                'dltemplate' => '/../DocLister/lib/DLTemplate.class.php',
                'doclister' => '/../DocLister/core/DocLister.abstract.php',
                'drewm\\mailchimp\\batch' => '/../FormLister/lib/MailChimp/Batch.php',
                'drewm\\mailchimp\\mailchimp' => '/../FormLister/lib/MailChimp/MailChimp.php',
                'extdoclister' => '/../DocLister/core/extDocLister.abstract.php',
                'filterdoclister' => '/../DocLister/core/filterDocLister.abstract.php',
                'formatter\\cssminify' => '/../../lib/Formatter/CSSMinify.php',
                'formatter\\htmlformatter' => '/../../lib/Formatter/HtmlFormatter.php',
                'formatter\\sqlformatter' => '/../../lib/Formatter/SqlFormatter.php',
                'formlister\\activate' => '/../FormLister/core/controller/Activate.php',
                'formlister\\captchainterface' => '/../FormLister/lib/captcha/Captcha.php',
                'formlister\\commentpreview' => '/FormLister/CommentPreview.php',
                'formlister\\comments' => '/FormLister/Comments.php',
                'formlister\\content' => '/../FormLister/core/controller/Content.php',
                'formlister\\core' => '/../FormLister/core/FormLister.abstract.php',
                'formlister\\deletecontent' => '/../FormLister/core/controller/DeleteContent.php',
                'formlister\\deleteuser' => '/../FormLister/core/controller/DeleteUser.php',
                'formlister\\filevalidator' => '/../FormLister/lib/FileValidator.php',
                'formlister\\filters' => '/../FormLister/lib/Filters.php',
                'formlister\\form' => '/../FormLister/core/controller/Form.php',
                'formlister\\login' => '/../FormLister/core/controller/Login.php',
                'formlister\\mailchimp' => '/../FormLister/core/controller/MailChimp.php',
                'formlister\\moderation' => '/FormLister/Moderation.php',
                'formlister\\profile' => '/../FormLister/core/controller/Profile.php',
                'formlister\\register' => '/../FormLister/core/controller/Register.php',
                'formlister\\reminder' => '/../FormLister/core/controller/Reminder.php',
                'formlister\\submitprotection' => '/../FormLister/lib/SubmitProtection.php',
                'formlister\\validator' => '/../FormLister/lib/Validator.php',
                'helpers\\collection' => '/../../lib/Helpers/Collection.php',
                'helpers\\config' => '/../../lib/Helpers/Config.php',
                'helpers\\debug' => '/../FormLister/lib/Debug.php',
                'helpers\\fs' => '/../../lib/Helpers/FS.php',
                'helpers\\gpc' => '/../FormLister/lib/Gpc.php',
                'helpers\\lexicon' => '/../FormLister/lib/Lexicon.php',
                'helpers\\lexicon\\abstractlexiconhandler' => '/../FormLister/lib/LexiconHandlers/AbstractLexiconHandler.php',
                'helpers\\lexicon\\evobabellexiconhandler' => '/../FormLister/lib/LexiconHandlers/EvoBabelLexiconHandler.php',
                'helpers\\mailer' => '/../../lib/Helpers/Mailer.php',
                'helpers\\phpthumb' => '/../../lib/Helpers/PHPThumb.php',
                'helpers\\video' => '/../../lib/Helpers/Video.php',
                'jsonhelper' => '/../DocLister/lib/jsonHelper.class.php',
                'modcategories' => '/../../lib/MODxAPI/modCategories.php',
                'modchunk' => '/../../lib/MODxAPI/modChunk.php',
                'modmanagers' => '/../../lib/MODxAPI/modManagers.php',
                'modmodule' => '/../../lib/MODxAPI/modModule.php',
                'modplugin' => '/../../lib/MODxAPI/modPlugin.php',
                'modresource' => '/../../lib/MODxAPI/modResource.php',
                'modsnippet' => '/../../lib/MODxAPI/modSnippet.php',
                'modtemplate' => '/../../lib/MODxAPI/modTemplate.php',
                'modtv' => '/../../lib/MODxAPI/modTV.php',
                'module\\action' => '/../../lib/Module/Action.php',
                'module\\helper' => '/../../lib/Module/Helper.php',
                'module\\template' => '/../../lib/Module/Template.php',
                'modusers' => '/../../lib/MODxAPI/modUsers.php',
                'modusersext' => '/../../lib/MODxAPI/modUsersExt.php',
                'modxapi' => '/../../lib/MODxAPI/MODx.php',
                'modxapihelpers' => '/../../lib/MODxAPI/MODx.php',
                'modxcaptcha' => '/../FormLister/lib/captcha/modxCaptcha/modxCaptcha.php',
                'modxcaptchawrapper' => '/../FormLister/lib/captcha/modxCaptcha/wrapper.php',
                'modxrtebridge' => '/../../lib/class.modxRTEbridge.php',
                'myresource' => '/../../lib/MODxAPI/myResource.php',
                'onetabledoclister' => '/../DocLister/core/controller/onetable.php',
                'private_dl_filter' => '/../DocLister/core/filter/private.filter.php',
                'recaptchawrapper' => '/../FormLister/lib/captcha/reCaptcha/wrapper.php',
                'recentcommentsdoclister' => '/DocLister/RecentComments.php',
                'runtimesharedsettings' => '/model/RuntimeSharedSettings.php',
                'sg_dl_filter' => '/../DocLister/core/filter/sg.filter.php',
                'shopkeeperdoclister' => '/../DocLister/core/controller/shopkeeper.php',
                'simpletab\\abstractcontroller' => '/../../lib/SimpleTab/controller.abstract.php',
                'simpletab\\datatable' => '/../../lib/SimpleTab/table.abstract.php',
                'simpletab\\plugin' => '/../../lib/SimpleTab/plugin.class.php',
                'site_content_filtersdoclister' => '/../DocLister/core/controller/site_content_filters.php',
                'site_content_menu_customdoclister' => '/../DocLister/core/controller/site_content_menu_custom.php',
                'site_content_menudoclister' => '/../DocLister/core/controller/site_content_menu.php',
                'site_content_tagsdoclister' => '/../DocLister/core/controller/site_content_tags.php',
                'site_contentdoclister' => '/../DocLister/core/controller/site_content.php',
                'smscaptchawrapper' => '/../FormLister/lib/captcha/smsCaptcha/wrapper.php',
                'smsmodel' => '/../FormLister/lib/captcha/smsCaptcha/model.php',
                'sqlhelper' => '/../DocLister/lib/sqlHelper.class.php',
                'summarytext' => '/../../lib/class.summary.php',
                'treeviewdoclister' => '/DocLister/TreeView.php',
                'tv_dl_filter' => '/../DocLister/core/filter/tv.filter.php',
                'tvd_dl_filter' => '/../DocLister/core/filter/tvd.filter.php',
                'xnop' => '/../DocLister/lib/xnop.class.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
// @codeCoverageIgnoreEnd

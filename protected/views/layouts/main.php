<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />

        <link href="/favicon.ico" type="image/x-icon" rel="icon" />
        <?php Yii::app()->clientScript->registerCssFile('/css/bootstrap.css'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
    Yii::app()->getClientScript()->registerCoreScript('jquery');
        Yii::app()->clientScript->packages['js'] = 
            array(  'baseUrl'=>'/js',
                      'js'=>array('syntaxhighlighter/scripts/shCore.js',
                          'syntaxhighlighter/scripts/shBrushJScript.js',
                          'syntaxhighlighter/scripts/shBrushSql.js',
                          'syntaxhighlighter/scripts/shBrushXml.js',
                          'syntaxhighlighter/scripts/shBrushCss.js',
                          'syntaxhighlighter/scripts/shBrushPhp.js',
                           'script.js'),
 //                     'js'=>array('highlight/highlight.pack.js'),
 //                      'js'=>array('jquery-ui-1.8.23.custom.min.js', 'ui.spinner.min.js',
  //                         'i18n/jquery.ui.datepicker-ru.js', 'jquery.cookie.js', 'script.js'),
 //                      'js'=>array( 'fileuploader.js'),
 //                      'js'=>array('jquery-1.6.4.min.js', 'ajaxupload.js','script.js'),
  //                  title.CClientScript::POS_END
               );
           Yii::app()->clientScript->registerPackage('js');
           
    ?>
        <link href="/js/syntaxhighlighter/styles/shCore.css" rel="stylesheet" type="text/css" />
        <link href="/js/syntaxhighlighter/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
         <script type="text/javascript">
  //          SyntaxHighlighter.config.bloggerMode = true;
            SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();
 //           hljs.initHighlightingOnLoad();
        </script>
</head>

<body>

<div class="container" id="page">

    <div class="row">
            <div id="header" class="span12"><div id="logo"><?php //echo CHtml::encode(Yii::app()->name); ?></div></div>
    </div><!-- header -->

    <div class="row"><div class="span12">
      <div class="navbar  navbar-static-top navbar-inverse">
	<div id="mainmenu" class="navbar-inner">
		<?php $this->widget('zii.widgets.CMenu',array(
                        'htmlOptions' => array( 'class' => 'nav'),
 			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/site/index')),
				array('label'=>'О сайте', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Контакты', 'url'=>array('/site/contact')),
				array('label'=>'Войти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
      </div>  
    </div></div>
    <div class="row"><div class="span12">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'htmlOptions' => array( 'class' => 'breadcrumb'),
			'links'=>$this->breadcrumbs,
                        'homeLink'=>CHtml::link('Главная','/' ),
		)); ?><!-- breadcrumbs -->
	<?php endif?>
    </div></div>
	<?php echo $content; ?>
 
    <div class="row"><div class="span12">
	<div id="footer">
          © 2011-2013 Дмитрий Хе. Все права защищены.
        </div><!-- footer -->
    </div></div>
</div><!-- page -->

</body>
</html>
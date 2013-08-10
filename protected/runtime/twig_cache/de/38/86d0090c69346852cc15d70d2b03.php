<?php

/* \views//layouts/blog.php */
class __TwigTemplate_de3886d0090c69346852cc15d70d2b03 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?php \$this->beginContent('//layouts/main'); ?>
<div class=\"row\">
    <div id=\"sidebar\" class=\"span3\">
    <?php \$this->widget('RubricsPost', array('titleCssClass'=>'nav-header'))?>
\t\t<?php
                   if(!Yii::app()->user->isGuest) 
                   {
                       \$this->widget('UserMenu', array(
 ///    \t\t\t'htmlOptions'=>array('class'=>'nav nav-tabs nav-stacked'),
                       )); 
                   }  
/*\t\t\t\$this->beginWidget('zii.widgets.CPortlet', array(
\t\t\t\t'title'=>'Операции',
\t\t\t));
\t\t\t\$this->widget('zii.widgets.CMenu', array(
\t\t\t\t'items'=>\$this->menu,
\t\t\t\t'htmlOptions'=>array('class'=>'operations'),
\t\t\t));
\t\t\t\$this->endWidget();
                 } */
\t\t?>
<?php \$this->widget('MonthlyArchives', array(
        'titleCssClass'=>'nav-header',
        'maxItems'=>Yii::app()->params['monthlyArchivesCount'],
)); ?>

    <?php \$this->widget('TagCloud', array(
        'maxTags'=>Yii::app()->params['tagCloudCount'],
    )); ?>
                    

    <?php \$this->widget('RecentComments', array(
        'maxComments'=>Yii::app()->params['recentCommentCount'],
    )); ?>
                    
    </div><!-- sidebar -->
    <div class=\"span9\">
\t\t<div id=\"content\">
\t\t\t<?php echo \$content; ?>
\t\t</div><!-- content -->
    </div>
</div>
<?php \$this->endContent(); ?>";
    }

    public function getTemplateName()
    {
        return "\\views//layouts/blog.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

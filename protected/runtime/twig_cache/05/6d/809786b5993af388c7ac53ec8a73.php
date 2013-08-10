<?php

/* \views\category\admin.php */
class __TwigTemplate_056d809786b5993af388c7ac53ec8a73 extends Twig_Template
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
        echo "<?php
\$this->breadcrumbs=array(
\t'Categories'=>array('index'),
\t'Manage',
);

\$this->menu=array(
\tarray('label'=>'List Category', 'url'=>array('index')),
\tarray('label'=>'Create Category', 'url'=>array('create')),
);

\$level=0;

foreach(\$categories as \$n=>\$category)
{
    if(\$category->level==\$level)
        echo CHtml::closeTag('li').\"\\n\";
    else if(\$category->level>\$level)
        echo CHtml::openTag('ul').\"\\n\";
    else
    {
        echo CHtml::closeTag('li').\"\\n\";

        for(\$i=\$level-\$category->level;\$i;\$i--)
        {
            echo CHtml::closeTag('ul').\"\\n\";
            echo CHtml::closeTag('li').\"\\n\";
        }
    }

    echo CHtml::openTag('li');
    echo CHtml::encode(\$category->title);
    \$level=\$category->level;
}

for(\$i=\$level;\$i;\$i--)
{
    echo CHtml::closeTag('li').\"\\n\";
    echo CHtml::closeTag('ul').\"\\n\";
}
?>";
    }

    public function getTemplateName()
    {
        return "\\views\\category\\admin.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

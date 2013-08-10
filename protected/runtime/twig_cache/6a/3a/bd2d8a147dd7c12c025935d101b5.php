<?php

/* \views\site\index.php */
class __TwigTemplate_6a3abd2d8a147dd7c12c025935d101b5 extends Twig_Template
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
        echo "<?php \$this->pageTitle=Yii::app()->name; ?>

<h1>Добро пожаловать на блог программиста!</h1>

<p>Меня зовут Дмитрий. Я веб-программист, занимаюсь созданием сайтов. 
   На этом блоге находятся мои заметки по программированию. Многие идеи взяты 
у других авторов, часть текста - первод с английского, что-то придумал сам).
</p>

        <?php 
// создаём контроллер, основываясь на нашем роуте
//\$p      = Yii::app()->createController('Post');
// берем функцию           
//\$result = \$p[0]->someFunction(\$params);
// или экшен
//\$r      = \$p[0]->actionIndex();
//echo \$r;
\$this->renderPartial('/post/index',array('dataProvider'=>\$dataProvider)); 
        ?>
";
    }

    public function getTemplateName()
    {
        return "\\views\\site\\index.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}

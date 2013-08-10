<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Просмотр записей', 'url'=>array('index')),
	array('label'=>'Управление записями', 'url'=>array('admin')),
);
?>

<h1>Create Post</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
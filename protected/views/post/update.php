<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Просмотр записей', 'url'=>array('index')),
	array('label'=>'Новая запись', 'url'=>array('create')),
	array('label'=>'Просмотр записи', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление записями', 'url'=>array('admin')),
);
?>

<h1>Update Post <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
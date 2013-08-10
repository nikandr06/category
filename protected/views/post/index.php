<?php
$this->breadcrumbs=array(
	'Записи',
);
$this->menu=array(
	array('label'=>'Новая запись', 'url'=>array('create')),
	array('label'=>'Управление записями', 'url'=>array('admin')),
);
?>

<?php if(!empty($_GET['tag'])): ?>
<h1>Записи с тегом <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php endif; ?>
<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/post/_view',
    'template'=>"{items}\n{pager}",
)); ?>

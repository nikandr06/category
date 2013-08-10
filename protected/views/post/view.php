<?php
$this->breadcrumbs=array(
	'Записи'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Просмотр постов', 'url'=>array('index')),
	array('label'=>'Создать пост', 'url'=>array('create')),
	array('label'=>'Обновить пост', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить пост', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление постами', 'url'=>array('admin')),
);
?>

<div class="post">
	<h1 class="title">
		<?php echo CHtml::encode($model->title); ?>
	</h1>
	<div class="author">
		опубликовано <?php echo $model->author->username .
          ', дата публикации  ' . Yii::app()->dateFormatter->format("dd MMMM y, HH:mm", $model->create_time); ?>
	</div>
	<div class="content">
		<?php
//			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $model->content;
//			$this->endWidget();
		?>
	</div>
	<div class="nav">
            <b>Рубрика:</b>
            <span> <?php echo CHtml::link($model->category->title,'/category/view/id/'.$model->category->id); ?></span>
            <b> | </b><b>Tags:</b>
		<?php echo implode(', ', $model->tagLinks); ?>
		<br/>
		Последнее обновление <?php echo Yii::app()->dateFormatter->format("dd MMMM y, HH:mm", $model->update_time); ?>
	</div>
</div>

<div id="comments">
    <?php if($model->commentCount>=1): ?>
        <h3>
            <?php echo $model->commentCount . 'комментарий(я)'; ?>
        </h3>
 
        <?php $this->renderPartial('_comments',array(
            'post'=>$model,
            'comments'=>$model->comments,
        )); ?>
    <?php endif; ?>

    <h3>Оставить комментарий</h3>
 
    <?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </div>
    <?php else: ?>
        <?php $this->renderPartial('/comment/_form',array(
            'model'=>$comment,
        )); ?>
    <?php endif; ?>
 
</div><!-- comments -->
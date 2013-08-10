<div class="post">
	<div class="page-header">
            <h2><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h2>
	</div>
	<div class="author">
		опубликовано <?php echo $data->author->username .
              ', дата публикации  ' . Yii::app()->dateFormatter->format("dd MMMM y, HH:mm",$data->create_time); ?>
	</div>
	<div class="content">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->description;
			$this->endWidget();
            echo CHtml::link('Читать дальше', $data->url, array('class'=>'readmore'));
		?>
	</div>
    <div class="clear"></div>
    <?php //print_r(phpinfo()); ?>
	<div class="nav">
            <b>Рубрика:</b>
            <span> <?php $cat=$data->category; 
  //          echo 'aaa='; print_r($cat);
            $title=$cat['title'];
            $id=$cat['id'];
//            $id=$data->category->id;
            echo CHtml::link($title,'/category/view/id/'.$id); 
            ?></span>
            <b> | </b><b>Tags:</b>
		<?php echo implode(', ', $data->tagLinks); ?>
		<br/>
		<?php echo CHtml::link("Комментариев ({$data->commentCount})",$data->url.'#comments'); ?> |
                Последнее обновление <?php echo Yii::app()->dateFormatter->format("dd MMMM y, HH:mm", $data->update_time);//$wt=strtotime($data->update_time); echo date('F j, Y',$wt);?>
	</div>
</div>
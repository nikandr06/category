<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div id="sidebar" class="span3">
    <?php $this->widget('RubricsPost')?>
		<?php
                   if(!Yii::app()->user->isGuest) 
                   {
                       $this->widget('UserMenu', array(
//                            'titleCssClass'=>'brand',
 ///    			'htmlOptions'=>array('class'=>'nav nav-tabs nav-stacked'),
                       )); 
                   }  
/*			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Операции',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
                 } */
		?>
<?php $this->widget('MonthlyArchives', array(
//        'titleCssClass'=>'nav-header',
        'maxItems'=>Yii::app()->params['monthlyArchivesCount'],
)); ?>

    <?php $this->widget('TagCloud', array(
        'maxTags'=>Yii::app()->params['tagCloudCount'],
    )); ?>
                    

    <?php $this->widget('RecentComments', array(
        'maxComments'=>Yii::app()->params['recentCommentCount'],
    )); ?>
                    
    </div><!-- sidebar -->
    <div class="span9">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>
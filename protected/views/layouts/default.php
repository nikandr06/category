<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="left-sidebar">
		<?php
                   if(!Yii::app()->user->isGuest) 
                   {
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
                       $this->widget('UserMenu'); 
			$this->endWidget();
                   }  
                 else {
    
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
                 } 
		?>
    <?php $this->widget('TagCloud', array(
        'maxTags'=>Yii::app()->params['tagCloudCount'],
    )); ?>
                    

    <?php $this->widget('RecentComments', array(
        'maxComments'=>Yii::app()->params['recentCommentCount'],
    )); ?>
                    
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>
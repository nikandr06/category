<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-5 last">
		<div id="left-sidebar">
    <?php $this->widget('RubricsPost')?>
		<?php
                   if(!Yii::app()->user->isGuest) 
                   {
                       $this->widget('UserMenu'); 
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
               

    <?php $this->widget('RecentComments', array(
        'maxComments'=>Yii::app()->params['recentCommentCount'],
    )); ?>
                    
		</div><!-- left-sidebar -->
	</div>
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
    <div class="span-5 last">
       <div id="right-sidebar">
    <?php $this->widget('TagCloud', array(
        'maxTags'=>Yii::app()->params['tagCloudCount'],
    )); ?>
       </div> <!-- right-sidebar -->
    </div>    
</div>
<?php $this->endContent(); ?>
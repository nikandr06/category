<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); 
                          if( isset($update) && $update)
                          {                     //         echo 'aaaaaaaaaaaaaaa';
                             echo 'Изменить родителя?'.CHtml::checkBox('flag_old', $flag_old, 
                                     array('id'=>'type_select',  'onclick'=>'checked_parent('."'#type_select','#doc_t'".')' 
                               ))                              
                       ?>
        
	<div id="doc_t" class="control-group" style="display: none">
	          <?php echo $form->labelEx($model,'parent'); ?>
  <?php echo $form->dropDownList($model,'parent', Category::show_category_up($model->nom,$model->level)); ?>
	</div>
    
	<?php } else  {   ?>
	<div    class="control-group">
	            <?php echo $form->labelEx($model,'parent'); ?>
	            <?php echo $form->dropDownList($model,'parent', Category::show_category()); ?>
	</div>

	<?php }   ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="control-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', 
                        array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
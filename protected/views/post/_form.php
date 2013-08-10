<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="control-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php //echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'content'); ?>
<?php 
//$oldcontent=$model->content;
$this->widget('ext.ckeditor.CKEditorWidget',array(
  "model"=>$model,                 # Модель данных
  "attribute"=>'content',          # Аттрибут в модели
  "defaultValue"=>$model->content,      #Значение по умолчанию
 
  # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
  "config" => array(
      "height"=>"400px",
      "width"=>"100%",
      "toolbar"=>"Full", #панель инструментов
      "defaultLanguage"=>"ru", # Язык по умолчанию
      ),
 
  #Optional address settings if you did not copy ckeditor on application root
  "ckEditor"=>Yii::app()->basePath."/../ckeditor/ckeditor.php",
                                  # Путь к ckeditor.php
  "ckBasePath"=>Yii::app()->baseUrl."/ckeditor/",
                                  # адрес к редактору
  ) ); ?>
</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_category'); ?>
                <?php echo $form->dropDownList($model,'id_category',Category::items()); ?>
		<?php echo $form->error($model,'id_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
                <?php echo $form->dropDownList($model,'status',Lookup::items('PostStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
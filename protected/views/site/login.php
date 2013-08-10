<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Вход на сайт</h1>

<p>Пожалуйста, укажите свои данные.</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="text-warning">Поля, отмеченные <span class="required">*</span> обязательны к заполнению.</p>

	<div class="control-group">
		<?php echo $form->labelEx($model,'username', array('class'=>'control-label')); ?>
		<div class="controls">
                    <?php echo $form->textField($model,'username'); ?>
                    <span class="help-block"><?php echo $form->error($model,'username', array('class'=>'alert alert-error')); ?></span>
                </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password', array('class'=>'alert alert-error')); ?>
                </div>
	</div>

	<div class="control-group">
		<div class="controls">
                <label class="checkbox"><?php echo $model->getAttributeLabel('rememberMe'); ?>
        		<?php echo $form->checkBox($model,'rememberMe', array('class'=>'control-label')); ?>
                </label>		
		<?php echo $form->error($model,'rememberMe', array('class'=>'alert alert-error')); ?>
                </div>
	</div>

	<div class="control-group">
		<?php echo CHtml::submitButton('Войти', array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

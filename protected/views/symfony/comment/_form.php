<div class="form">

<?php $form = $this->beginWidget('CActiveForm', ['id' => 'comment-form', 'enableAjaxValidation' => true]) ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?= $form->labelEx($model, 'author') ?>
		<?= $form->textField($model, 'author[fullName]', ['size' => 60, 'maxlength' => 128]) ?>
		<?= $form->error($model, 'author') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'email') ?>
		<?= $form->textField($model, 'author[email]', ['size' => 60, 'maxlength' => 128]) ?>
		<?= $form->error($model, 'email') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'url') ?>
		<?= $form->textField($model, 'author[url]', ['size' => 60, 'maxlength' => 128]) ?>
		<?= $form->error($model, 'url') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'content') ?>
		<?= $form->textArea($model, 'content', ['rows' => 6, 'cols' => 50]) ?>
		<?= $form->error($model, 'content') ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save') ?>
	</div>

<?php $this->endWidget() ?>

</div><!-- form -->
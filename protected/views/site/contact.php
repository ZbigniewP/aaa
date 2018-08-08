<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = ['Contact'];
?>

<h1>Contact Us</h1>

<?php if (Yii::app()->user->hasFlash('contact')) : ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact') ?>
</div>

<?php else : ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm') ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= $form->errorSummary($model) ?>

	<div class="row">
		<?= $form->labelEx($model, 'name') ?>
		<?= $form->textField($model, 'name') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'email') ?>
		<?= $form->textField($model, 'email') ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'subject') ?>
		<?= $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)) ?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'body') ?>
		<?= $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)) ?>
	</div>

	<?php if (CCaptcha::checkRequirements()) : ?>
	<div class="row">
		<?= $form->labelEx($model, 'verifyCode') ?>
		<div>
		<?php $this->widget('CCaptcha') ?>
		<?= $form->textField($model, 'verifyCode') ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br />Letters are not case-sensitive.</div>
	</div>
	<?php endif; ?>

	<div class="row submit">
		<?= CHtml::submitButton('Submit') ?>
	</div>

<?php $this->endWidget() ?>

</div><!-- form -->

<?php endif; ?>
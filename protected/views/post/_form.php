<div class="form">

<?php $form = $this->beginWidget('CActiveForm')?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?= CHtml::errorSummary($model)?>

	<div class="row">
		<?= $form->labelEx($model, 'title')?>
		<?= $form->textField($model, 'title', ['size' => 80, 'maxlength' => 128])?>
		<?= $form->error($model, 'title')?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'content')?>
		<?= CHtml::activeTextArea($model, 'content', ['rows' => 10, 'cols' => 70])?>
		<p class="hint">You may use <a target="_blank" href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a>.</p>
		<?= $form->error($model, 'content')?>
	</div>

	<div class="row">
		<?php
		echo $form->labelEx($model, 'tags');
		$this->widget('CAutoComplete', [
				'model' => $model,
				'attribute' => 'tags',
				'url' => ['suggestTags'],
				'multiple' => true,
				'htmlOptions' => ['size' => 50],
			]);
		?>
		<p class="hint">Please separate different tags with commas.</p>
		<?= $form->error($model, 'tags')?>
	</div>

	<div class="row">
		<?= $form->labelEx($model, 'status')?>
		<?= $form->dropDownList($model, 'status', Lookup::items('PostStatus'))?>
		<?= $form->error($model, 'status')?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save')?>
	</div>

<?php $this->endWidget()?>

</div><!-- form -->
<!-- {#
	By default, forms enable client-side validation. This means that you can't
	test the server-side validation errors from the browser. To temporarily
	disable this validation, add the 'novalidate' attribute:
	{{ form_start(form, {method: ..., action: ..., attr: {novalidate: 'novalidate'}}) }}
#} -->
<!-- {{ form_start(form, {method: 'POST', action: path('comment_new', ['postSlug'=>$post->slug])}) }} -->
<?php $form = $this->beginWidget('CActiveForm') ?>
	<!-- {#  instead of displaying form fields one by one, you can also display them
		all with their default options and styles just by calling to this function:
		{{ form_widget(form) }}
	#} -->
	<fieldset>
		<legend>
			<i class="fa fa-comment" aria-hidden="true"></i> <?= Yii::t('messages', 'title.add_comment') ?>
		</legend>
		<!-- {# Render any global form error (e.g. when a constraint on a public getter method failed) #} -->
		{{ form_errors(form) }}
		<div class="form-group {% if not form.content.vars.valid %}has-error{% endif %}">
			{{ form_label(form.content, 'label.content', {label_attr: {class: 'hidden'}}) }}
			<!-- {# Render any errors for the "content" field (e.g. when a class property constraint failed) #} -->
			{{ form_errors(form.content) }}
			{{ form_widget(form.content, {attr: {rows: 10}}) }}
		</div>
		<div class="form-group">
			<button class="btn btn-primary pull-right" type="submit">
				<i class="fa fa-paper-plane" aria-hidden="true"></i> <?= Yii::t('messages', 'action.publish_comment') ?>
			</button>
		</div>
	</fieldset>
<?php $this->endWidget() ?>
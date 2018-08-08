<!-- {#
   Each field type is rendered by a template fragment, which is determined
   by the name of your form type class (DateTimePickerType -> date_time_picker)
   and the suffix "_widget". This can be controlled by overriding getBlockPrefix()
   in DateTimePickerType.

   See https://symfony.com/doc/current/cookbook/form/create_custom_field_type.html#creating-a-template-for-the-field
#} -->

<!-- {% block date_time_picker_widget %} -->
	<div class="input-group date" data-toggle="datetimepicker">
		{{ block('datetime_widget') }}
		<span class="input-group-addon">
			<span class="fa fa-calendar" aria-hidden="true"></span>
		</span>
	</div>
<!-- {% endblock %} -->

<!-- {% block tags_input_widget %} -->
	<div class="input-group">
		{{ form_widget(form, {'attr': {'data-toggle': 'tagsinput', 'data-tags': tags|json_encode}}) }}
		<span class="input-group-addon">
			<span class="fa fa-tags" aria-hidden="true"></span>
		</span>
	</div>
<!-- {% endblock %} -->

<?php $this->breadcrumbs = array('Update', $model->title => $model->url) ?>

<h1>Update <i><?php echo CHtml::encode($model->title) ?></i></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)) ?>
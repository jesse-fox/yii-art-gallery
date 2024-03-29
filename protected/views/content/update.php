<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create')),
	array('label'=>'View Content', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1>Update Content #<?php echo $model->id; ?></h1>

<img src="<?php echo Yii::app()->request->baseUrl . "/" . Yii::app()->params['content_path'] . "thumb/" . $model->file; ?>">

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
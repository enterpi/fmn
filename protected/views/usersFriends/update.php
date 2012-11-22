<?php
/* @var $this UsersFriendsController */
/* @var $model UsersFriends */

$this->breadcrumbs=array(
	'Users Friends'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersFriends', 'url'=>array('index')),
	array('label'=>'Create UsersFriends', 'url'=>array('create')),
	array('label'=>'View UsersFriends', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersFriends', 'url'=>array('admin')),
);
?>

<h1>Update UsersFriends <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
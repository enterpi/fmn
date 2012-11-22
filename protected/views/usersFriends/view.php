<?php
/* @var $this UsersFriendsController */
/* @var $model UsersFriends */

$this->breadcrumbs=array(
	'Users Friends'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsersFriends', 'url'=>array('index')),
	array('label'=>'Create UsersFriends', 'url'=>array('create')),
	array('label'=>'Update UsersFriends', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersFriends', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsersFriends', 'url'=>array('admin')),
);
?>

<h1>View UsersFriends #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'users_id',
		'users_friend_id',
		'status',
	),
)); ?>

<?php
/* @var $this UsersFriendsController */
/* @var $model UsersFriends */

$this->breadcrumbs=array(
	'Users Friends'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsersFriends', 'url'=>array('index')),
	array('label'=>'Manage UsersFriends', 'url'=>array('admin')),
);
?>

<h1>Create UsersFriends</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
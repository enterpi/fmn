<?php
/* @var $this UsersFriendsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Friends',
);

$this->menu=array(
	array('label'=>'Create UsersFriends', 'url'=>array('create')),
	array('label'=>'Manage UsersFriends', 'url'=>array('admin')),
);
?>

<h1>Users Friends</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

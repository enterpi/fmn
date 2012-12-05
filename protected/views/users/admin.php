<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--
<h1>Manage Users</h1>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<div class="admin_menu">
    <ul class="nav nav-tabs m_b_0">
      <li class="active"><a href="#">Users</a></li>
      <li><a href="#">Questions</a></li>
    </ul>
</div>

<div class="userlist">
	<div class="f_r">
        	<a href="#" rel="adduser" class="btn btn_fgt m_b_10" type="button"><i class="icon-plus-sign icon-white m_r_5"></i>Add Users</a>
    </div>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'users-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            'first_name',
            'last_name',
            'email_address',
            'gender',
            'birthday',
            
            //'id',
            //'password',
            'physical_address',
            /*'created_by',
            'created_date',
            'modified_by',
            'modified_date',*/
            'ipaddress',
            array(
                'class'=>'CButtonColumn',
            ),
        ),
            'pager'=>array('header'=>''),
            'enableSorting'=>true,
    )); ?>
</div>
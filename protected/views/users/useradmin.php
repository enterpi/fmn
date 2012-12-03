<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

/* $this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
); */
?>


<div class="wrapper_home">
	<div class="admin_menu">
    	<ul class="nav nav-tabs m_b_0">
          <li class="active"><a href="#">Users</a></li>
          <li><a href="#">Questions</a></li>
        </ul>
    </div>
	<div class="userlist">
    	<div class="f_r">
        	<a href="#data" rel="adduser" class="btn btn_fgt m_b_10" type="button"><i class="icon-plus-sign icon-white m_r_5"></i>Add Users</a>
        </div>
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Birthday</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
           <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
            <tr>
              <td>Mark</td>
              <td>Otto</td>
              <td>otto.mark@gmail.com</td>
              <td>Male</td>
              <td>1985-08-26</td>
              <td>
                <a href="#edit" rel="editpro"><i class="icon-pencil m_r_10"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="pagination">
      <ul>
        <li><a href="#">Prev</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
      </ul>
    </div>
</div>
<div style="display:none">
    <div id="data">
        <div class="heading">Add Users</div>
        
    </div>
</div>
<div style="display:none">
    <div id="edit">
        <div class="heading">Edit</div>
        
    </div>
</div>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=adduser]',
    //'config'=>array('autoDimensions'=>false,'width'=>'400','height'=>'100'),
    )
);
?>
<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=editpro]',
    //'config'=>array('autoDimensions'=>false,'width'=>'400','height'=>'100'),
    )
);
?>
<style>
    #data{
        font-size:13px;
		min-height:100px;
		min-width:377px;
    }
	#edit{
        font-size:13px;
		min-height:100px;
		min-width:377px;
    }
</style>
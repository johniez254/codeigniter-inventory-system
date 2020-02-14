<?php
//$op="posted_by='admin'";
$this->db->select('*');
$this->db->from('profiles');
//$this->db->where($op);
$prof	=	$this->db->count_all_results();
//echo $prof;
?>

            
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Users &raquo; User Management</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            <?php
								
								//confirm for absence of error (incase no error instance)
								if(form_error('name')=='' && form_error('username')=='' && form_error('phone')=='' && form_error('address')=='' &&form_error('idno')==''){
								
								 ?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-users"></i> Current Users</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-square"></i> Add User</a>
                                    </li>                                    
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    <div class=" row">
                                    <div class=" col-lg-12">
                                    <div class="tile well">
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group">
                                         <a href="#" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/users/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" target="_blank" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/users/pdf' ?>"  class="btn btn-white" data-toggle="tooltip" data-placement="top" target="_blank" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                        
                                        <div class="table-responsive" style="display:none;">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('fullnames'); ?></th>
                                                <th><?php echo get_phrase('username'); ?></th>
                                                <th><?php echo get_phrase('phone'); ?></th>
                                                <th><?php echo get_phrase('address'); ?></th>
                                                <th><?php echo get_phrase('idno'); ?></th>
                                                <th><?php echo get_phrase('datereg'); ?></th>
                                                <th><?php echo get_phrase('role'); ?></th>
                                                <th><?php echo get_phrase('Status'); ?></th>
                                                <?php /*?><th><?php echo get_phrase('action'); ?></th><?php */?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
				
								$emp	=	$this->db->get('profiles' )->result_array();
								$i=1;
                                foreach($emp as $row):?>					
								<?php $id=$row['id']; ?>
								<?php $fn= $row['fullnames'];?>
								<?php $un= $row['username'];?>
								<?php $p= $row['phone'];?>
								<?php $ad= $row['address'];?>
								<?php $idno= $row['idno'];?>
								<?php $d= $row['datereg'];?>
								<?php $role= $row['role'];?>
                                <?php
                                $status      =	$this->db->get_where('login' , array('user_id'=>$id))->row()->login_status;
								?>
				
               
	
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $fn; ?></td>
                                                <td><?php echo $un; ?></td>
                                                <td class="center">+254<?php echo $p ?></td>
                                                <td class="center"><?php echo $ad ?></td>
                                                <td class="center"><?php echo $idno ?></td>
                                              <td class="center"><?php echo date('M,d,Y', $d) ?></td>
                                              <td class="center"><?php echo $role ?></td>
                                              <td class="center">
											  	<?php if($status=='active'): ?>
                                                <span class="badge blue"><i class="fa fa-check"></i> Active</span>
                                                <?php endif ?> 
                                                <?php if($status=='disabled'): ?>
                                                <span class="badge default"><i class="fa fa-times"></i> Disabled</span>
                                                <?php endif ?>
                                              </td>
                                                <?php /*?><td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/users/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> <?php echo get_phrase('edit'); ?></small></a>
                                            </li>
                                            <?php if($status=='active'): ?>
                                                <li><a href="#" onclick="confirm_deactivate('<?php echo base_url();?>admin/users/disable/<?php echo $id;?>');"><small><i class="fa fa-times"></i> Disable</small></a>
                                            </li>
                                                <?php endif ?>
                                                <?php if($status=='disabled'): ?>
                                                <li><a href="#" onclick="confirm_activate('<?php echo base_url();?>admin/users/activate/<?php echo $id;?>');"><small><i class="fa fa-check"></i> Activate</small></a>
                                            </li>
                                                <?php endif ?>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/users/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> <?php echo get_phrase('delete'); ?></small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    
</td><?php */?>
                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    
                                  
                                </div>    
                                </div>
                                <!-- /.table-responsive -->
                                <div class="row pricing-circle">
                       <?php $emp	=	$this->db->get('profiles' )->result_array();
								$i=1;
                                foreach($emp as $row):?>
                                <?php $id=$row['id']; ?>
								<?php $fn= $row['fullnames'];?>
								<?php $un= $row['username'];?>
								<?php $p= $row['phone'];?>
								<?php $ad= $row['address'];?>
								<?php $idno= $row['idno'];?>
								<?php $d= $row['datereg'];?>
								<?php $role= $row['role'];?>
                                 <?php
                                $status      =	$this->db->get_where('login' , array('user_id'=>$id))->row()->login_status;
								?>
                            <?php if ($prof=='1'){ ?><div class="col-md-12"><?php }?>
                            <?php if ($prof=='2'){ ?><div class="col-md-6"><?php }?>
                            <?php if ($prof=='3'){ ?><div class="col-md-4"><?php }?>
                            <?php if ($prof>='4'){ ?><div class="col-md-3"><?php }?>
                                <ul class="plan plan1">
                                    <li class="plan-price">
                                    	<span class="label" style="background-color: rgba(0,0,0,0.2);"><b><i class="fa fa-user"></i> <?=ucwords($role)?></b></span>
                                    </li>
                                    <?php $userpic       =	$this->db->get_where('login' , array('user_id'=>$id))->row()->id;?>
                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$userpic);?>"  alt="" width="150" height="150">
                                    <li class=""></li>
                                    <li class="plan-price" style="background-color: rgba(0,0,0,0.2);">
                                        <strong><?=$fn?></strong><br />
                                        <small><strong>+(254) <?=number_format($p, 0, '.', ' ')?></strong></small>
                                    </li>
                                    <table align="center" style="color:#fff;">
                                        <tr><td class="text-right" style="width:50%;"><strong>Username&nbsp;:</strong></td> <td class="text-left">&nbsp;<?=$un?></td></tr>
                                        <tr><td class="text-right" style="width:50%;"><strong>ID.Number&nbsp;:</strong></td> <td class="text-left">&nbsp;<?=$idno?></td></tr>
                                        <tr><td class="text-right" style="width:50%;" style="width:50%;"><strong>Address&nbsp;:</strong></td> <td class="text-left">&nbsp;<?=$ad?></td></tr>
                                        <?php if($status=='active'): ?>
                                                <tr><td class="text-right" style="width:50%;"><strong>Status&nbsp;:</strong></td> <td class="text-left">&nbsp;<span class="badge blue"><i class="fa fa-check"></i> <?=ucwords($status)?></span></td></tr>
                                        <?php endif ?>
                                        <?php if($status=='disabled'): ?>
                                                 <tr><td class="text-right" style="width:50%;"><strong>Status&nbsp;:</strong></td> <td class="text-left">&nbsp;<span class="badge default"><i class="fa fa-times"></i> <?=ucwords($status)?></span></td></tr>
                                        <?php endif ?> 
                                        <tr><td class="text-right" style="width:50%;"><strong>Date Reg&nbsp;:</strong></td> <td class="text-left">&nbsp;<?php echo date('M,d,Y', $d)?></td></tr>
                                    </table>
                                    <li class="plan-action">
                                    <div class="btn-group button-tooltips">
                                     <?php if($status=='active'): ?>
                                        <button type="button" class="btn btn-white" onclick="confirm_deactivate('<?php echo base_url();?>admin/users/disable/<?php echo $id;?>');" data-toggle="tooltip" data-placement="top" title="Disable" class="btn btn-white"><i class="fa fa-unlock-alt"></i></button>
                                        <?php endif; ?>
                                        <?php if($status=='disabled'): ?>
                                        <button type="button" class="btn btn-white" onclick="confirm_activate('<?php echo base_url();?>admin/users/activate/<?php echo $id;?>');" data-toggle="tooltip" data-placement="top" title="Activate" class="btn btn-white"><i class="fa fa-unlock"></i></button>
                                        <?php endif; ?>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('edit'); ?>" onclick="showAjaxModal('<?php echo base_url();?>admin/users/edit/<?php echo $id;?>');" class="btn btn-white"><i class="fa fa-edit"></i></button>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('delete'); ?>" onclick="confirm_modal('<?php echo base_url();?>admin/users/delete/<?php echo $id;?>');" class="btn btn-white"><i class="fa fa-trash-o"></i></button>
                                    </div>

                                        <!--<a href="#" class="btn btn-blue btn-sm">Edit</a>
                                        <a href="#" class="btn btn-red btn-sm">Delete</a>-->
                                    </li>
                                </ul>
                            </div>
                            
                    <?php endforeach ?>
                            
                            <!--/.col-md-3-->
                        </div>
                        <!--/.pricing-circle-->
                                        
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                        <!--add users form starts here-->
                                        <div class="row">
                                        <div class="col-lg-8">
                                        	 <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'admin/users/add_user', $at);?>
                                             
                                             	<?php if(form_error('name')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('fullnames'); ?></label>
														<?php
                                                        $data=array(
															'name'=>'name',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('fullnames'),
															'value'=>set_value('name'),
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('name'); ?></span>
                                                    </div>
                                                    
                                                      <?php if(form_error('username')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('username'); ?></label>
														<?php
                                                        $data=array(
															'name'=>'username',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('username'),
															'value'=>set_value('username'),
															'id'=>'basicMax',
															'class'=>'form-control',
															'maxlength'=>"20",
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('username'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('phone')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('phone'); ?> * :</label>
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><b>+254</b></span>
                                                    <input type="number" class="form-control" placeholder="<?php echo get_phrase('phone'); ?>" name="phone" value="<?php echo set_value('phone'); ?>" maxlength="9" id="basicMax">
                                                </div>

														<?php /*?><?php
                                                        $data=array(
															'name'=>'phone',
															'type'=>'number',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('phone'),
															'value'=>set_value('phone'),
															'id'=>'phone',
															'class'=>'form-control',
														);
														echo form_input($data);
														?><?php */?>
                                                        <span class="help-block"><?php echo form_error('phone'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('address')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('address'); ?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'address',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('address'),
															'value'=>set_value('address'),
															'id'=>'name',
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('address'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('idno')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>  
                                                    <div class="tooltip-demo">                                                  
                                                    <label><?php echo get_phrase('idno'); ?> * 
                                                     <a href="#" data-placement="right" data-toggle="tooltip"  title="Will be used by user as first login password!"><i class="fa fa-info-circle fa-fw text-blue"></i></a> :
                                                    </label>
                                                    </div>
														<?php
                                                        $data=array(
															'name'=>'idno',
															'type'=>'number',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('idno'),
															'value'=>set_value('idno'),
															'id'=>'idno',
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('idno'); ?></span>
                                                    </div>
                                                    <input type="hidden" name="d" value="<?php echo date('Ymd') ?>" />
                                                    <div class="form-group">
                                                    	<label><?php echo get_phrase('role'); ?> * :</label>
                                                    	<?php
														$data=array(
															'inventory manager'=>'Inventory Manager',
															'sales manager'=>'Sales Manager',
															'sales person'=>'Sales person',
														);
														$class='class="form-control"';
														echo form_dropdown('role',$data,'sales person',$class);
														?>
                                                    </div>
												 
                                        </div>
                                        <!--end of nested co-lg-8-->
                                        
                                        <!--satrt of nested co-lg-4-->
                                        	<div class="col-lg-4">
                                             
                                        <h4><?php echo get_phrase('upload_user_picture'); ?> :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo base_url().'uploads/temp.jpg'?>"  alt="User Image" >
                    </a>
                                            	<div class="form-group">
                                                                <label><?php echo get_phrase('chose_new_pic'); ?></label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_specify'); ?></p>
                                            </div>
                                        <!--end of nested co-lg-4-->
                                        
                                        </div>
                                        <div class="col-lg-12">
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> <?php echo get_phrase('add_user'); ?></button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> <?php echo get_phrase('reset'); ?></button>                                                     
                                                        </div>
                                            <?php echo form_close(); ?>
                                        <!--add users form ends here-->
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                            <?PHP }else{ ?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab"><i class="fa fa-users"></i> <?php echo get_phrase('current_users'); ?></a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-plus-square"></i> Add User</a>
                                    </li>                                    
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane  fade" id="home">
                                    
                                    <div class=" row">
                                    <div class=" col-lg-12">
                                    <div class="tile well">
                                       <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/users/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" target="_blank" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/users/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                        </div>
                                        </div>
                                        </div>
                                    </div> 
                                       <div class="table-responsive" style="display:none;">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('fullnames'); ?></th>
                                                <th><?php echo get_phrase('username'); ?></th>
                                                <th><?php echo get_phrase('phone'); ?></th>
                                                <th><?php echo get_phrase('address'); ?></th>
                                                <th><?php echo get_phrase('idno'); ?></th>
                                                <th><?php echo get_phrase('datereg'); ?></th>
                                                <th><?php echo get_phrase('role'); ?></th>
                                                <th><?php echo get_phrase('Status'); ?></th>
                                                <?php /*?><th><?php echo get_phrase('action'); ?></th><?php */?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
				
								$emp	=	$this->db->get('profiles' )->result_array();
								$i=1;
                                foreach($emp as $row):?>					
								<?php $id=$row['id']; ?>
								<?php $fn= $row['fullnames'];?>
								<?php $un= $row['username'];?>
								<?php $p= $row['phone'];?>
								<?php $ad= $row['address'];?>
								<?php $idno= $row['idno'];?>
								<?php $d= $row['datereg'];?>
								<?php $role= $row['role'];?>
                                <?php
                                $status      =	$this->db->get_where('login' , array('user_id'=>$id))->row()->login_status;
								?>
				
               
	
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $fn; ?></td>
                                                <td><?php echo $un; ?></td>
                                                <td class="center">+254<?php echo $p ?></td>
                                                <td class="center"><?php echo $ad ?></td>
                                                <td class="center"><?php echo $idno ?></td>
                                              <td class="center"><?php echo date('M,d,Y', $d) ?></td>
                                              <td class="center"><?php echo $role ?></td>
                                              <td class="center">
											  	<?php if($status=='active'): ?>
                                                <span class="badge blue"><i class="fa fa-check"></i> Active</span>
                                                <?php endif ?> 
                                                <?php if($status=='disabled'): ?>
                                                <span class="badge default"><i class="fa fa-times"></i> Disabled</span>
                                                <?php endif ?>
                                              </td>
                                                <?php /*?><td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/users/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> <?php echo get_phrase('edit'); ?></small></a>
                                            </li>
                                            <?php if($status=='active'): ?>
                                                <li><a href="#" onclick="confirm_deactivate('<?php echo base_url();?>admin/users/disable/<?php echo $id;?>');"><small><i class="fa fa-times"></i> Disable</small></a>
                                            </li>
                                                <?php endif ?>
                                                <?php if($status=='disabled'): ?>
                                                <li><a href="#" onclick="confirm_activate('<?php echo base_url();?>admin/users/activate/<?php echo $id;?>');"><small><i class="fa fa-check"></i> Activate</small></a>
                                            </li>
                                                <?php endif ?>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/users/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> <?php echo get_phrase('delete'); ?></small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    
</td><?php */?>
                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    
                                  
                                </div>    
                                </div>
                                <!-- /.table-responsive -->
                                <div class="row pricing-circle">
                       <?php $emp	=	$this->db->get('profiles' )->result_array();
								$i=1;
                                foreach($emp as $row):?>
                                <?php $id=$row['id']; ?>
								<?php $fn= $row['fullnames'];?>
								<?php $un= $row['username'];?>
								<?php $p= $row['phone'];?>
								<?php $ad= $row['address'];?>
								<?php $idno= $row['idno'];?>
								<?php $d= $row['datereg'];?>
								<?php $role= $row['role'];?>
                                 <?php
                                $status      =	$this->db->get_where('login' , array('user_id'=>$id))->row()->login_status;
								?>
                            <?php if ($prof=='1'){ ?><div class="col-md-12"><?php }?>
                            <?php if ($prof=='2'){ ?><div class="col-md-6"><?php }?>
                            <?php if ($prof=='3'){ ?><div class="col-md-4"><?php }?>
                            <?php if ($prof>='4'){ ?><div class="col-md-3"><?php }?>
                                <ul class="plan plan1">
                                    <li class="plan-price">
                                    	<span class="label" style="background-color: rgba(0,0,0,0.2);"><b><i class="fa fa-user"></i> <?=ucwords($role)?></b></span>
                                    </li>
                                    <?php $userpic       =	$this->db->get_where('login' , array('user_id'=>$id))->row()->id;?>
                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$userpic);?>"  alt="" width="150" height="150">
                                    <li class=""></li>
                                    <li class="plan-price" style="background-color: rgba(0,0,0,0.2);">
                                        <strong><?=$fn?></strong><br />
                                        <small><strong>+(254) <?=number_format($p, 0, '.', ' ')?></strong></small>
                                    </li>
                                    <table align="center" style="color:#fff;">
                                        <tr><td class="text-right" style="width:50%;"><strong>Username&nbsp;:</strong></td> <td class="text-left">&nbsp;<?=$un?></td></tr>
                                        <tr><td class="text-right" style="width:50%;"><strong>ID.Number&nbsp;:</strong></td> <td class="text-left">&nbsp;<?=$idno?></td></tr>
                                        <tr><td class="text-right" style="width:50%;" style="width:50%;"><strong>Address&nbsp;:</strong></td> <td class="text-left">&nbsp;<?=$ad?></td></tr>
                                        <?php if($status=='active'): ?>
                                                <tr><td class="text-right" style="width:50%;"><strong>Status&nbsp;:</strong></td> <td class="text-left">&nbsp;<span class="badge blue"><i class="fa fa-check"></i> <?=ucwords($status)?></span></td></tr>
                                        <?php endif ?>
                                        <?php if($status=='disabled'): ?>
                                                 <tr><td class="text-right" style="width:50%;"><strong>Status&nbsp;:</strong></td> <td class="text-left">&nbsp;<span class="badge default"><i class="fa fa-times"></i> <?=ucwords($status)?></span></td></tr>
                                        <?php endif ?> 
                                        <tr><td class="text-right" style="width:50%;"><strong>Date Reg&nbsp;:</strong></td> <td class="text-left">&nbsp;<?php echo date('M,d,Y', $d)?></td></tr>
                                    </table>
                                    <li class="plan-action">
                                    <div class="btn-group button-tooltips">
                                     <?php if($status=='active'): ?>
                                        <button type="button" class="btn btn-white" onclick="confirm_deactivate('<?php echo base_url();?>admin/users/disable/<?php echo $id;?>');" data-toggle="tooltip" data-placement="top" title="Disable" class="btn btn-white"><i class="fa fa-unlock-alt"></i></button>
                                        <?php endif; ?>
                                        <?php if($status=='disabled'): ?>
                                        <button type="button" class="btn btn-white" onclick="confirm_activate('<?php echo base_url();?>admin/users/activate/<?php echo $id;?>');" data-toggle="tooltip" data-placement="top" title="Activate" class="btn btn-white"><i class="fa fa-unlock"></i></button>
                                        <?php endif; ?>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('edit'); ?>" onclick="showAjaxModal('<?php echo base_url();?>admin/users/edit/<?php echo $id;?>');" class="btn btn-white"><i class="fa fa-edit"></i></button>
                                        <button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('delete'); ?>" onclick="confirm_modal('<?php echo base_url();?>admin/users/delete/<?php echo $id;?>');" class="btn btn-white"><i class="fa fa-trash-o"></i></button>
                                    </div>

                                        <!--<a href="#" class="btn btn-blue btn-sm">Edit</a>
                                        <a href="#" class="btn btn-red btn-sm">Delete</a>-->
                                    </li>
                                </ul>
                            </div>
                            
                    <?php endforeach ?>
                            
                            <!--/.col-md-3-->
                        </div>
                        <!--/.pricing-circle-->
                                        
                                    </div>
                                    <div class="tab-pane fade in active" id="profile">
                                        <!--add users form starts here-->
                                        <div class="row">
                                        <div class="col-lg-8">
                                        	 <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'admin/users/add_user', $at);?>
                                             
                                             	<?php if(form_error('name')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('fullnames'); ?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'name',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('fullnames'),
															'value'=>set_value('name'),
															'id'=>'basicMax',
															'class'=>'form-control',
															'maxlength'=>'50'
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('name'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('username')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('username'); ?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'username',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('username'),
															'value'=>set_value('username'),
															'id'=>'basicMax',
															'class'=>'form-control',
															'maxlength'=>'20'
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('username'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('phone')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('phone'); ?> * :</label>
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><b>+254</b></span>
                                                    <input type="number" class="form-control" placeholder="<?php echo get_phrase('phone'); ?>" name="phone" autocomplete="off" value="<?php echo set_value('phone'); ?>" maxlength="9" id="basicMax">
                                                </div>
														<?php /*?><?php
                                                        $data=array(
															'name'=>'phone',
															'type'=>'number',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('phone'),
															'value'=>set_value('phone'),
															'id'=>'phone',
															'class'=>'form-control',
														);
														echo form_input($data);
														?><?php */?>
                                                        <span class="help-block"><?php echo form_error('phone'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('address')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('address'); ?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'address',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('address'),
															'value'=>set_value('address'),
															'id'=>'name',
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('address'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('idno')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <div class="tooltip-demo">                                                  
                                                    <label><?php echo get_phrase('idno'); ?> * 
                                                     <a href="#" data-placement="right" data-toggle="tooltip"  title="Will be used by user as first login password!"><i class="fa fa-info-circle fa-fw text-danger"></i></a> :
                                                    </label>
                                                    </div>
														<?php
                                                        $data=array(
															'name'=>'idno',
															'type'=>'number',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('idno'),
															'value'=>set_value('idno'),
															'id'=>'idno',
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('idno'); ?></span>
                                                    </div>
                                                    
                                                    <input type="hidden" name="d" value="<?php echo date('Ymd') ?>" />
                                                        
                                                        <div class="form-group">
                                                    	<label><?php echo get_phrase('role'); ?> * :</label>
                                                    	<?php
														$data=array(
															'inventory manager'=>'Inventory Manager',
															'sales manager'=>'Sales Manager',
															'sales person'=>'Sales person',
														);
														$class='class="form-control"';
														echo form_dropdown('role',$data,'sales person',$class);
														?>
                                                    </div>
                                                    
                                                                               
												 
                                        </div>
                                        	 <!--end of nested co-lg-8-->
                                        
                                        <!--satrt of nested co-lg-4-->
                                        	<div class="col-lg-4">
                                             
                                        <h4><?php echo get_phrase('upload_user_picture'); ?> :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo base_url().'uploads/temp.jpg'?>"  alt="User Image" >
                    </a>
                                            	<div class="form-group">
                                                                <label><?php echo get_phrase('chose_new_pic'); ?></label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								'value'=>set_value('userfile'),
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_specify'); ?></p>
                                            </div>
                                        <!--end of nested co-lg-4-->
                                        
                                        </div>
                                        				<div class="col-lg-12">
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> <?php echo get_phrase('add_user'); ?></button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> <?php echo get_phrase('reset'); ?></button>
                                                        </div>
                                            <?php echo form_close(); ?>
                                        <!--add users form ends here-->
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                            <?php }?>
                            
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                


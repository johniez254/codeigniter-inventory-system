<?php 
												$count_order_table= $this->db->count_all('supplier');
												$calc_next_order_table=	$count_order_table+1;
												$next_supply_number='SN-000'.$calc_next_order_table.'';
											 ?>
            
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('suppliers'); ?> &raquo; <?php echo get_phrase('user_management'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            <?php
								
								//confirm for absence of error (incase no error instance)
								if(form_error('sname')=='' && form_error('email')=='' && form_error('phone')=='' && form_error('address')==''){
								
								 ?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-users"></i> <?php echo get_phrase('current_suppliers'); ?></a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-square"></i> <?php echo get_phrase('add_supplier'); ?></a>
                                    </li>                                    
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/suppliers/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/suppliers/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                        
                                        <div class="table-responsive">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('supplier_number'); ?></th>
                                                <th><?php echo get_phrase('supplier_name'); ?></th>
                                                <th><?php echo get_phrase('phone'); ?></th>
                                                <th><?php echo get_phrase('email'); ?></th>
                                                <th><?php echo get_phrase('address'); ?></th>
                                                <th><?php echo get_phrase('datereg'); ?></th>
                                                <th><?php echo get_phrase('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
											$where="deleted_supplier='0'";
											$this->db->select('*');
											$this->db->from('supplier');
											$this->db->where($where);
											$desc	=	$this->db->get()->result_array();
								$i=1;
                                foreach($desc as $row):
											$sid=$row['supplier_id'];
											$sn=$row['supplier_number'];
											$sname=$row['supplier_name'];
											$p=$row['supplier_phone'];
											$add=$row['supplier_address'];
											$semail=$row['supplier_email'];
											$sdate=$row['date_added'];
								
										?>
               
	
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $sname; ?></td>
                                                <td class="center"><?php echo '0'.$p ?></td>
                                                <td class="center"><?php echo $semail ?></td>
                                                <td class="center"><?php echo $add ?></td>
                                              <td class="center"><?php echo date('d,M,Y', $sdate) ?></td>
                                                <td class="center" style="width:150px;">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action');?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/suppliers/edit/<?php echo $sid;?>');"><small><i class="fa fa-edit"></i> <?php echo get_phrase('edit_details'); ?></small></a>
                                            </li>
                                            <li>
                                              <a href="<?php echo base_url().'admin/suppliers/view_details/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sid)))))))).'' ?>"><small><i class="fa fa-arrow-circle-right"></i> <?php echo get_phrase('view_details'); ?></small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/suppliers/delete/<?php echo $sid;?>');"><small><i class="fa fa-trash-o"></i> <?php echo get_phrase('delete'); ?></small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    
</td>
                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    
                                  
                                    
                                </div>
                                </div>
                                <!-- /.table-responsive -->
                                        
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                        <!--add users form starts here-->
                                        <div class="row">
                                        <div class="col-lg-8">
                                        	 <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'admin/suppliers/add_supplier', $at);?>
                                             
                                             	
													<div class="form-group">                                                    
                                                    <label><?php echo get_phrase('supplier_number'); ?> :</label>
														<?php
                                                        $data=array(
															'name'=>'s',
															'type'=>'text',
															'value'=>$next_supply_number,
															'class'=>'form-control',
															'readonly'=>"readonly"
														);
														echo form_input($data);
														?>
                                                    </div>
                                                    
                                                      <?php if(form_error('sname')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('supplier_name'); ?> :</label>
														<?php
                                                        $data=array(
															'name'=>'sname',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('supplier_name'),
															'value'=>set_value('sname'),
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('sname'); ?></span>
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
                                                    
                                                    <?php if(form_error('email')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('email'); ?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'email',
															'type'=>'email',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('email'),
															'value'=>set_value('email'),
															'id'=>'idno',
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('email'); ?></span>
                                                    </div>
                                                    <input type="hidden" name="d" value="<?php echo date('Ymd') ?>" />
                                                    
												 
                                        </div>
                                        <!--end of nested co-lg-8-->
                                        
                                        <!--satrt of nested co-lg-4-->
                                        	<div class="col-lg-4">
                                             
                                        <h4><?php echo get_phrase('u_s_p'); ?> :</h4>

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
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_specify');?></p>
                                            </div>
                                        <!--end of nested co-lg-4-->
                                        
                                        </div>
                                        <div class="col-lg-12">
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> <?php echo get_phrase('add_supplier');?></button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> <?php echo get_phrase('reset');?></button>                                                     
                                                        </div>
                                            <?php echo form_close(); ?>
                                        <!--add users form ends here-->
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                            <?PHP }else{ ?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab"><i class="fa fa-users"></i> <?php echo get_phrase('current_suppliers');?></a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-plus-square"></i> <?php echo get_phrase('add_supplier');?></a>
                                    </li>                                    
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane  fade" id="home">
                                          <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print');?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/suppliers/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/suppliers/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                        <div class="table-responsive">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('supplier_number');?></th>
                                                <th><?php echo get_phrase('supplier_name');?></th>
                                                <th><?php echo get_phrase('phone');?></th>
                                                <th><?php echo get_phrase('email');?></th>
                                                <th><?php echo get_phrase('email');?></th>
                                                <th><?php echo get_phrase('datereg');?></th>
                                                <th><?php echo get_phrase('action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
											$where="deleted_supplier='0'";
											$this->db->select('*');
											$this->db->from('supplier');
											$this->db->where($where);
											$desc	=	$this->db->get()->result_array();
								$i=1;
                                foreach($desc as $row):
											$sid=$row['supplier_id'];
											$sn=$row['supplier_number'];
											$sname=$row['supplier_name'];
											$p=$row['supplier_phone'];
											$add=$row['supplier_address'];
											$semail=$row['supplier_email'];
											$sdate=$row['date_added'];
								
										?>
               
	
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $sn; ?></td>
                                                <td><?php echo $sname; ?></td>
                                                <td class="center"><?php echo '0'.$p ?></td>
                                                <td class="center"><?php echo $semail ?></td>
                                                <td class="center"><?php echo $add ?></td>
                                              <td class="center"><?php echo date('d,M,Y', $sdate) ?></td>
                                                <td class="center" style="width:150px;">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action');?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/suppliers/edit/<?php echo $sid;?>');"><small><i class="fa fa-edit"></i> <?php echo get_phrase('edit_details');?></small></a>
                                            </li>
                                             <li>
                                              <a href="<?php echo base_url().'admin/suppliers/view_details/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sid)))))))).'' ?>"><small><i class="fa fa-arrow-circle-right"></i> <?php echo get_phrase('view_details');?></small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/suppliers/delete/<?php echo $sid;?>');"><small><i class="fa fa-trash-o"></i> <?php echo get_phrase('delete');?></small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    
</td>
                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
                                  
                                    
                                </div>
                                </div>
                                <!-- /.table-responsive -->
                                        
                                    </div>
                                    <div class="tab-pane fade in active" id="profile">
                                        <!--add users form starts here-->
                                        <div class="row">
                                        <div class="col-lg-8">
                                        	 <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'admin/suppliers/add_supplier', $at);?>
                                             
                                             	<label><?php echo get_phrase('supplier_number');?> :</label>
                                                <div class="form-group">
														<?php
                                                        $data=array(
															'name'=>'s',
															'type'=>'text',
															'value'=>$next_supply_number,
															'class'=>'form-control',
															'readonly'=>"readonly"
														);
														echo form_input($data);
														?>
                                                    </div>
                                                    
                                                    <?php if(form_error('sname')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('supplier_name');?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'sname',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('supplier_name'),
															'value'=>set_value('sname'),
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('sname'); ?></span>
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
                                                        <span class="help-block"><?php echo form_error('phone'); ?></span>
                                                    </div>
                                                    
                                                    <?php if(form_error('address')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('address');?> * :</label>
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
                                                    
                                                    <?php if(form_error('email')==''){?>
                                                	<div class="form-group">
                                                    <?php }else{?>
													<div class="form-group has-error">
                                                    <?php }?>                                                    
                                                    <label><?php echo get_phrase('email');?> * :</label>
														<?php
                                                        $data=array(
															'name'=>'email',
															'type'=>'email',
															'autocomplete'=>'off',
															'placeholder'=>get_phrase('email'),
															'value'=>set_value('email'),
															'id'=>'email',
															'class'=>'form-control',
														);
														echo form_input($data);
														?>
                                                        <span class="help-block"><?php echo form_error('email'); ?></span>
                                                    </div>
                                                    
                                                                               
												 
                                        </div>
                                        	 <!--end of nested co-lg-8-->
                                        
                                        <!--satrt of nested co-lg-4-->
                                        	<div class="col-lg-4">
                                             
                                        <h4><?php echo get_phrase('u_s_p');?> :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo base_url().'uploads/temp.jpg'?>"  alt="User Image" >
                    </a>
                                            	<div class="form-group">
                                                                <label><?php echo get_phrase('chose_new_pic');?></label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								//'required'=>'required',
								'value'=>set_value('userfile'),
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_specify');?></p>
                                            </div>
                                        <!--end of nested co-lg-4-->
                                        
                                        </div>
                                        				<div class="col-lg-12">
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> <?php echo get_phrase('add_supplier');?></button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> <?php echo get_phrase('reset');?></button>
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
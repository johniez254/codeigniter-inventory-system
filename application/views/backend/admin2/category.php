<script src="<?php echo base_url(); ?>components/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>components/searchindex.js"></script>
<?php
$oc="deleted_cat=0";
$this->db->select('*');
$this->db->from('category');
$this->db->where($oc);
$count	=	$this->db->count_all_results();


?>
<!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Inventory Categories</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                             <?php
								
								//confirm for absence of error (incase no error instance)
								if(form_error('category')==''){
								
								 ?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-list-alt"></i> Categories</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-circle"></i> Add Category</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    
                                    	<div class="row">
                                        <div class="col-lg-12">
                                        <h4>All Categories (<?=$count?>)</h4>
                                        <hr>
                                        </div>
                                        <!--end nested col-lg-12-->
                                        <div class="col-lg-3">
                                            <button class="btn btn-green btn-block btn-square"><b>Categories</b></button>                                            <span><small><small><small><small><small><small><small><small><small><small><small>.</small></small></small></small></small></small></small></small></small></small></small></span>
                                            <input type="text" name="filter" id="filter" placeholder="Search category" autocomplete="off" class="form-control"; />       <br>
                                         <!--<div class="tile dark-gray"> --> 
                                        <div class="table-responsive" style="height:280px; overflow:auto;">
                                    <table class="table table-hover table-green">
                                       
                                        <tbody>
                                         <?php
								$where="deleted_cat='0'";
											$this->db->select('*');
											$this->db->from('category');
											$this->db->where($where);
											$this->db->order_by('c_name','asc');
								$cat	=	$this->db->get()->result_array();
								$i=1;
                                foreach($cat as $row):?>
													
								<?php $id=$row['category_id']; ?>
								<?php $name= $row['c_name'];?>
								<?php $state= $row['status'];
									if($state==1){$desc='available';}else{$desc='not available';}
								?>
									
				
               
	
                                            <tr class="odd gradeX"> 
                                                <td><?php echo $name; ?></td>
                                                <td>
                                                <div class="tooltip-sidebar-toggle"> 
                                                                                             
                        <a href="#" onclick="get_stock(<?php echo 'id='.$id.''; ?>);"><button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="View Category"><i class="fa fa-book"></i></button></a>
                                                <a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>admin/category/edit/<?php echo $id;?>')"><button type="button" class="btn btn-blue btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/category/delete/<?php echo $id;?>')"><button type="button" class="btn btn-red btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button></a>                      
                        
                    </div></td>
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    
                                  
                                    
                                </div>
                                <!-- /.table-responsive -->
                               <!-- </div>-->
                                <!--tile close-->
                                        
                                        </div>
                                        <!--end of col-lg-2-->
                                        <div class="col-lg-9">
                                        	<div id="category">
                                                    <div class="portlet portlet-green">
                                                        <div class="portlet-heading">
                                                            <div class="portlet-title">
                                                                <h4>Category &raquo; sugar</h4>
                                                            </div>
                                                            <div class="portlet-widgets">
                                                                <span class="divider"></span>
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#orangePortlet"><i class="fa fa-chevron-down"></i></a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div id="orangePortlet" class="panel-collapse collapse in">
                                                            <div class="portlet-body">
                                                            	 <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Products</th>
                                                <th>Available</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
				
											$op="category='1' and deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											//$this->db->insert_id();
											$this->db->where($op);
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$cat	=	$this->db->get()->result_array();
										 foreach($cat as $row):
											$n= $row['name'];
											$avail= $row['available'];
											$price= $row['s_price'];
											$stock_id= $row['stock_id'];
											$du= $row['unit'];
											$q= $row['quantity'];
										?>
                                            <tr>
                                            	<td>
                                                <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$stock_id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td><?php echo $n ?> (<?php echo $q ?> <?php echo $du ?>)</td>
                                                <td><?php echo  $avail ?></td>
                                                <td><?php echo $price ?></td>
                                            </tr>
                                             <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                    
                                    <!--start offset-->
                                    <div class="row">
                                        <div class="col-lg-6">
                        					<div class="portlet-body">
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/category/add", $attributes);?>
            
            				<div class="form-group">
                            <label>Category * :</label>
            								 <?php 
								$data=array(
								'name'=> 'category',
								'type'=>'text',
								'placeholder'=>'Add Category',
								'class'=>'form-control',
								'id'=>'category',
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            
                              <div class="form-group">
                            <label>Status * :</label>
            								 <?php 
								$status=array(
								'1'=> 'Available',
								'2'=>'Not Available',								
								);
								$class='class="form-control"';
								echo form_dropdown('status',$status,'1',$class);
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Category</button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
            
            							<?php echo form_close() ?>
                                            
                                            </div>
                                        </div>
                                    </div>    
                                    <!--end offset-->
                                        
                                    </div>
                                </div>
                                
                                <?php }else{ ?>
                                
                                                <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab"><i class="fa fa-list-alt"></i> Categories</a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-plus-circle"></i> Add Category</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade" id="home">
                                    
                                    	<div class="row">
                                        <div class="col-lg-12">
                                        <h4>All Categories (<?=$count?>)</h4>
                                        <hr>
                                        </div>
                                        <!--end nested col-lg-12-->
                                        <div class="col-lg-3">
                                            <button class="btn btn-green btn-block btn-square"><b>Categories</b></button>                                            <span><small><small><small><small><small><small><small><small><small><small><small>.</small></small></small></small></small></small></small></small></small></small></small></span>
                                            <input type="text" name="filter" id="filter" placeholder="Search category" autocomplete="off" class="form-control"; />       <br>
                                         <!--<div class="tile dark-gray"> --> 
                                        <div class="table-responsive" style="height:280px; overflow:auto;">
                                    <table class="table table-hover table-green">
                                       
                                        <tbody>
                                         <?php
								$where="deleted_cat='0'";
											$this->db->select('*');
											$this->db->from('category');
											$this->db->where($where);
											$this->db->order_by('c_name','asc');
								$cat	=	$this->db->get()->result_array();
								$i=1;
                                foreach($cat as $row):?>
													
								<?php $id=$row['category_id']; ?>
								<?php $name= $row['c_name'];?>
								<?php $state= $row['status'];
									if($state==1){$desc='available';}else{$desc='not available';}
								?>
									
				
               
	
                                            <tr class="odd gradeX"> 
                                                <td><?php echo $name; ?></td>
                                                <td>
                                                <div class="tooltip-sidebar-toggle">                                              
                        <a href="#" onclick="get_stock(<?php echo 'id='.$id.''; ?>);"><button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="View Category"><i class="fa fa-book"></i></button></a>
                                                <a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>admin/category/edit/<?php echo $id;?>')"><button type="button" class="btn btn-blue btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button></a>  
                                                <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/category/delete/<?php echo $id;?>')"><button type="button" class="btn btn-red btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button></a>   
                        
                    </div></td>
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    
                                  
                                    
                                </div>
                                <!-- /.table-responsive -->
                               <!-- </div>-->
                                <!--tile close-->
                                        
                                        </div>
                                        <!--end of col-lg-2-->
                                        <div class="col-lg-9">
                                        	<div id="category">
                                                    <div class="portlet portlet-green">
                                                        <div class="portlet-heading">
                                                            <div class="portlet-title">
                                                                <h4>Category &raquo; sugar</h4>
                                                            </div>
                                                            <div class="portlet-widgets">
                                                                <span class="divider"></span>
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#orangePortlet"><i class="fa fa-chevron-down"></i></a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div id="orangePortlet" class="panel-collapse collapse in">
                                                            <div class="portlet-body">
                                                            	 <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Products</th>
                                                <th>Available</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
				
											$op="category='1' and deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											//$this->db->insert_id();
											$this->db->where($op);
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$cat	=	$this->db->get()->result_array();
										 foreach($cat as $row):
											$n= $row['name'];
											$avail= $row['available'];
											$price= $row['s_price'];
											$stock_id= $row['stock_id'];
											$du= $row['unit'];
											$q= $row['quantity'];
										?>
                                            <tr>
                                            	<td>
                                                <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$stock_id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td><?php echo $n ?> (<?php echo $q ?> <?php echo $du ?>)</td>
                                                <td><?php echo  $avail ?></td>
                                                <td><?php echo $price ?></td>
                                            </tr>
                                             <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                            <div class="portlet-footer">
                                                                Portlet Footer - Collapses with Toggle
                                                            </div>
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                        
                                    </div>
                                    <div class="tab-pane fade in active" id="profile">
                                    
                                    <!--start offset-->
                                    <div class="row">
                                        <div class="col-lg-6">
                        					<div class="portlet-body">
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/category/add", $attributes);?>
            
            				<div class="form-group has-error">
                            <label>Category * :</label>
            								 <?php 
								$data=array(
								'name'=> 'category',
								'type'=>'text',
								'placeholder'=>'Add Category',
								'class'=>'form-control',
								'id'=>'category',
								'value'=>set_value('category'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('category'); ?></span>
                                                            </div>
                                                            
                              <div class="form-group">
                            <label>Status * :</label>
            								 <?php 
								$status=array(
								'1'=> 'Available',
								'2'=>'Not Available',								
								);
								$class='class="form-control"';
								echo form_dropdown('status',$status,'1',$class);
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Category</button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
            
            							<?php echo form_close() ?>
                                            
                                            </div>
                                        </div>
                                    </div>    
                                    <!--end offset-->
                                        
                                    </div>
                                </div>
                                
                                <?php }?>
                                
                                
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Manage Descriptions</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            <?php	
							//confirm for absence of error (incase no error instance)
								if(form_error('name[]')=='' && form_error('unit[]')=='' && form_error('quantity[]')==''){
								
							?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Descriptions</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus"></i> Add Descriptions</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                          <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/descriptions/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/descriptions/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                        
                                        <div class="table-responsive">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Description Name</th>
                                                <th>Unit</th>
                                                <th>Measurement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
				 //$where="deleted='0'";
                                        $this->db->select('*');
                                        $this->db->from('descriptions');
                                        //$this->db->where($where);
                                       	$this->db->order_by('d_name','asc');
										$desc	=	$this->db->get()->result_array();
								$i=1;
                                foreach($desc as $row):?>
													
								<?php $id=$row['description_id']; ?>
								<?php $name= $row['d_name'];?>
								<?php $un= $row['unit'];?>
								<?php $q= $row['quantity'];?>
				
               
	
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?>.</td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $un; ?></td>
                                                <td class="center"><?php echo $q ?></td>
                                                <td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/descriptions/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/descriptions/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
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
                                    <!--home tab end-->
                                    
                                    <div class="tab-pane fade" id="profile">
                                    
                                        <!--add descriptions-->
                                    <div class="table-responsive">
                                        
              <form method="post" action="<?php echo base_url().'admin/descriptions/add' ?>">                          
			  <table class="table table-green" id="productTable">
			  	<thead>
			  		<tr>
                    	<th>No.</th>			  			
			  			<th>Description Name</th>
			  			<th>Unit</th>
			  			<th>Measurement</th>			  			
			  			<th>Delete</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 4; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                        	<td>
								<div class="form-group">
                            	<input type="button" class="form-control" value="<?php echo $x ?>." disabled="true" />
			  					</div>
                            </td>			  				
			  				<td>
			  					<div class="form-group">
									<input type="text" name="name[]" autocomplete="off" required class="form-control" placeholder="Description e.g grammes">
			  					</div>
			  				</td>
			  				<td>
                            
                            <div class="form-group">
									<input type="text" name="unit[]" autocomplete="off" required class="form-control" placeholder="e.g kg">
			  					</div>			  					
			  					<!--<input type="text" name="rate[]" id="rate<?php// echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php// echo $x; ?>" autocomplete="off" class="form-control" />	-->		  					
			  				</td>
			  				<td>
			  					<div class="form-group">
			  					<input type="text" name="quantity[]" required autocomplete="off" class="form-control" placeholder="e.g (1,2,3 XL,L) " />
			  					</div>
			  				</td>
			  				<td>
			  					<button class="btn btn-red  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
             
                                        
                                        <!--end tables descriptions-->
                                        
                                        <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus-circle"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Adding..." class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Descriptions</button>

			      <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
                  </form>
                  </div>
			    </div>
                                        
                                        
                                    </div>
                                </div>
                                
                                <?php }else{ ?>
                                
                                  <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Descriptions</a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-plus"></i> Add Descriptions</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade" id="home">
                                        
                                         <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/descriptions/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/descriptions/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                        <div class="table-responsive">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Description Name</th>
                                                <th>Unit</th>
                                                <th>Measurement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
				
								$desc	=	$this->db->get('descriptions' )->result_array();
								$i=1;
                                foreach($desc as $row):?>
													
								<?php $id=$row['description_id']; ?>
								<?php $name= $row['d_name'];?>
								<?php $un= $row['unit'];?>
								<?php $q= $row['quantity'];?>
				
               
	
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?>.</td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $un; ?></td>
                                                <td class="center"><?php echo $q ?></td>
                                                <td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/descriptions/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/descriptions/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
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
                                    <!--home tab end-->
                                    
                                    <div class="tab-pane fade in active" id="profile">
                                    
                                        <!--add descriptions-->
                                    <div class="table-responsive">
                                        
              <form method="post" action="<?php echo base_url().'admin/descriptions/add' ?>">                          
			  <table class="table table-green" id="productTable">
			  	<thead>
			  		<tr>
                    	<th>No.</th>			  			
			  			<th>Description Name</th>
			  			<th>Unit</th>
			  			<th>Measurement</th>			  			
			  			<th>Delete</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 4; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                        	<td>
								<div class="form-group">
                            	<input type="button" class="form-control" value="<?php echo $x ?>." disabled="true" />
			  					</div>
                            </td>			  				
			  				<td>
                            <?php if(form_error('name[]')==''){ ?> 
                            <div class="form-group">
									<input type="text" name="name[]" required value="<?php echo set_value('name[]');?>" autocomplete="off" class="form-control" placeholder="Description e.g grammes">
                                    <span class="help-block"><?php echo form_error('name[]'); ?></span>
			  					</div>
                                
                            <?php }else{?>                           
			  					<div class="form-group has-error">
                                <input type="text" name="name[]" required value="<?php echo set_value('name[]');?>" autocomplete="off" class="form-control" placeholder="Description e.g grammes">
                                    <span class="help-block"><?php echo form_error('name[]'); ?></span>
			  					</div>
                            <?php }?>
			  				</td>
			  				<td>
                            <?php if(form_error('unit[]')==''){ ?> 
                            <div class="form-group">
                            <input type="text" name="unit[]" value="<?php echo set_value('unit[]');?>" required autocomplete="off" class="form-control" placeholder="e.g kg">
                            <?php } else{?>
                            <div class="form-group has-error">
									<input type="text" name="unit[]" value="<?php echo set_value('unit[]');?>" required autocomplete="off" class="form-control" placeholder="e.g kg">
                                    <span class="help-block"><?php echo form_error('unit[]'); ?></span>
			  					</div>		
                                <?php }?>	  					
			  					<!--<input type="text" name="rate[]" id="rate<?php// echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php// echo $x; ?>" autocomplete="off" class="form-control" />	-->		  					
			  				</td>
			  				<td>
                             <?php if(form_error('unit[]')==''){ ?>
			  					<div class="form-group">
			  					<input type="text" placeholder="e.g (1,2,3 XL,L) " name="quantity[]" value="<?php echo set_value('quantity[]');?>" required autocomplete="off" class="form-control" min="1" />
                                <span class="help-block"><?php echo form_error('quantity[]'); ?></span>
			  					</div>
                             <?php }else{ ?>                             
			  					<div class="form-group has-error">
			  					<input type="text" placeholder="e.g (1,2,3 XL,L) " name="quantity[]" value="<?php echo set_value('quantity[]');?>" required autocomplete="off" class="form-control"/>
                                <span class="help-block"><?php echo form_error('quantity[]'); ?></span>
			  					</div>
                             <?php }?>
			  				</td>
			  				<td>
			  					<button class="btn btn-red  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
             
                                        
                                        <!--end tables descriptions-->
                                        
                                        <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus-circle"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Adding..." class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Descriptions</button>

			      <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
                  </form>
                  </div>
			    </div>
                                        
                                        
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
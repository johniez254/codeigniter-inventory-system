    <?php foreach($stock->result() as $row):
$id=$row->stock_id;
$name=$row->name;
$cat_id=$row->category;
$d_id=$row->description_id;
$q_price=$row->s_price;
$av=$row->available;
?>
<?php endforeach;?>
<?php $cat_name      =	$this->db->get_where('category' , array('category_id'=>$cat_id))->row()->c_name;?>
<?php $d_unit      =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->unit;?>
<?php $d_quat     =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->quantity;?>
<?php $d_name     =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->d_name;?>

 <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'admin/stock/update/'.$id.'', $at);?>

    <div class="row">
                                        <div class="col-lg-6">
                                             
                                                       
                                             	<div class="form-group">                                                   
                                                    <label>Stock Name:</label>
														<?php
                                                        $data=array(
															'name'=>'name',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>'name',
															'class'=>'form-control',
															'required'=>'required',
															'value'=>$name,
														);
														echo form_input($data);
														?>
                                                    </div>
                                                    
                                                      <div class="form-group">                                                   
                                                    <label>Category</label>
														 <select name="category" class="form-control" required id="category">
                              
                                    <option value="<?php echo $cat_id  ?>" selected><?php echo $cat_name; ?></option>
                              <?php 
								$c = $this->db->get('category')->result_array();
								foreach($c as $row):
									?>
                            		<option value="<?php echo $row['category_id'];?>">
										<?php echo $row['c_name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
                                                    </div>
                                                    
                                                    <div class="form-group"> 
                                                    <label>Description</label>                                                 
                                                     <select name="desc" class="form-control" onchange="return get_mdesc(this.value)" required>
                              <option value="<?php echo $d_id; ?>"><?php echo $d_name ?></option>
                              <?php 
								$this->db->distinct();
							 	$this->db->select('d_name');
							  	$this->db->from('descriptions');
								$dept = $this->db->get()->result_array();
								foreach($dept as $row):
									?>                                    
                            		<option value="<?php echo $row['d_name'];?>">
										<?php echo $row['d_name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
                                                    </div>                                                    
                                                    
                                                    <div class="form-group">                                                  
                                                    <label>Measurements * :</label>
									<select name="measure" id="measure" class="form-control">
                                    	<option value="<?php echo $d_id; ?>"><?php echo $d_quat;?> <?php echo $d_unit; ?></option>
                                    </select>
                                                    </div>
                                                    <div class="form-group">                                                  
                                                    <label>Available Stock :</label>
													<input type="number" class="form-control" required value="<?php echo $av; ?>" name="avail">
                                                    </div>
                                                    
                                                     <div class="form-group">                                                  
                                                    <label>Price (Ksh) :</label>
													<input type="number" class="form-control" required value="<?php echo $q_price; ?>" name="price" placeholder="price" min="1">
                                                    </div>
                                                    
                                                    </div>
                                        <!--end of nested colg8-->
                                        
                                        <!--satrt of nested colg4-->
                                        	<div class="col-lg-4">
                                        <h4>Upload Stock Picture :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('stock',$id);?>"  alt="Stock Image" >
                    </a>
                                            	<div class="form-group">
                                                                <label>Choose a New Picture</label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile'
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG</p>
                                            </div>
                                        <!--end of nested co-lg-4-->
                                        
                                        </div>
                                        
                                        <div class="col-lg-12">
                                        
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> Update Stock</button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
                                                        </div>
                                        <!--add users form ends here-->
                                    </div>
                                    </form>
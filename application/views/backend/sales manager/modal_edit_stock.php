    <?php foreach($stock->result() as $row):
$id=$row->stock_id;
$name=$row->name;
$cat_id=$row->category;
$d_id=$row->description_id;
$q_price=$row->s_price;
$b_price=$row->b_price;
$av=$row->available;
?>
<?php endforeach;?>
<?php $cat_name      =	$this->db->get_where('category' , array('category_id'=>$cat_id))->row()->c_name;?>
<?php $d_unit      =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->unit;?>
<?php $d_quat     =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->quantity;?>
<?php $d_name     =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->d_name;?>

 <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'salesManager/stock/pricing/'.$id.'', $at);?>

    <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 col-md-12">
                                             
                                                       
                                             	<div class="form-group">                                                   
                                                    <label>Stock Name:</label>
														<?php
                                                        $data=array(
															'name'=>'name',
															'type'=>'text',
															'autocomplete'=>'off',
															'placeholder'=>'name',
															'class'=>'form-control',
															'disabled'=>'disabled',
															'value'=>$name.' ('.$d_quat.$d_unit.')',
														);
														echo form_input($data);
														?>
                                                    </div>
                                                    
                                                     <div class="form-group">                                                  
                                                    <label>Buying Price (Ksh) :</label>
													<input type="text" class="form-control" required value="<?php echo $b_price; ?>" name="bprice" placeholder="price" min="1" disabled="disabled">
                                                    </div>
                                                    
                                                    <div class="form-group">                                                  
                                                    <label>Selling Price (Ksh) :</label>
													<input type="number" class="form-control" required value="<?php echo $q_price; ?>" name="price" placeholder="price" min="1">
                                                    </div>
                                                    
                                                    
                                        
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-check"></i> Modify</button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
                                                    
                                                    </div>
                                        <!--end of nested colg8-->
                                        
                                        <!--satrt of nested colg4-->
                                        
                                        <div class="col-lg-12">
                                                        </div>
                                        <!--add users form ends here-->
                                    </div>
                                    </form>
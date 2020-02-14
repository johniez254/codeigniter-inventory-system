 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">
                    

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Orders</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-shopping-cart"></i> Orders</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-circle"></i> New order</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        <!--table class responsive-->
                                        
                                        <div class="table-responsive">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order No</th>
                                                <th>Customer Name</th>
                                                <th>Contact</th>
                                                <th>Order Date</th>
                                                <th>Items Ordered</th>
                                                <th>Payment Status</th>
                                                <th>Approval Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											$where="deleted='0'";
											$this->db->select('*');
											$this->db->from('orders');
											$this->db->where($where);
											$desc	=	$this->db->get()->result_array();
								$i=1;
                                foreach($desc as $row):?>
								<?php $order_id= $row['order_id'];?>
                                <?php
									  $cname=$row['customer_name'];
									  $phone=$row['phone'];
									  $on=$row['order_no'];
									  $order_date=$row['order_date'];
									  $pstatus=$row['payment_status'];
									  $o_status=$row['order_status'];
								
								?>
                                <?php
								//count
                                			$oc="order_id=".$order_id."";
											$this->db->select('*');
											$this->db->from('order_item');
											$this->db->where($oc);
											$count	=	$this->db->count_all_results();
											?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $on; ?></td>
                                                <td><?php echo $cname; ?></td>
                                                <td class="center">0<?php echo $phone; ?></td>
                                                <td class="center"><?php echo date('d'.','.'M'.','.'Y',$order_date); ?></td>
                                                <td><?php echo $count; ?></td>
                                                <td class="center">
												<?php if($pstatus=='1'){ echo '<span class="label green">Full Payment</span>'; }?>
                                                <?php if($pstatus=='2'){ echo '<span class="label blue">Advance Payment</span>'; }?>
                                                <?php if($pstatus=='3'){ echo '<span class="label orange">No Payment</span>'; }?>
                                                </td>
                                                <td class="center">
												<?php if($o_status==0){ ?>
                                                <a class="btn btn-xs btn-orange disabled"><i class="fa fa-clock-o"></i> Pending</a>
                                                <?php } else{
													echo'<a class="btn btn-xs btn-default disabled"><i class="fa fa-thumbs-o-up"></i> Approved</a>';
												}
													?>
                                                </td>
                                                <td>	<?php //$key='87876656768776765654';?>
                                                	 <a href="<?php echo base_url().'user/orders/view_order/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($order_id)))))))).'' ?>" class="btn btn-xs btn-green"><i class="fa fa-arrow-circle-right"></i> View Order</a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                    <div class="success-messages"></div>
                                     <!--/success-messages-->
                                        <!--Responsive orders table-->
                                        <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/orders/add_order' ?>" id="createOrderForm">
                                        <div class="well well-sm"><center><h4>Add Stock Sales</h4></center></div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Customer Names * :</label>
                                            <div class="col-sm-10">
                                        	<input type="text" name="names" id="names" placeholder="Customer fullnames" class="form-control">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Contacts * :</label>
                                            <div class="col-sm-10">
                                        	<input type="number" autocomplete="off" name="phone" id="basicMax" maxlength="10" placeholder="Customer contacts" class="form-control">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<?php 
												$count_order_table= $this->db->count_all('orders');
												$calc_next_order_table=	$count_order_table+1;
												$next_order_number='SO-000'.$calc_next_order_table.'';
											 ?>
                                        	<label class="col-sm-2 control-label">Order No: :</label>
                                            <div class="col-sm-10">
                                        	<input type="text" name="order_no" value="<?php echo $next_order_number; ?>" class="form-control" readonly="readonly">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Order Date * :</label>
                                            <div class="col-sm-10">
                                            <div id="sandbox-container">
                                        	<input type="text" id="orderdate" name="orderdate" value="<?php echo date('m'.'/'.'d'.'/'.'Y'); ?>" placeholder="mm/dd/yyyy" class="form-control">
                                            </div>
                                        	</div>
                                        </div>
                                        
                                         <div class="table-responsive">
                                    <table class="table" id="productOrderTable">
                                        <thead>
                                            <tr>
                                            	<th>No.</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
			  							$arrayNumber = 0;
			  							for($x = 1; $x < 4; $x++) { ?>
			  							<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                        		<td><input type="button" class="form-control" value="<?php echo $x ?>." disabled="true" /></td>
                                                <td>
                                                        <select name="product[]" class="form-control" id="product<?php echo $x; ?>" onChange="getproductdata(<?php echo $x; ?>)">
                                                            
                                                            <option value="">~~ Select Product ~~</option> 
                                                            <?php
                                                                $where="deleted='0'";
                                                                $this->db->select('*');
                                                                $this->db->from('stock');
                                                                $this->db->where($where);
                                                                $this->db->order_by('name','asc');
                                                                $this->db->join('category', 'category.category_id = stock.category');
                                                                $this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
                                                                $desc	=	$this->db->get()->result_array();
                                                                foreach($desc as $row):?>
                                                                <?php $id=$row['stock_id']; ?>
                                                                <?php $cname= $row['c_name'];?>
                                                                <?php $avail= $row['available'];?>
                                                                <?php $damage= $row['damaged'];?>
                                                                <?php $price= $row['s_price'];
                                                                      $sname=$row['name'];
                                                                      $unit=$row['unit'];
                                                                      $quat=$row['quantity'];
                                                                ?>   
                                                            <option value="<?php echo $id; ?>"><?php echo $sname; ?>&nbsp;(<?php echo $quat ?>&nbsp;<?php echo $unit; ?>)</option>
                                                            <?php endforeach ?>
                                                        </select> 
                                                        <small><b><div id="spansmall<?php echo $x ?>"></div></b></small>                                             
                                                </td>
                                                <td><input type="text" name="price[]" placeholder="price" id="price<?php echo $x; ?>" class="form-control" readonly />
                                                <input type="hidden" name="priceValue[]" id="priceValue<?php echo $x; ?>" autocomplete="off"/>
                                                </td>
                                                <td><input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" min="1" class="form-control" onkeyup="getTotal(<?php echo $x ?>)"/></td>
                                                <td><input type="text" name="total[]" readonly id="total<?php echo $x; ?>" class="form-control">
                                                	<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                </td>
                                                <td><button class="btn btn-red removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash-o"></i></button></td>
                                            </tr>
                                            <?php
		  										$arrayNumber++;
			  									} // /for
			  								?>
                                        </tbody>
                                    </table>
                                <hr size="2" noshade>
                                </div>
                                <div class="row">
                                	<div class="col-lg-6">
                                    
                                    	<div class="form-group">
                                        	<label class="col-sm-4 control-label">Sub Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="sub" id="sub" readonly placeholder="sub amount" class="form-control">
                                            <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">VAT 10% :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="vat" id="vat" readonly placeholder="vat 10%" class="form-control">
                                            <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                                        	</div>
                                        </div>
                                        
                                         <div class="form-group">
                                        	<label class="col-sm-4 control-label">Total Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="tta" id="tta" readonly placeholder="total amount" class="form-control">
                                            <input type="hidden" class="form-control" id="ttavalue" name="ttavalue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Discount :</label>
                                            <div class="col-sm-8">
                                        	<input type="number" name="discount" id="discount" placeholder="discount" min="0" onkeyup="discountFunc()" class="form-control">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Grand Total :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" readonly id="grand" name="grand" placeholder="grand total" class="form-control">
                                            <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
                                        	</div>
                                        </div>
                                        
                                    </div>
                                    <!--end of nested left col-lg-6-->
                                    <div class="col-lg-6">
                                    	
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Paid Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="number" name="paid" id="paid" placeholder="paid amount" min="0" onkeyup="paidAmount()" class="form-control">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Due Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="due" id="due" readonly placeholder="due amount" class="form-control">
                                            <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Payment Type :</label>
                                            <div class="col-sm-8">
                                        	<select name="ptype" id="ptype" class="form-control">
                                            	<option value="1" selected>Cash</option>
                                                <option value="2">Cheque</option>
                                                <option value="3">Credit card</option>
                                            </select>
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Payment Status :</label>
                                            <div class="col-sm-8">
                                        	<select name="pstatus" id="pstatus" class="form-control">
                                            	<option value="1" selected>Full Payment</option>
                                                <option value="2">Advance Payment</option>
                                                <option value="3">No payment</option>
                                            </select>
                                        	</div>
                                        </div>
                                        
                                    </div>
                                    <!--end of nested col-lg-6 right--> 
                                <div class="col-sm-offset-2 col-sm-10">
                                	<div id="orderbuttons">
                                    <button type="button" class="btn btn-default  removeProductRowBtn" onclick="addOrdersRow()" id="addOrderRowBtn" data-loading-text="<i class='fa fa-plus-circle'></i> Adding..."><i class="fa fa-plus-circle"></i> Add Row</button> 
                                    <button class="btn btn-green removeProductRowBtn" type="submit" onclick="validateOrder()" id="createOrderBtn" data-loading-text="<i class='fa fa-check-circle'></i> Placing..."/><i class="fa fa-check-circle"></i> Place Order</button>
                                    <button type="reset" onclick="resetOrderForm()" class="btn btn-orange removeProductRowBtn"><i class="fa fa-eraser"></i> Reset</button> 
                                    </div>
                                </div> 
                                
                           		</div>
                                <!--end of class nested row-->    
                                        <!--end of responsive order table-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                
                
               
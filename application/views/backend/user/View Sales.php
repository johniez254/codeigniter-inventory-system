 <?php $setting_id=$this->db->get_where('settings', array('id' => 1)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$s_id=$row->id;
$sname=$row->systemname;
$st=$row->systemtitle;
$s_address=$row->address;
$em=$row->email;
$s_phone=$row->phone;
//$cur=$row->currency;
?> <?php endforeach;?>
<?php foreach($id->result() as $row):
$order_id=$row->order_id;
$order_no=$row->order_no;
$order_date=$row->order_date;
$c_name=$row->customer_name;
$c_phone=$row->phone;
$order_status=$row->order_status;
$sub_amount=$row->sub_total;
$total_amount=$row->total_amount;
$discount=$row->discount;
$grand_total=$row->grand_total;
$vat=$row->vat;
$paid_amount=$row->paid;
$due_amt=$row->due;
$payment_type=$row->payment_type;
$payment_status=$row->payment_status;
if($order_status=='0'){
	$out='Pending';
}else{$out='Approved';}

endforeach;
//echo $this->uri->segment('4');
?>
<?php
//count order items data
$oc="order_id=".$order_id."";
$this->db->select('*');
$this->db->from('order_item');
$this->db->where($oc);
$count	=	$this->db->count_all_results();


function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
?>
<!-- FAQ Accordion -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-body">

                                <div class="row">
                                    <div class="col-lg-9">
                                        
                                        <div class="row">
                                    <div class="col-md-6">
                                        <h2><i class="fa fa-gears"></i> <?php echo $st; ?></h2>
                                        <br>
                                        <address>
                                            <strong>Sales Invoice.</strong>
                                            <br><b>Address :</b> <?php echo $s_address; ?>
                                            <br><b>Phone :</b> <?php echo $s_phone; ?>
                                            <br><b>Email :</b> <a href="MAILTO:<?php echo $em; ?>"><?php echo $em; ?></a>
                                        </address>
                                    </div>
                                    <div class="col-md-6 invoice-terms">
                                        <h3>Order # <?php echo $order_no; ?></h3>
                                  <p>
                                            Sales Date: <?php echo date('d'.'/'.'M'.'/'.'Y',$order_date); ?>
                                            <br>
                                            <h4>Customer</h4>
                                            <address>
                                            <strong><?php echo $c_name; ?></strong>
                                            <br>
                                            <strong>(+254) <?php  echo $c_phone; ?></strong>
                                      </address>
                                        </p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                    <hr />
                                        <h3>Items Ordered (<?php echo $count; ?>)</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                     	<th>#</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Price (Ksh.)</th>
                                                        <th>Total Price (Ksh.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 <?php
											$where="order_id=".$order_id."";
											$this->db->select('*');
											$this->db->from('order_item');
											//$this->db->join('order_item', 'order_item.order_id = orders.order_id');
											$this->db->join('stock', 'stock.stock_id = order_item.stock_id');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$this->db->where($where);
											$desc	=	$this->db->get()->result_array();
											$i=1;
                                			foreach($desc as $row):?>
                                            <?php
												$stock_name=$row['name'];
												$quantity=$row['quantity_ordered'];
												$unit=$row['unit'];
									  			$quat=$row['quantity'];
												$price=$row['price'];
												$total=$row['total'];
											?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td width="50%"><?php echo $stock_name; ?>&nbsp;(<?php echo $quat.'&nbsp;'.$unit ?>)</td>
                                                        <td><center><?php echo $quantity; ?></center></td>
                                                        <td class="text-right"><?php echo formatMoney($price,true);?></td>
                                                        <td class="text-right"><?php echo formatMoney($total,true)?></td>
                                                    </tr>
                                                  <?php endforeach?> 
                                                 	 <tr>
                                                    	<td colspan="5"></td>
                                                    </tr>
                                                  	
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong>Subtotal:</strong></td>
                                                        <td class="text-right"><strong><?php echo formatMoney($sub_amount,true); ?></strong></td>
                                                    </tr> 
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong>Vat(10%):</strong></td>
                                                        <td class="text-right"><strong><?php echo formatMoney($vat,true); ?></strong></td>
                                                    </tr> 
                                                    <?php if($discount>0):?>
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong>Discount:</strong></td>
                                                        <td class="text-right"><strong><?php echo formatMoney($discount,true); ?></strong></td>
                                                    </tr>
                                                    <?php endif; ?> 
                                                     <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><span class="text text-blue"><strong>Grand Total:</strong></span></td>
                                                        <td class="text-right"><strong><span class="text text-blue" style="border-bottom:3px double;"><?php echo formatMoney($grand_total,true); ?></span></strong></td>
                                                    </tr>
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong>Paid Amount:</strong></td>
                                                        <td class="text-right"><strong><?php echo formatMoney($paid_amount,true); ?></strong></td>
                                                    </tr>
                                                    <?php if($due_amt>=0){ ?>
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong><span class="text text-red">Due Amount:</span></strong></td>
                                                        <td class="text-right"><strong><span class="text text-red"><?php echo formatMoney($due_amt,true); ?></span></strong></td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <?php $final_due=(-$due_amt-$due_amt+$due_amt);?>
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong><span class="text text-green">Change:</span></strong></td>
                                                        <td class="text-right"><strong><span class="text text-green"><?php echo formatMoney($final_due,true); ?></span></strong></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                        <a class="btn btn-green"><i class="fa fa-print"></i> Print</a>
                                        <a class="btn btn-pinterest"><i class="fa fa-download"></i> Download PDF</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                                        
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="<?php echo base_url().'user/sales/view' ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back To Sales</a>
                                        <hr>
                                    <h3>Payment Details</h3>
                                    <p><table cellpadding="5">
                                    <tr><td>Payment Type:</td><td>
                                    <?php if($payment_type=='1'){?>
                                    <span class="label green">Cash</span>
                                    <?php } ?>
                                    <?php if($payment_type=='2'){?>
                                    <span class="label blue">Cheque</span>
                                    <?php } ?>
                                    <?php if($payment_type=='3'){?>
                                    <span class="label purple">Credit Card</span>
                                    <?php } ?></td></tr>
                                    <tr><td>Payment Status:</td><td>
                                    <?php if($payment_status=='1'){?>
                                    <span class="label green">Full Payment</span>
                                    <?php } ?>
                                    <?php if($payment_status=='2'){?>
                                    <span class="label blue">Advance Payment</span>
                                    <?php } ?>
                                    <?php if($payment_status=='3'){?>
                                    <span class="label orange">No Payment</span>
                                    <?php } ?>
                                    </td></tr></table>
                                    </p>
                                    <hr />
                                        <h3>Quick links</h3>
                                        <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'admin/suppliers/view' ?>">Suppliers</a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/outstandings/purchases' ?>">Purchase Outstandings</a>
                                            </li>
                                            
                                            <li><a href="<?php echo base_url().'admin/outstandings/sales' ?>">Sales Outstandings</a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/stock/view' ?>">Manage Stock</a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/category/view' ?>">View Categories</a>
                                            </li>
                                        </ul>
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

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



 <?php foreach($pid->result() as $row):
$purchase_id=$row->purchase_id;
$purchase_no=$row->purchase_no;
$purchase_date=$row->purchase_date;
$supplier_id=$row->supplier_id;
$sub_total=$row->sub_total;
$vat=$row->vat;
$total_amount=$row->total_amount;
$discount=$row->discount;
$grand_total=$row->grand_total;
$paid=$row->paid;
$due=$row->due;
$payment_type=$row->payment_type;
$payment_status=$row->payment_status;
$deleted_purchase=$row->deleted_purchase;
$payment_type=$row->payment_type;
$payment_status=$row->payment_status;

endforeach;
$sup_name       =	$this->db->get_where('supplier' , array('supplier_id'=>$supplier_id))->row()->supplier_name;
$sup_phone       =	$this->db->get_where('supplier' , array('supplier_id'=>$supplier_id))->row()->supplier_phone;
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
//echo $this->uri->segment('4');
?>

<?php
//count order items data
$oc="purchase_id=".$purchase_id."";
$this->db->select('*');
$this->db->from('stock');
$this->db->where($oc);
$count	=	$this->db->count_all_results();
?>
 <!-- FAQ Accordion -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-body">

                                <div class="row">
                                <div id="printer">
                                    <div class="col-lg-9">
                                        <h3><?php echo get_phrase('purchases'); ?> Invoice # <?=$purchase_no?></h3>
                                        <hr>
                                        <div class="input-group">
                                            
                                        </div>
                                        <!-- /input-group -->
                                      	<div class="col-md-6">
                                        <h4><i class="fa fa-gears"></i> <?php echo $st; ?></h4>
                                        <address>
                                            <strong><?php echo get_phrase('purchases'); ?> Invoice.</strong>
                                            <br><b><?php echo get_phrase('address'); ?> :</b> <?php echo $s_address; ?>
                                            <br><b><?php echo get_phrase('phone'); ?> :</b> <?php echo $s_phone; ?>
                                            <br><b><?php echo get_phrase('email'); ?> :</b> <a href="MAILTO:<?php echo $em; ?>"><?php echo $em; ?></a>
                                        </address>
                                    </div>
                                    
                                    <div class="col-md-6 invoice-terms">
                                        <h4><?php echo get_phrase('order_no'); ?> # <?php echo $purchase_no; ?></h4>
                                  <p>
                                            <?php echo get_phrase('purchase_date'); ?>: <?php echo date('d'.'/'.'M'.'/'.'Y',$purchase_date); ?>
                                            <br>
                                            <h4><?php echo get_phrase('supplier'); ?></h4>
                                            <address>
                                            <strong><?php echo $sup_name; ?></strong>
                                            <br>
                                            <strong>(+254) <?php  echo $sup_phone;/*substr($sup_phone,1)*/ ?></strong>
                                      </address>
                                        </p>
                                    </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3><?php echo get_phrase('purchases'); ?> (<?php echo $count; ?>)</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                     	<th>#</th>
                                                        <th><?php echo get_phrase('item'); ?></th>
                                                        <th><?php echo get_phrase('quantity'); ?></th>
                                                        <th><?php echo get_phrase('price'); ?> @ (Ksh.)</th>
                                                        <th><?php echo get_phrase('total_price'); ?> (Ksh.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 <?php
											$where="purchase_id=".$purchase_id."";
											$this->db->select('*');
											$this->db->from('stock');
											//$this->db->join('order_item', 'order_item.order_id = orders.order_id');
											//$this->db->join('stock', 'stock.stock_id = order_item.stock_id');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$this->db->where($where);
											$desc	=	$this->db->get()->result_array();
											$i=1;
                                			foreach($desc as $row):?>
                                            <?php
												$stock_name=$row['name'];
												$purchases_ordered=$row['purchases_ordered'];
												$purchase_total=$row['purchase_total'];
												$unit=$row['unit'];
									  			$quat=$row['quantity'];
												$price=$row['b_price'];
												//$total=$row['total'];
											?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td width="50%"><?php echo $stock_name; ?>&nbsp;(<?php echo $quat.'&nbsp;'.$unit ?>)</td>
                                                        <td><center><?php echo $purchases_ordered; ?></center></td>
                                                        <td class="text-right"><?php echo formatMoney($price,true);?></td>
                                                        <td class="text-right"><?php echo formatMoney($purchase_total,true)?></td>
                                                    </tr>
                                                  <?php endforeach?> 
                                                 	 <tr>
                                                    	<td colspan="5"></td>
                                                    </tr>
                                                  	
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong>Subtotal:</strong></td>
                                                        <td class="text-right"><strong><?php echo formatMoney($sub_total,true); ?></strong></td>
                                                    </tr> 
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong>Vat(5%):</strong></td>
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
                                                        <td class="text-right"><strong><?php echo formatMoney($paid,true); ?></strong></td>
                                                    </tr>
                                                    <?php if($due>=0){ ?>
                                                    <tr>
                                                    	<td colspan="3"></td>
                                                        <td class="text-left"><strong><span class="text text-red">Due Amount:</span></strong></td>
                                                        <td class="text-right"><strong><span class="text text-red"><?php echo formatMoney($due,true); ?></span></strong></td>
                                                    </tr>
                                                    <?php }else{ ?>
                                                    <?php $final_due=(-$due-$due+$due);?>
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
                                        <?php if($due>0){?>
                                        <a href="#"  onclick="showAjaxModalSmall('<?php echo base_url();?>salesManager/stock/payment/<?php echo $purchase_id;?>')" class="btn btn-green"><i class="fa fa-rub"></i> <?php echo get_phrase('pay_now'); ?></a>
                                        <?php }?>
                                        <a class="btn btn-blue" onclick="printDiv('printer')"><i class="fa fa-print"></i> <?php echo get_phrase('print'); ?> Invoice</a>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                                        
                                    </div>

                                    <div class="col-lg-3">
                                        <a href="<?php echo base_url().'salesManager/purchases/view' ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?php echo get_phrase('back_to_purchases'); ?></a>
                                        <hr>
                                    <h3><?php echo get_phrase('payment_details'); ?></h3>
                                    <p><table cellpadding="5">
                                    <tr><td><?php echo get_phrase('payment_type'); ?>:</td><td>
                                    <?php if($payment_type=='1'){?>
                                    <span class="label green">Cash</span>
                                    <?php } ?>
                                    <?php if($payment_type=='2'){?>
                                    <span class="label blue">Cheque</span>
                                    <?php } ?>
                                    <?php if($payment_type=='3'){?>
                                    <span class="label purple">Credit Card</span>
                                    <?php } ?></td></tr>
                                    <tr><td><?php echo get_phrase('payment_status'); ?>:</td><td>
                                    <?php if($payment_status=='1'){?>
                                    <span class="label green">Full Payment</span>
                                    <?php } ?>
                                    <?php if($payment_status=='2'){?>
                                    <span class="label blue">Advance Payment</span>
                                    <?php } ?>
                                    <?php if($payment_status=='2'){?>
                                    <span class="label orange">No Payment</span>
                                    <?php } ?>
                                    </td></tr></table>
                                    </p>
                                    <hr>
                                        <h4><?php echo get_phrase('quick_links'); ?></h4>
                                        <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'salesManager/sales/view' ?>"><?php echo get_phrase('sales'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'salesManager/outstandings/sales' ?>"><?php echo get_phrase('sales_outstandings'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'salesManager/stock/view' ?>"><?php echo get_phrase('manage_stock'); ?></a>
                                            </li>
                                            <li><a href="#"><?php echo get_phrase('manage_category'); ?></a>
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
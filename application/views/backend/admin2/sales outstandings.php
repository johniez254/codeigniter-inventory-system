 <?php
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
				
				$where="due>='1'";
											$this->db->select('*');
											$this->db->from('orders');
											$this->db->where($where);
											$this->db->order_by('order_date','asc');
											//$this->db->join('stock', 'stock.purchase_id = purchases.purchase_id');
											//$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
											$count	=	$this->db->count_all_results();
				
 ?>
 
 <!-- begin ADVANCED TABLES ROW -->
                <div class="row">

                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('sales_outstandings'); ?> <?php echo get_phrase('overview'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            		<?php if($count=='0'): ?>
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong><i class="fa fa-info-circle"></i> Info Alert:</strong> There are no outstanding sales records found.
                                        </div>
									<?php endif ?> <?php if($count=='0'){ ?>
                                     <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/sales/excel' ?>" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/sales/pdf' ?>" target="_blank" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" onclick="printDiv('printer')" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/sales_outstandings/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/sales_outstandings/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                    <?php } ?>
                                <div class="table-responsive">
                                <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th><?php echo get_phrase('customer'); ?></th>
                                                <th><?php echo get_phrase('sales_no'); ?></th>
                                                <th><?php echo get_phrase('sales_date'); ?></th>
                                                <th><?php echo get_phrase('items_ordered'); ?></th>
                                                <th><?php echo get_phrase('total_price'); ?> (ksh)</th>
                                                <th><?php echo get_phrase('total_paid'); ?>(ksh)</th>
                                                <th><?php echo get_phrase('balance'); ?> (ksh)</th>
                                                <th><?php echo get_phrase('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$where="due>='1'";
											$this->db->select('*');
											$this->db->from('orders');
											$this->db->where($where);
											$this->db->order_by('order_date','asc');
											//$this->db->join('order_item', 'order_item.order_id = orders.order_id');
											//$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$id=$row['order_id'];
											$name=$row['customer_name'];
											$pno=$row['order_no'];
											$pdate=$row['order_date'];
											$sname=$row['order_id'];
											$tta=$row['grand_total'];
											$ttp=$row['paid'];
											$due=$row['due'];
											
											?>
                                            <?php
								//count
                                			$oc="order_id=".$id."";
											$this->db->select('*');
											$this->db->from('order_item');
											$this->db->where($oc);
											$count	=	$this->db->count_all_results();
											?>
                                            <tr class="odd gradeX">
                                            	<td><?php echo $i++; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $pno; ?></td>
                                                <td><?php echo date('d'.', '.'M'.', '.'Y',$pdate); ?></td>
                                                <td class="text-right"><?php echo $count; ?></td>
                                                <td class="text-right"><?php echo formatMoney($tta,true); ?></td>
                                                <td class="text-right"><?php echo formatMoney($ttp,true); ?></td>
                                                <td class="text-right"><?php echo formatMoney($due,true); ?></td>
                                                <td class="center" style="width:150px;">
                                                	<div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="text-align:left; widows:20px;">
                                        	<li><a href="<?php echo base_url();?>admin/outstandings/view_sales/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($id))))))))?>;"><small><i class="fa fa-book"></i> <?php echo get_phrase('view_details'); ?></small></a>
                                            </li>
                                            <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>admin/sales/payment/<?php echo $id;?>');"><small><i class="fa fa-rub"></i> <?php echo get_phrase('pay_now'); ?></small></a>
                                            </li>
                                           <?php /*?> <li><a href="#" onclick="confirm_modal('<?php //echo base_url();?>admin/stock/delete/<?php //echo $id;?>');"><small><i class="fa fa-gavel"></i> Add to Exclusions</small></a>
                                            </li><?php */?>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
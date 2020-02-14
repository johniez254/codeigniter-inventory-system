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
											$this->db->from('purchases');
											$this->db->where($where);
											$this->db->order_by('purchase_date','asc');
											//$this->db->join('stock', 'stock.purchase_id = purchases.purchase_id');
											$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
											$count	=	$this->db->count_all_results();
				
 ?>
 
 <!-- begin ADVANCED TABLES ROW -->
                <div class="row">

                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('purchases_outstandings'); ?> <?php echo get_phrase('overview'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            		<?php if($count=='0'): ?>
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong><i class="fa fa-info-circle"></i> Info Alert:</strong> <?php echo get_phrase('p_outstandings_message'); ?>.
                                        </div>
									<?php endif ?>
                                    <?php if($count=='0'){ ?>
                                     <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i>
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
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'admin/downloads/purchase_outstandings/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a><?php */?>
                                         <a href="<?php echo base_url().'admin/downloads/purchase_outstandings/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
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
                                                <th><?php echo get_phrase('supplier'); ?></th>
                                                <th><?php echo get_phrase('purchase_number'); ?>.</th>
                                                <th><?php echo get_phrase('purchase_date'); ?></th>
                                                <th><?php echo get_phrase('total_price'); ?> (ksh)</th>
                                                <th><?php echo get_phrase('total_paid'); ?> (ksh)</th>
                                                <th><?php echo get_phrase('balance'); ?> (ksh)</th>
                                                <th><?php echo get_phrase('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$where="due>='1'";
											$this->db->select('*');
											$this->db->from('purchases');
											$this->db->where($where);
											$this->db->order_by('purchase_date','asc');
											//$this->db->join('stock', 'stock.purchase_id = purchases.purchase_id');
											$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$id=$row['supplier_id'];
											$pid=$row['purchase_id'];
											$pno=$row['purchase_no'];
											$pdate=$row['purchase_date'];
											$sname=$row['supplier_name'];
											$tta=$row['grand_total'];
											$ttp=$row['paid'];
											$due=$row['due'];
											?>
                                            <tr class="odd gradeX">
                                            	<td><?php echo $i++; ?></td>
                                                <td><?php echo $sname; ?></td>
                                                <td><?php echo $pno; ?></td>
                                                <td><?php echo date('d'.', '.'M'.', '.'Y',$pdate); ?></td>
                                                <td class="text-right"><?php echo formatMoney($tta,true); ?></td>
                                                <td class="text-right"><?php echo formatMoney($ttp,true); ?></td>
                                                <td class="text-right"><?php echo formatMoney($due,true); ?></td>
                                                <td class="center" style="width:150px;">
                                                	<div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="text-align:left; widows:20px;">
                                        	<li><a href="<?php echo base_url();?>admin/outstandings/view_purchases/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($pid))))))))?>;"><small><i class="fa fa-book"></i> <?php echo get_phrase('view_details'); ?></small></a>
                                            </li>
                                            <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>admin/stock/payment/<?php echo $pid;?>');"><small><i class="fa fa-rub"></i> <?php echo get_phrase('pay_now'); ?></small></a>
                                            </li>
                                            <?php /*?><li><a href="#" onclick="confirm_modal('<?php //echo base_url();?>admin/stock/delete/<?php //echo $id;?>');"><small><i class="fa fa-gavel"></i> Add to Exclusions</small></a>
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
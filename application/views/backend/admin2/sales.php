 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">
                    

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('sales'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-shopping-cart"></i> <?php echo get_phrase('sales'); ?></a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        <!--table class responsive-->
                                         <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'admin/downloads/sales/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a><?php */?>
                                         <a href="<?php echo base_url().'admin/downloads/sales/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                        
                                        <div class="table-responsive">
                                        <div id="printer">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('order_no'); ?></th>
                                                <th><?php echo get_phrase('customer_name'); ?></th>
                                                <th><?php echo get_phrase('phone'); ?></th>
                                                <th><?php echo get_phrase('sales_date'); ?></th>
                                                <th><?php echo get_phrase('sold_items'); ?></th>
                                                <th><?php echo get_phrase('payment_status'); ?></th>
                                                <th><?php echo get_phrase('action'); ?></th>
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
                                                <td class="text-right"><?php echo $count; ?></td>
                                                <td class="center">
												<?php if($pstatus=='1'){ echo '<span class="label green">Full Payment</span>'; }?>
                                                <?php if($pstatus=='2'){ echo '<span class="label blue">Advance Payment</span>'; }?>
                                                <?php if($pstatus=='3'){ echo '<span class="label orange">No Payment</span>'; }?>
                                                </td>
                                                
                                                <td style="width:150px;">
                                                         <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown"><?php echo get_phrase('action'); ?>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="text-align:left;">
                                        	<li><a href="<?php echo base_url().'admin/sales/view_sales/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($order_id)))))))).'' ?>"><small><i class="fa fa-arrow-circle-right"></i> <?php echo get_phrase('view_sales'); ?></small></a>
                                            </li>
                                        </ul>
                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <!-- /.table-responsive -->
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
                
                
                
               
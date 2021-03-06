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
?>
<!-- Area Chart Example -->
<div class="row">
                    <div class="col-lg-12">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Sales Details Report</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#areaChart"><i class="fa-chevron-down fa"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="areaChart" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                <center>
                                <h3>Select Date To View Sales Report</h3>
                                <form class="form-inline" role="form" method="get" action="<?php echo base_url().'user/reports/sales_reports' ?>">
                                                <div class="form-group">
                                                    <label class="sr-only" for="from">From</label>
                                                    <div id="sandbox-container">
                                                    <input required="required" type="text" name="from" class="form-control" id="from" placeholder="From">
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="To">Password</label>
                                                    <div id="sandbox-container">
                                                    <input required="required" type="text" name="to" class="form-control" id="to" placeholder="To">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-default">Reload List</button>
                                            </form>
                                            </center>
                                            <hr />
                                        <div id="printer">
                                             
                                            <?php if(isset($_GET['from']) && isset($_GET['to'])){ ?>
                                            <center><h4>Sales Report from&nbsp;<b><?php echo $_GET['from'] ?></b>&nbsp;to&nbsp;<b><?php echo $_GET['to'] ?></b></h4></center>
                                            <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> Print Report
                                                    </a>
                                    	</div>
                                    </div>
                                            <div class="table-responsive">
                                            <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order No</th>
                                                <th>Customer Name</th>
                                                <th>Contact</th>
                                                <th>Sales Date</th>
                                                <th>Items Sold</th>
                                                <th>Payment Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
										$d1=strtotime($_GET['from']);
										$d2=strtotime($_GET['to']);
									  $query = $this->db->query("select * from orders where order_date BETWEEN ".$d1." and ".$d2."");

										foreach ($query->result() as $row){
											$i='1';
											$order_id=$row->order_id;
        									$cname=$row->customer_name;
        									$on=$phone=$row->order_no;
        									$order_date=$row->order_date;
											$pstatus=$row->payment_status;
											$phone=$row->phone;
											
											$oc="order_id=".$order_id."";
											$this->db->select('*');
											$this->db->from('order_item');
											$this->db->where($oc);
											$count	=	$this->db->count_all_results();
											
									   
										?>
                                        	<tr>
                                            	<td><?php echo $i++; ?></td>
                                                <td><?php echo $on; ?></td>
                                                <td><?php echo $cname; ?></td>
                                                <td>0<?php echo $phone; ?></td>
                                                <td><?php echo date('d'.'/'.'M'.'/'.'Y',$order_date); ?></td>
                                                <td><?php echo $count; ?></td>
                                                <td><?php if($pstatus=='1'){ echo '<span class="label green">Full Payment</span>'; }?>
                                                <?php if($pstatus=='2'){ echo '<span class="label blue">Advance Payment</span>'; }?>
                                                <?php if($pstatus=='3'){ echo '<span class="label orange">No Payment</span>'; }?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        </table>
                                            

                                            <?php } ?>
                                            </div></div>
                                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                    </div>

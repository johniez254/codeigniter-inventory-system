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
                                    <h4><?php echo get_phrase('events_reports');?></h4>
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
                                <h3><?php echo get_phrase('report_select_events');?></h3>
                                <form class="form-inline" role="form" method="get" action="<?php echo base_url().'manager/reports/events_reports' ?>">
                                                <div class="form-group">
                                                    <label class="sr-only" for="from">From</label>
                                                    <div id="sandbox-container">
                                                    <input required="required" type="text" name="from" class="form-control" id="from" placeholder="<?php echo get_phrase('from');?>">
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="To">to</label>
                                                    <div id="sandbox-container">
                                                    <input required="required" type="text" name="to" class="form-control" id="to" placeholder="<?php echo get_phrase('to');?>">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-default"><?php echo get_phrase('reload_list');?></button>
                                            </form>
                                            </center>
                                            <hr />
                                        <div id="printer">
                                             
                                            <?php if(isset($_GET['from']) && isset($_GET['to'])){ ?>
                                            <center><h4><?php echo get_phrase('events_reports');?> <?php echo get_phrase('from');?>&nbsp;<b><?php echo $_GET['from'] ?></b>&nbsp;<?php echo get_phrase('to');?>&nbsp;<b><?php echo $_GET['to'] ?></b></h4></center>
                                            <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> <?php echo get_phrase('print_report');?>
                                                    </a>
                                    	</div>
                                    </div>
                                            <div class="table-responsive">
                                            <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('title');?></th>
                                                <th><?php echo get_phrase('notice');?></th>
                                                <th><?php echo get_phrase('Status');?></th>
                                                <th><?php echo get_phrase('date');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
										$d1=strtotime($_GET['from']);
										$d2=strtotime($_GET['to']);
									  $query = $this->db->query("select * from events where posted_by='admin' OR posted_by='inventory manager' AND event_date BETWEEN ".$d1." and ".$d2."");

										foreach ($query->result() as $row){
											$i='1';
											$state=$row->status;
										$title=$row->title;
										$d=$row->event_date;
										$notice=$row->notice;
										$id=$row->id;
										?>
                                        <?php if($state==0){$disp='Public';}else{$disp='Private';} ?>
                                        	<tr>
                                            	<td><?php echo $i++; ?></td>
                                                 <td><b><?php echo $title; ?></b></td>
                                                <td><?php echo $notice; ?></td>
                                                <?php if($disp=='Public'){ ?>
                                                <td><span class="badge green"><?php echo $disp; ?></span></td>
                                                <?php }else{ ?>
                                                <td><span class="badge orange"><?php echo $disp; ?></span></td>
                                                <?php } ?>
                                                <td><?php echo date('M,d,Y', $d); ?></td>
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

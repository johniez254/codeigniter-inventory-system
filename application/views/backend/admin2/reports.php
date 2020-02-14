<div class="row">
<div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('generate_reports'); ?></h4>
                                </div>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#socialButtons"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="socialButtons" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><?php echo get_phrase('inventory'); ?></h4>
                                            <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'admin/stock/stock_report' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('stock_details'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/reports/category_reports' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('category_details'); ?></a>
                                            </li>
                                        </ul>


                                        </div>

                                        <div class="col-sm-6">
                                        <h4><?php echo get_phrase('sales'); ?></h4>
                                          <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'admin/reports/sales_reports' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('sales_details'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/reports/sales_outstanding_reports' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('sales_outstanding_details'); ?></a>
                                            </li>
                                        </ul>
                                        </div>

                                    </div>
                                    <!-- /.row -->
                                    <hr />
                                    <div class="row">
                                    	<div class="col-sm-6">
                                        	<h4><?php echo get_phrase('purchases'); ?></h4>
                                            <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'admin/reports/purchases_reports' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('purchases_details'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/reports/purchases_outstanding_reports' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('p_outstandings_details'); ?></a>
                                            </li>
                                        </ul>
                                        </div>
                                    	<div class="col-sm-6">
                                        	<h4><?php echo get_phrase('events'); ?></h4>
                                            <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'admin/reports/events_reports' ?>"><i class="fa fa-chevron-right"></i> <?php echo get_phrase('events_details'); ?></a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>

								</div>
							</div>
						</div>
					</div>
				</div>
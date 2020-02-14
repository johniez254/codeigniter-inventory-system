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
 <!-- Pill Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('category_reports'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myPills" class="nav nav-pills">
                                    <li class="active"><a href="#pillHome" data-toggle="tab"><?php echo get_phrase('available_category'); ?></a>
                                    </li>
                                    <li><a href="#pillProfile" data-toggle="tab"><?php echo get_phrase('not_available_category'); ?></a>
                                    </li>
                                </ul>
                                <hr />
                                <div id="myPillsContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="pillHome">
                                    
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/category/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a>
                                         <a href="<?php echo base_url().'admin/downloads/category/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                        
                                        <div class="table-responsive">
                                         <div id="printer">
                                    <table class="table  table-green table-striped table-bordered" id="example-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('category'); ?></th>
                                                <th><?php echo get_phrase('Status'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											$where="status='1'";
											$this->db->select('*');
											$this->db->from('category');
											$this->db->where($where);
											$this->db->order_by('c_name','asc');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['category_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $status= $row['status'];?>
                                			<?php if($status==1){$a='Available';}else{ $a='Not Available';}?>                                <tr>
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <?php echo $cname; ?>
                                                </td>
                                                <td>
                                                	<?php echo $a; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                        
                                        <!--end of stock table-->
                                        
                                    </div>
                                    <div class="tab-pane fade" id="pillProfile">
                                    <?php
											$where="status='0'";
											$this->db->select('*');
											$this->db->from('category');
											$this->db->where($where);
											$count	=	$this->db->count_all_results();
											?>
                                            <?php if($count!='0'): ?>
                                        <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDivs('printers')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                    	</div>
                                        
                                    <hr />
                                    </div>
                                    <?php endif;?>
                                       
                                        <div class="table-responsive">
                                         <div id="printers">
                                    <table class="table table-striped table-bordered  table-green" id="low-stock">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo get_phrase('category'); ?></th>
                                                <th><?php echo get_phrase('Status'); ?></th
                                            ></tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											
											$where="status='0'";
											$this->db->select('*');
											$this->db->from('category');
											$this->db->where($where);
											$this->db->order_by('c_name','asc');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['category_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $status= $row['status'];?>
                                			<?php if($status==1){$a='Available';}else{ $a='Not Available';}?>                                <tr>
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <?php echo $cname; ?>
                                                </td>
                                                <td>
                                                	<?php echo $a; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                        <!--end of stock table-->
                                        
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

                                         <script type="text/javascript">
		function printDivs(printers){
			var printContents=document.getElementById(printers).innerHTML;
			var originalContents=document.body.innerHTML;
			document.body.innerHTML=printContents;
			window.print() ;
			document.body.innerHTML=printContents;
		}
	
	</script>
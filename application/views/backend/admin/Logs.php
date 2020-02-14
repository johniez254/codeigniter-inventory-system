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
				
				$where="deleted_history='0'";
											$this->db->select('*');
											$this->db->from('history_logs');
											$this->db->where($where);
											//$this->db->order_by('purchase_date','asc');
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
                                    <h4><i class="fa fa-bug"></i> <?php echo get_phrase('history'); ?> / <?php echo get_phrase('logs'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                    <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
           									 echo form_open_multipart(base_url() .'admin/logs/delete', $at);?>
                            		<?php if($count=='0'): ?>
                                        <div class="alert alert-info alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <strong><i class="fa fa-info-circle"></i> Info Alert:</strong> <?php echo get_phrase('history_message'); ?>.
                                        </div>
									<?php endif ?>
                                    <?php if($count=='0'){ ?>
                                     <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> Print History
                                                    </a>
                                    	</div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <button type="submit" onclick="return confirm('Are you sure you want to Delete?');" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete selected"><i class='fa fa-trash-o'></i></button>
                                         <a href="#" onclick="printDiv('printer')" class="btn btn-blue" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                    <?php } ?>
                                <div class="table-responsive">
                                <div id="printer">
                                    <table id="example-table" class="table table-striped table-hover table-green">
                                        <thead>
                                            <tr>
                                            	<th>
                                                <div class="button-tooltips">
                                                <input type="checkbox" id="selectall" data-toggle="tooltip" data-placement="top" title="Select All">
                                                </div>
                                                </th>
                                                <th><?php echo get_phrase('descriptions'); ?></th>
                                                <th><?php echo get_phrase('role'); ?></th>
                                                <th><?php echo get_phrase('date'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$where="deleted_history='0'";
											$this->db->select('*');
											$this->db->from('history_logs');
											$this->db->where($where);
											$this->db->order_by('date_created','desc');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$id=$row['history_id'];
											$desc=$row['description'];
											$role=$row['user_role'];
											$pdate=$row['date_created'];
											?>
                                            <tr class="odd gradeX">
                                            	<td><input type="checkbox" class="selectedId" value="<?php echo $id; ?>" name="selected[]"></td>
                                                <td><?php echo $desc; ?></td>
                                                <td><?php echo $role; ?></td>
                                                <td><?php echo date('d'.', '.'M'.', '.'Y'.' @ '.'h'.':'.'i'.'a',$pdate); ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <!-- /.table-responsive -->
                                <?php echo form_close(); ?>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
 <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Available Stock</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <span class="label green">Label</span>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#defaultPortlet"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="defaultPortlet" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'user/downloads/stock/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a><?php */?>
                                         <a href="<?php echo base_url().'user/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                   
                                     <!--stock table-->
                                         <div class="table-responsive">
                                         <div id="printer">
                                    <table id="example-table" class="table table-green">
                                        <thead>
                                            <tr>
                                                <th rowspan="2"><center>#<br /><br /></center></th>
                                                <th rowspan="2"></th>
                                                <th rowspan="2">Products<br /><br /></th>
                                                <th colspan="2"><center>Stock</center></th>
                                                <th rowspan="2"><center>Pricing (Ksh)<br /><br /></center></th>
                                            </tr>
                                            <tr>
                                                <th><center><small>Available</small></center></th>
                                                <th><center><small>Damaged</small></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											$where="deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$desc	=	$this->db->get()->result_array();
								$i=1;
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $price= $row['s_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity']
								
								?>
                                			<?php if($avail<=10){ echo '<tr style="background-color:#d9edf7;">';}else{ echo '<tr>';}?>                                
                                                <td><br /><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p class="text-blue"><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><center><?php echo $avail; ?></center></td>
                                                <td><center><?php echo $damage; ?></center></td>
                                                <td><center><?php echo $price; ?></center></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                   
                                </div>
                            </div>
                        </div>
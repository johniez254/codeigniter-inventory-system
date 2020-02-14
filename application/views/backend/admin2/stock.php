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
 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Basic Tabs Example</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            <?php
								
							//confirm for absence of error (incase no error instance)
								if(form_error('name[]')==''){								
							?>
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-gift"></i> Available Stock</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-circle"></i> Add New Stock</a>
                                    </li>
                                    <li><a href="#existing" data-toggle="tab"><i class="fa fa-pencil"></i> Update Existing Stock</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        
                                        <!--stock table-->
                                        
                                         <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'admin/downloads/stock/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a><?php */?>
                                         <a href="<?php echo base_url().'admin/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                         <div class="table-responsive">
                                         <div id="printer">
                                    <table class="table table-hover  table-green" id="example-table">
                                        <thead>
                                            <tr>
                                                <th rowspan="2"><center>#<br /><br /></center></th>
                                                <th rowspan="2"></th>
                                                <th rowspan="2"><center>Product<br /><br /></center></th>
                                                <th colspan="2"><center>Stock</center></th>
                                                <th colspan="2"><center>Pricing (Ksh)</center></th>
                                                <th rowspan="2"><center>Actions<br /><br /></center></th>
                                            </tr>
                                            <tr>
                                                <th><center><small>Available</small></center></th>
                                                <th><center><small>Damaged</small></center></th>
                                                <th><center><small>Buying price</small></center></th>
                                                <th><center><small>Selling price</small></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											$where="deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											$this->db->order_by('name','asc');
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $sprice= $row['s_price'];
								$bprice= $row['b_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity']
								
								?>
                                			<?php if($avail<=10){ echo '<tr style="background-color:#d9edf7;">';}else{ echo '<tr>';}?>                                
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p class="text-blue"><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><center><?php echo $avail; ?></center></td>
                                                <td><center><?php echo $damage; ?></center></td>
                                                <td><center><?php echo $bprice; ?></center></td>
                                                <td><center><?php echo $sprice; ?></center></td>
                                                <td style="width:150px;"><center>
                                                    	 
                                                         
                                                         
                                                         
                                                         <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="text-align:left;">
                                        	<li><a href="<?php echo base_url().'admin/stock/view_stock/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($id)))))))) ?>"><small><i class="fa fa-book"></i> View Details</small></a>
                                            </li>
                                        	<li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/stock/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Edit Details</small></a>
                                            </li>
                                            <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>admin/stock/damage/<?php echo $id;?>');"><small><i class="fa fa-tasks"></i> Mark Damaged</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/stock/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    </center>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                        
                                        <!--end of stock table-->
                                        
                                    </div>
                                    <!--end of tab-pane fade in active-->
                                    
                                    <div class="tab-pane fade" id="profile">
                                       
                                    <div class="success-messages"></div>
                                     <!--/success-messages-->
                                        <!--Responsive orders table-->
                                        <form class="form-horizontal" method="POST" action="<?php echo base_url().'admin/stock/add_stock' ?>" id="createPurchaseForm">
                             <div class="well well-sm"><center><h4>Add Stock Purchases</h4></center></div>
                
                	
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Select Supplier * :</label>
                                            <div class="col-sm-10">
                                        	<select name="supplier"  data-style="btn btn-white btn-square" class="form-control selectpicker " data-live-search="true" title="Select Supplier" id="supplier">
                              <?php 
							 	$this->db->select('*');
							  	$this->db->from('supplier');
								$dept = $this->db->get()->result_array();
								foreach($dept as $row):
									?>                                    
                            		<option value="<?php echo $row['supplier_id'];?>">
										<?php echo $row['supplier_name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
                                        	</div>
                                        </div>
                                        
                                         <div class="form-group">
                                        	<?php 
												$count_order_table= $this->db->count_all('purchases');
												$calc_next_order_table=	$count_order_table+1;
												$next_order_number='PO-000'.$calc_next_order_table.'';
											 ?>
                                        	<label class="col-sm-2 control-label">Purchase No:</label>
                                            <div class="col-sm-10">
                                        	<input type="text" name="purchase_no" value="<?php echo $next_order_number; ?>" class="form-control" readonly="readonly">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Purchase Date * :</label>
                                            <div class="col-sm-10">
                                            <div id="sandbox-container">
                                        	<input type="text" id="orderdate" name="orderdate" value="<?php echo date('m'.'/'.'d'.'/'.'Y'); ?>" placeholder="mm/dd/yyyy" class="form-control">
                                            </div>
                                        	</div>
                                        </div>
                                        
                                         <div class="table-responsive">
                                    <table class="table" id="purchaseOrderTable">
                                        <thead>
                                          	<th>No.</th>			  			
                                                <th>Stock Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>Quantity</th>
                                                <th>B.P(Ksh)</th>
                                                <th>S.P(Ksh)</th>			  			
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
			  							$arrayNumber = 0;
			  							for($x = 1; $x < 6; $x++) { ?>
			  							<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td>
                            	<input type="button" class="form-control" value="<?php echo $x ?>." disabled="true" />
                            </td>
                            <td>
									<input type="text" name="name[]" id="name<?php echo $x; ?>" autocomplete="off"  class="form-control" placeholder="Stock Name">
			  				</td>
                            <td>     
                                     <select name="category[]" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Category"  id="category<?php echo $x; ?>">
                              <?php 
								$dept = $this->db->get('category')->result_array();
								foreach($dept as $row):
									?>
                            		<option value="<?php echo $row['category_id'];?>">
										<?php echo $row['c_name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
			  				</td>
                            <td>
                                     <select name="desc[]"  data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="~~Description~~"  id="desc<?php echo $x; ?>" onchange="return get_desc(this.value, id='<?php echo $x; ?>')">
                              <?php 
								$this->db->distinct();
							 	$this->db->select('d_name');
							  	$this->db->from('descriptions');
								$dept = $this->db->get()->result_array();
								foreach($dept as $row):
									?>                                    
                            		<option value="<?php echo $row['d_name'];?>">
										<?php echo $row['d_name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
			  				</td>
			  				<td>
                            
									<select name="measurements[]" id="measurements<?php echo $x; ?>" class="form-control">
                                    	<option value="">Select Description first</option>
                                    </select>
                           	</td>
			  				<td>
			  					<input type="number" name="qt[]" onkeyup="getTotalPrice(<?php echo $x ?>)"  id="qt<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" placeholder="e.g 1,2,3..." />
			  				</td>
                            <td>
			  					<input type="number" name="b_price[]" id="b_price<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" placeholder="Buying price" onkeyup="getTotalPrice(<?php echo $x ?>)" />
			  			</td>
                             <td>
			  					<input type="number" name="s_price[]" id="s_price<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" placeholder="Selling price" />
                                <input type="hidden" name="ptotal[]" readonly id="ptotal<?php echo $x; ?>" class="form-control">
                                                	<input type="hidden" name="ptotalValue[]" id="ptotalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
			  				</td>
			  				<td>
			  					<button class="btn btn-red  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
			  				</td>
                                            </tr>
                                            <?php
		  										$arrayNumber++;
			  									} // /for
			  								?>
                                        </tbody>
                                    </table>
                                <hr size="2" noshade>
                                </div>
                                <div class="row">
                                	<div class="col-lg-6">
                                    
                                    	<div class="form-group">
                                        	<label class="col-sm-4 control-label">Sub Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="psub" id="psub" readonly placeholder="sub amount" class="form-control">
                                            <input type="hidden" class="form-control" id="psubTotalValue" name="subTotalValue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">VAT 5% :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="vat" id="pvat" readonly placeholder="vat 10%" class="form-control">
                                            <input type="hidden" class="form-control" id="pvatValue" name="vatValue" />
                                        	</div>
                                        </div>
                                        
                                         <div class="form-group">
                                        	<label class="col-sm-4 control-label">Total Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="tta" id="ptta" readonly placeholder="total amount" class="form-control">
                                            <input type="hidden" class="form-control" id="pttavalue" name="ttavalue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Discount :</label>
                                            <div class="col-sm-8">
                                        	<input type="number" name="discount" id="discount" placeholder="discount" min="0" onkeyup="pdiscountFunc()" class="form-control" step="0.5">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Grand Total :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" readonly id="pgrand" name="grand" placeholder="grand total" class="form-control">
                                            <input type="hidden" class="form-control" id="pgrandTotalValue" name="grandTotalValue" />
                                        	</div>
                                        </div>
                                        
                                    </div>
                                    <!--end of nested left col-lg-6-->
                                    <div class="col-lg-6">
                                    	
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Paid Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="number" name="paid" id="ppaid" placeholder="paid amount" min="0" onkeyup="ppaidAmount()" class="form-control">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Due Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="due" id="pdue" readonly placeholder="due amount" class="form-control">
                                            <input type="hidden" class="form-control" id="pdueValue" name="dueValue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Payment Type :</label>
                                            <div class="col-sm-8">
                                        	<select name="ptype" id="ptype" class="form-control">
                                            	<option value="1" selected>Cash</option>
                                                <option value="2">Cheque</option>
                                                <option value="3">Credit card</option>
                                            </select>
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Payment Status :</label>
                                            <div class="col-sm-8">
                                        	<select name="pstatus" id="pstatus" class="form-control">
                                            	<option value="1" selected>Full Payment</option>
                                                <option value="2">Advance Payment</option>
                                                <option value="3">No payment</option>
                                            </select>
                                        	</div>
                                        </div>
                                        
                                    </div>
                                    <!--end of nested col-lg-6 right--> 
                                <div class="col-sm-offset-2 col-sm-10">
                                	<div id="orderbuttons">
                                    <button type="button" class="btn btn-default  removeProductRowBtn" onclick="addPurchaseRow()" id="addPurchaseRowBtn" data-loading-text="<i class='fa fa-plus-circle'></i> Adding..."><i class="fa fa-plus-circle"></i> Add Row</button> 
                                    <button class="btn btn-green removeProductRowBtn" type="submit" onclick="validatePurchase()" id="createOrderBtn" data-loading-text="<i class='fa fa-check-circle'></i> Placing..."/><i class="fa fa-check-circle"></i> Purchase Stock</button>
                                    <button type="reset" onclick="presetOrderForm()" class="btn btn-orange removeProductRowBtn"><i class="fa fa-eraser"></i> Reset</button> 
                                    </div>
                                </div> 
                                
                           		</div>
                                <!--end of class nested row-->    
                                        <!--end of responsive order table-->
                                        </form>
                                </div>
                                
                                <div class="tab-pane fade" id="existing">
                                	<?php include_once 'update_existing_stock.php' ?>
                                </div>
                                
                                <?php
								//incase an error is noted
								  }else{?>
                                 <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab">Home</a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab">Profile</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade" id="home">
                                        <p>Stock</p>
                                    </div>
                                    <div class="tab-pane fade in active" id="profile">
                                        <p>Add Stock</p>
                                    </div>
                                </div>
                                
                                <?php  }?>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
<script>
//function for adding orders rows
function addPurchaseRow() {
	$("#addPurchaseRowBtn").button("loading");

	var tableLength = $("#purchaseOrderTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#purchaseOrderTable tbody tr:last").attr('id');
		arrayNumber = $("#purchaseOrderTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: '<?php echo base_url()?>admin/category/select_category',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addPurchaseRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
				'<td>'+
					'<input type="button" value="'+count+'" disabled="true" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<input type="text" name="name[]" autocomplete="off" id="name'+count+'" class="form-control" placeholder="Stock Name" />'+
				'</td>'+			  				
				'<td>'+
					'<select name="category[]" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Category"   id="category'+count+'" >'+
						'<option value="">Select Category</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value['category_id']+'">'+value['c_name']+'</option>';							
						});
													
					tr += '</select>'+
				'</td>'+
				'<td>'+
					'<select name="desc[]" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Category" id="desc'+count+'" >'+
						'<option value="">~~Description~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value['description_id']+'">'+value['d_name']+'</option>';							
						});
													
					tr += '</select>'+
				'</td>'+
				'<td>'+
					'<select name="measurements[]" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Category" id="measurements'+count+'" >'+
						'<option value="">~~Select Description~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value['description_id']+'">'+value['quantity']+'&nbsp;'+value['unit']+'</option>';							
						});
													
					tr += '</select>'+
				'</td>'+
				'<td>'+
					'<input type="number" name="qt[]" autocomplete="off" class="form-control" min="1" placeholder="e.g 1,2,3..."  onkeyup="getTotalPrice('+count+')"   id="qt'+count+'" />'+
				'</td>'+
				'<td>'+
					'<input type="number" name="b_price[]" autocomplete="off" class="form-control" min="1" placeholder="Buying price"  onkeyup="getTotalPrice('+count+')"  id="b_price'+count+'" />'+
				'</td>'+
				'<td>'+
					'<input type="number" name="s_price[]"autocomplete="off" class="form-control" min="1" placeholder="Selling price"   id="s_price'+count+'" />'+
					'<input type="hidden" name="ptotal[]" readonly id="ptotal'+count+'" class="form-control">'+
                    '<input type="hidden" name="ptotalValue[]" id="ptotalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-red removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#purchaseOrderTable tbody tr:last").after(tr);
			} else {				
				$("#purchaseOrderTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row
</script>


<script>
	 	//validateorderform
				function validatePurchase(){
				$(document).ready(function() {	

		// create order form function
		$("#createPurchaseForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var orderdate = $("#orderdate").val();
			var supplier = $("#supplier").val();
			var paid = $("#ppaid").val();
			var discount = $("#discount").val();
			var ptype = $("#ptype").val();
			var pstatus = $("#pstatus").val();		

			// form validation 
			if(orderdate == "") {
				$("#orderdate").after('<small class="text-danger"> The Order Date field is required </small>');
				$('#orderdate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderdate').closest('.form-group').addClass('has-success');
			} // /else
			
			if(supplier == "") {
				$("#supplier").after('<small class="text-danger"> Please Select Supplier!!</small>');
				$('#supplier').closest('.form-group').addClass('has-error');
			}else {
				$('#supplier').closest('.form-group').addClass('has-success');
			} // /else


			if(paid == "") {
				$("#ppaid").after('<small class="text-danger"> The Paid Amount field is required </small>');
				$('#ppaid').closest('.form-group').addClass('has-error');
			} else {
				$('#ppaid').closest('.form-group').addClass('has-success');
			} // /else

			if(discount == "") {
				$("#discount").after('<small class="text-danger"> The Discount field is required </small>');
				$('#discount').closest('.form-group').addClass('has-error');
			} else {
				$('#discount').closest('.form-group').addClass('has-success');
			} // /else

			if(ptype == "") {
				$("#ptype").after('<small class="text-danger"> The Payment Type field is required </small>');
				$('#ptype').closest('.form-group').addClass('has-error');
			} else {
				$('#ptype').closest('.form-group').addClass('has-success');
			} // /else

			if(pstatus == "") {
				$("#pstatus").after('<small class="text-danger"> The Payment Status field is required </small>');
				$('#pstatus').closest('.form-group').addClass('has-error');
			} else {
				$('#pstatus').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var productName = document.getElementsByName('name[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<small class="text-danger"> Stock Name  required!! </small>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for       		   	
	   	
	   	var quantity = document.getElementsByName('category[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<small class="text-danger"> Category Field is required!! </small>');
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for      
		
		var desc = document.getElementsByName('desc[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < desc.length; x++) {       
	 			var descId = desc[x].id;
		    if(desc[x].value == ''){	    	
		    	$("#"+descId+"").after('<small class="text-danger"> Description Field is required!! </small>');
		    	$("#"+descId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+descId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < desc.length; x++) {       						
		    if(desc[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for 
		
		var meas = document.getElementsByName('measurements[]');		   	
	   	var validateMeasure;
	   	for (var x = 0; x < meas.length; x++) {       
	 			var measId = meas[x].id;
		    if(meas[x].value == ''){	    	
		    	$("#"+measId+"").after('<small class="text-danger"> Measurement is required!! </small>');
		    	$("#"+measId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+measId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < meas.length; x++) {       						
		    if(meas[x].value){	    		    		    	
		    	validateMeasure = true;
	      } else {      	
		    	validateMeasure = false;
	      }          
	   	} // for  
		
		
		var quat = document.getElementsByName('qt[]');		   	
	   	var validateAvailable;
	   	for (var x = 0; x < quat.length; x++) {       
	 			var qtId = quat[x].id;
		    if(quat[x].value == ''){	    	
		    	$("#"+qtId+"").after('<small class="text-danger"> Quantity Field is required!! </small>');
		    	$("#"+qtId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+qtId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quat.length; x++) {       						
		    if(quat[x].value){	    		    		    	
		    	validateAvailable = true;
	      } else {      	
		    	validateAvailable = false;
	      }          
	   	} // for 
		
		
		var bp = document.getElementsByName('b_price[]');		   	
	   	var validateBp;
	   	for (var x = 0; x < bp.length; x++) {       
	 			var bpId = bp[x].id;
		    if(bp[x].value == ''){	    	
		    	$("#"+bpId+"").after('<small class="text-danger"> Input buying price!! </small>');
		    	$("#"+bpId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+bpId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < bp.length; x++) {       						
		    if(bp[x].value){	    		    		    	
		    	validateBp = true;
	      } else {      	
		    	validateBp = false;
	      }          
	   	} // for  	 	 	
	   	
		
			var sp = document.getElementsByName('s_price[]');		   	
	   	var validateSp;
	   	for (var x = 0; x < sp.length; x++) {       
	 			var spId = sp[x].id;
		    if(sp[x].value == ''){	    	
		    	$("#"+spId+"").after('<small class="text-danger"> Input Selling price!! </small>');
		    	$("#"+spId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+spId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < sp.length; x++) {       						
		    if(sp[x].value){	    		    		    	
		    	validateSp = true;
	      } else {      	
		    	validateSp = false;
	      }          
	   	} // for 

			if(orderdate && supplier && paid && discount && ptype && pstatus) {
				if(validateProduct == true && validateQuantity == true && validateMeasure == true && validateAvailable == true && validateBp==true && validateSp==true) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="fa fa-check-circle"></i></strong> '+ response.messages +
	            	''+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							document.getElementById("orderbuttons").style.display="none";
							// remove the product row
							$(".removeProductRowBtn").addClass('disabled');
							
							Messenger.options = {
								extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
								theme: 'flat'
							}
						
							Messenger().post({
								message: '<h4><i class="fa fa-check"></i> Success !!!</h4> Stock Was Added Successfully!!',
								id: "Only-one-message",
								type: 'success',
								showCloseButton: true
							});
							
							setTimeout(function(){location.reload();},5000);
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create order form function		

}); // /documernt
				}//validateorder
				

function getTotalPrice(row = null) {
	if(row) {
		var total = Number($("#b_price"+row).val()) * Number($("#qt"+row).val());
		total = total.toFixed(2);
		$("#ptotal"+row).val(total);
		$("#ptotalValue"+row).val(total);
		
		psubAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}


function psubAmount() {
	var tableProductLength = $("#purchaseOrderTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#purchaseOrderTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#ptotal"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#psub").val(totalSubAmount);
	$("#psubTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#psub").val())/100) * 5;
	vat = vat.toFixed(2);
	$("#pvat").val(vat);
	$("#pvatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#psub").val()) + Number($("#pvat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#ptta").val(totalAmount);
	$("#pttavalue").val(totalAmount);

	var discount = $("#discount").val();
	if(discount) {
		var grandTotal = Number($("#ptta").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#pgrand").val(grandTotal);
		$("#pgrandTotalValue").val(grandTotal);
	} else {
		$("#pgrand").val(totalAmount);
		$("#pgrandTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#ppaid").val();
	if(paidAmount) {
		paidAmount =  Number($("#pgrand").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#pdue").val(paidAmount);
		$("#pdueValue").val(paidAmount);
	} else {	
		$("#pdue").val($("#pgrand").val());
		$("#pdueValue").val($("#pgrand").val());
	} // else

} // /sub total amount

function pdiscountFunc() {
	var discount = $("#discount").val();
 	var totalAmount = Number($("#ptotalAmount").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#ptta").val()) - Number($("#discount").val());
 		grandTotal = grandTotal.toFixed(2);

 		$("#pgrand").val(grandTotal);
 		$("#pgrandTotalValue").val(grandTotal);
 	} else {
 	}

 	var paid = $("#ppaid").val();

 	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#pgrand").val()) - Number($("#ppaid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#pdue").val(dueAmount);
 		$("#pdueValue").val(dueAmount);
 	} else {
 		$("#pdue").val($("#pgrand").val());
 		$("#pdueValue").val($("#pgrand").val());
 	}

} // /discount function

function ppaidAmount() {
	var grandTotal = $("#pgrand").val();

	if(grandTotal) {
		var dueAmount = Number($("#pgrand").val()) - Number($("#ppaid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#pdue").val(dueAmount);
		$("#pdueValue").val(dueAmount);
	} // /if
} // /paid amoutn f


</script>

        
<script>
//reset
function presetOrderForm() {
	// reset the input field
	$("#createPurchaseForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form
</script>    
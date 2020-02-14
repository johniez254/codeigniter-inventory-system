 <div class="portlet portlet-default">
                                                <div class="portlet-body">
                                                <div class="success-messages"></div>
                                     <!--/success-messages-->
                                        <!--Responsive orders table-->
                                        <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/orders/edit_order/'.$order_id.'' ?>" id="Editform">
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Name * :</label>
                                            <div class="col-sm-10">
                                        	<input type="text" name="cname" id="cname" placeholder="Customer fullnames" class="form-control" value="<?php echo $c_name; ?>">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Contacts * :</label>
                                            <div class="col-sm-10">
                                        	<input type="number" autocomplete="off" name="contact" value="0<?php echo $c_phone; ?>" id="basicMax" maxlength="10" placeholder="Customer contacts" class="form-control">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Order No: :</label>
                                            <div class="col-sm-10">
                                        	<input type="text" name="ono" value="<?php echo $order_no; ?>" class="form-control" readonly="readonly">
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Order Date * :</label>
                                            <div class="col-sm-10">
                                            <div id="sandbox-container">
                                        	<input type="text" id="odate" name="odate" value="<?php echo date('m'.'/'.'d'.'/'.'Y',$order_date); ?>" placeholder="mm/dd/yyyy" class="form-control">
                                            </div>
                                        	</div>
                                        </div>
                                        
                                         <div class="table-responsive">
                                    <table class="table" id="ordertable">
                                        <thead>
                                            <tr>
                                            	<th>No.</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
			  							$arrayNumber = 0;
										$x=1;
			  							  $where="order_id=".$order_id."";
                                                                $this->db->select('*');
                                                                $this->db->from('order_item');
                                                                $this->db->where($where);
                                                                $s	=	$this->db->get()->result_array();
                                                                foreach($s as $row):
																$selected_stock_id= $row['stock_id'];
																$selected_price= $row['price'];
																$selected_quantity= $row['quantity_ordered'];
																$selected_total= $row['total'];
																?>
                                                                
			  							<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                                        		<td><input type="button" class="form-control" value="<?php echo $x ?>." disabled="true" /></td>
                                                <td>
                                                        <select name="oproduct[]" class="form-control" id="oproduct<?php echo $x; ?>" onChange="getpdata(<?php echo $x; ?>)">
                                                            
                                                            <option value="">~~ Select Product ~~</option> 
                                                            <?php
                                                                $where="deleted='0'";
                                                                $this->db->select('*');
                                                                $this->db->from('stock');
                                                                $this->db->where($where);
                                                                $this->db->order_by('name','asc');
                                                                $this->db->join('category', 'category.category_id = stock.category');
                                                                $this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
                                                                $desc	=	$this->db->get()->result_array();
                                                                foreach($desc as $row):?>
                                                                <?php $id=$row['stock_id']; ?>
                                                                <?php $cname= $row['c_name'];?>
                                                                <?php $avail= $row['available'];?>
                                                                <?php $damage= $row['damaged'];?>
                                                                <?php $price= $row['price'];
                                                                      $sname=$row['name'];
                                                                      $unit=$row['unit'];
                                                                      $quat=$row['quantity'];
                                                                ?>
                                                                <?php if($selected_stock_id==$id){ ?>   
                                                            <option value="<?php echo $id; ?>" selected="selected"><?php echo $sname; ?>&nbsp;(<?php echo $quat ?>&nbsp;<?php echo $unit; ?>)</option>
                                                            <?php }else{?>
                                                            <option value="<?php echo $id; ?>"><?php echo $sname; ?>&nbsp;(<?php echo $quat ?>&nbsp;<?php echo $unit; ?>)</option>
                                                            <?php }?>
                                                            <?php endforeach ?>
                                                        </select> 
                                                        <small><b><div id="ospansmall<?php echo $x ?>"></div></b></small>                                             
                                                </td>
                                                <td><input type="text" name="oprice[]" value="<?php echo $selected_price; ?>" placeholder="price" id="oprice<?php echo $x; ?>" class="form-control" readonly />
                                                <input type="hidden" name="opriceValue[]" value="<?php echo $selected_price; ?>" id="opriceValue<?php echo $x; ?>" autocomplete="off"/>
                                                </td>
                                                <td><input type="number" value="<?php echo $selected_quantity; ?>" name="oquantity[]" id="oquantity<?php echo $x; ?>" min="1" class="form-control" onkeyup="oTotal(<?php echo $x ?>)"/></td>
                                                <td><input type="text" value="<?php echo $selected_total; ?>" name="ototal[]" readonly id="ototal<?php echo $x; ?>" class="form-control">
                                                	<input type="hidden" value="<?php echo $selected_total; ?>" name="ototalValue[]" id="ototalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                                                </td>
                                                <td><button class="btn btn-red removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash-o"></i></button></td>
                                            </tr>
                                            <?php
		  										$arrayNumber++;
												$x++;
												endforeach;
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
                                        	<input type="text" name="osub" id="osub" value="<?php echo $sub_amount; ?>" readonly placeholder="osub amount" class="form-control">
                                            <input type="hidden" class="form-control" value="<?php echo $sub_amount; ?>" id="osubTotalValue" name="osubTotalValue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">VAT 10% :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="ovat" value="<?php echo $vat; ?>" id="ovat" readonly placeholder="vat 10%" class="form-control">
                                            <input type="hidden" class="form-control" value="<?php echo $vat; ?>" id="ovatValue" name="ovatValue" />
                                        	</div>
                                        </div>
                                        
                                         <div class="form-group">
                                        	<label class="col-sm-4 control-label">Total Amt :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="otta" value="<?php echo $total_amount; ?>" id="otta" readonly placeholder="total amount" class="form-control">
                                            <input type="hidden" value="<?php echo $total_amount; ?>" class="form-control" id="ottavalue" name="ottavalue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Discount :</label>
                                            <div class="col-sm-8">
                                        	<input type="number" name="odiscount" value="<?php echo $discount; ?>" id="odiscount" placeholder="discount" min="0" onkeyup="odiscountFunc()" class="form-control">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Grand Total :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" readonly id="ogrand" value="<?php echo $grand_total; ?>" name="ogrand" placeholder="grand total" class="form-control">
                                            <input type="hidden" class="form-control" value="<?php echo $grand_total; ?>" id="ograndTotalValue" name="ograndTotalValue" />
                                        	</div>
                                        </div>
                                        
                                    </div>
                                    <!--end of nested left col-lg-6-->
                                    <div class="col-lg-6">
                                    	
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Paid Amt :</label>
                                            <div class="col-sm-8">
                                        	<input type="number" name="opaid" value="<?php echo $paid_amount; ?>" id="opaid" placeholder="paid amount" min="0.5" onkeyup="opaidAmountFunc()" class="form-control">
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">Due Amount :</label>
                                            <div class="col-sm-8">
                                        	<input type="text" name="odue" value="<?php echo $due_amt; ?>" id="odue" readonly placeholder="due amount" class="form-control">
                                            <input type="hidden" class="form-control" value="<?php echo $due_amt; ?>" id="odueValue" name="odueValue" />
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">P. Type :</label>
                                            <div class="col-sm-8">
                                        	<select name="optype" id="optype" class="form-control">
                                            	<option value="1"<?php if($payment_type == 1) {
				      							echo "selected";
				      							} ?> >Cash</option>
                                                <option value="2"<?php if($payment_type == 2) {
				      							echo "selected";
				      							} ?> >Cheque</option>
                                                <option value="3"<?php if($payment_type == 3) {
				      							echo "selected";
				      							} ?> >Credit card</option>
                                            </select>
                                        	</div>
                                        </div>
                                        
                                        <div class="form-group">
                                        	<label class="col-sm-4 control-label">P. Status :</label>
                                            <div class="col-sm-8">
                                        	<select name="opstatus" id="opstatus" class="form-control">
                                            	<option value="1"<?php if($payment_status == 1) {
				      							echo "selected";
				      							} ?> >Full Payment</option>
                                            	<option value="2"<?php if($payment_status == 2) {
				      							echo "selected";
				      							} ?> >Advance Payment</option>
                                                <option value="3"<?php if($payment_status == 3) {
				      							echo "selected";
				      							} ?> >No payment</option>
                                            </select>
                                        	</div>
                                        </div>
                                        
                                    </div>
                                    <!--end of nested col-lg-6 right--> 
                                <div class="col-sm-offset-2 col-sm-10">
                                	<div id="orderbuttons">
                                    <button type="button" class="btn btn-default  removeProductRowBtn" onclick="oaddRow()" id="oBtn" data-loading-text="<i class='fa fa-plus-circle'></i> Adding..."><i class="fa fa-plus-circle"></i> Add Row</button> 
                                    <button class="btn btn-green removeProductRowBtn" type="submit" onclick="validateEdit()" id="ocreateOrderBtn" data-loading-text="<i class='fa fa-check-circle'></i> Placing..."/><i class="fa fa-check-circle"></i> Update Order</button>
                                    <button type="reset" onclick="resetOrderForm()" class="btn btn-orange removeProductRowBtn"><i class="fa fa-eraser"></i> Reset</button> 
                                    </div>
                                </div> 
                                
                           		</div>
                                <!--end of class nested row-->    
                                        <!--end of responsive order table-->
                                        </form>
                                        </div>
                                        <!--end of .portlet body-->
                                        </div>
                                        <!--end of portlet portlet default-->
                                        
<script>
function validateEdit(){

$(document).ready(function() {
	


		// create order form function
		$("#Editform").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var odate = $("#odate").val();
			var cname = $("#cname").val();
			var contact = $("#basicMax").val();
			var opaid = $("#opaid").val();
			var odiscount = $("#0discount").val();
			var optype = $("#optype").val();
			var opstatus = $("#opstatus").val();		

			// form validation 
			if(odate == "") {
				$("#odate").after('<p class="text-danger"> The Order Date field is required </p>');
				$('#odate').closest('.form-group').addClass('has-error');
			} else {
				$('#odate').closest('.form-group').addClass('has-success');
			} // /else

			if(cname == "") {
				$("#cname").after('<p class="text-danger"> The Customer Name field is required </p>');
				$('#cname').closest('.form-group').addClass('has-error');
			} else {
				$('#cname').closest('.form-group').addClass('has-success');
			} // /else

			if(contact == "") {
				$("#basicMax").after('<p class="text-danger"> The Contact field is required </p>');
				$('#basicMax').closest('.form-group').addClass('has-error');
			} else {
				$('#basicMax').closest('.form-group').addClass('has-success');
			} // /else

			if(opaid == "") {
				$("#opaid").after('<p class="text-danger"> The Paid field is required </p>');
				$('#opaid').closest('.form-group').addClass('has-error');
			} else {
				$('#opaid').closest('.form-group').addClass('has-success');
			} // /else

			if(odiscount == "") {
				$("#odiscount").after('<p class="text-danger"> The Discount field is required </p>');
				$('#odiscount').closest('.form-group').addClass('has-error');
			} else {
				$('#odiscount').closest('.form-group').addClass('has-success');
			} // /else

			if(optype == "") {
				$("#optype").after('<p class="text-danger"> The Payment Type field is required </p>');
				$('#optype').closest('.form-group').addClass('has-error');
			} else {
				$('#optype').closest('.form-group').addClass('has-success');
			} // /else

			if(opstatus == "") {
				$("#opstatus").after('<p class="text-danger"> The Payment Status field is required </p>');
				$('#opstatus').closest('.form-group').addClass('has-error');
			} else {
				$('#opstatus').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var productName = document.getElementsByName('oproduct[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
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
	   	
	   	var quantity = document.getElementsByName('oquantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
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
	   	

			if(odate && cname && contact && opaid && odiscount && optypte && opstatus) {
				if(validateProduct == true && validateQuantity == true) {
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
							$("#ocreateOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	' <br /> <br /> <a type="button" onclick="printOrder('+response.order_id+')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>'+
	            	'<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>'+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
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
}//end whole function

// print order function
function printOrder(/*orderId = null*/) {
	if(orderId) {		
			
		$.ajax({
			url: 'php_action/printOrder.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Order Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function

function oaddRow() {
	$("#oBtn").button("loading");

	var tableLength = $("#ordertable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#ordertable tbody tr:last").attr('id');
		arrayNumber = $("#ordertable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: '<?php echo base_url()?>user/orders/get_stock',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#oBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
				'<td>'+
					'<input type="button" value="'+count+'" disabled="true" class="form-control" />'+
				'</td>'+			  				
				'<td>'+
					'<select class="form-control" name="oproduct[]" id="oproduct'+count+'" onchange="getpdata('+count+')" >'+
						'<option value="">~~ Select Product ~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value['stock_id']+'">'+value['name']+'&nbsp;('+value['quantity']+'&nbsp;'+value['unit']+')'+'</option>';							
						});
													
					tr += '</select>'+
					'<small><b><div id="ospansmall'+count+'"></div></b></small>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="oprice[]" placeholder="price" id="oprice'+count+'"  readonly class="form-control" />'+
					'<input type="hidden" name="opriceValue[]" id="opriceValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<input type="number" name="oquantity[]" id="oquantity'+count+'" onkeyup="oTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
				'</td>'+
				'<td>'+
					'<input type="text" name="ototal[]" id="ototal'+count+'" autocomplete="off" class="form-control" readonly />'+
					'<input type="hidden" name="ototalValue[]" id="ototalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-red removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#ordertable tbody tr:last").after(tr);
			} else {				
				$("#ordertable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeProductRow(/*row = null*/) {
	if(row) {
		$("#row"+row).remove();


		osubAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getpdata(row = null) {
	if(row) {
		var stockid = $("#oproduct"+row).val();		
		
		if(stockid == "") {
			$("#oprice"+row).val("");

			$("#oquantity"+row).val("");						
			$("#ototal"+row).val("");

			// remove check if product name is selected
			// var tableProductLength = $("#productTable tbody tr").length;			
			// for(x = 0; x < tableProductLength; x++) {
			// 	var tr = $("#productTable tbody tr")[x];
			// 	var count = $(tr).attr('id');
			// 	count = count.substring(3);

			// 	var productValue = $("#productName"+row).val()

			// 	if($("#productName"+count).val() == "") {					
			// 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');	
			// 		console.log("#changeProduct"+count);
			// 	}											
			// } // /for

		} else {
			$.ajax({
				url: '<?php echo base_url() ?>user/orders/getproductdata',
				type: 'post',
				data: {stockid : stockid},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#oprice"+row).val(response.price);
					$("#opriceValue"+row).val(response.price);
					if(response.available > 10){
					document.getElementById("ospansmall"+row).innerHTML="Available Stock : "+response.available+"";
					document.getElementById("ospansmall"+row).style.color="#16a085";
					}
					else{
						document.getElementById("ospansmall"+row).innerHTML="Available Stock : "+response.available+""; 
						document.getElementById("ospansmall"+row).style.color="#e74c3c";
					}

					$("#oquantity"+row).val(1);

					var total = Number(response.price) * 1;
					total = total.toFixed(2);
					$("#ototal"+row).val(total);
					$("#ototalValue"+row).val(total);
					
					// check if product name is selected
					// var tableProductLength = $("#productTable tbody tr").length;					
					// for(x = 0; x < tableProductLength; x++) {
					// 	var tr = $("#productTable tbody tr")[x];
					// 	var count = $(tr).attr('id');
					// 	count = count.substring(3);

					// 	var productValue = $("#productName"+row).val()

					// 	if($("#productName"+count).val() != productValue) {
					// 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');	
					// 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');								
					// 		console.log("#changeProduct"+count);
					// 	}											
					// } // /for
			
					osubAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

// table total
function oTotal(row = null) {
	if(row) {
		var total = Number($("#oprice"+row).val()) * Number($("#oquantity"+row).val());
		total = total.toFixed(2);
		$("#ototal"+row).val(total);
		$("#ototalValue"+row).val(total);
		
		osubAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function osubAmount() {
	var tableProductLength = $("#ordertable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#ordertable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#ototal"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

// sub total
	$("#osub").val(totalSubAmount);
	$("#osubTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#osub").val())/100) * 10;
	vat = vat.toFixed(2);
	$("#ovat").val(vat);
	$("#ovatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#osub").val()) + Number($("#ovat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#otta").val(totalAmount);
	$("#ottavalue").val(totalAmount);

	var discount = $("#odiscount").val();
	if(discount) {
		var grandTotal = Number($("#otta").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#ogrand").val(grandTotal);
		$("#ograndTotalValue").val(grandTotal);
	} else {
		$("#ogrand").val(totalAmount);
		$("#ograndTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#opaid").val();
	if(paidAmount) {
		paidAmount =  Number($("#ogrand").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#odue").val(paidAmount);
		$("#odueValue").val(paidAmount);
	} else {	
		$("#odue").val($("#ogrand").val());
		$("#odueValue").val($("#ogrand").val());
	} // else

} // /sub total amount

function odiscountFunc() {
	var discount = $("#odiscount").val();
 	var totalAmount = Number($("#otta").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#otta").val()) - Number($("#odiscount").val());
 		grandTotal = grandTotal.toFixed(2);

 		$("#ogrand").val(grandTotal);
 		$("#ograndTotalValue").val(grandTotal);
 	} else {
 	}

 	var paid = $("#opaid").val();

 	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#ogrand").val()) - Number($("#opaid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#odue").val(dueAmount);
 		$("#odueValue").val(dueAmount);
 	} else {
 		$("#odue").val($("#ogrand").val());
 		$("#odueValue").val($("#ogrand").val());
 	}

} // /discount function

function opaidAmountFunc() {
	var grandTotal = $("#ogrand").val();

	if(grandTotal) {
		var dueAmount = Number($("#ogrand").val()) - Number($("#opaid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#odue").val(dueAmount);
		$("#odueValue").val(dueAmount);
	} // /if
} // /paid amoutn function


function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// remove order from server
function removeOrder(/*orderId = null*/) {
	if(orderId) {
		$("#removeOrderBtn").unbind('click').bind('click', function() {
			$("#removeOrderBtn").button('loading');

			$.ajax({
				url: 'php_action/removeOrder.php',
				type: 'post',
				data: {orderId : orderId},
				dataType: 'json',
				success:function(response) {
					$("#removeOrderBtn").button('reset');

					if(response.success == true) {

						manageOrderTable.ajax.reload(null, false);
						// hide modal
						$("#removeOrderModal").modal('hide');
						// success messages
						// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	' <br /> <br /> <a type="button" onclick="printOrder('+response.order_id+')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>'+
	            	'<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>'+
	            	
	   		       '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removeOrderMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
// /remove order from server

// Payment ORDER
function paymentOrder(/*orderId = null*/) {
	if(orderId) {

		$("#orderDate").datepicker();

		$.ajax({
			url: 'php_action/fetchOrderData.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'json',
			success:function(response) {				

				// due 
				$("#due").val(response.order[10]);				

				// pay amount 
				$("#payAmount").val(response.order[10]);

				var paidAmount = response.order[9] 
				var dueAmount = response.order[10];							
				var grandTotal = response.order[8];

				// update payment
				$("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
					var payAmount = $("#payAmount").val();
					var paymentType = $("#paymentType").val();
					var paymentStatus = $("#paymentStatus").val();

					if(payAmount == "") {
						$("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#payAmount").closest('.form-group').addClass('has-error');
					} else {
						$("#payAmount").closest('.form-group').addClass('has-success');
					}

					if(paymentType == "") {
						$("#paymentType").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#paymentType").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentType").closest('.form-group').addClass('has-success');
					}

					if(paymentStatus == "") {
						$("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#paymentStatus").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentStatus").closest('.form-group').addClass('has-success');
					}

					if(payAmount && paymentType && paymentStatus) {
						$("#updatePaymentOrderBtn").button('loading');
						$.ajax({
							url: 'php_action/editPayment.php',
							type: 'post',
							data: {
								orderId: orderId,
								payAmount: payAmount,
								paymentType: paymentType,
								paymentStatus: paymentStatus,
								paidAmount: paidAmount,
								grandTotal: grandTotal
							},
							dataType: 'json',
							success:function(response) {
								$("#updatePaymentOrderBtn").button('loading');

								// remove error
								$('.text-danger').remove();
								$('.form-group').removeClass('has-error').removeClass('has-success');

								$("#paymentOrderModal").modal('hide');

								$("#success-messages").html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

								// remove the mesages
			          $(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert	

			          // refresh the manage order table
								manageOrderTable.ajax.reload(null, false);

							} //

						});
					} // /if
						
					return false;
				}); // /update payment			

			} // /success
		}); // fetch order data
	} else {
		alert('Error ! Refresh the page again');
	}
}

</script>
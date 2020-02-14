	
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
				
				
				// show datepicker
				$('#sandbox-container input').datepicker({
    autoclose: true,
    todayHighlight: true
		});	

			}
		});
	}
	
	<!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header" style="background-color:#34495e; color:white;">
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><i class="fa fa-edit"></i> Edit Details</h4>
                </div>
                
                <div class="modal-body" style="height:470px; overflow:auto;">
                
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
	
	function showAjaxModalSmall(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax_small').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax_small .modal-body').html(response);
				
				
				// show datepicker
				$('#sandbox-container input').datepicker({
    autoclose: true,
    todayHighlight: true
		});
		

			}
		});
	}
	
    
     <!-- (Ajax small Modal)-->
    <div class="modal fade" id="modal_ajax_small">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header" style="background-color:#34495e; color:white;">
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><i class="fa fa-edit"></i> Edit Details</h4>
                </div>
                
                <div class="modal-body" style="height:470px; overflow:auto;">
                
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
   
//responsible for all delete functions
	
	function confirm_modal(delete_url)
	{
		jQuery('#flexModal').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
    
        <!-- (Normal Modal)-->
          <div class="modal modal-flex fade" id="flexModal" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-red" id="delete_link">delete</a>
                    <button type="button" class="btn btn-green" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
    
    
	//get stock	
	function get_stock(id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/category/get_category/' + id ,
            success: function(response)
            {
                jQuery('#category').html(response);
            }
        });

    }
    
   
    
	
	
	
	//get description
	function get_desc(name,id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/descriptions/get_desc/' + name ,
            success: function(response)
            {
                jQuery('#measurements'+id).html(response);
            }
        });

    }
	
	
	//edit descriptions in modal stock edit
	function get_mdesc(d_name) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/descriptions/get_desc/' + d_name ,
            success: function(response)
            {
                jQuery('#measure').html(response);
            }
        });

    }
	
	
	
	
//for descriptions row adding
function addRow() {
	$("#addRowBtn").button("Adding");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
$.ajax({		
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
							  				
				'<td>'+
					'<div class="form-group">'+
					'<input type="button" class="form-control" value="'+count+'." disabled="true" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="text" name="name[]" id="" autocomplete="off" class="form-control" placeholder="Description e.g grammes"/>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="text" name="unit[]" id=""  autocomplete="off" class="form-control" placeholder="e.g kg" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="text" name="quantity[]" placeholder="e.g (1,2,3 XL,L) " id="" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-red removeProductRowBtn" type="button" onclick="removeProductRow('+count+')" data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row



// select on product data
function getproductdata(/*row = null*/) {
	if(row) {
		var stockid = $("#product"+row).val();		
		
		if(stockid == "") {
			$("#price"+row).val("");

			$("#quantity"+row).val("");						
			$("#total"+row).val("");


		} else {
			$.ajax({
				url: '<?php echo base_url() ?>user/orders/getproductdata',
				type: 'post',
				data: {stockid : stockid},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#price"+row).val(response.price);
					$("#rateValue"+row).val(response.price);
					if(response.available > 10){
					document.getElementById("spansmall"+row).innerHTML="Available Stock : "+response.available+"";
					document.getElementById("spansmall"+row).style.color="#16a085";
					}
					else{
						document.getElementById("spansmall"+row).innerHTML="Available Stock : "+response.available+""; 
						document.getElementById("spansmall"+row).style.color="#e74c3c";
					}

					$("#quantity"+row).val(1);

					var total = Number(response.price) * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					
			
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

// table total
function getTotal(/*row = null*/) {
	if(row) {
		var total = Number($("#price"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productOrderTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productOrderTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#sub").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#sub").val())/100) * 10;
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#sub").val()) + Number($("#vat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#tta").val(totalAmount);
	$("#ttavalue").val(totalAmount);

	var discount = $("#discount").val();
	if(discount) {
		var grandTotal = Number($("#tta").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grand").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grand").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#paid").val();
	if(paidAmount) {
		paidAmount =  Number($("#grand").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {	
		$("#due").val($("#grand").val());
		$("#dueValue").val($("#grand").val());
	} // else

} // /sub total amount

function discountFunc() {
	var discount = $("#discount").val();
 	var totalAmount = Number($("#totalAmount").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#tta").val()) - Number($("#discount").val());
 		grandTotal = grandTotal.toFixed(2);

 		$("#grand").val(grandTotal);
 		$("#grandTotalValue").val(grandTotal);
 	} else {
 	}

 	var paid = $("#paid").val();

 	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#grand").val()) - Number($("#paid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#due").val(dueAmount);
 		$("#dueValue").val(dueAmount);
 	} else {
 		$("#due").val($("#grand").val());
 		$("#dueValue").val($("#grand").val());
 	}

} // /discount function

function paidAmount() {
	var grandTotal = $("#grand").val();

	if(grandTotal) {
		var dueAmount = Number($("#grand").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amoutn f




//function for adding orders rows
function addOrdersRow() {
	$("#addOrderRowBtn").button("loading");

	var tableLength = $("#productOrderTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productOrderTable tbody tr:last").attr('id');
		arrayNumber = $("#productOrderTable tbody tr:last").attr('class');
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
			$("#addOrderRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
				'<td>'+
					'<input type="button" value="'+count+'" disabled="true" class="form-control" />'+
				'</td>'+			  				
				'<td>'+
					'<select class="form-control" name="product[]" id="product'+count+'" onchange="getproductdata('+count+')" >'+
						'<option value="">~~ Select Product ~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value['stock_id']+'">'+value['name']+'&nbsp;('+value['quantity']+'&nbsp;'+value['unit']+')'+'</option>';							
						});
													
					tr += '</select>'+
					'<small><b><div id="spansmall'+count+'"></div></b></small>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="price[]" placeholder="price" id="price'+count+'"  readonly class="form-control" />'+
					'<input type="hidden" name="priceValue[]" id="priceValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
				'</td>'+
				'<td>'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" readonly />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-red removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productOrderTable tbody tr:last").after(tr);
			} else {				
				$("#productOrderTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

	
	//remove selected row
	function removeProductRow(/*row=null*/) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

//validate ajax the category modal in adding stock table
function ajax_validate(){
$('#submit').click(function() {
    var form_data = {
        name: $('#name').val(),
		status: $('#status').val(),
    };
    $.ajax({
        url: "<?php echo base_url() ?>admin/category/ajax_validate",
        type: 'POST',
        data: form_data,
        success: function(msg) {
            if (msg == 'success'){
					$('#alertmsg').hide();
					$('#sucmessage').show().html('<div class="alert alert-success"><strong><i class="fa fa-check"></i> Success ! </strong>Category Added Successfully.</div>');					
				$('#productStockTable').ajax.reload(null, true);
				//$('#category').fadeOut('fast').load('<?php //echo base_url().'admin/stock/get_cat' ?>').show('#category');
			}
				
            else
                $('#alertmsg').html('<div class="alert alert-danger">' + msg + '</div>');
        }
    });
    return false;
})};

	
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
				
				
				// show datepicker
				$('#sandbox-container input').datepicker({
    autoclose: true,
    todayHighlight: true
		});	

			}
		});
	}
	
	
	
	function showAjaxModalSmall(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax_small').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax_small .modal-body').html(response);
				
				
				// show datepicker
				$('#sandbox-container input').datepicker({
    autoclose: true,
    todayHighlight: true
		});
		

			}
		});
	}
	
//responsible for all delete functions	
	function confirm_modal(delete_url)
	{
		jQuery('#flexModal').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
	//get stock	
	function get_stock(id) {

    	$.ajax({
            url: 'http://localhost/projects/inventory/admin/category/get_category/' + id ,
            success: function(response)
            {
                jQuery('#category').html(response);
            }
        });

    }
	
	
	//get description
	
	function get_desc(name,id) {

    	$.ajax({
            url: 'http://localhost/projects/inventory/admin/descriptions/get_desc/' + name ,
            success: function(response)
            {
                jQuery('#measurements'+id).html(response);
            }
        });

    }
	
	
	
	//edit descriptions in modal stock edit
	function get_mdesc(d_name) {

    	$.ajax({
            url: 'http://localhost/projects/inventory/admin/descriptions/get_desc/' + d_name ,
            success: function(response)
            {
                jQuery('#measure').html(response);
            }
        });

    }
	
	
	
//for descriptions row adding
function addRow() {
	$("#addRowBtn").button("Adding");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
$.ajax({		
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
							  				
				'<td>'+
					'<div class="form-group">'+
					'<input type="button" class="form-control" value="'+count+'." disabled="true" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="text" name="name[]" id="" autocomplete="off" class="form-control" placeholder="Description e.g grammes"/>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="text" name="unit[]" id=""  autocomplete="off" class="form-control" placeholder="e.g kg" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
					'<input type="text" name="quantity[]" placeholder="e.g (1,2,3 XL,L) " id="" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-red removeProductRowBtn" type="button" onclick="removeProductRow('+count+')" data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row


//function for adding orders rows
function addOrdersRow() {
	$("#addOrderRowBtn").button("loading");

	var tableLength = $("#productOrderTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productOrderTable tbody tr:last").attr('id');
		arrayNumber = $("#productOrderTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'http://localhost/projects/inventory/user/orders/get_stock',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addOrderRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
				'<td>'+
					'<input type="button" value="'+count+'" disabled="true" class="form-control" />'+
				'</td>'+			  				
				'<td>'+
					'<select class="form-control" name="product[]" id="product'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">~~ Select Product ~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value['stock_id']+'">'+value['name']+'&nbsp;('+value['quantity']+'&nbsp;'+value['unit']+')'+'</option>';							
						});
													
					tr += '</select>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="price[]" placeholder="price" id="price'+count+'"  readonly class="form-control" />'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
				'</td>'+
				'<td>'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" readonly />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-red removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productOrderTable tbody tr:last").after(tr);
			} else {				
				$("#productOrderTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row


	
	
	//remove selected row
	function removeProductRow() {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}


//validate ajax the category modal in adding stock table
function ajax_validate(){
$('#submit').click(function() {
    var form_data = {
        name: $('#name').val(),
		status: $('#status').val(),
    };
    $.ajax({
        url: "http://localhost/projects/inventory/admin/category/ajax_validate",
        type: 'POST',
        data: form_data,
        success: function(msg) {
            if (msg == 'success'){
					$('#alertmsg').hide();
					$('#sucmessage').show().html('<div class="alert alert-success"><strong><i class="fa fa-check"></i> Success ! </strong>Category Added Successfully.</div>');					
				$('#productStockTable').ajax.reload(null, true);
				//$('#category').fadeOut('fast').load('<?php echo base_url().'admin/stock/get_cat' ?>').show('#category');
			}
				
            else
                $('#alertmsg').html('<div class="alert alert-danger">' + msg + '</div>');
        }
    });
    return false;
})};
	
	
	
		//validateorderform
				function validateOrder(){
				$(document).ready(function() {	

		// create order form function
		$("#createOrderForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var orderdate = $("#orderdate").val();
			var names = $("#names").val();
			var contacts = $("#basicMax").val();
			var paid = $("#paid").val();
			var discount = $("#discount").val();
			var ptype = $("#ptype").val();
			var pstatus = $("#pstatus").val();		

			// form validation 
			if(orderdate == "") {
				$("#orderdate").after('<p class="text-danger"> The Order Date field is required </p>');
				$('#orderdate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderdate').closest('.form-group').addClass('has-success');
			} // /else
			
			if(names == "") {
				$("#names").after('<p class="text-danger"> The Customer Name field is required </p>');
				$('#names').closest('.form-group').addClass('has-error');
			}else {
				$('#names').closest('.form-group').addClass('has-success');
			} // /else

			if(contacts == "") {
				$("#basicMax").after('<p class="text-danger"> The Customer Contacts field is required </p>');
				$('#basicMax').closest('.form-group').addClass('has-error');
			} else {
				$('#contacts').closest('.form-group').addClass('has-success');
			} // /else

			if(paid == "") {
				$("#paid").after('<p class="text-danger"> The Paid Amount field is required </p>');
				$('#paid').closest('.form-group').addClass('has-error');
			} else {
				$('#paid').closest('.form-group').addClass('has-success');
			} // /else

			if(discount == "") {
				$("#discount").after('<p class="text-danger"> The Discount field is required </p>');
				$('#discount').closest('.form-group').addClass('has-error');
			} else {
				$('#discount').closest('.form-group').addClass('has-success');
			} // /else

			if(ptype == "") {
				$("#ptype").after('<p class="text-danger"> The Payment Type field is required </p>');
				$('#ptype').closest('.form-group').addClass('has-error');
			} else {
				$('#ptype').closest('.form-group').addClass('has-success');
			} // /else

			if(pstatus == "") {
				$("#pstatus").after('<p class="text-danger"> The Payment Status field is required </p>');
				$('#pstatus').closest('.form-group').addClass('has-error');
			} else {
				$('#pstatus').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var productName = document.getElementsByName('product[]');				
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
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").after('<p class="text-danger"> Quantity Field is required!! </p>');
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
	   	

			if(orderdate && names && contacts && paid && discount && ptype && pstatus) {
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
							$("#createOrderBtn").button('reset');
							
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
							document.getElementById("orderbuttons").style.display="none";
							// remove the product row
							$(".removeProductRowBtn").addClass('disabled');
								
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

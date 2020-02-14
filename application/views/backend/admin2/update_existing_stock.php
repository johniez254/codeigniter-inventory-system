

<div class="well well-sm"><center><h4>Update Existing Stock</h4></center></div>
<div class="success-mess"></div>
                                     <!--/success-messages-->
                                        <!--Responsive orders table-->
                                        <form class="form-horizontal" method="POST" action="<?php echo base_url().'admin/stock/updatearraystock' ?>" id="updateForm">
                                        
 <div class="table-responsive">
                                    <table class="table" id="updatable">
                                        <thead>
                                        <tr>
                                          	<th>No.</th>			  			
                                                <th>Stock Name</th>
                                                <th>Buying Price (Ksh)</th>
                                                <th>Selling Price (ksh)</th>
                                                <th>Available</th>
                                                <th>Damaged</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
$arrar = 0;
$p=1;
$oc="deleted=0";
$this->db->select('*');
$this->db->from('stock');
$this->db->where($oc);
$this->db->order_by('name','asc');
$this->db->join('descriptions','descriptions.description_id=stock.description_id');
$desc	=	$this->db->get()->result_array();
foreach($desc as $row):
$name=$row['name'];
$b_price=$row['b_price'];
$s_price=$row['s_price'];
$available=$row['available'];
$damaged=$row['damaged'];
$unit=$row['unit'];
$quat=$row['quantity'];
$stockid=$row['stock_id'];
?>
                                        <tr id="row<?php echo $p; ?>" class="<?php echo $arrar; ?>">
                                        	<td><input type="button" class="form-control" disabled="true" value="<?php echo $p; ?>"></td>
                                            <td><input readonly type="text" value="<?php echo $name; ?> (<?=$quat?><?=$unit?>)" class="form-control">
                                            <input type="hidden" name="sid[]" value="<?=$stockid?>" />
                                            <input type="hidden" name="max[]" id="max<?php echo $p; ?>" value="<?=$available?>" />
                                            </td>
                                            <td><input type="number" name="bprice[]" min="1" value="<?=$b_price?>" autocomplete="off" class="form-control" placeholder="Buying price" id="bprice<?php echo $p;?>"></td>
                                            <td><input type="number" min="1" name="sprice[]" value="<?=$s_price?>" autocomplete="off" class="form-control" placeholder="Selling price" id="sprice<?php echo $p;?>"></td>
                                            <td><input type="number" min="1" name="available[]" value="<?=$available?>" autocomplete="off" class="form-control" id="available<?php echo $p;?>"></td>
                                            <td><input type="number" name="damaged[]" class="form-control" value="<?= $damaged ?>" id="damaged<?php echo $p; ?>" onkeyup="changeAvailable(<?php echo $p ?>)">                                     </td>
                                        </tr>
                                        <?php 
										$arrar++;
												$p++;
endforeach; ?>
                                        </tbody>
                                        </table>
                                	<div id="uorderbuttons">
                                    <button class="btn btn-green removeProductRowBtn" type="submit" onclick="validateUpdateStock()" id="ucreateOrderBtn" data-loading-text="<i class='fa fa-check-circle'></i> Placing..."/><i class="fa fa-check-circle"></i> Update Stock</button>
                                    <button type="reset" onclick="uresetOrderForm()" class="btn btn-orange removeProductRowBtn"><i class="fa fa-eraser"></i> Reset</button> 
                                    </div>
                                        </div>
                                        </form>
<script>
//validateorderform
				function validateUpdateStock(){
				$(document).ready(function() {	

		// create order form function
		$("#updateForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				

			// array validation
			var bprice = document.getElementsByName('bprice[]');				
			var validaeBuying;
			for (var x = 0; x < bprice.length; x++) {       			
				var bpriceId = bprice[x].id;	    	
		    if(bprice[x].value == ''){	    		    	
		    	$("#"+bpriceId+"").after('<small class="text-danger"> Buying Price is required!! </small>');
		    	$("#"+bpriceId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+bpriceId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < bprice.length; x++) {       						
		    if(bprice[x].value){	    		    		    	
		    	validaeBuying = true;
	      } else {      	
		    	validaeBuying = false;
	      }          
	   	} // for       		   	
	   	
	   	var sprice = document.getElementsByName('sprice[]');		   	
	   	var validateSales;
	   	for (var x = 0; x < sprice.length; x++) {       
	 			var spriceId = sprice[x].id;
		    if(sprice[x].value == ''){	    	
		    	$("#"+spriceId+"").after('<small class="text-danger"> Selling Price is required!! </small>');
		    	$("#"+spriceId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+spriceId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < sprice.length; x++) {       						
		    if(sprice[x].value){	    		    		    	
		    	validateSales = true;
	      } else {      	
		    	validateSales = false;
	      }          
	   	} // for      
		
		var desc = document.getElementsByName('available[]');		   	
	   	var validateAvailable;
	   	for (var x = 0; x < desc.length; x++) {       
	 			var descId = desc[x].id;
		    if(desc[x].value == ''){	    	
		    	$("#"+descId+"").after('<small class="text-danger"> Available Field is required!! </small>');
		    	$("#"+descId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+descId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < desc.length; x++) {       						
		    if(desc[x].value){	    		    		    	
		    	validateAvailable = true;
	      } else {      	
		    	validateAvailable = false;
	      }          
	   	} // for 
		
		var meas = document.getElementsByName('damaged[]');		   	
	   	var validateMeasure;
	   	for (var x = 0; x < meas.length; x++) {       
	 			var measId = meas[x].id;
		    if(meas[x].value == ''){	    	
		    	$("#"+measId+"").after('<small class="text-danger"> Damaged Field is required!! </small>');
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
		


				if(validaeBuying == true && validateSales == true && validateAvailable == true && validateMeasure == true) {
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
							$("#ucreateOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-mess").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="fa fa-check-circle"></i></strong> '+ response.messages +
	            	''+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							document.getElementById("uorderbuttons").style.display="none";
							// remove the product row
							$(".uremoveProductRowBtn").addClass('disabled');
							
							Messenger.options = {
								extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
								theme: 'flat'
							}
						
							Messenger().post({
								message: '<h4><i class="fa fa-check"></i> Success !!!</h4> Stock Was Updated Successfully!!',
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
			///} // /if field validate is true
			

			return false;
		}); // /create order form function		

}); // /documernt
				}//validateorder
				
</script>

<script>
function changeAvailable() {

	if(row) {
		var avail = Number($("#max"+row).val());
		var damaged =  Number($("#damaged"+row).val());
		
		var available = Number($("#max"+row).val()) - Number($("#damaged"+row).val());
		available = available.toFixed(2);
		$("#available"+row).val(available);
		
		if (damaged > avail) {
			$("#damaged"+row).val(avail);
			var available = Number($("#max"+row).val()) - Number($("#damaged"+row).val());
			available = available.toFixed(2);
			$("#available"+row).val(available);
			//$("#totalValue"+row).val(total);
			
			//show message
			//document.getElementById("mes"+row).innerHTML="Max Damage : "+avail+""; 
			//document.getElementById("mes"+row).style.color="#e74c3c";
			$("#damaged"+row).after('<small class="text-danger"> <b>Max Damage : '+avail+' </b></small>');
			//$("#damaged"+row).closest('.form-group').addClass('has-error');
		}else{
//$("#damaged"+row).after('<small class="text-green"> <b>okay </b></small>');
}

	} else {
		alert('no row !! please refresh the page');
	}
}
</script>

<script>
//reset
function uresetOrderForm() {
	// reset the input field
	$("#updateForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


</script>  

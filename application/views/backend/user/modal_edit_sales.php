<?php foreach($oid->result() as $row):
$id=$row->order_id;
$grand=$row->grand_total;
$due=$row->due;
$paid=$row->paid;
?>
<?php endforeach;?>
<center><h3><i class="fa fa-edit"></i> Edit Sales Outstanding Payments</h3></center>
<hr>
<?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("user/sales/sales_update/".$id, $attributes);?>
                                                <div class="form-group">
                                                    <label>Total Sales Price :</label>
                                                    <input type="text" readonly class="form-control" value="<?php echo $grand; ?>" name="tta" required placeholder="grand total">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Paid Amount :</label>
                                                    <input type="text" readonly class="form-control" value="<?php echo $paid; ?>" name="paid" required placeholder="paid">
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <label>Payment:</label>
                                                    <input type="number" class="form-control" value="" name="payment" required id="xpayment" onkeyup="GetBalancePayment()" onclick="GetBalancePayment()" placeholder="add payment">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Due Amount :</label>
                                                    <input type="text" readonly class="form-control"  name="due" id="xdue" required placeholder="<?php echo $due; ?>">
                                                    <input type="hidden" name="x" value="<?php echo $due?>">
                                                </div>
                                                	
                                                
                                                <button type="submit" class="btn btn-green">Make Payment</button>	
                                                <button type="reset" class="btn btn-orange">Reset</button>
                                                <?php echo form_close()?>
                                                
<script>
function GetBalancePayment() {
var geto = <?php echo $due; ?>;
var payment = Number($("#xpayment").val());
var balance = geto - payment;
$("#xdue").val(balance);
if (payment > geto) {
		$("#xpayment").val(geto);
		$("#xdue").val("0");
	}
}

			   </script>		 

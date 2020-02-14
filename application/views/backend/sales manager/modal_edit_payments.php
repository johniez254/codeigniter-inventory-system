<?php foreach($p_id->result() as $row):
$id=$row->purchase_id;
$grand=$row->grand_total;
$due=$row->due;
$paid=$row->paid;
$pay_status=$row->payment_status;
?>
<?php endforeach;?>
<center><h3><i class="fa fa-edit"></i> <?php echo get_phrase('edit'); ?> <?php echo get_phrase('purchases_outstandings'); ?></h3></center>
<hr />
<?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("salesManager/stock/purchase_update/".$id, $attributes);?>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('total_price'); ?> :</label>
                                                    <input type="text" readonly class="form-control" value="<?php echo $grand; ?>" name="tta" required placeholder="grand total">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('total_paid'); ?> :</label>
                                                    <input type="text" readonly class="form-control" value="<?php echo $paid; ?>" name="paid" required placeholder="paid">
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('payment'); ?>:</label>
                                                    <input type="number" class="form-control" value="" name="payment" required id="xpayment" onkeyup="GetBalancePayment()" onclick="GetBalancePayment()" placeholder="add payment">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('due_amt'); ?> :</label>
                                                    <input type="text" readonly class="form-control"  name="due" id="xdue" required placeholder="<?php echo $due; ?>">
                                                    <input type="hidden" name="x" value="<?php echo $due?>">
                                                    <input type="hidden" name="pstatus" value="<?php echo $pay_status; ?>" />
                                                </div>
                                                	
                                                
                                                <button type="submit" class="btn btn-green"><?php echo get_phrase('make_payment'); ?></button>	
                                                <button type="reset" class="btn btn-orange"><?php echo get_phrase('reset'); ?></button>
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

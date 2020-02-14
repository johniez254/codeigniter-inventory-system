<?php $system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle;?>
<div class="row">
	<div class="col-lg-12">
		<p class="text-center">
        	<b><?php echo get_phrase('copyright');?> &copy; <?php echo date('Y'); ?> | <?php echo $system_title; ?> | <?php echo get_phrase('developed_by');?> : <b class="text-info">Johnson Matoke</b></b>
		</p>
	</div>
</div>                                        


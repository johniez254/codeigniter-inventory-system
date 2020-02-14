
    <script src="<?php echo base_url(); ?>components/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url(); ?>components/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
   <script src="<?php echo base_url(); ?>components/js/plugins/popupoverlay/defaults.js"></script>
   <script src="<?php echo base_url(); ?>components/js/plugins/fullcalendar/jquery-ui.custom.min.js"></script>

   
   <script src="<?php echo base_url(); ?>components/js/plugins/popupoverlay/logout.js"></script> 
        <script src="<?php echo base_url(); ?>components/js/plugins/hisrc/hisrc.js"></script>
        
        
        <script src="<?php echo base_url(); ?>components/js/plugins/messenger/messenger.min.js"></script> 
        <script src="<?php echo base_url(); ?>components/js/plugins/messenger/messenger-theme-flat.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/daterangepicker/moment.js"></script>
    
    <script src="<?php echo base_url(); ?>components/js/plugins/daterangepicker/daterangepicker.js"></script> 
	<script src="<?php echo base_url(); ?>components/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/morris/morris.js"></script>    
    <script src="<?php echo base_url(); ?>components/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/flot/jquery.flot.resize.js"></script>    
    <script src="<?php echo base_url(); ?>components/js/plugins/sparkline/jquery.sparkline.min.js"></script> 
    <script src="<?php echo base_url(); ?>components/js/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>    
    <script src="<?php echo base_url(); ?>components/js/plugins/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script> 
    <script src="<?php echo base_url(); ?>components/js/demo/map-demo-data.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/easypiechart/jquery.easypiechart.min.js"></script>
    
     
    <script src="<?php echo base_url(); ?>components/js/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/datatables/datatables-bs3.js"></script>
    
    
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-tokenfield/scrollspy.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-tokenfield/affix.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-tokenfield/typeahead.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-select/bootstrap-select.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/bootstrap-editable/bootstrap-editable.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/validate/jquery.validate.min.js"></script>
    
    <script src="<?php echo base_url(); ?>components/js/plugins/ladda/spin.min.js"></script>
    <script src="<?php echo base_url(); ?>components/js/plugins/ladda/ladda.min.js"></script>


        
        
    <script src="<?php echo base_url(); ?>components/js/flex.js"></script>  
    <?php include'dahboard_control.php'; ?>
    <script src="<?php //echo base_url(); ?>components/js/demo/buttons-demo.js"></script>
    <script src="<?php echo base_url(); ?>components/js/demo/mailbox-demo.js"></script>
    <script src="<?php echo base_url(); ?>components/js/demo/map-demo-data.js"></script>
    <script src="<?php echo base_url(); ?>components/js/demo/advanced-form-demo.js"></script>
    <script src="<?php echo base_url(); ?>components/js/demo/advanced-tables-demo.js"></script> 
    <script src="<?php echo base_url(); ?>components/js/demo/validation-demo.js"></script>
    



    
      
   <?php include'calendar.php';?>

<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
 Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
        theme: 'flat'
    }

    Messenger().post({
        message: '<?php echo $this->session->flashdata("flash_message");?>',
        id: "Only-one-message",
        type: 'success',
        showCloseButton: true
    });
</script>

<?php endif;?>

<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('error_message') != ""):?>

<script type="text/javascript">
 Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
        theme: 'flat'
    }

    Messenger().post({
        message: '<?php echo $this->session->flashdata("error_message");?>',
        id: "Only-one-message",
        type: 'error',
        showCloseButton: true
    });
</script>

<?php endif;?>

<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('alert_message') != ""):?>

<script type="text/javascript">
 Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
        theme: 'flat'
    }

    Messenger().post({
        message: '<?php echo $this->session->flashdata("alert_message");?>',
        id: "Only-one-message",
        type: 'info',
        showCloseButton: true
    });
</script>

<?php endif;?>



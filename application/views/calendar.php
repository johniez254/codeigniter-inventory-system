    <?php $actype       =	$this->session->userdata('role'); ?>
    <?php $actype_id       =	$this->session->userdata('login_user_id'); ?>
    <?php $jina=$this->db->get_where('login', array('id' => $actype_id)); ?>
	<?php foreach($jina->result() as $row):
	$un=$row->user_id;
	endforeach
	?>
    
    <?php if($actype=='admin'): ?>
	<script>
  $(document).ready(function() {
	  
	  var calendar = $('#calendar');
				
				$('#calendar').fullCalendar({
					 header: {
            left: 'prev,next today',
           	center: 'title',
            right: 'month,agendaWeek,agendaDay'
       },
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,		
					
					events: [						
						 <?php 
 $event=$this->db->get_where('events', array('posted_by' => 'admin'));
 foreach($event->result() as $row):
$state=$row->status;
$title=$row->title;
$date=$row->event_date;
?>
						{
							className: '<?php if($state=='1') {echo'fc-orange';}else{ echo 'fc_default';} ?>',
							title: "<?php echo $title;?>",
							start: new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>),
							end:	new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>) 
						},	
						
<?php endforeach;?>
					]
				});
	});
	
				$(function() {

    // popover demo
    $("[data-toggle=popover]")
        .popover()

})

$(function() {

    // tooltip demo
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    $('.tooltip-test').tooltip()
    $('.popover-test').popover()

    // popover demo
    $("[data-toggle=popover]")
        .popover()

})
  </script>
  
  <?php endif ?>
  
   <?php if($actype=='inventory manager'): ?>
	<script>
  $(document).ready(function() {
	  
	  var calendar = $('#calendar');
				
				$('#calendar').fullCalendar({
					 header: {
            left: 'prev,next today',
           	center: 'title',
            right: 'month,agendaWeek,agendaDay'
       },
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,		
					
					events: [						
						 <?php 
$op="status='0' OR posted_by='inventory manager' AND user_id=".$un."";
 $event=$this->db->get_where('events',$op);
 foreach($event->result() as $row):
$state=$row->status;
$title=$row->title;
$date=$row->event_date;
?>
						{
							className: '<?php if($state=='1') {echo'fc-orange';}else{ echo 'fc_default';} ?>',
							title: "<?php echo $title;?>",
							start: new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>),
							end:	new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>) 
						},	
						
<?php endforeach;?>
					]
				});
	});
	
				$(function() {

    // popover demo
    $("[data-toggle=popover]")
        .popover()

})
  </script>
  
  <?php endif ?>
  
   <?php if($actype=='user'): ?>
	<script>
  $(document).ready(function() {
	  
	  var calendar = $('#calendar');
				
				$('#calendar').fullCalendar({
					 header: {
            left: 'prev,next today',
           	center: 'title',
            right: 'month,agendaWeek,agendaDay'
       },
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,		
					
					events: [						
						 <?php 
$op="status='0' OR posted_by='user' AND user_id=".$un."";
 $event=$this->db->get_where('events',$op);
 foreach($event->result() as $row):
$state=$row->status;
$title=$row->title;
$date=$row->event_date;
?>
						{
							className: '<?php if($state=='1') {echo'fc-orange';}else{ echo 'fc_default';} ?>',
							title: "<?php echo $title;?>",
							start: new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>),
							end:	new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>) 
						},	
						
<?php endforeach;?>
					]
				});
	});
	
				$(function() {

    // popover demo
    $("[data-toggle=popover]")
        .popover()

})
  </script>
  
  <?php endif ?>

  
   <?php if($actype=='sales manager'): ?>
	<script>
  $(document).ready(function() {
	  
	  var calendar = $('#calendar');
				
				$('#calendar').fullCalendar({
					 header: {
            left: 'prev,next today',
           	center: 'title',
            right: 'month,agendaWeek,agendaDay'
       },
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,		
					
					events: [						
						 <?php 
$op="status='0' OR posted_by='sales manager' AND user_id=".$un."";
 $event=$this->db->get_where('events',$op);
 foreach($event->result() as $row):
$state=$row->status;
$title=$row->title;
$date=$row->event_date;
?>
						{
							className: '<?php if($state=='1') {echo'fc-orange';}else{ echo 'fc_default';} ?>',
							title: "<?php echo $title;?>",
							start: new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>),
							end:	new Date(<?php echo date('Y',$date);?>, <?php echo date('m',$date)-1;?>, <?php echo date('d',$date);?>) 
						},	
						
<?php endforeach;?>
					]
				});
	});
	
				$(function() {

    // popover demo
    $("[data-toggle=popover]")
        .popover()

})
  </script>
  
  <?php endif ?>
		
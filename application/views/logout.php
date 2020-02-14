<?php $actype       =	$this->session->userdata('role'); ?>
<?php $actype_id       =	$this->session->userdata('login_user_id'); ?>
<?php if($actype=='admin'){ ?>
     <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo $this->crud->get_image_url('admin',$actype_id);?>" alt="" width="150px" height="150px">
            <h3>
                <i class="fa fa-sign-out text-green"></i> <?php echo get_phrase('ready_to_go');?>?
            </h3>
            <p><?php echo get_phrase('end_session');?>.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()."main/logout" ?>' class="btn btn-green">
                        <strong><?php echo get_phrase('logout');?></strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green"><?php echo get_phrase('cancel');?></button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    
    
    <?php }
	
	elseif($actype=='inventory manager'){ ?>
     <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo $this->crud->get_image_url('manager',$actype_id);?>" alt="" width="150px" height="150px">
            <h3>
                <i class="fa fa-sign-out text-green"></i> <?php echo get_phrase('ready_to_go');?>?
            </h3>
            <p><?php echo get_phrase('end_session');?>.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()."main/logout" ?>' class="btn btn-green">
                        <strong><?php echo get_phrase('logout');?></strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green"><?php echo get_phrase('cancel');?></button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    
    
    <?php }elseif ($actype=='user'){?>
	<!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo $this->crud->get_image_url('user',$actype_id);?>" alt="" width="150px" height="150px">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()."main/logout" ?>' class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    
    
    <?php }elseif ($actype=='sales manager'){?>
	<!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo $this->crud->get_image_url('user',$actype_id);?>" alt="" width="150px" height="150px">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()."main/logout" ?>' class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    
    
    <?php }else{ ?>
    <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo base_url(); ?>components/img/profile-pic.jpg" alt="">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()."main/logout" ?>' class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
	<?php }?>
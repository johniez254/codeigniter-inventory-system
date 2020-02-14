<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';
$config_controller_path='../application/controllers/Main.php';
$install_foder_path='../install';


require_once('includes/welcome_class.php');
$welcome = new Welcome();

$wel = $welcome->display_welcome('require');

	//show require page
if($wel==$_GET['o']) {?>

<!DOCTYPE html>
    <head>

		<title>Install | Inventory Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="css/my_style.css">

		<script src="css/jquery.min.js"></script>
        <script src="css/bootstrap.min.js"></script>
	</head>
	<body class="login">

    <div class="container">
        <div class="row">
        	<div class="col-md-10 col-md-offset-1">
            
            <div class="login-banner text-center">
                    <!--<h3><i class="fa fa-gears"></i> <?php //echo $system_title; ?>Inventory System</h3>-->
                </div>
            
            	<div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title"><?PHP //$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle; ?>
                            <h4><strong><i class="fa fa-magic"></i> System Installation</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
                    
                    
                    
                    
                    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet portlet-default">
                            <div class="portlet-body">

                                <div id="mailbox">

                                    <ul class="nav nav-pills nav-stacked mailbox-sidenav">
                                        <li class="nav-divider"></li>
                                        <li class="mailbox-menu-title text-muted">Step 1 of 3 &rsaquo; Requirements</li>
                                        <li class="active"><button style="text-align:left; padding:10px;" class="btn btn-default btn-block"><i class="fa fa-bars"></i> Requirements</button>
                                        </li>
                                        <li><button style="text-align:left; padding:10px;" class="btn btn-white btn-block disabled"><i class="fa fa-wrench"></i> Installation</button>
                                        </li>
                                        <li><button style="text-align:left; padding:10px;" class="btn btn-white btn-block disabled"><i class="fa fa-check"></i> Complete</button>
                                        </li>
                                        <li class="nav-divider"></li>
                                    </ul>

                                    <div id="mailbox-wrapper">
                                    <ul class="nav nav-pills nav-stacked">
                                    <li class="nav-divider"></li>
                                    </ul>

                                        <div class="table-responsive mailbox-messages">
                                           
                                           <span id="taskScroll">
                                            <p>
                                                <b>progress</b>
                                                <span class="pull-right">
                                                    <strong>0%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%;"></div>
                                            </div>
                                    </span>
                                    
                                    
                                    <p><strong>(a)</strong> Welcome to <b>Inventory Management System</b> Installation Wizard. Before Proceeding, the system will automatically scan for <b>directory/file permissions</b> whether they are writable before proceeding with Installation. All the required permissions below should be marked with tick (<b class="text-blue"><i class="fa fa-check"></i></b>). In case of any difficulties, Please <a href="mailto:johnsonmatoke@gmail.com">contact the webmaster</a> for necessary assistance.</p>
                                    
                                    <!-- Basic Responsive Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-green">
                                        <thead>
                                            <tr>
                                                <th>Directory/File Permissions</th>
                                                <th>Writable</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo '<b>'.$db_config_path.'</b>'; ?></td>
                                                <td>
													<?php if(is_writable($db_config_path)){
														echo'<b class="text-blue"><i class="fa fa-check"></i></b>';
													}else{ echo'<b class="text-red"><i class="fa fa-times"></i></b>';}?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo '<b>'.$config_controller_path.'</b>'; ?></td>
                                                <td>
                                                	<?php if(is_writable($config_controller_path)){
														echo'<b class="text-blue"><i class="fa fa-check"></i></b>';
													}else{ echo'<b class="text-red"><i class="fa fa-times"></i></b>';}?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        <!-- /.table responsive -->
                        <p><strong>(b)</strong> Please ensure you also have the required load versions for effective system functionality. Required versions: <i>PHP <strong>5.0.0</strong> or higher.</p>
                        <?php //echo phpinfo() ?>
                        <?php //echo mysql_get_server_info() ?>
                        <?php //echo extension_loaded(0) ?>
                         <!-- Basic Responsive Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-green">
                                        <thead>
                                            <tr>
                                                <th>Load Version</th>
                                                <th>Status</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo '<b>PHP</b>'; ?></td>
                                                <td>
													<?php if(phpversion()>'5.0.0'){
														echo'You have <span class="text-green"><b>PHP '.phpversion().'</b></span> <b class="text-blue">(<i class="fa fa-check"></i>)</b>';
													}else{ echo 'You have <span class="text-green"><b>PHP '.phpversion().'</b></span>. Recommended version <b>5.0.0</b> or later.';}?>
                                                </td>
                                            </tr>
                                            <!-- <tr>
                                                <td><?php //echo '<b>MYSQL</b>'; ?></td>
                                                <td>
                                                	<?php //if(mysql_get_server_info()){
														//echo'You have <span class="text-green"><b>Mysql '.mysql_get_server_info().'</b></span> <b class="text-blue">(<i class="fa fa-check"></i>)</b>';
													//}else{ echo'<b class="text-red"><i class="fa fa-times"></i> No server information detected. <a target="_blank" href="https://bitnami.com/xampp?utm_source=bitnami&utm_medium=installer&utm_campaign=XAMPP%2BModule">Download from here now?</b>';}?>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                        <!-- /.table responsive -->
                        <hr>
                        
     
    <a href="index.php?o=install"><button class="btn btn-green btn-square pull-right" type="button">Next <i class="fa fa-arrow-right"></i></button></a>
    <button  style="margin-left:2px;" class="btn btn-green btn-square pull-right disabled" type="button"><i class="fa fa-arrow-left"></i> Previous</button>
    
    
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
   

    
    </div>
      			</div>
      		</div>
      	</div>
      </div>

	</body>
</html>
	
<?php	}//end of requirements page

//start complete page
elseif($_GET['o']=='complete') {?>
    

<!DOCTYPE html>
    <head>

		<title>Install | Inventory Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="css/my_style.css">

		<script src="css/jquery.min.js"></script>
        <script src="css/bootstrap.min.js"></script>
	</head>
	<body class="login">

    <div class="container">
        <div class="row">
        	<div class="col-md-10 col-md-offset-1">
            
            <div class="login-banner text-center">
                    <!--<h3><i class="fa fa-gears"></i> <?php //echo $system_title; ?>Inventory System</h3>-->
                </div>
            
            	<div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title"><?PHP //$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle; ?>
                            <h4><strong><i class="fa fa-magic"></i> System Installation</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
                    
                    
                    
                    
                    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet portlet-default">
                            <div class="portlet-body">

                                <div id="mailbox">

                                    <ul class="nav nav-pills nav-stacked mailbox-sidenav">
                                        <li class="nav-divider"></li>
                                        <li class="mailbox-menu-title text-muted">Step 3 of 3 &rsaquo; Complete</li>
                                        <li class="active"><a href="index.php?o=require" style="text-align:left; background-color:#526476; border-color:#495c6e;" class="btn btn-default"><i class="fa fa-bars"></i> Requirements</a>
                                        </li>
                                        <li class="active"><a href="index.php?o=install" style="text-align:left; background-color:#526476; border-color:#495c6e;" class="btn btn-default"><i class="fa fa-wrench"></i> Installaion</a>
                                        </li>
                                        </li>
                                        <li><button style="text-align:left; padding:10px;" class="btn btn-default btn-block"><i class="fa fa-check"></i> Complete</button>
                                        </li>
                                        <li class="nav-divider"></li>
                                    </ul>

                                    <div id="mailbox-wrapper">
                                    <ul class="nav nav-pills nav-stacked">
                                    <li class="nav-divider"></li>
                                    </ul>

                                        <div class="table-responsive mailbox-messages">
                                           
                                           <span id="taskScroll">
                                            <p>
                                                <b>progress</b>
                                                <span class="pull-right">
                                                    <strong>100%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                            </div>
                                    </span>
                                    
                                    
                                    <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 <center><strong><i class="fa fa-check"></i> Installation was successfull.</strong></center>
                                        </div>
                                        
                                    <p>Good job! Everthing is correct and you're ready to go. Remember to <strong class="text-red">delete</strong> the installation folder <code><?php echo $install_foder_path; ?></code> located in the root folder of your system to avoid future errors. </p>
                                    <p>Hit the <strong>finish</strong> button to proceed to login to the system using the following credentials:</p>
                                    <table width="30%">
                                    <tr>
                                    	<td><span class="label green"><strong><i class="fa fa-user"></i> Username</strong></span></td>
                                        <td><strong>administrator</strong></td>
                                    </tr>
                                    <tr>
                                    	<td><span class="label green"><strong><i class="fa fa-unlock-alt"></i> Password</strong></span></td>
                                        <td><strong>admin</strong></td>
                                    </tr>
                                    </table>
                                    <br>
                                    <p>(<em><strong>Note:</strong> You can always change your login credentials once you have logged in under your profile settings.</em>)
                                    </p>
                                    <hr>

                        
     
    <a href="../"><button class="btn btn-green btn-square pull-right" type="button">Finish <i class="fa fa-arrow-right"></i></button></a>
    <a href="index.php?o=install"><button  style="margin-left:2px;" class="btn btn-green btn-square pull-right" type="button"><i class="fa fa-arrow-left"></i> Previous</button></a>
    
    
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
   

    
    </div>
      			</div>
      		</div>
      	</div>
      </div>

	</body>
</html>
    
<?php
}
	else{

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();

	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		} else if ($core->write_main($_POST) == false) {
			$message = $core->show_message('error',"The main configuration file could not be written, please chmod application/config/Main.php file to 777");
		}


		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			//header( 'Location: ' . $redir . 'welcome' ) ;
			header( 'Location: index.php?o=complete' ) ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The <b>hostname, username, database name</b> are required.');
	}
}

?>

	<html>
    <head>

		<title>Install | Inventory Management System</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="css/my_style.css">

		<script src="css/jquery.min.js"></script>
        <script src="css/bootstrap.min.js"></script>
	</head>
	<body class="login">

    <div class="container">
        <div class="row">
        	<div class="col-md-10 col-md-offset-1">
            
            <div class="login-banner text-center">
                    <!--<h3><i class="fa fa-gears"></i> <?php //echo $system_title; ?>Inventory System</h3>-->
                </div>
            
            	<div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title"><?PHP //$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle; ?>
                            <h4><strong><i class="fa fa-magic"></i> System Installation</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
    	
        
      
      <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet portlet-default">
                            <div class="portlet-body">

                                <div id="mailbox">

                                    <ul class="nav nav-pills nav-stacked mailbox-sidenav">
                                        <li class="nav-divider"></li>
                                        <li class="mailbox-menu-title text-muted">Step 2 of 3 &rsaquo; Installation</li>
                                        <li class="active"><a href="index.php?o=require" style="text-align:left; background-color:#526476; border-color:#495c6e;" class="btn btn-default"><i class="fa fa-bars"></i> Requirements</a>
                                        </li>
                                        <li><button style="text-align:left; padding:10px;" class="btn btn-default btn-block"><i class="fa fa-wrench"></i> Installation</button>
                                        </li>
                                        <li><button style="text-align:left; padding:10px;" class="btn btn-white btn-block disabled"><i class="fa fa-check"></i> Complete</button>
                                        </li>
                                        <li class="nav-divider"></li>
                                    </ul>

                                    <div id="mailbox-wrapper">
                                    <ul class="nav nav-pills nav-stacked">
                                    <li class="nav-divider"></li>
                                    </ul>

                                        <div class="table-responsive mailbox-messages">
                                           
                                           <span id="taskScroll">
                                            <p>
                                                <b>progress</b>
                                                <span class="pull-right">
                                                    <strong>50%</strong>
                                                </span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                                            </div>
                                    </span>
                                    
                           <p><strong>(c)</strong> Fill in the database Configurations below to connect to the database and install the required data tables for the system functionality. All fields marked with (<strong>*</strong>) are required. Incase you have set password for the user, remember to provide the password, otherwise the password field can be left blank.</p>  
                           <p><strong><em>Note: </em></strong>If you have already created the database and installed the necessary tables, do the following;
                           <ol type="i">
                           		<li>Modify <code>line 15</code> of <code><?php echo $config_controller_path; ?></code> where there is <code><em><strong>'database_name'</strong></em></code> and replace with the name of the database you created.</li>
                                <li>Modify <code><?php echo $db_config_path ?></code>, specifying the <strong>hostname</strong>, <strong>username</strong>, <strong>password</strong>(if set) and <strong>database name</strong> of your system.</li>
                                <li>Skip the Iinstallation wizard. <a class="text-blue" href="../">Click here</a> to skip insatllation.</li>
                           </ol>
                            </p>       

                         <?php if(is_writable($db_config_path)){?>

<div class="well">

		  <?php if(isset($message)) {echo '<div class="alert alert-danger"><strong><i class="fa fa-info-circle"></i> Error: </strong> ' . $message . '</div>';}?>

		  <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="form-group">
          <label for="hostname">Hostname*</label><input type="text"  autocomplete="off" id="hostname" value="localhost" class="form-control" name="hostname" placeholder="hostname" />
          </div>
          
          <div class="form-group">
          <label for="username">Username*</label><input type="text" autocomplete="off" value="root" id="username" class="form-control" name="username" placeholder="username" />
          </div>
          
          <div class="form-group">
          <label for="password">Password</label><input type="password" placeholder="password" id="password" class="form-control" name="password" />
          </div>
          
          <div class="form-group">
          <label for="database">Database Name*</label><input autocomplete="off" type="text" placeholder="database name" id="database" class="form-control" name="database" />
          </div>
         <hr>
                        
     <button class="btn btn-green btn-square pull-right" type="submit">Next <i class="fa fa-arrow-right"></i></button>
    <a href="index.php?o=require"><button  style="margin-left:2px;" class="btn btn-green btn-square pull-right" type="button"><i class="fa fa-arrow-left"></i> Previous</button></a>
		  </form>
          <br><br>
          </div>

	  <?php } else { ?>
      <p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
	  <?php } ?>
    
    
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
      
      
      
      
      				</div>
      			</div>
      		</div>
      	</div>
      </div>

	</body>
</html>


<?php
	}
?>
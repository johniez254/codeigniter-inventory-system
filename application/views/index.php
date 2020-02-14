<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle;
?>
<?php $account_type       =	$this->session->userdata('role'); ?>
<?php $account_id       =	$this->session->userdata('login_user_id'); 

$username       =	$this->db->get_where('login' , array('id'=>$account_id))->row()->username;
?>



<?php if($account_type=='admin'){ ?>
<?php
$where="due>='1'";
$this->db->select('*');
$this->db->from('orders');
$this->db->where($where);
$this->db->order_by('order_date','asc');
$count_sales_outsatandings	=	$this->db->count_all_results();
$where="due>='1'";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($where);
$this->db->order_by('purchase_date','asc');
$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
$count_purchase_outstandings	=	$this->db->count_all_results();

$this->db->select('*');
$this->db->from('purchases');
$count_all_purchases	=	$this->db->count_all_results();

$this->db->select('*');
$this->db->from('orders');
$count_all_sales	=	$this->db->count_all_results();

?>											

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?> | <?php echo $system_title; ?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('admin',$account_id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> <?php echo get_phrase('logged_in_as');?>
                        </p>
                        <?php if($account_type=='admin'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('logout');?>"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            Johnson
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('logout');?>"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    <?php if($page_name=='Dashboard'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/dashboard" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-dashboard"></i> <?php echo get_phrase('dashboard');?>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/dashboard" ?>">
                            <i class="fa fa-dashboard"></i> <?php echo get_phrase('dashboard');?>
                        </a>
                    </li>
                    <?php }  ?>
                    <!-- end DASHBOARD LINK -->                   
                    
                     <!-- begin Suppliers -->
                      <?php if($page_name=='Suppliers' || $page_name=='View Supplier'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/suppliers/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('suppliers');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."admin/suppliers/view" ?>">
                                <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('suppliers');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end Suppliers  -->
                    
                    
                    
                    <!-- begin stock LINK -->
                    <?php if($page_name=='Stock'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/stock/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-hdd-o"></i> <?php echo get_phrase('stock');?>
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."admin/stock/view" ?>">
                            <i class="fa fa-hdd-o"></i> <?php echo get_phrase('stock');?>
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end stock LINK -->
                    
                    
                    
                    <!-- begin orders CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#orders">
                            <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('orders');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Sales' || $page_name=='View Sales' || $page_name=='Purchases' || $page_name=='View Purchases'){
							echo'<ul class="collapse nav in" id="orders">';}
							else {echo'<ul class="collapse nav" id="orders">';}
						 ?>
                        
                        	<?php if($page_name=='Purchases' || $page_name=='View Purchases'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."admin/purchases/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases');?>
                                    <?php if($count_all_purchases>0):?>
                                    <span class="badge default pull-right"><?=$count_all_purchases?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."admin/purchases/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases');?>
                                    <?php if($count_all_purchases>0):?>
                                    <span class="badge default pull-right"><?=$count_all_purchases?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of purchase orders-->
                            
                            <!--start sales orders-->
                            <?php  if($page_name=='Sales' || $page_name=='View Sales'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."admin/sales/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales');?>
                                    <?php if($count_all_sales>0):?>
                                    <span class="badge default pull-right"><?=$count_all_sales?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."admin/sales/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales');?>
                                    <?php if($count_all_sales>0):?>
                                    <span class="badge default pull-right"><?=$count_all_sales?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end sales orders-->
                        </ul>
                    </li>
                    <!-- end orders CENTER DROPDOWN -->
                    
                    
                    
                    
                    
                                         <!-- begin outsatanding CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#outstandings">
                            <i class="fa fa-tags"></i> <?php echo get_phrase('outstandings');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Purchase outstandings' || $page_name=='Sales outstandings' || $page_name=='View Sales Outstandings' || $page_name=='View Purchases Outstandings'){
							echo'<ul class="collapse nav in" id="outstandings">';}
							else {echo'<ul class="collapse nav" id="outstandings">';}
						 ?>
                        
                        	<?php if($page_name=='Purchase outstandings' || $page_name=='View Purchases Outstandings'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."admin/outstandings/purchases" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases_outstandings');?>
                                    <?php if($count_purchase_outstandings>0):?>
                                    <span class="badge green pull-right"><?=$count_purchase_outstandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."admin/outstandings/purchases" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases_outstandings');?>
                                    <?php if($count_purchase_outstandings>0):?>
                                    <span class="badge green pull-right"><?=$count_purchase_outstandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of Purchase outstandings-->
                            
                            <!--start Sales outstandings-->
							<?php if($page_name=='Sales outstandings' || $page_name=='View Sales Outstandings'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."admin/outstandings/sales"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales_outstandings');?>
                                    <?php if($count_sales_outsatandings>0):?>
                                    <span class="badge green pull-right"><?=$count_sales_outsatandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."admin/outstandings/sales"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales_outstandings');?>
                                    <?php if($count_sales_outsatandings>0):?>
                                    <span class="badge green pull-right"><?=$count_sales_outsatandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end Sales Outstandings-->
                            
                        </ul>
                    </li>
                    <!-- end outstandings CENTER DROPDOWN -->
                    
                    
                    <!-- begin Users LINK -->
                    <?php if($page_name=='Users'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/users/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-users"></i> <?php echo get_phrase('users');?>
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."admin/users/view" ?>">
                            <i class="fa fa-users"></i> <?php echo get_phrase('users');?>
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Users LINK -->
  
                    
                     <!-- begin settins CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#inventory">
                            <i class="fa fa-wrench"></i> <?php echo get_phrase('settings');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Settings' || $page_name=='Language Settings' || $page_name=='Manage Language'){
							echo'<ul class="collapse nav in" id="inventory">';}
							else {echo'<ul class="collapse nav" id="inventory">';}
						 ?>
                        
                        	<?php if($page_name=='Settings'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."admin/settings/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('general_settings');?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."admin/settings/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('general_settings');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of gen_settings-->
                            
                            <!--start lang_settings-->
                            <?php  if($page_name=='Language Settings' || $page_name=='Manage Language'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."admin/settings/language_settings"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('language_settings');?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."admin/settings/language_settings"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('language_settings');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end lang_settings-->
                        </ul>
                    </li>
                    <!-- end settings CENTER DROPDOWN -->
                                         
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$account_type.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
    <?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>

<!--begin of index user content-->






<?php } else if($account_type=='admin1'){ ?>
<?php
$where="due>='1'";
$this->db->select('*');
$this->db->from('orders');
$this->db->where($where);
$this->db->order_by('order_date','asc');
$count_sales_outsatandings	=	$this->db->count_all_results();
$where="due>='1'";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($where);
$this->db->order_by('purchase_date','asc');
$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
$count_purchase_outstandings	=	$this->db->count_all_results();

?>											

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?> | <?php echo $system_title; ?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('admin',$account_id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> <?php echo get_phrase('logged_in_as');?>
                        </p>
                        <?php if($account_type=='admin'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('logout');?>"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            John
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('logout');?>"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    <?php if($page_name=='Dashboard'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/dashboard" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-dashboard"></i> <?php echo get_phrase('dashboard');?>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/dashboard" ?>">
                            <i class="fa fa-dashboard"></i> <?php echo get_phrase('dashboard');?>
                        </a>
                    </li>
                    <?php }  ?>
                    <!-- end DASHBOARD LINK -->
                    
                    <!-- begin Suppliers -->
                      <?php if($page_name=='Suppliers' || $page_name=='View Supplier'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/suppliers/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('suppliers');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."admin/suppliers/view" ?>">
                                <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('suppliers');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end Suppliers  -->
                    
                      <!-- begin inventory CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#inventory">
                            <i class="fa fa-briefcase"></i> <?php echo get_phrase('inventory');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Category' || $page_name=='Descriptions' || $page_name=='Stock' || $page_name=='View Stock'){
							echo'<ul class="collapse nav in" id="inventory">';}
							else {echo'<ul class="collapse nav" id="inventory">';}
						 ?>
                        
                        	<?php if($page_name=='Category'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."admin/category/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_category');?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."admin/category/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_category');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of category-->
                            
                            <!--start description-->
							<?php if($page_name=='Descriptions'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."admin/descriptions/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_descriptions');?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."admin/descriptions/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_descriptions');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end description-->
                            
                            <!--start stock-->
                            <?php  if($page_name=='Stock' || $page_name=='View Stock'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."admin/stock/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_stock');?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."admin/stock/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_stock');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end stock-->
                        </ul>
                    </li>
                    <!-- end inventory CENTER DROPDOWN -->
                    
                    <!-- begin sales -->
                      <?php if($page_name=='Sales' || $page_name=='View Sales'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/sales/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-money"></i> <?php echo get_phrase('sales');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."admin/sales/view" ?>">
                                <i class="fa fa-money"></i> <?php echo get_phrase('sales');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end sales  -->
                    
                     <!-- begin outsatanding CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#outstandings">
                            <i class="fa fa-tags"></i> <?php echo get_phrase('outstandings');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Purchase outstandings' || $page_name=='Sales outstandings' || $page_name=='View Sales Outstandings' || $page_name=='View Purchases Outstandings'){
							echo'<ul class="collapse nav in" id="outstandings">';}
							else {echo'<ul class="collapse nav" id="outstandings">';}
						 ?>
                        
                        	<?php if($page_name=='Purchase outstandings' || $page_name=='View Purchases Outstandings'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."admin/outstandings/purchases" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases_outstandings');?>
                                    <?php if($count_purchase_outstandings>0):?>
                                    <span class="badge green pull-right"><?=$count_purchase_outstandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."admin/outstandings/purchases" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases_outstandings');?>
                                    <?php if($count_purchase_outstandings>0):?>
                                    <span class="badge green pull-right"><?=$count_purchase_outstandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of Purchase outstandings-->
                            
                            <!--start Sales outstandings-->
							<?php if($page_name=='Sales outstandings' || $page_name=='View Sales Outstandings'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."admin/outstandings/sales"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales_outstandings');?>
                                    <?php if($count_sales_outsatandings>0):?>
                                    <span class="badge green pull-right"><?=$count_sales_outsatandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."admin/outstandings/sales"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales_outstandings');?>
                                    <?php if($count_sales_outsatandings>0):?>
                                    <span class="badge green pull-right"><?=$count_sales_outsatandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end Sales Outstandings-->
                            
                        </ul>
                    </li>
                    <!-- end outstandings CENTER DROPDOWN -->
                    
                    <!-- begin Users LINK -->
                    <?php if($page_name=='Users'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/users/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-users"></i> <?php echo get_phrase('users');?>
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."admin/users/view" ?>">
                            <i class="fa fa-users"></i> <?php echo get_phrase('users');?>
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Users LINK -->
                    
                    <!-- begin reports LINK -->
                    <?php if($page_name=='Reports' || $page_name=='Stock Reports' || $page_name=='Category Reports' || $page_name=='Purchases Reports' || $page_name=='Sales Reports' || $page_name=='Sales Outstanding Reports' || $page_name=='Purchases Outstanding Reports' || $page_name=='Events Reports' ){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/reports/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-rss"></i> <?php echo get_phrase('reports');?>
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."admin/reports/view" ?>">
                            <i class="fa fa-rss"></i> <?php echo get_phrase('reports');?>
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Reports LINK -->                     
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$account_type.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
    <?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>

<!--begin of index user content-->


<?php } else if($account_type=='inventory manager'){ ?>
<?php
$where="due>='1'";
$this->db->select('*');
$this->db->from('orders');
$this->db->where($where);
$this->db->order_by('order_date','asc');
$count_sales_outsatandings	=	$this->db->count_all_results();
$where="due>='1'";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($where);
$this->db->order_by('purchase_date','asc');
$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
$count_purchase_outstandings	=	$this->db->count_all_results();

?>											

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?> | <?php echo $system_title; ?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$account_id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> <?php echo get_phrase('logged_in_as');?>
                        </p>
                        <?php if($account_type=='inventory manager'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('logout');?>"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            John
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('logout');?>"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    <?php if($page_name=='Dashboard'){ ?>
                    <li>
                        <a href="<?php echo base_url()."manager/dashboard" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-dashboard"></i> <?php echo get_phrase('dashboard');?>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."manager/dashboard" ?>">
                            <i class="fa fa-dashboard"></i> <?php echo get_phrase('dashboard');?>
                        </a>
                    </li>
                    <?php }  ?>
                    <!-- end DASHBOARD LINK -->
                    
                    <!-- begin Suppliers -->
                      <?php /*?><?php if($page_name=='Suppliers' || $page_name=='View Supplier'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/suppliers/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('suppliers');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."admin/suppliers/view" ?>">
                                <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('suppliers');?>
                            </a>
                    </li>
                      <?php } ?><?php */?>
                    <!-- end Suppliers  -->
                    
                      <!-- begin inventory CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#inventory">
                            <i class="fa fa-briefcase"></i> <?php echo get_phrase('inventory');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Category' || $page_name=='Descriptions' || $page_name=='Stock' || $page_name=='View Stock'){
							echo'<ul class="collapse nav in" id="inventory">';}
							else {echo'<ul class="collapse nav" id="inventory">';}
						 ?>
                        
                        	<?php if($page_name=='Category'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."manager/category/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_category');?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."manager/category/view" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_category');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of category-->
                            
                            <!--start description-->
							<?php if($page_name=='Descriptions'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."manager/descriptions/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_descriptions');?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."manager/descriptions/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_descriptions');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end description-->
                            
                            <!--start stock-->
                            <?php  if($page_name=='Stock' || $page_name=='View Stock'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."manager/stock/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_stock');?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."manager/stock/view"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('manage_stock');?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end stock-->
                        </ul>
                    </li>
                    <!-- end inventory CENTER DROPDOWN -->
                    
                    <!-- begin purchases -->
                      <?php if($page_name=='Purchases' || $page_name=='View Purchases'){ ?>
                    <li>
                        <a href="<?php echo base_url()."manager/purchases/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-money"></i> <?php echo get_phrase('purchases');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."manager/purchases/view" ?>">
                                <i class="fa fa-money"></i> <?php echo get_phrase('purchases');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end purchases  -->
                    
                    <!-- begin sales -->
                      <?php if($page_name=='Sales' || $page_name=='View Sales'){ ?>
                    <li>
                        <a href="<?php echo base_url()."manager/sales/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-money"></i> <?php echo get_phrase('sales');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."manager/sales/view" ?>">
                                <i class="fa fa-money"></i> <?php echo get_phrase('sales');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end sales  -->
                    

                    
                    <!-- begin Users LINK -->
                    <?php /*?><?php if($page_name=='Users'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/users/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-users"></i> <?php echo get_phrase('users');?>
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."admin/users/view" ?>">
                            <i class="fa fa-users"></i> <?php echo get_phrase('users');?>
                        </a>
                    </li>
                    
                    <?php } ?><?php */?>
                    <!-- end Users LINK -->
                    
                    <!-- begin reports LINK -->
                    <?php if($page_name=='Reports' || $page_name=='Stock Reports' || $page_name=='Category Reports' || $page_name=='Purchases Reports' || $page_name=='Sales Reports' || $page_name=='Sales Outstanding Reports' || $page_name=='Purchases Outstanding Reports' || $page_name=='Events Reports' ){ ?>
                    <li>
                        <a href="<?php echo base_url()."manager/reports/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-rss"></i> <?php echo get_phrase('reports');?>
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."manager/reports/view" ?>">
                            <i class="fa fa-rss"></i> <?php echo get_phrase('reports');?>
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Reports LINK -->                     
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$account_type.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
    <?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>

<!--begin of index user content-->

<?php } elseif($account_type=='user'){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?> | <?php echo $system_title; ?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$account_id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> Logged in as
                        </p>
                        <?php if($account_type=='user'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            John
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    <?php if($page_name=='Dashboard'){ ?>
                    <li>
                        <a href="<?php echo base_url()."user/dashboard" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."user/dashboard" ?>">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php }  ?>
                    <!-- end DASHBOARD LINK -->
                    
                       <!-- begin stock -->
                      <?php if($page_name=='Stock'){ ?>
                    <li>
                        <a href="<?php echo base_url()."user/stock/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-briefcase"></i> Stock
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."user/stock/view" ?>">
                                <i class="fa fa-briefcase"></i> Stock
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end stock  -->
                    
                    <!-- begin sales -->
                      <?php if($page_name=='Sales' || $page_name=='View Order'){ ?>
                    <li>
                        <a href="<?php echo base_url()."user/sales/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-money"></i> Sales
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."user/sales/view" ?>">
                                <i class="fa fa-money"></i> Sales
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end sales  -->
                    
                     <!-- begin orders -->
                      <?php if($page_name=='Outstandings' || $page_name=='View Sales'){ ?>
                    <li>
                        <a href="<?php echo base_url()."user/outstandings/sales" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-shopping-cart"></i> Outstandings
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."user/outstandings/sales" ?>">
                                <i class="fa fa-shopping-cart"></i> Outstandings
                            </a>
                    </li>
                      <?php } ?>
                      
                    <!-- end orders  -->
                    
                    <!-- begin reports LINK -->
                    <?php if($page_name=='Reports' || $page_name=='Stock Reports' || $page_name=='Sales Reports' || $page_name=='Sales Outstanding Reports' || $page_name=='Events Reports'){ ?>
                    <li>
                        <a href="<?php echo base_url()."user/reports/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-rss"></i> Reports
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."user/reports/view" ?>">
                            <i class="fa fa-rss"></i> Reports
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Reports LINK -->                     
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$account_type.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
    <?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>


<?php } elseif($account_type=='sales manager'){ ?>
<?php
$where="due>='1'";
$this->db->select('*');
$this->db->from('orders');
$this->db->where($where);
$this->db->order_by('order_date','asc');
$count_sales_outsatandings	=	$this->db->count_all_results();
$where="due>='1'";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($where);
$this->db->order_by('purchase_date','asc');
$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
$count_purchase_outstandings	=	$this->db->count_all_results();

$this->db->select('*');
$this->db->from('purchases');
$count_all_purchases	=	$this->db->count_all_results();

$this->db->select('*');
$this->db->from('orders');
$count_all_sales	=	$this->db->count_all_results();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?> | <?php echo $system_title; ?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$account_id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> Logged in as
                        </p>
                        <?php if($account_type=='sales manager'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            John
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    <?php if($page_name=='Dashboard'){ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/dashboard" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/dashboard" ?>">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php }  ?>
                    <!-- end DASHBOARD LINK -->
                    
                     <!-- begin Suppliers -->
                      <?php if($page_name=='Suppliers' || $page_name=='View Supplier'){ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/suppliers/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-users"></i> <?php echo get_phrase('suppliers');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."salesManager/suppliers/view" ?>">
                                <i class="fa fa-users"></i> <?php echo get_phrase('suppliers');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end Suppliers  -->
                    
                    
                    <!-- begin purchases -->
                      <?php if($page_name=='Purchases' || $page_name=='View Purchases'){ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/purchases/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('purchases');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."salesManager/purchases/view" ?>">
                                <i class="fa fa-shopping-cart"></i> <?php echo get_phrase('purchases');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end purchases  -->
                    
                     <!-- begin sales -->
                      <?php if($page_name=='Sales' || $page_name=='View Sales'){ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/sales/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-hospital-o"></i> <?php echo get_phrase('sales');?>
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."salesManager/sales/view" ?>">
                                <i class="fa fa-hospital-o"></i> <?php echo get_phrase('sales');?>
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end sales  -->
                    
                    
                       <!-- begin stock -->
                      <?php if($page_name=='Stock'){ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/stock/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-briefcase"></i> Stock
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."salesManager/stock/view" ?>">
                                <i class="fa fa-briefcase"></i> Stock
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end stock  -->
                    
                   
                    
                                          <!-- begin outsatanding CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#outstandings">
                            <i class="fa fa-tags"></i> <?php echo get_phrase('outstandings');?> <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='Purchase outstandings' || $page_name=='Sales outstandings' || $page_name=='View Sales Outstandings' || $page_name=='View Purchases Outstandings'){
							echo'<ul class="collapse nav in" id="outstandings">';}
							else {echo'<ul class="collapse nav" id="outstandings">';}
						 ?>
                        
                        	<?php if($page_name=='Purchase outstandings' || $page_name=='View Purchases Outstandings'){ ?>
                            <li>
                                <a  class="active" href="<?php echo base_url()."salesManager/outstandings/purchases" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases_outstandings');?>
                                    <?php if($count_purchase_outstandings>0):?>
                                    <span class="badge green pull-right"><?=$count_purchase_outstandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <a href="<?php echo base_url()."salesManager/outstandings/purchases" ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('purchases_outstandings');?>
                                    <?php if($count_purchase_outstandings>0):?>
                                    <span class="badge green pull-right"><?=$count_purchase_outstandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end of Purchase outstandings-->
                            
                            <!--start Sales outstandings-->
							<?php if($page_name=='Sales outstandings' || $page_name=='View Sales Outstandings'){ ?>
                            <li>
                                <a class="active" href="<?php echo base_url()."salesManager/outstandings/sales"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales_outstandings');?>
                                    <?php if($count_sales_outsatandings>0):?>
                                    <span class="badge green pull-right"><?=$count_sales_outsatandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }else{?>
                            <li>
                                <a href="<?php echo base_url()."salesManager/outstandings/sales"?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo get_phrase('sales_outstandings');?>
                                    <?php if($count_sales_outsatandings>0):?>
                                    <span class="badge green pull-right"><?=$count_sales_outsatandings?></span>
									<?php endif ?>
                                </a>
                            </li>
                            <?php }?>
                            <!--end Sales Outstandings-->
                            
                        </ul>
                    </li>
                    <!-- end outstandings CENTER DROPDOWN -->
                    
                    <!-- begin reports LINK -->
                    <?php if($page_name=='Reports' || $page_name=='Stock Reports' || $page_name=='Sales Reports' || $page_name=='Sales Outstanding Reports' || $page_name=='Events Reports'){ ?>
                    <li>
                        <a href="<?php echo base_url()."salesManager/reports/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-rss"></i> Reports
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."salesManager/reports/view" ?>">
                            <i class="fa fa-rss"></i> Reports
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Reports LINK -->                     
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$account_type.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
    <?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>




<!--begin of index accountant content-->
<?php }elseif($account_type=='accountant'){?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title;?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo base_url(); ?>components/img/profile-pic.jpg" alt="">
                        <p class="welcome">
                            <i class="fa fa-key"></i> Logged in as
                        </p>
                        <p class="name tooltip-sidebar-logout">
                            john
                            <span class="last-name"><?php echo $account_type; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin SIDE NAV SEARCH -->
                    <li class="nav-search">
                        <form role="form">
                            <input type="search" class="form-control" placeholder="Search...">
                            <button class="btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </li>
                    <!-- end SIDE NAV SEARCH -->
                    <!-- begin DASHBOARD LINK -->
                    <?php if($page_name=='Dashboard'){ ?>
                    <li>
                        <a href="<?php echo base_url()."accountant/dashboard" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."accountant/dashboard" ?>">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php }  ?>
                    <!-- end DASHBOARD LINK -->
                    
                    <?php /*?> <!-- begin Department LINK -->
                     <?php if($page_name=='Departments'){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/departments" ?>"<?php echo 'class="active"'; ?>>
                            <i class="fa fa-building-o"></i> Departments
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/departments" ?>">
                            <i class="fa fa-building-o"></i> Departments
                        </a>
                    </li>
                    <?php } ?>
                    <!-- end Department LINK --><?php */?>
                    
                    <!-- begin employees LINK -->
                    <?php if($page_name=='Employees'){ ?>
                    <li>
                        <a href="<?php echo base_url()."accountant/employees" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-users"></i> Employees
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."accountant/employees" ?>">
                                <i class="fa fa-users"></i> Employees
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end employees LINK -->
                    
                      <!-- begin PAYMENTS -->
                      <?php if($page_name=='Payments'){ ?>
                    <li>
                        <a href="<?php echo base_url()."accountant/payments/view" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-money"></i> Payments
                        </a>
                  	</li>
					  <?php }else{ ?>
                    <li>
                            <a href="<?php echo base_url()."accountant/payments/view" ?>">
                                <i class="fa fa-money"></i> Payments
                            </a>
                    </li>
                      <?php } ?>
                    <!-- end PAYMENTS  -->
                    
                    <!-- begin Statistics LINK -->
                    <li>
                        <a href="#">
                            <i class="fa fa-calendar"></i> Statistics
                        </a>
                    </li>
                    <!-- end Statistics LINK -->
                    
                    <?php /*?><!-- begin Users LINK -->
                    <?php if($page_name=='Users' || $page_name=='View user' ){ ?>
                    <li>
                        <a href="<?php echo base_url()."admin/users" ?>" <?php echo 'class="active"'; ?>>
                            <i class="fa fa-user"></i> Users
                        </a>
                    </li>
                    <?php } else { ?>
                     <li>
                        <a href="<?php echo base_url()."admin/users" ?>">
                            <i class="fa fa-user"></i> Users
                        </a>
                    </li>
                    
                    <?php } ?>
                    <!-- end Users LINK --><?php */?>
                    
                    
                    <!-- begin MESSAGE CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#message-center">
                            <i class="fa fa-inbox"></i> Message Center <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="collapse nav" id="message-center">
                            <li>
                                <a href="<?php echo base_url()."main/mailbox" ?>">
                                    <i class="fa fa-angle-double-right"></i> Mailbox
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()."main/newmail"?>">
                                    <i class="fa fa-angle-double-right"></i> Compose Message
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <i class="fa fa-angle-double-right"></i> Chat
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end MESSAGE CENTER DROPDOWN -->
                   
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$account_type.'/'.$page_name.'.php';?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
    <?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>

<?php }?>
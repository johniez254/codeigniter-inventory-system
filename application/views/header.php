<?php $user       =	$this->session->userdata('role'); ?>
<?php if($user=='admin'){ ?>
				<!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                <i class="fa fa-arrow-circle-right"></i> <?php echo $page_name_phrase;?>
                            </h1>
                            <?php if($crumb=='2'){?>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."admin/dashboard" ?>"><?php echo get_phrase('dashboard');?></a>
                                </li>
                                <li  class="active"> <a href="<?php echo base_url()."admin/".$function."" ?>"><?php echo $page_crumb;?></a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
							
							<?php }else{?>                            
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."admin/dashboard" ?>"><?php echo get_phrase('dashboard');?></a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
                            <?php }?>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
                
                
                
                
                <?php }elseif($user=='user'){?>
                	<!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1> <i class="fa fa-arrow-circle-right"></i> 
                                <?php echo $page_name; ?>
                            </h1>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."user/dashboard" ?>">Dashboard</a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
                  <?php }elseif($user=='sales manager'){?>
                	<!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                <i class="fa fa-arrow-circle-right"></i> <?php echo $page_name_phrase;?>
                            </h1>
                            <?php if($crumb=='2'){?>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."admin/dashboard" ?>"><?php echo get_phrase('dashboard');?></a>
                                </li>
                                <li  class="active"> <a href="<?php echo base_url()."salesManager/".$function."" ?>"><?php echo $page_crumb;?></a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
							
							<?php }else{?>                            
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."salesManager/dashboard" ?>"><?php echo get_phrase('dashboard');?></a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
                            <?php }?>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
                <?php }elseif($user=='inventory manager'){?>
                	<!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1> <i class="fa fa-arrow-circle-right"></i> 
                                <?php echo $page_name; ?>
                            </h1>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."manager/dashboard" ?>">Dashboard</a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
				<?php }else{ ?>
                
                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                <?php echo $page_name; ?>
                            </h1>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."accountant/dashboard" ?>">Dashboard</a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
				<?php } ?>
				
                
                
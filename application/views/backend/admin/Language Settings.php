<?php //$current_editing_language	=	$lang; ?>
						<div class="row">
                        
                        
                         <div class="col-lg-12">

                        <!-- begin FONT AWESOME ICONS -->
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('manage_language');?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                            <div class="row">
                                
                                <div class="col-lg-12">
                                <ul id="myPills" class="nav nav-pills" style="background-color:#f5f5f5;">
                                    <li class="active"><a href="#pillProfile" data-toggle="tab"><i class="fa fa-list-ul"></i> <?php echo get_phrase('language_list'); ?></a>
                                    </li>
                                    <li><a href="#pillLanguage" data-toggle="tab"><i class="fa fa-plus-circle"></i> <?php echo get_phrase('add_phrase');?></a>
                                    </li>
                                     <li><a href="#pillPhrase" data-toggle="tab"><i class="fa fa-plus-circle"></i> <?php echo get_phrase('add_language');?></a>
                                    </li>
                                </ul>
                                </div>
                                
                                <div id="myPillsContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="pillProfile">
                                    <div class="col-lg-12">
                                    <hr />
                                    	<div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="background-color:#f5f5f5;"><?php echo get_phrase('language'); ?></th>
                                                <th style="background-color:#f5f5f5;"><?php echo get_phrase('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                               <?php
							   		$fields = $this->db->list_fields('language');
                                        foreach($fields as $field)
								{
									 if($field == 'phrase_id' || $field == 'phrase')continue;
							?>
                                            <tr>
                                                <td>
                                                <?php echo ucwords($field);?>
                                                </td>
                                                <td>
                                                <a href="<?php echo base_url();?>admin/settings/manage_language/<?php echo $field;?>"
                                	 class="btn btn-blue btn-xs">
                                		<i class="fa fa-pencil"></i> <?php echo get_phrase('edit_language');?>
                                </a>
                                                </td>
                                            </tr>
                                            <?php }; ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>

                                    </div>
                                    
                                    
                                    <div class="tab-pane fade" id="pillLanguage">
                                    <div class="col-lg-12">
                                        <hr />
                                         <?php $attributes = array("name" => "form", 'id'=>'validatephrase', 'enctype' => 'multipart/form-data','class'=>"form-horizontal");
            echo form_open("admin/settings/add_phrase", $attributes);?>
            
             <div class="form-group">
                                                    <label for="phrase" class="col-sm-4 control-label"><?php echo get_phrase('phrase_name');?></label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="phrase" required="required" class="form-control" id="phrase" placeholder="<?php echo get_phrase('phrase_name');?>">
                                                    </div>
                                                </div>

                                                
                                                
                                                <div class="form-group">
                                                    <label for="sub" class="col-sm-4 control-label"></label>
                                                    <div class="col-sm-6">
                                                        <input type="submit"   id="sub" class="btn btn-square btn-green" value="<?php echo get_phrase('add_phrase');?>">
                                                    </div>
                                                </div>

            
            <?php echo form_close()?>
            </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="pillPhrase">
                                    <div class="col-lg-12">
                                        <hr />
                                         <?php $comps = array("name" => "form",'id'=>'validate','class'=>"form-horizontal");
            echo form_open("admin/settings/add_language", $comps);?>
            
             <div class="form-group">
                                                    <label for="lang" class="col-sm-4 control-label"><?php echo get_phrase('language_name');?></label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="language" required="required" class="form-control" id="lang" placeholder="<?php echo get_phrase('language_name');?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="submit" class="col-sm-4 control-label"></label>
                                                    <div class="col-sm-6">
                                                        <input type="submit"   id="submit" class="btn btn-square btn-green" value="<?php echo get_phrase('add_language');?>">
                                                    </div>
                                                </div>

            <?php echo form_close()?>
            
                                    </div>
                                    </div>
                                   
                        
                        </div>
                        </div>
                       </div>
                      </div> 
                        
                                        
			</div>
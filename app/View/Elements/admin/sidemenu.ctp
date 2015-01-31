<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span>
                            <?php 
                                //echo $this->webroot;
                                $imgPathSmall = "";
                                $imgPathBig = "";                                
                                $userImage = $this->Session->read('Auth.User.image');
                                 
                                if( !empty($userImage) && ( file_exists(WWW_ROOT . "images/user/big/".$userImage) )){
                                   $imgPathBig = $this->webroot."images/user/big/".$userImage    ;
                                   $imgPathSmall = $this->webroot."images/user/small/".$userImage    ;
                                }else{
                                   $imgPathBig    =  $this->webroot."img/admin/No-Image-Basic.png";
                                   $imgPathSmall  = $this->webroot."img/admin/photo.jpg";
                                }
                                 
                            ?> 
                            <img alt="image" id="profileImgSmall" class="img-circle" src="<?php echo $imgPathSmall; ?>" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                                <?php
                                    echo $this->Session->read('Auth.User.first_name')." ".$this->Session->read('Auth.User.last_name');
                                ?>
                            </strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                
                                    <li><a href="<?php echo $this->Html->url(array("controller"=>"users","action" => "profile","admin" => true));?>">Profile</a></li>
                                    <?php /*
                                    <li><a href="contacts.html">Contacts</a></li>
                                    <li><a href="mailbox.html">Mailbox</a></li>
                                    */
                                    ?>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $this->Html->url(array("controller"=>"users","action" => "logout","admin" => true));?>">Logout</a></li>
                                </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>

                    </li>
                    <li class="active">
                        <a href="<?php echo $this->Html->url(array("controller"=>"index","action" => "index","admin" => true));?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                    </li> 
                    <li id="sidemenu3">
                        <a href="javascript:void(0)"><i class="fa fa-files-o"></i> <span class="nav-label">Masters</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">                            
                            <li class=""><a href="<?php echo $this->Html->url(array("controller"=>"category","action" => "main","admin" => true));?>">Main Category</a></li>
                            <li class=""><a href="<?php echo $this->Html->url(array("controller"=>"category","action" => "sub","admin" => true));?>">Sub Category</a></li>
                            <li><a href="<?php echo $this->Html->url(array("controller"=>"services","action" => "index","admin" => true));?>">Services</a></li>
                        </ul>
                    </li>
                    <li id="sidemenu4">
                        <a href="#"><i class="fa fa-table"></i> <span class="nav-label">User Management</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo $this->Html->url(array("admin" => true,"controller"=>"customers","action" => "index"));?>">Customers</a></li>
                            <li><a href="<?php echo $this->Html->url(array("admin" => true,"controller"=>"serviceprovider","action" => "index"));?>">Service providers</a>
                            </li>
                            <li><a href="<?php echo $this->Html->url(array("admin" => true,"controller"=>"cleaner","action" => "index"));?>">Cleaner</a></li>
                        </ul>
                    </li>

                    <li id="sidemenu6">
                        <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Booking</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo $this->Html->url(array("admin" => true,"controller"=>"booking","action" => "bookinglist"));?>">Booking List</a></li>
                        </ul>
                    </li>
                    
                    <li id="sidemenu5">
                        <a href="javascript:void(0)"><i class="fa fa-files-o"></i> <span class="nav-label">Content Management</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">                            
                            <li class=""><a href="<?php echo $this->Html->url(array("controller"=>"cms_pages","action" => "index","admin" => true));?>">CMS Pages</a></li>
                            <!--
                            <li><a href="<?php //echo $this->Html->url(array("controller"=>"faq_categories","action" => "index","admin" => true));?>">FAQ's</a></li>
                            -->
                        </ul>
                    </li>
                    <!--
                    <li>
                        <a href="<?php //echo $this->Html->url(array("controller"=>"settings","action" => "index","admin" => true));?>"><i class="fa fa-cogs"></i><span class="nav-label">Settings</span></a>
                    </li>
										-->
                </ul>

            </div>
        </nav>
<?php
    $controller = $this->params['controller'];
    $selectedlink = "";
    if($controller == "category" || $controller == "services"){
        $selectedlink = "sidemenu3";
    }elseif($controller == "customers" || $controller == "serviceprovider" || $controller == "cleaner"){
        $selectedlink = "sidemenu4";
    }elseif($controller == "cms_pages"){
        $selectedlink = "sidemenu5";
    }
?>
<script type="text/javascript">

$( document ).ready(function() {
    $("#<?php echo $selectedlink;?> a").click();
});

</script>
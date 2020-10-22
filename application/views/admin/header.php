<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META SECTION -->
    <title><?php
    echo $ProjectName;
    ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url();?>assets/theme/css/theme-night-head-light.css"/>
    <!-- START PLUGINS -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/theme/js/plugins/nestable/jquery.nestable.js"></script>
    <!-- END PLUGINS -->
    <!-- EOF CSS INCLUDE -->
</head>
<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
        <li class="xn-logo"> <a href="<?php echo base_url();?>administrator/dashboard/index"><?php echo $ProjectName; ?></a><a href="#" class="x-navigation-control"></a> </li>
        <li class="xn-profile"> <a href="#" class="profile-mini">
                <img src="/assets/theme/assets/images/users/user.jpg" alt="image"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                     <img src="/assets/theme/assets/images/users/user.jpg" alt="image"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?php echo isset($FullName) ? $FullName : ''; ?></div>
                    <div class="profile-data-title"><?php echo isset($MemberLevel) ? $MemberLevel : ''; ?></div>
                </div>
                
            </div>
        </li>

        <li class="<?php if ($Active == 'Dashboard') { echo "active"; }?>"><a href="/admin/dashboard/index"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a></li>

        <li class="<?php if ($Active == 'store' || $Active == 'store_categories' || $Active == 'store_products' || $Active == 'store_order_management') { echo "active"; } ?> "><a href="#"><span class="fa fa-list"></span> <span class="xn-text">Store</span></a>
            <ul>
                <li class="<?php if ($Active == 'store_categories') { echo "active"; } ?>"><a href="/admin/store/categories"><span class="fa fa-th-list"></span> Categories</a></li>
                <li class="<?php if ($Active == 'store_products') { echo "active"; } ?>"><a href="/admin/store/products"><span class="fa fa-th-list"></span> Products</a></li>
                <li class="<?php if ($Active == 'store_order_management') { echo "active"; } ?>"><a href="/admin/store/ordermanagement"><span class="fa fa-th-list"></span> Order_management</a></li>
            </ul>
        </li>
        <li class="<?php if ($Active == 'OurServices' || $Active == 'ManageServices') { echo "active"; } ?>"><a href="#"><span class="fa fa-th-list"></span> <span class="xn-text">Our Services</span></a>
            <ul>
                <li class="<?php if ($Active == 'ManageServices') {  echo "active"; } ?>"><a href="/admin/services/index"><span class="fa fa-file-text-o"></span> Manage Services</a></li>
            </ul>
        </li>
        <li class="<?php if ($Active == 'Users-All' || $Active == 'Users-Manage') { echo "active";} ?>"><a href="#"><span class="fa fa-users"></span> <span class="xn-text">Users</span></a>
        <ul>
            <li class="<?php if ($Active == 'Users-All') { echo "active"; } ?>"><a href="/admin/users/index"><span class="fa fa-th-list"></span> View Users</a></li>
            <!-- <li class="<?php if ($Active == 'Users-Manage') { echo "active"; }?>"><a href="/admin/users/manage"><span class="fa fa-plus-square-o"></span> Manage Users</a></li> -->

        </ul>
        </li>
        <li class="<?php if ($Active == 'Banner') { echo "active";} ?>"><a href="/admin/banner/index"><span class="fa fa-bold"></span><span class="xn-text">Manage Banner</span></a></li>
          <li class="<?php if ($Active == 'MainCategoryDetails' || $Active == 'ManageCategory') { echo "active";} ?>"><a href="#"><span class="fa fa-th"></span><span class="xn-text">Main Category Details</span></a>
            <ul>
            <li class="<?php if ($Active == 'ManageCategory') { echo "active"; } ?>"><a href="/admin/category/index"><span class="fa fa-align-justify"></span> Manage Category</a></li>
        
        </ul>
          </li>
           <li class="<?php if ($Active == 'SEO') { echo "active";} ?>"><a href="/admin/seo/index"><span class="fa fa-bold"></span><span class="xn-text">SEO Management</span></a></li>
       
</ul>
<!-- END X-NAVIGATION -->
</div>

<!-- END PAGE SIDEBAR -->
<div class="page-content">

    <!-- START X-NAVIGATION VERTICAL -->
    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
        <!-- TOGGLE NAVIGATION -->
        <li class="xn-icon-button">
            <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
        </li>
        <!-- END TOGGLE NAVIGATION -->

        <!-- POWER OFF -->
        <li class="xn-icon-button pull-right last">
            <a href="#"><span class="fa fa-power-off"></span></a>
            <ul class="xn-drop-left animated zoomIn">
             <li><a href="/admin/users/changepassword" class="><span class="fa fa-users-o"></span> Change Password</a></li>
            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
        </ul>
    </li>
   
    
    <!-- END LANG BAR -->
</ul>
                <!-- END X-NAVIGATION VERTICAL -->
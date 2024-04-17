<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Hospital CMS</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>public/admin/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>public/admin/plugins/summernote/summernote-bs4.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          Welcome,<strong>Admin</strong>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url().'admin/login/logout';?>" class="dropdown-item">
          Logout
          </a>
          
        
          
        </div>
      </li>
      
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url().'admin/home/index'?>" class="brand-link bg-white">
     
      <span class="brand-text ml-4"><strong>Hospital CMS</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="<?php echo base_url().'admin/home/index'?>" class="nav-link">
            <i class="fa fa-dashboard nav-icon" style="color: white;"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php echo(!empty($mainModule) && $mainModule =="pages") ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link">
            <i class="fa fa-newspaper-o nav-icon" style="color: white;"></i>                                                                                                                                                                    
              <p>
                Pages
                <i class="right fas fa-angle-left"></i> 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/home/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="pages" && !empty($subModule) && $subModule =="viewHome") ? 'active' : '' ;?>">
                  <i class="fa fa-home nav-icon" style="color: white;"></i>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/about/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="pages" && !empty($subModule) && $subModule =="viewAbout") ? 'active' : '' ;?>">
                  <i class="fa fa-info-circle nav-icon" style="color: white;"></i>                                                                                                                                                                                                                                                                        
                  <p>About</p> 
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/service/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="pages" && !empty($subModule) && $subModule =="cService") ? 'active' : '' ;?>">
                  <i class="fa fa-plus-square nav-icon" style="color: white;"></i>                                                                                                                                                                                                                                                                        
                  <p>Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/contact/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="pages" && !empty($subModule) && $subModule =="viewContact") ? 'active' : '' ;?>">
                  <i class="far fa-address-book nav-icon" style="color: white;"></i>                                                                                                                                                                                                                                                                        
                  <p>Contact</p>
                </a>
              </li>
            </ul>
          </li>

              <li class="nav-item has-treeview <?php echo(!empty($mainModule) && $mainModule =="department") ? 'menu-open' : '' ?>">
            <a href="<?php echo base_url().'admin/department/index'?>" class="nav-link">
            <i class="fas fa-building nav-icon" style="color: white;"></i>
              <p>
                Departments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php echo base_url().'admin/department/create'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="department" && !empty($subModule) && $subModule =="cDepartment") ? 'active' : '' ;?>">
                  <i class="fa fa-plus-circle nav-icon" style="color: white;"></i>
                  <p>Add Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/department/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="department" && !empty($subModule) && $subModule =="viewDepartment") ? 'active' : '' ;?>">
                  <i class="fa fa-low-vision nav-icon" style="color: white;"></i>                                                                                                                                                                   
                  <p>View Departments</p>                                                                                                                                                                                                                                                                                                                   
                </a>
              </li>
            </ul>
          </li>      

          <li class="nav-item has-treeview <?php echo(!empty($mainModule) && $mainModule =="doctor") ? 'menu-open' : '' ?>">
            <a href="<?php echo base_url().'admin/doctor/index'?>" class="nav-link">
            <i class="	fa fa-user-md nav-icon" style="color: white;"></i>                                                                                                                                                                    
              <p>
                Doctors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/doctor/create'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="doctor" && !empty($subModule)&& $subModule =="createDoctor") ? 'active' : '' ?>">
                  <i class="fa fa-plus-circle nav-icon" style="color: white;"></i>
                  <p>Add Doctors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/doctor/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="doctor" && !empty($subModule)&& $subModule =="viewDoctor") ? 'active' : '' ?>">
                  <i class="fa fa-low-vision nav-icon" style="color: white;"></i>                                                                                                                                                                                                                                                                        
                  <p>View doctors</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo(!empty($mainModule) && $mainModule =="form") ? 'menu-open' : '' ?>">
            <a href="<?php echo base_url().'admin/form/index'?>" class="nav-link">
            <i class="	fa fa-file-text-o nav-icon" style="color: white;"></i>                                                                                                                                                                    
              <p>
                Forms
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/appointment/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="form" && !empty($subModule)&& $subModule =="viewAppointment") ? 'active' : '' ?>">
                  <i class="far fa-calendar-alt nav-icon" style="color: white;"></i>
                  <p>Appointment form</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/enquiry/index'?>" class="nav-link <?php echo(!empty($mainModule) && $mainModule =="form" && !empty($subModule)&& $subModule =="viewEnquiry") ? 'active' : '' ?>">
                  <i class="far fa-address-book nav-icon" style="color: white;"></i>                                                                                                                                                                                                                                                                        
                  <p>Enquiry Form</p>
                </a>
              </li>

              </ul>
          </li>
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fa fa-cog nav-icon" style="color: white;"></i>                                                                                                                                                                    
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                
                <a href="<?php echo base_url().'admin/login/logout';?>" class="nav-link">
                  <i class="fa fa-sign-out nav-icon" style="color: white;"></i>
                  <p>Logout</p>
                </a>
              </li>

            
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

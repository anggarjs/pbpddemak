<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, nice admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, " />
  <meta name="description" content="Nice is powerful and clean admin dashboard template, inpired from Google's Material Design" />
  <meta name="robots" content="noindex,nofollow" />
  <title>Dashboard MDU PBPD Demak</title>
  <link rel="canonical" href="https://www.wrappixel.com/templates/niceadmin/" />
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png" />
  <!-- Feather Icon -->
  <script src="https://unpkg.com/feather-icons"></script>
  <!-- Custom CSS -->
  <link href="<?php echo base_url() ?>dist/css/style.min.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>css/error.css" rel="stylesheet" />
  <!-- This page plugin CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <!-- JS DATATABLES -->
  <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
  <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#233242" stroke-width="2"></path>
      <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#233242" stroke-width="2"></path>
      <path id="teabag" fill="#233242" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
      <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#233242"></path>
      <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#233242" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
            <i class="ri-close-line fs-6 ri-menu-2-line"></i>
          </a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-brand">
            <a href="<?php echo base_url('Input/upload_rab') ?>" class="logo">
              <!-- Logo icon -->
              <b class="logo-icon">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="<?php echo base_url() ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo icon -->
                <img src="<?php echo base_url() ?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                <!-- dark Logo text -->
                <img src="<?php echo base_url() ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo text -->
                <img src="<?php echo base_url() ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
              </span>
            </a>
            <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
              <i class="mdi mdi-toggle-switch mdi-toggle-switch-off fs-6"></i>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i data-feather="more-horizontal" class="feather-sm"></i>
          </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav me-auto">
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav">
            <!-- ============================================================== -->
            <!-- Messages -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">

            </li>
            <!-- ============================================================== -->
            <!-- End Messages -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Comment -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown border-end">

            </li>
            <!-- ============================================================== -->
            <!-- End Comment -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="
                    nav-link
                    dropdown-toggle
                    waves-effect waves-dark
                    pro-pic
                  " href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo base_url() ?>assets/images/users/2.jpg" alt="user" class="rounded-circle" width="40" />
                <span class="ms-1 font-weight-medium d-none d-sm-inline-block"><?php echo $nama_user; ?>
                  <i data-feather="chevron-down" class="feather-sm"></i></span>
              </a>

            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->



    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu">Menu Sidebar</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-av-timer"></i>
                <span class="hide-menu">Dashboard </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="#" class="sidebar-link">
                    <i class="mdi mdi-adjust"></i>
                    <span class="hide-menu"> Classic </span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-receipt"></i>
                <span class="hide-menu">Pengelolaan PBPD</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
			<!-- only admin, admin up3 dan admin ulp akses -->
			<?php if(($_SESSION['role_user'] == 1) || ($_SESSION['role_user'] == 3) || $_SESSION['role_user'] == 4){ ?>  
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>Input/upload_rab" class="sidebar-link">
                    <i class="mdi mdi-content-paste"></i>
                    <span class="hide-menu"> Upload RAB</span>
                  </a>
                </li>
			<?php } ?>	
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>Capel/view_capel" class="sidebar-link">
                      <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu"> Data Capel Disetujui</span>
                  </a>
                </li>				
			<?php if($_SESSION['role_user'] == 1 || $_SESSION['role_user'] == 3){ ?>
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>Capel/view_capel_approved" class="sidebar-link">
                    <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu"> Pengecekan Material</span>
                  </a>
                </li>
			<?php } ?>
			<?php if($_SESSION['role_user'] == 4){ ?>	
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>Capel/view_capel_lgkp_material" class="sidebar-link">
                    <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu"> Update Status Bayar</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>Capel/view_capel_sudah_bayar" class="sidebar-link">
                    <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu"> Update Status PDL</span>
                  </a>
                </li>				
			<?php } ?>
              </ul>
			</li>
		
		<!-- only admin dan admin up3 akses -->
		<?php if($_SESSION['role_user'] == 1 || $_SESSION['role_user'] == 3){ ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-border-none"></i>
                <span class="hide-menu">Logistik</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>Logistik/materialkurangPBPD" class="sidebar-link">
                    <i class="mdi mdi-arrange-bring-forward"></i>
                    <span class="hide-menu"> Material Kurang PBPD</span>
                  </a>
                </li>
				
              </ul>			  
			</li>
		<?php } ?>	
		
		<!-- only admin akses -->
		<?php if($_SESSION['role_user'] == 1){ ?>	
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Manajemen User</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>User/Tambah" class="sidebar-link">
                    <i class="mdi mdi-account-network"></i>
                    <span class="hide-menu"> Tambah Data</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>User/View" class="sidebar-link">
                    <i class="mdi mdi-account-star-variant"></i>
                    <span class="hide-menu"> Data User</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-receipt"></i>
                <span class="hide-menu">Administrator</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>User/Tambah" class="sidebar-link">
                    <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu"> Hapus Data Capel</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="<?php echo base_url() ?>User/View" class="sidebar-link">
                    <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu"> Rollback Kesiapan Material</span>
                  </a>
                </li>
              </ul>
            </li>			
		<?php } ?>	
		
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>Login/logout" aria-expanded="false">
                <i class="mdi mdi-directions"></i>
                <span class="hide-menu">Log Out</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->

    <?php echo $content; ?>
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- customizer Panel -->
  <!-- ============================================================== -->

  <div class="chat-windows"></div>
  <!-- ============================================================== -->
  <!-- My Javascript -->
  <script src="<?php echo base_url() ?>assets/js/script.js"></script>
  <!-- SweetAlert CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="<?php echo base_url() ?>dist/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?php echo base_url() ?>dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- apps -->
  <script src="<?php echo base_url() ?>dist/js/app.min.js"></script>
  <script src="<?php echo base_url() ?>dist/js/app.init.js"></script>
  <script src="<?php echo base_url() ?>dist/js/app-style-switcher.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="<?php echo base_url() ?>dist/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js"></script>
  <script src="<?php echo base_url() ?>dist/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
  <!--Wave Effects -->
  <script src="<?php echo base_url() ?>dist/js/waves.js"></script>
  <!--Flexigrid -->
  <script src="<?php echo base_url() ?>dist/js/flexigrid.js"></script>
  <!--Menu sidebar -->
  <script src="<?php echo base_url() ?>dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="<?php echo base_url() ?>dist/js/feather.min.js"></script>
  <script src="<?php echo base_url() ?>dist/js/custom.min.js"></script>
  <!--This page plugins -->
  <script src="<?php echo base_url() ?>dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>dist/js/pages/datatable/custom-datatable.js"></script>
  <script src="<?php echo base_url() ?>dist/js/pages/datatable/datatable-basic.init.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <!-- Feather Icon -->
  <script>
    feather.replace();
  </script>
  <!-- Script DataTable -->
  <script>
    $(document).ready(function() {
      $('#tabel-view-user').DataTable();
    });
    $(document).ready(function() {
      $('#tabel-data-survey').DataTable();
    });
  </script>
  <!-- End DataTables -->
</body>

</html>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Anak Bangsa">
  <title>Layanan Internet</title>
  <link rel="apple-touch-icon" href="{{ url('app-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ url('app-assets/images/ico/favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/vendors.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/app.css') }}">
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/core/menu/menu-types/vertical-compact-menu.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/charts/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/fonts/simple-line-icons/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/core/colors/palette-gradient.css') }}">
  <!-- END Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('app-assets/vendors/css/extensions/sweetalert.css') }}">
</head>
<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto">
            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="index.html">
              <img class="brand-logo" alt="modern admin logo" src="../app-assets/images/logo/logo.png">
              <h3 class="brand-text">Layanan Internet</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700">John Doe</span>
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="app-content content">
    @yield('content')
  </div>
  <footer class="footer fixed-bottom footer-dark navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2023 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
        target="_blank">ANAK BANGSA </a>, All rights reserved.
      </span>
    </p>
  </footer>
</body>
<script src="{{ url('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ url('app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/vendors/js/charts/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/vendors/js/charts/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/data/jvector/visitor-data.js') }}" type="text/javascript"></script>
<script src="{{ url('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>

<!-- END PAGE VENDOR JS-->
<script type="text/javascript">
  $( ".se-pre-con" ).hide();
  
  $(document).ajaxStop(function() {
    setTimeout(function(){
      $( ".se-pre-con" ).hide();
    },500);
  });
  $(document).ajaxStart(function() {
    $(".se-pre-con").show();
  });
  $(document).ajaxError(function() {
    setTimeout(function(){
      $( ".se-pre-con" ).hide();
    },500);
  });
  function logout(){
    swal({
      title: "Are you sure?",
      text: "Anda akan keluar dari sistem!",
      icon: "warning",
      showCancelButton: true,
      buttons: {
        cancel: {
          text: "Batal!",
          value: null,
          visible: true,
          className: "btn-warning",
          closeModal: false,
        },
        confirm: {
          text: "Keluar",
          value: true,
          visible: true,
          className: "",
          closeModal: false
        }
      }
    }).then(isConfirm => {
      if (isConfirm) {
        window.location = '{{ url("logout")}}'; 
      } else {
        swal("Batal!", "Anda batal keluar sistem!.", "info");
      } 
    });
  }
</script>

</html>
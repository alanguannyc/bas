<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="icon" href="../assets/img/BIG-APPLE.png">
    <title>
        Big Apple Star Awards Nominations
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/material-dashboard.css?v=2.1.1">
    <style>
        div.alert-success {
        bottom: 30px;
        position: absolute;
        right: 30px;
        z-index: 10;
        width: auto;
      }
    </style>
    
    <!-- Documentation extras -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{-- <link href="../assets/assets-for-demo/demo.css" rel="stylesheet" /> --}}
    <!-- iframe removal -->
</head>

<body class="" >
    <div class="wrapper">
        
        @include('layouts.member.sidebar')
        <div class="main-panel" >
            <!-- Navbar -->
              
            @include('layouts.member.nav')
            <!-- End Navbar -->
            <div class="content" id="member">
                    <div class="alert alert-success" style="display:none"></div>          
            @yield('content')
            </div>
            
            @include('layouts.member.footer')
        </div>
    </div>
</body>
{{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script> --}} --}}
{{-- <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script> --}}
 


<!--   Core JS Files   -->

<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/bootstrap-material-design.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!-- Library for adding dinamically elements -->
<script src="../assets/js/plugins/arrive.min.js" type="text/javascript"></script>
<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="../assets/js/material-dashboard.js?v=2.0.0"></script>
<!-- demo init -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="{{ asset('js/app.js?v=2.03') }}" ></script>
<script src="../assets/js/plugins/demo.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        //init wizard

        // demo.initMaterialWizard();

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initCharts();
    });
</script>


</html>

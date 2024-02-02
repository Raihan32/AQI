<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
if (isset($_POST['logout'])) {
  // Unset all session variables
  session_unset();
  
  // Destroy the session
  session_destroy();
  
  // Redirect to the login page after logout
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AQI</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        
                        <!-- Nav Item - Alerts -->
                       

                        <!-- Nav Item - Messages -->
                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <form method="post" action="">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <button onclick="window.open('recordtable.php', '_blank');" href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Temperatur</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <p ><span ><span id="ESP32_01_Temp"></span> &deg;C</span></p></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Humidity</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><p><span ><span id="ESP32_01_Humd"></span> &percnt;</span></p></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                      

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                PPM</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><p><span ><span id="ESP32_01_ppm"></span></span></p></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Card Body -->
                                <div class="card-body">
                                     <!-- Buttons for controlling the LEDs on Slave 2. ************************** -->
                    <div class="card-body">
                        <h4 ><i class="fas fa-lightbulb"></i> LED 1</h4>
                        <label >
                            <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01')" class="form-check-input">
                            <div >  </div>
                        </label>
                        <h4 ><i class="fas fa-lightbulb"></i> LED 2</h4>
                        <label >
                            <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02')" class="form-check-input">
                            <div >  </div>
                        </label>
                        <!-- *********************************************************************** -->
                    </div>
                                </div>
           
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                       

                    
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <script>
        //------------------------------------------------------------
        document.getElementById("ESP32_01_Temp").innerHTML = "NN"; 
        document.getElementById("ESP32_01_Humd").innerHTML = "NN";
        document.getElementById("ESP32_01_ppm").innerHTML = "NN";
        document.getElementById("ESP32_01_Status_Read").innerHTML = "NN";
        document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
        //------------------------------------------------------------
        
        Get_Data("esp32_01");
        
        setInterval(myTimer, 5000);
        
        //------------------------------------------------------------
        function myTimer() {
          Get_Data("esp32_01");
        }
        //------------------------------------------------------------
        
        //------------------------------------------------------------
        function Get_Data(id) {
                  if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
          } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              const myObj = JSON.parse(this.responseText);
              if (myObj.id == "esp32_01") {
                document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
                document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
                document.getElementById("ESP32_01_ppm").innerHTML = myObj.ppm;
                document.getElementById("ESP32_01_Status_Read").innerHTML = myObj.status_read_sensor;
                document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
                if (myObj.LED_01 == "ON") {
                  document.getElementById("ESP32_01_TogLED_01").checked = true;
                } else if (myObj.LED_01 == "OFF") {
                  document.getElementById("ESP32_01_TogLED_01").checked = false;
                }
                if (myObj.LED_02 == "ON") {
                  document.getElementById("ESP32_01_TogLED_02").checked = true;
                } else if (myObj.LED_02 == "OFF") {
                  document.getElementById("ESP32_01_TogLED_02").checked = false;
                }
              }
            }
          };
          xmlhttp.open("POST","getdata.php",true);
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send("id="+id);
              }
        //------------------------------------------------------------
        
        //------------------------------------------------------------
        function GetTogBtnLEDState(togbtnid) {
          if (togbtnid == "ESP32_01_TogLED_01") {
            var togbtnchecked = document.getElementById(togbtnid).checked;
            var togbtncheckedsend = "";
            if (togbtnchecked == true) togbtncheckedsend = "ON";
            if (togbtnchecked == false) togbtncheckedsend = "OFF";
            Update_LEDs("esp32_01","LED_01",togbtncheckedsend);
          }
          if (togbtnid == "ESP32_01_TogLED_02") {
            var togbtnchecked = document.getElementById(togbtnid).checked;
            var togbtncheckedsend = "";
            if (togbtnchecked == true) togbtncheckedsend = "ON";
            if (togbtnchecked == false) togbtncheckedsend = "OFF";
            Update_LEDs("esp32_01","LED_02",togbtncheckedsend);
          }
        }
        //------------------------------------------------------------
  
        //------------------------------------------------------------
        function Update_LEDs(id,lednum,ledstate) {
                  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //document.getElementById("demo").innerHTML = this.responseText;
            }
          }
          xmlhttp.open("POST","updateLEDs.php",true);
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send("id="+id+"&lednum="+lednum+"&ledstate="+ledstate);
              }
        //------------------------------------------------------------
      </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    
</body>

</html>
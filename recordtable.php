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
<!DOCTYPE HTML>
<html>
  <head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      /* ----------------------------------- TOPNAV STYLE */
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      /* ----------------------------------- */
      
      /* ----------------------------------- TABLE STYLE */
      .styled-table {
        border-collapse: collapse;
        margin-left: auto; 
        margin-right: auto;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 0.5em;
        overflow: hidden;
        width: 90%;
      }

      .styled-table thead tr {
        background-color: #0275d8;
        color: #f7f7f7;
        text-align: left;
      }

      .styled-table th {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table td {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }

      .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
      }

      .bdr {
        border-right: 1px solid #e3e3e3;
        border-left: 1px solid #e3e3e3;
      }
      
      td:hover {background-color: rgba(12, 105, 128, 0.21);}
      tr:hover {background-color: rgba(12, 105, 128, 0.15);}
      /* ----------------------------------- */
      
      /* ----------------------------------- BUTTON STYLE */
      .btn-group .button {
        background-color: #0275d8; /* Green */
        border: 1px solid #e3e3e3;
        color: white;
        padding: 5px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        float: center;
      }

      .btn-group .button:not(:last-child) {
        border-right: none; /* Prevent double borders */
      }

      .btn-group .button:hover {
        background-color: #094c5d;
      }

      .btn-group .button:active {
        background-color: #0c6980;
        transform: translateY(1px);
      }

      .btn-group .button:disabled,
      .button.disabled{
        color:#fff;
        background-color: #a0a0a0; 
        cursor: not-allowed;
        pointer-events:none;
      }
      /* ----------------------------------- */
    </style>
  </head>
  
  <body>
  <div id="wrapper">
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    
    <div class="sidebar-brand-text mx-3">Monitoring Kualitas Udara</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="home.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>
<hr class="sidebar-divider  my-0">
<?php
if ($_SESSION['role'] === 'admin') {
?>
<li class="nav-item active">
    <a onclick="window.open('recordtable.php', '_blank');" class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Table Record</span></a>
</li>
<?php
}
?>
<hr class="sidebar-divider my-0">
<!-- Sidebar Toggler (Sidebar) -->


</ul>  
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
                                    
                                    <form method="post" action="">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
  <table class="styled-table" id= "table_id">
      <thead>
        <tr>
          <th>NO</th>
          <th>DATE</th>
          <th>TIME</th>
          <th>TEMPERATURE (°C)</th>
          <th>HUMIDITY (%)</th>
          <th>PPM</th>
          <th>STATUS READ SENSOR DHT11</th>
          <th>Air Purifier</th>
          <th>AC</th>
          
          
        </tr>
      </thead>
      <tbody id="tbody_table_record">
        <?php
          include 'config.php';
          $num = 0;         
          $pdo = Database::connect();
          $sql = 'SELECT * FROM esp32_table_dht11_leds_record ORDER BY date, time';
          foreach ($pdo->query($sql) as $row) {
            $date = date_create($row['date']);
            $dateFormat = date_format($date,"d-m-Y");
            $num++;
            echo '<tr>';
            echo '<td>'. $num . '</td>';
            echo '<td>'. $dateFormat . '</td>';
            echo '<td class="bdr">'. $row['time'] . '</td>';
            echo '<td class="bdr">'. $row['temperature'] . '</td>';
            echo '<td class="bdr">'. $row['humidity'] . '</td>';
            echo '<td class="bdr">'. $row['ppm'] . '</td>';
            echo '<td class="bdr">'. $row['status_read_sensor'] . '</td>';
            echo '<td class="bdr">'. $row['LED_01'] . '</td>';
            echo '<td class="bdr">'. $row['LED_02'] . '</td>';
           
            echo '</tr>';
          }
          Database::disconnect();
        ?>
      </tbody>
    </table>
    
    <br>
    
    <div class="container">
    <div class="row justify-content-center">
        <div class="btn-group">
            <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
            <button class="button" id="btn_next" onclick="nextPage()">Next</button>
            <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; margin: 2px;">
                <p style=" font-size: 24px; margin: 2px;"> Table : <span id="page"></span></p>
            </div>
            <select name="number_of_rows" id="number_of_rows">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
        </div>
    </div>
</div>
    
    
  
    
    <script>
      //------------------------------------------------------------
      var current_page = 1;
      var records_per_page = 10;
      var l = document.getElementById("table_id").rows.length
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");
       
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
          if (listing_table.rows[i]) {
            listing_table.rows[i].style.display = ""
          } else {
            continue;
          }
        }
          
        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l-1) + ") | Number of Rows : ";
        
        if (page == 0 && numPages() == 0) {
          btn_prev.disabled = true;
          btn_next.disabled = true;
          return;
        }

        if (page == 1) {
          btn_prev.disabled = true;
        } else {
          btn_prev.disabled = false;
        }

        if (page == numPages()) {
          btn_next.disabled = true;
        } else {
          btn_next.disabled = false;
        }
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      function numPages() {
        return Math.ceil((l - 1) / records_per_page);
      }
      //------------------------------------------------------------
      
      //------------------------------------------------------------
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      };
      //------------------------------------------------------------
    </script>
  </body>
</html>
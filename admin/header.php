<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP IMS</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="css/fullcalendar.css"/>
    <link rel="stylesheet" href="css/matrix-style.css"/>
    <link rel="stylesheet" href="css/matrix-media.css"/>
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <!-- <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet">
  <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet">
  <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/jquery.gritter.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>


<div id="header">

    <h2 style="color: white;position: absolute; margin-top:20px;">
        <a href="demo.php" style="color:white; margin-left: 30px; margin-top: 60px;">IOT IMS</a>
    </h2>
</div>



<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text">Welcome Admin</span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                <li class="divider"></li>
                <li><a href="login.html"><i class="icon-signin"></i> Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>



<!--sidebar-menu-->
<div id="sidebar">
    <ul>
        <li class="<?php if($page == 'dashboard') {echo 'active';} ?>">
            <a href="demo.php"><i class="icon icon-dashboard"></i><span>Dashboard</span>
            <span class="label label-important" id="noti_number"></span></a>
        </li>
        <li class="<?php if($page == 'user') {echo 'active';} ?>">
            <a href="add-new-user.php"><i class="icon icon-user"></i><span>Add New User</span></a>
        </li>
        <li class="<?php if($page == 'company') {echo 'active';} ?>">
            <a href="add-new-company.php"><i class="icon icon-home"></i><span>Add New Company</span></a>
        </li>
        <li class="<?php if($page == 'diameter') {echo 'active';} ?>">
            <a href="add-new-diameter.php"><i class="icon-resize-horizontal"></i></i><span>Add New Diameter</span></a>
        </li>
        <li class="<?php if($page == 'party') {echo 'active';} ?>">
            <a href="add-new-party.php"><i class="icon icon-thumbs-up"></i><span>Add New Party</span></a>
        </li>
        <li class="<?php if($page == 'product') {echo 'active';} ?>">
            <a href="add-new-product.php"><i class="icon icon-circle-blank"></i><span>Add New Tires</span></a>
        </li>
        <li class="<?php if($page == 'buy') {echo 'active';} ?>">
            <a href="buy-tires.php"><i class="icon icon-credit-card"></i><span>Buy Tires</span></a>
        </li>
        <li class="<?php if($page == 'stock') {echo 'active';} ?>">
            <a href="stock.php"><i class="icon icon-th-large"></i><span>Stock</span></a>
        </li>
        <li class="<?php if($page == 'sell') {echo 'active';} ?>">
            <a href="sells-master.php"><i class="icon icon-shopping-cart"></i><span>Create Orders</span></a>
        </li>
        <li class="<?php if($page == 'bills') {echo 'active';} ?>">
            <a href="view_bills.php"><i class="icon icon-bar-chart"></i><span>Sales Report</span></a>
        </li>

        <!-- <li class="submenu"><a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span
                class="label label-important">3</span></a>
            <ul>
                <li><a href="form-common.html">Basic Form</a></li>
                <li><a href="form-validation.html">Form with Validation</a></li>
                <li><a href="form-wizard.html">Form with Wizard</a></li>
            </ul>
        </li> -->

    </ul>
</div>
<!--sidebar-menu-->

<div id="search">
        <h4 style="color: #f7f7f7; font-size:20px; text-align: centr;"><b>IOT Based Inventory Management System</b></h4>
        <!-- <a href="index.html" style="color:white;"><i class="icon icon-key" style=" margin-top:8px!important;"></i><span>&nbsp;LogOut</span></a> -->

</div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('a14e4453e32002cd5a51', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    //  alert(JSON.stringify(data));
    function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("noti_number").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "notifications.php", true);
  xhttp.send();
}
loadDoc();
    });
  </script>
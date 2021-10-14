<?php
session_start();
include "./user/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./user/css/login-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="icon" type="image/x-icon" href="./user/img/favicon.ico" />

    <title>Login IOT-IMS</title>
</head>
<body>
    <div class="full-height">
    <h1>IOT IMS</h1>
    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h3>All In One Solution</h3>
                <h2>IOT Based Inventory Management System</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of  </p>
                <img src="./user/img/loginimg.svg">
            </section>
        </div>
        <div class="right">
            <form name="login-form" action="" method="POST">
                <section class="copy">
                    <h3>Login to <br> Access Your Account</h3>
                </section>
                <div class="input-container username">
                    <label for="uname">Username</label>
                    <input type="text" name="uname" required>
                </div>
                <div class="input-container password">
                    <label for="password">Password</label>
                    <input type="password" name="pword" id="password" required>
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>
                <button class="login-btn" type="submit" name="submit">LOGIN</button>
            </form>
        </div>
    </div>
    </div>
</body>
</html>

<script type="text/javascript">
    const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('bi-eye');
});
</script>

<?php

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['pword']);

    $count = 0;
    $sql = "SELECT * FROM user_registrstion WHERE user_name='$username' && password='$password' && status='active'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    while($row=mysqli_fetch_assoc($res)){
        $role = $row['role'];
    }

    if($count > 0 && $role=="Admin"){
        $_SESSION["admin"]=$username;
        ?>
        <script type="text/javascript">
            window.location = "./admin/demo.php";
        </script>
        <?php
    }elseif($count > 0 && $role=="User"){
        $_SESSION["user"]=$username;
        echo "user";
        ?>
        <script type="text/javascript">
            window.location = "./user/demo.php";
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
            alert("Undifined User!");
        </script>
        <?php
    }
}
?>
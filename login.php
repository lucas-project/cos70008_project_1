<!--login page-->
<!--For users to login to their accounts by customer number and password-->
<!--if login success, redirect to request page-->
<!---->
<!--@author Lucas Qin, student ID is 103527269.-->
<!--@version  php 8.1.6-->
<!--@date 10/09/2022-->

<?php
//start session to get login user's info
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <?php
    include_once "head.inc";
    include_once "nav.inc";
    ?>
    <body>
    <?php

$message="";
if(count($_POST)>0) {
    //connect to database
    require_once "settings.php";
    $con = mysqli_connect($host, $user, $pwd, $sql_db);
    $result = mysqli_query($con,"SELECT * FROM customer WHERE customer_number='" . $_POST["customer_number"] . "' and password = '". $_POST["password"]."'");
    //get data from database as an array
    $row  = mysqli_fetch_array($result);
    //if login successfully, store user's info in browser's SESSION
    if(is_array($row)) {
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];
        $_SESSION["customer_number"] = $row['customer_number'];
        $_SESSION["name"] = $row['customer_name'];
    } else {
        $message = "Invalid Username or Password!";
    }
}
//if logged in, redirect to request page
if(isset($_SESSION["email"])) {
    header("Location:request.php");
}
?>
<!--    a form that accept user's input to log in-->
<form name="frmUser" method="post" action="" align="center">
    <div class="message"><?php if($message!="") { echo $message; } ?></div>
    <div class="card">
        <div class="card-body">
            <br><br><br>
            <h2 class="card-title">Please Enter Login Details</h2>
            <br>
            <br>
            <br>
            <div class="container col-lg-12">
                <div class="row">
                    <div>
                        <h4 class="card-text">Customer number:</h4><br>
                        <input type="text" name="customer_number" class="form-control" placeholder="please type in your customer number">
                    </div>
                    <div>
                        <h4 class="card-text">Password:</h4><br>
                        <input type="password" name="password" class="form-control" placeholder="please type in your password">
                    </div>
                </div>
            </div>
            <br><br>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <input type="reset" class="btn btn-light">
        </div>
    </div>
</form>
<a href="register.php" class="btn btn-success">Register here</a>
<br><br><br>
<?php
include_once "footer.inc";
?>
</body>
</html>
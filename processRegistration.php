<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Creating Web Application Lab 09" />
    <meta name="keyword" content="PHP, Mysql" />
    <title>Retrieving records to HTML</title>
</head>
<body>

<?php
// redirect if accesss by url
if(!isset($_POST["email"])) {
    header("location:index.php");
    exit();
}

function sanitise_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
require_once ("settings.php");
$conn = @mysqli_connect($host,
    $user,
    $pwd,
    $sql_db
);
if(!$conn) {
    echo "<p>Database connection failure-1</p>";

} else {
    $sql_table="register";
    $err_msg="";
    $user_name = sanitise_input($_POST["user_name"]);
    if ($user_name==""){
        $err_msg .= "<p>Please enter your name.</p>";
    }else if (!preg_match("/^[a-zA-Z]{2,20}$/",$user_name)){
        $err_msg .= "<p>User name must contain only letter between 2 to 20.</p>";
    }

    $email = sanitise_input($_POST["email"]);
    if (trim($email) == "")
        $err_msg .= "<p>Please enter email.</p>";
    else {
        $email =  sanitise_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $err_msg .= "<p>Email format is not valid.</p>";
    }

    $phone = sanitise_input($_POST["phone"]);
    if ($phone=="")
        $err_msg .= "<p>Please enter your phone number.</p>";
    else if (!preg_match("/^[0-9\s]{8,12}$/",$phone))
        $err_msg .= "<p>Phone number only contains 8-12 numbers.</p>";


    $password = sanitise_input($_POST["password"]);
    if ($password==""){
        $err_msg .= "<p>Please enter your password.</p>";
    }else if (!preg_match("/^[a-zA-Z0-9]{2,20}$/",$password)){
        $err_msg .= "<p>Password must contain letters or number between 2 to 20.</p>";
    }

    $confirm_password = sanitise_input($_POST["confirm_password"]);
    if ($confirm_password==""){
        $err_msg .= "<p>Please confirm your password.</p>";
    }else if (!preg_match("/^[a-zA-Z0-9]{2,20}$/",$confirm_password)){
        $err_msg .= "<p>Password must contain letters or number between 2 to 20.</p>";
    }else if (strcmp($password, $confirm_password)){
        $err_msg .= "<p>Password not match, confirm your password again.</p>";
    }

    if ($err_msg!=""){
        echo $err_msg;
        exit();
    }
    $checkEmail = "SELECT * FROM ".$sql_table." WHERE email='".$_POST["email"]."'";
    $runCheckEmail = mysqli_query($conn,$checkEmail);
    $row_count = mysqli_num_rows($runCheckEmail);

    if ($row_count>0){
        include_once "head.inc";
        include_once "nav.inc";
        echo "<br><br><br><br><br><br><br><br><br>";
        echo"The email has been registered, change another email or ";
        echo"<a href='login.php'>login</a>";
        echo "<br><br>";
        echo "<a type='button' class='btn btn-warning' href='registration.php'>return</a>";
        echo "<br><br><br><br><br><br><br><br><br>";
        include_once "footer.inc";

    } else {
        $query = "INSERT INTO $sql_table (name, email, password, phone) values ('$user_name','$email','$password','$phone')";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            echo "<p class=\'wrong\'>Something is wrong with ", $query, "</p>";
        }elseif (mysqli_query($conn, $query)) {

            include_once "head.inc";
            include_once "nav.inc";
            echo "<br><br><br><br><br><br><br><br><br>";
            echo "<p class=\"ok\">Dear ".$user_name.",</p> you are successfully registered into ShipOnline, and your customer number is ".$email.", which will be used to get into the system";
            echo '<a href="login.php" type="button" class="btn btn-success">Login now</a>';
            echo "<br><br><br><br><br><br><br><br><br>";
            include_once "footer.inc";
        } else {
            $result['response'] = "Error: " . $query . "<br>" . $sql_db->error;
        }


        mysqli_close($conn);
    }
}


?>
</body>
</html>

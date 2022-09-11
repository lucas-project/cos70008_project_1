<!--register page-->
<!--For users to register their account by name, email, phone and password-->
<!---->
<!--@author Lucas Qin, student ID is 103527269.-->
<!--@date 10/09/2022-->
<!DOCTYPE html>
<html lang="en">
<?php
include_once "head.inc";
?>
<body>
<?php
include_once "nav.inc";
?>

<div class="row">
    <div class="col-md-6 offset-md-3 form-1-box wow fadeInUp">
        <br><br><br><br><br><br>
        <div class="signup-form">
<!--            a form to collect information for registering users-->
            <form action="" name="register" method="POST">
                <h2>Register</h2>
                <p class="hint-text">Create your account</p>
<!--                input user name-->
                <div class="form-group">
                    <div class="row">
                        <div class="col"><input type="text" class="form-control" name="user_name" placeholder="your user name" required="required"/></div>
                    </div>
                </div>
<!--                input email-->
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="email" required="required"/>
                </div>
<!--                input phone-->
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="enter phone number" required="required">
                </div>
<!--                input password-->
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="enter password" required="required">
                </div>
<!--                confirm password-->
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="confirm password" required="required">
                </div>
                <br><br><br>
                <div class="form-group">
                    <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Register Now</button>
                </div>
                <br>
<!--                an input to check if the form submitted-->
                <input type="hidden" name="submitted" value="true">
            </form>
<!--            redirect to login page-->
            <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
<?php
//check if the form submitted
if(isset($_POST['submitted'])) {
    //this is a function used to sanitize input data
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //get input data from HTML
    $err_msg = "";
    $user_name = sanitise_input($_POST["user_name"]);
    //if no data, prompt users to provide the data
    if ($user_name == "") {
        $err_msg .= "<p>Please enter your name.</p>";
        //Use Regex to check input format
    } elseif (!preg_match("/^[a-zA-Z]{2,20}$/", $user_name)) {
        $err_msg .= "<p>User name must contain only letter between 2 to 20.</p>";
    }

    //check if email is empty and meet format requirements
    $email = sanitise_input($_POST["email"]);
    if (trim($email) == "")
        $err_msg .= "<p>Please enter email.</p>";
    else {
        $email = sanitise_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $err_msg .= "<p>Email format is not valid.</p>";
    }

    //check if phone is empty and meet format requirements
    $phone = sanitise_input($_POST["phone"]);
    if ($phone == "")
        $err_msg .= "<p>Please enter your phone number.</p>";
    elseif (!preg_match("/^[0-9\s]{8,12}$/", $phone))
        $err_msg .= "<p>Phone number only contains 8-12 numbers.</p>";


    //check if password is empty and meet format requirements
    $password = sanitise_input($_POST["password"]);
    if ($password == "") {
        $err_msg .= "<p>Please enter your password.</p>";
    } elseif (!preg_match("/^[a-zA-Z0-9]{2,20}$/", $password)) {
        $err_msg .= "<p>Password must contain letters or number between 2 to 20.</p>";
    }

    //check if password is same as first-time input
    $confirm_password = sanitise_input($_POST["confirm_password"]);
    if ($confirm_password == "") {
        $err_msg .= "<p>Please confirm your password.</p>";
    } elseif (!preg_match("/^[a-zA-Z0-9]{2,20}$/", $confirm_password)) {
        $err_msg .= "<p>Password must contain letters or number between 2 to 20.</p>";
    } elseif (strcmp($password, $confirm_password)) {
        $err_msg .= "<p>Password not match, confirm your password again.</p>";
    }

    //if there is any error, remind and exit
    if ($err_msg != "") {
        echo $err_msg;
        exit();
    }

    //connect to database
    require_once("settings.php");
    $conn = @mysqli_connect($host,
        $user,
        $pwd,
        $sql_db
    );
    //if not success
    if (!$conn) {
        echo "<p>Database connection failure</p>";

        //if database connect successfully
    } else {
        $sql_table = "customer";
        $err_msg = "";

        //define query sentence and check in database, check if email already exist
        $checkEmail = "SELECT * FROM " . $sql_table . " WHERE email='" . $_POST["email"] . "'";
        $runCheckEmail = mysqli_query($conn, $checkEmail);
        $row_count = mysqli_num_rows($runCheckEmail);

        //check if there's any row meet requirement that has same email, if yes, then the email already exist
        if ($row_count > 0) {
            echo "<br><br><br><br><br><br><br><br><br>";
            echo "The email has been registered, change another to email or ";
            echo "<a href='login.php'>login</a>";
            echo "<br><br>";
            echo "<a type='button' class='btn btn-warning' href='register.php'>return</a>";
            echo "<br><br><br><br><br><br><br><br><br>";
            mysqli_close($conn);
        //if no repeated email
        } else {
            //register user's info
            $query = "INSERT INTO $sql_table (customer_name, email, password, phone) values ('$user_name','$email','$password','$phone')";
            $result = mysqli_query($conn, $query);
            //if insert not success
            if (!$result) {
                echo "<p class=\'wrong\'>Something is wrong with ", $query, "</p>";
                $result['response'] = "Error: " . $query . "<br>" . $sql_db->error;
            } else {
                //if register successfully, remind user to login
                echo "<br><br><br><br><br><br><br><br><br>";
                echo "<p class=\"ok\">Dear " . $user_name . ",</p> you are successfully registered into ShipOnline, and your customer number is " . $conn->insert_id . ", which will be used to get into the system";
                echo '<a href="login.php" type="button" class="btn btn-success">Login now</a>';
                echo "<br><br><br><br><br><br><br><br><br>";

            }
            //close connection with database
            mysqli_close($conn);
        }
    }
}
?>
    </div>
</div>
<!--import footer component-->
<?php
include_once "footer.inc";
?>
</body>

</html>

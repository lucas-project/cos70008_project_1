<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Make Business Simple</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

            <?php
            if($_SESSION["email"]) {
                if (!isset($_POST["description"])) {
                    header ("location: index.php");
                    exit();
                }
                else {
                    $err_msg = "";
                    function sanitise_input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }

                    // validate-name
                    $description = sanitise_input($_POST["description"]);
                    if ($description == "")
                        $err_msg .= "<p>Please enter description of the item.</p>";
                    else if (!preg_match("/^[a-zA-Z]{2,100}$/", $description))
                        $err_msg .= "<p>description only contains letters between 2 to 100.</p>";

                    if (!isset($_POST["weight"]))
                        $err_msg .= "<p>Please select item's weight.</p>";
                    else {
                        $weight = $_POST["weight"];
                    }

                    $address = sanitise_input($_POST["address"]);
                    if (!preg_match("/^[\w',-\\/.\s]{2,40}$/", $address))
                        $err_msg .= "<p>address should contain letters and numbers between 2 and 40.</p>";

                    $suburb = sanitise_input($_POST["suburb"]);
                    if ($suburb == "")
                        $err_msg .= "<p>Please enter your suburb.</p>";
                    else if (!preg_match("/^[a-zA-Z]{2,20}$/", $suburb))
                        $err_msg .= "<p>Suburb only contains letters between 2 and 20.</p>";

                    if (!isset($_POST["preferred_day"]))
                        $err_msg .= "<p>Please select preferred day of pickup.</p>";
                    else {
                        $preferred_day = sanitise_input($_POST["preferred_day"]);
                    }

                    if (!isset($_POST["preferred_month"]))
                        $err_msg .= "<p>Please select preferred month of pickup.</p>";
                    else {
                        $preferred_month = $_POST["preferred_month"];
                    }

                    if (!isset($_POST["preferred_year"]))
                        $err_msg .= "<p>Please select preferred year of pickup.</p>";
                    else {
                        $preferred_year = $_POST["preferred_year"];
                    }

                    if (!isset($_POST["preferred_time"]))
                        $err_msg .= "<p>Please select preferred day time of pickup.</p>";
                    else {
                        $preferred_time = $_POST["preferred_time"];
                    }

                    $preferred_minute = sanitise_input($_POST["minute"]);
                    if ($preferred_minute == "")
                        $err_msg .= "<p>Please enter exact minute for pickup.</p>";
                    else if (!preg_match("/^[0-9]{1,60}$/", $preferred_minute))
                        $err_msg .= "<p>Minute only should between 1 to 60.</p>";

                    $receiver = sanitise_input($_POST["receiver"]);
                    if ($receiver == "")
                        $err_msg .= "<p>Please enter receiver's name.</p>";
                    else if (!preg_match("/^[a-zA-Z]{1,15}$/", $receiver))
                        $err_msg .= "<p>Receiver's name should between 1 to 15.</p>";

                    $receiver_address = sanitise_input($_POST["receiver_address"]);
                    if ($receiver_address == "")
                        $err_msg .= "<p>Please enter receiver's address.</p>";
                    else if (!preg_match("/^[\w',-\\/.\s]{2,40}$/", $receiver_address))
                        $err_msg .= "<p>Receiver's address should contain letters and numbers between 2 and 40.</p>";

                    $receiver_suburb = sanitise_input($_POST["receiver_suburb"]);
                    if ($receiver_suburb == "")
                        $err_msg .= "<p>Please enter receiver's name.</p>";
                    else if (!preg_match("/^[a-zA-Z ]{2,15}$/", $receiver_suburb))
                        $err_msg .= "<p>Receiver's suburb should between 2 to 15.</p>";

                    if (!isset($_POST["receiver_state"]))
                        $err_msg .= "<p>Please select receiver's state.</p>";
                    else {
                        $receiver_state = $_POST["receiver_state"];
                    }

                    if ($err_msg!=""){
                        echo $err_msg;
                        exit();
                    }

                    date_default_timezone_set('Australia/Melbourne');
                    $request_date = date('d-m-y h:i:s');
                    // connect to db, create table and insert record
                    require_once("settings.php");
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                    if (!$conn) {
                        echo "<p>Connection is failed.</p>";
                    } else {
                        $sql_table = "application";
                        $insert_query = "INSERT INTO request (
                         request_date, description, weight, address, suburb, preferredDay, preferredMonth, preferredYear, preferredTime, 
                         minute, receiver,receiverAddress, receiverSuburb, receiverState)
                                    VALUES (
                                            '$request_date','$description','$weight','$address','$suburb','$preferred_day','$preferred_month','$preferred_year','$preferred_time',
                                            '$preferred_minute','$receiver','$receiver_address','$receiver_suburb','$receiver_state'
                                            )";
                        $result = mysqli_query($conn, $insert_query);
                        if ($result){

                            include_once "head.inc";
                            include_once "nav.inc";

                            if ((int)$weight<=2){
                                $price=2;
                            }else {
                                $price = ($weight-2)*2+2;
                            }

                            $to = $_SESSION["email"];
                            $subject = "Shipping request with ShipOnline";
                            $message = "<b>Dear ".$_SESSION["email"].", thank you for using ShipOnline! Your request number is , the cost is . We will pick up the item at on .</b>";
                            $header = "From:103527269@student.swin.edu.au \r\n";
                            $sendEmail = mail ($to,$subject,$message,$header);

                            if($sendEmail) {
                                echo "Message sent successfully...";
                            }else {
                                echo "Message could not be sent...";
                            }
                            
                            echo "<br><br><br><br><br><br><br><br><br>";
                            echo "<p>Thank you! Your request number is " . mysqli_insert_id($conn) . ". The cost number is $".$price.". We will pick up the item at ".$preferred_time.":".$preferred_minute." on ".$preferred_day.", ".$preferred_month.". </p>";
                            echo "<p>We have sent a confirmation email to ".$_SESSION["email"].".</p>";

                            echo "<a type='button' class='btn btn-primary' href='index.php'>Return</a>";
                            echo "<br><br><br><br><br><br><br><br><br>";
                            include_once "footer.inc";}
                        else
                            echo "<p>Failed to insert.</p>";

                        mysqli_close($conn);
                    }
                }

            ?><?php
            }else {
                echo "<h1>Please login first.</h1>";
                echo '<a href="login.php" class="btn btn-success">Login</a>';

            }
            ?>
    </body>
</html>
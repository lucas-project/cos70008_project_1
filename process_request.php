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
            //import PHPMailer class
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            //include library files
            require "PHPMailer/Exception.php";
            require "PHPMailer/PHPMailer.php";
            require "PHPMailer/SMTP.php";


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
                    else if (!preg_match("/^[a-zA-Z ]{2,20}$/", $suburb))
                        $err_msg .= "<p>Suburb only contains letters between 2 and 20.</p>";


                    if (!isset($_POST["preferredDate"]))
                        $err_msg .= "<p>Please select preferred date of pickup.</p>";
                    else {
                        $preferredDate = $_POST["preferredDate"];
                    }

                    if (!isset($_POST["preferred_time"]))
                        $err_msg .= "<p>Please select preferred day time of pickup.</p>";
                    else {
                        $preferred_time = $_POST["preferred_time"];
                    }

                    $preferred_minute = sanitise_input($_POST["minute"]);
                    if (!preg_match("/^[0-9]{1,60}$/", $preferred_minute))
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
                    $request_date = date('y-m-d');
                    // connect to db, create table and insert record
                    require_once("settings.php");
                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                    if (!$conn) {
                        echo "<p>Connection is failed.</p>";
                    } else {
                        if ((int)$weight<=2){
                            $price=2;
                        }else {
                            $price = ($weight-2)*2+2;
                        }

                        $customer_number = (int)$_SESSION['customer_number'];
                        $customer_name = $_SESSION['name'];
                        $email = $_SESSION['email'];
                        echo $customer_number." and ".$customer_name;

                        $insert_query = "INSERT INTO request (
                         request_date, description, weight, address, suburb, preferredDate, preferredTime, 
                         minute, receiver,receiverAddress, receiverSuburb, receiverState,customer_number,customer_name)
                                    VALUES (
                                            '$request_date','$description','$weight','$address','$suburb','$preferredDate','$preferred_time',
                                            '$preferred_minute','$receiver','$receiver_address','$receiver_suburb','$receiver_state',
                                            (SELECT customer_number FROM register WHERE customer_number = '$customer_number'),
                                            (SELECT customer_name FROM register WHERE customer_name = '$customer_name')
                                            )";
                        $result = mysqli_query($conn, $insert_query);
                        if ($result){

                            include_once "head.inc";
                            include_once "nav.inc";


                            //create new PHPMailer instance
                            $mail = new PHPMailer;

                            //configuration settings
                            $mail->isSMTP();
                            $mail->Host = 'smpt.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = "lucas qin";
                            $mail->Password = "qwertyuiop321";
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port = 466;

                            //sender
                            $mail->setFrom('103527269.lucas.qin@gmail.com','lucas');

                            //receiver
                            $mail->addAddress($_SESSION["email"]);
                            //email format
                            $mail->isHTML(true);

                            $mail->Subject = "Shipping request with ShipOnline";
                            $bodyContent = "<b>Dear ".$_SESSION["name"].", thank you for using ShipOnline! Your request number is , the cost is . We will pick up the item at on .</b>";
                            $mail->Body = $bodyContent;
                            $header = "From:103527269@student.swin.edu.au \r\n";
                            //send email
                            if ($mail->send()){
                                echo "Email has been sent";
                            }else{
                                echo "Email failed to send. PHPMailer error:".$mail->ErrorInfo;
                            }


                            
                            echo "<br><br><br><br><br><br><br><br><br>";
                            echo "<p>Thank you! Your request number is " . mysqli_insert_id($conn) . ". The cost number is $".$price.". We will pick up the item at ".$preferred_time.":".$preferred_minute." on ".$preferredDate.". </p>";
                            echo "<p>We have sent a confirmation email to ".$_SESSION["email"].".</p>";

                            echo "<a type='button' class='btn btn-primary' href='index.php'>Return</a>";
                            echo "<br><br><br><br><br><br><br><br><br>";
                            include_once "footer.inc";
                        } else {
                            echo "<p>Failed to insert.</p>";
                            echo "Errno: " . $conn->errno . ": ".$conn->error.".</br>";
                        }


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
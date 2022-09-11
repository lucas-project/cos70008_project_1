<!--request page-->
<!--online login users can make a request-->
<!--if not login, the website will redirect user to login page-->
<!---->
<!--@author Lucas Qin, student ID is 103527269.-->
<!--@date 10/09/2022-->
<?php
//access user login status
session_start();
?>
<?php
//if user not login, redirect to login page
if(!isset($_SESSION["email"])) {
    header("Location:login.php");
}else {
?>
<!DOCTYPE html>
<html lang="en">
<!--import head component-->
<?php
include_once "head.inc";
?>
<body id="page-top">
<!--import navigation component-->
<?php
include_once "nav.inc";
?>
<!--form-->
<!--//bootstrap grid system-->
<section class="container mt-5">
    <br>
    <br>
    <br>
    <div class="row mb-2">
        <div class="col-lg-12"></div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">
               Request form
            </h1>
        </div>
    </div>
    <hr>
    <div class="col-lg-12 rounded bg-light">
        <br>
        <!--xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-item-information-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->
        <h4>Personal Information</h4>
        <hr>
<!--        a form to accept user information for making shipping request-->
        <form name="info" action="" method="post">
            <div class="row"></div>
            <div class="row">
                <div class="col-lg-4 col-md-6 form-group"><label for="description">Description:</label><input type="text" id="description" name="description" class="form-control" /></div>
                <div class="col-lg-6 col-md-6 form-group">
                    <label class="required" for="weight">Weight</label>
<!--                    select weight of the item-->
                    <select id="weight" name="weight" required="required" class="form-control">
                        <div class="dropdown-menu">
                            <option value="" selected="selected" class="dropdown-item">Select Weight</option><option value="1" class="dropdown-item">0-2.0 kg</option>
                            <option value="2" class="dropdown-item"> 2.0 kg</option><option value="3" class="dropdown-item">3.0 kg</option><option value="4" class="dropdown-item">4.0 kg</option>
                            <option value="5" class="dropdown-item">5.0 kg</option><option value="6" class="dropdown-item">6.0 kg</option><option value="7" class="dropdown-item">7.0 kg</option>
                            <option value="8" class="dropdown-item"> 8.0 kg</option><option value="9" class="dropdown-item">9.0 kg</option><option value="10" class="dropdown-item">10.0 kg</option>
                            <option value="11" class="dropdown-item">11.0 kg</option><option value="12" class="dropdown-item">12.0 kg</option><option value="13" class="dropdown-item">13.0 kg</option>
                            <option value="14" class="dropdown-item"> 14.0 kg</option><option value="15" class="dropdown-item">15.0 kg</option><option value="16" class="dropdown-item">16.0 kg</option>
                            <option value="17" class="dropdown-item">17.0 kg</option><option value="18" class="dropdown-item">18.0 kg</option><option value="19" class="dropdown-item">19.0 kg</option>
                            <option value="20" class="dropdown-item">20.0 kg</option>
                            <option value="21" class="dropdown-item">We only ship small item, please contact customer support for customizing item weight.</option>
                        </div>
                    </select>
                </div>
            </div>
<!--            some space-->
            <br>
            <br>
            <br>
            <br>
<!--            get pick up information-->
            <h4>Pick-up Information</h4>
            <div class="row">
                <div class="col-lg-4 col-md-6 form-group"><label for="address">Address:</label><input type="text" id="address" name="address" class="form-control" /></div>
                <div class="col-lg-4 col-md-6 form-group"><label for="suburb">Suburb:</label><input type="text" id="suburb" name="suburb" class="form-control" /></div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 form-group">
                    <label class="required">Preferred date: </label>
                    <div class="form-row">
                        <div class="col-4">
                           <input type="date" name="preferredDate">
                        </div>
                    </div>

                </div>
            </div>
<!--            get preferred time-->
            <div class="row">
                <label class="required">Preferred time: </label>
                <div class="form-row">
                    <div class="col-4">
                        <select id="preferred_time" name="preferred_time" required="required" class="form-control">
                            <div class="dropdown-menu">
                                <option value="" class="dropdown-item">hour</option><option value="7" class="dropdown-item" selected="selected" >7</option>
                                <option value="8" class="dropdown-item">8</option><option value="9" class="dropdown-item">9</option>
                                <option value="10" class="dropdown-item">10</option><option value="11" class="dropdown-item">11</option>
                                <option value="12" class="dropdown-item">12</option><option value="13" class="dropdown-item">13</option>
                                <option value="14" class="dropdown-item">14</option><option value="15" class="dropdown-item">15</option>
                                <option value="16" class="dropdown-item">16</option><option value="17" class="dropdown-item">17</option>
                                <option value="18" class="dropdown-item">18</option><option value="19" class="dropdown-item">19</option>
                                <option value="20" class="dropdown-item">20</option>
                            </div>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 form-group"><label for="minute">Minute: </label><input type="text" id="minute" name="minute" class="form-control" /></div>
                    <p>*If you don't input minute property, we'll assume you want us to pick the item up at the exact hour, except for 7 am, default pick up time is 7:30 am.</p>
            </div>

            <h4>Delivery Information</h4>
<!--                provide receiver's info-->
            <div class="row">
                <div class="col-lg-6 col-md-6 form-group"><label for="receiver" class="required">Receiver's name: *</label><input type="text" id="receiver" name="receiver" required="required" class="form-control" /></div>
                <div class="col-lg-6 col-md-6 form-group"><label for="receiver_address" class="required">Receiver's address: *</label><input type="text" id="receiver_address" name="receiver_address" required="required" class="form-control" /></div>
                <div class="col-lg-6 col-md-6 form-group"><label for="receiver_suburb" class="required">Receiver's suburb: *</label><input type="text" id="receiver_suburb" name="receiver_suburb" required="required" class="form-control" /></div>
            <br>
            <div class="row">
                <div class="col-lg-6 col-md-6 form-group">
                    <label class="required" for="receiver_state">State: *</label>
<!--                    select delivery state-->
                    <select id="receiver_state" name="receiver_state" required="required" class="form-control">
                        <div class="dropdown-menu">
                            <option value="" selected="selected" class="dropdown-item">Select a state</option><option value="Australian Capital Territory" class="dropdown-item">Australian Capital Territory</option>
                            <option value="New South Wales" class="dropdown-item">New South Wales</option><option value="Northern Territory" class="dropdown-item">Northern Territory</option><option value="Queensland" class="dropdown-item">Queensland</option>
                            <option value="South Australia" class="dropdown-item">South Australia</option><option value="Tasmania" class="dropdown-item">Tasmania</option><option value="Victoria" class="dropdown-item">Victoria</option>
                            <option value="Western Australia" class="dropdown-item">Western Australia</option>
                        </div>
                    </select>
                </div>
            </div>

            <br>
    </div>
    <br><br><br><br><br><br>

                <p id="price"></p>
    <button class="btn btn-success float-right btn-lg col-md-2" aria-label="Submit">&nbsp;&nbsp;&nbsp;&nbsp;Request&nbsp;&nbsp;&nbsp;&nbsp;</button>
                <input type="hidden" name="submitted" value="true">
    </form>
        <br>


</section>
<!--put all PHP-generated info into grid-->
<div class="row">
    <div class="col-md-10 offset-md-2 form-1-box wow fadeInUp">
<?php
//check if the form submitted, if not then the php wont execute
    if(isset($_POST['submitted'])) {
        $err_msg = "";
        //a function that sanitise input data
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
        else if (!preg_match("/^[a-zA-Z., ]{2,100}$/", $description))
            $err_msg .= "<p>description only contains letters between 2 to 100.</p>";

        if (!isset($_POST["weight"]))
            $err_msg .= "<p>Please select item's weight.</p>";
        else {
            $weight = $_POST["weight"];
        }
        //get address and validate
        $address = sanitise_input($_POST["address"]);
        if (!preg_match("/^[\w',-\\/.\s]{2,40}$/", $address))
            $err_msg .= "<p>address should contain letters and numbers between 2 and 40.</p>";

        //get suburb and validate
        $suburb = sanitise_input($_POST["suburb"]);
        if ($suburb == "")
            $err_msg .= "<p>Please enter your suburb.</p>";
        else if (!preg_match("/^[a-zA-Z ]{2,20}$/", $suburb))
            $err_msg .= "<p>Suburb only contains letters between 2 and 20.</p>";

        //get preferred date
        if (!isset($_POST["preferredDate"]))
            $err_msg .= "<p>Please select preferred date of pickup.</p>";
        else {
            $preferredDate = $_POST["preferredDate"];
        }
        //get preferred time
        if (!isset($_POST["preferred_time"]))
            $err_msg .= "<p>Please select preferred day time of pickup.</p>";
        else {
            $preferred_time = $_POST["preferred_time"];

        }
        //get preferred minute and add restriction
        $preferred_minute = sanitise_input($_POST["minute"]);
        if ($preferred_minute == "" && (int)$preferred_time == 7) {
            $preferred_minute = 30;

        } elseif ($preferred_minute == "" && (int)$preferred_time != 7) {
            $preferred_minute = 0;

        } elseif (!preg_match("/^[0-9]{1,60}$/", $preferred_minute))
            $err_msg .= "<p>Minute only should between 1 to 60.</p>";
        //combine hour and minute as a string for later use
        $combine_min_hr = $preferred_time . ":" . $preferred_minute;
        //get receiver and validate
        $receiver = sanitise_input($_POST["receiver"]);
        if ($receiver == "")
            $err_msg .= "<p>Please enter receiver's name.</p>";
        else if (!preg_match("/^[a-zA-Z]{1,15}$/", $receiver))
            $err_msg .= "<p>Receiver's name should between 1 to 15.</p>";

        //get receiver address and validate
        $receiver_address = sanitise_input($_POST["receiver_address"]);
        if ($receiver_address == "")
            $err_msg .= "<p>Please enter receiver's address.</p>";
        else if (!preg_match("/^[\w',-\\/.\s]{2,40}$/", $receiver_address))
            $err_msg .= "<p>Receiver's address should contain letters and numbers between 2 and 40.</p>";

        //get suburb and validate
        $receiver_suburb = sanitise_input($_POST["receiver_suburb"]);
        if ($receiver_suburb == "")
            $err_msg .= "<p>Please enter receiver's name.</p>";
        else if (!preg_match("/^[a-zA-Z ]{2,15}$/", $receiver_suburb))
            $err_msg .= "<p>Receiver's suburb should between 2 to 15.</p>";
        //get state
        if (!isset($_POST["receiver_state"]))
            $err_msg .= "<p>Please select receiver's state.</p>";
        else {
            $receiver_state = $_POST["receiver_state"];
        }

        //get current time
        date_default_timezone_set('Australia/Melbourne');
        $request_date = date('y-m-d h:i:s');
        //combine date and time
        $preferred_date_time = $preferredDate . " " . $preferred_time . ":" . $preferred_minute;
        //convert time string to time stamp
        $preferTimeStamp = strtotime($preferred_date_time);
        $requestTimeStamp = strtotime($request_date);

        //if less than 24 hour
        if ($preferTimeStamp - $requestTimeStamp < 86400) {
            $err_msg .= "<p>The preferred pick-up date and time need to be at least 24 hours after current time</p><br>";
        }

        //if user select 7am, then pickup time can before 7:30
        if ($preferred_time == "7" && (int)$preferred_minute < 30) {
            $err_msg .= "<p>Sorry, we can't start delivery before 7:30 am, our business time is between 7:30 to 20:30.</p><br>";
            //if user select 8pm. then pick up time can after 8:30pm
        } elseif ($preferred_time == "20" && (int)$preferred_minute > 30) {
            $err_msg .= "<p>Sorry, we closed at 20:30, our business time is between 7:30 to 20:30.</p><br>";
        }

        //if any error, remind and exit
        if ($err_msg != "") {
            echo $err_msg;
            exit();
        }
        // connect to db, create table and insert record
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

        if (!$conn) {
            echo "<p>Connection is failed.</p>";
        } else {
            if ((int)$weight <= 2) {
                $price = 2;
            } else {
                $price = ($weight - 2) * 2 + 2;
            }

            //get user info from session
            $customer_number = (int)$_SESSION['customer_number'];
            $customer_name = $_SESSION['name'];
            $email = $_SESSION['email'];


            //query to insert new record
            $insert_query = "INSERT INTO request (
                         request_date, description, weight, address, suburb, preferredDate,
                         time, receiver,receiverAddress, receiverSuburb, receiverState,customer_number,customer_name)
                                    VALUES (
                                            '$request_date','$description','$weight','$address','$suburb','$preferredDate',
                                            '$combine_min_hr','$receiver','$receiver_address','$receiver_suburb','$receiver_state',
                                            (SELECT customer_number FROM customer WHERE customer_number = '$customer_number'),
                                            (SELECT customer_name FROM customer WHERE customer_number = '$customer_number' AND customer_name = '$customer_name')
                                            )";
            $result = mysqli_query($conn, $insert_query);
            //if insert successfully, send email
            if ($result) {
                //define all variable required by mail()
                $to = $_SESSION['email'];
                $subject = "Shipping request with ShipOnline";
                $message = "<b>Dear " . $_SESSION["name"] . ", thank you for using ShipOnline! Your request number is , the cost is . We will pick up the item at on .</b>";
                $header = "From:103527269@student.swin.edu.au \r\n";
                $return = "-r 103527269@student.swin.edu.au";
                //call mail() to send email
                mail($to, $subject, $message, $header, $return);

                //remind user information on their request
                echo "<br><br><br><br><br><br><br><br><br>";
                echo "<p>Thank you! Your request number is " . mysqli_insert_id($conn) . ". The cost number is $" . $price . ". We will pick up the item at " . $preferred_time . ":" . $preferred_minute . " on " . $preferredDate . ". </p>";
                echo "<p>We have sent a confirmation email to " . $_SESSION["email"] . ".</p>";

                echo "<a type='button' class='btn btn-primary' href='shiponline.php'>Return</a>";
                echo "<br><br><br><br><br><br><br><br><br>";

            } else {
                echo "<p>Failed to insert.</p>";
                echo "Errno: " . $conn->errno . ": " . $conn->error . ".</br>";
            }
            //close database connection
            mysqli_close($conn);
        }
    }

    ?><?php
}
?>
    </div>
</div>

<!-- Footer-->
<?php
include_once "footer.inc";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
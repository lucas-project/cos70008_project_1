<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once "head.inc";
?>
<body id="manage">
<?php
include_once "nav.inc";
?>
<?php
if($_SESSION["email"]) {
?>
<br><br><br><br>Welcome back,  <?php echo $_SESSION["name"]; ?>. <br>Click here to <a href="logout.php" tite="Logout" class="btn btn-danger">Logout.</a>

<div class="jumbotron">
    <h2>ShipOnline System Administration Page</h2>
    <br>
    <br>
    <br>

    <div class="form-1-container section-container">
        <div class="container">
            <div class="row">
                <div class="col form-1 section-description wow fadeIn">

                    <div class="divider-1 wow fadeInUp"><span></span></div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-1-box wow fadeInUp">

                    <form action="" method="POST">

                        <fieldset class="form-group border p-3">
                            <legend class="w-auto px-2">Date for Retrieve</legend>
                            <div class="form-group">
                                <label for="select_date"></label>
                                <div class="col-sm">
                                    <input type="date" name="selected_date">
                                    <br><br>

                                    <input type="radio" name="selected_type" value="request date">request date<br><br>
                                    <input type="radio" name="selected_type" value="pick-up date">pick up date<br><br>

                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="form-group row text-right">
                                    <div class="col">
                                        <button type="submit" value="Result" name="Result" class="btn btn-primary btn-customized">Show</button>
                                    </div>
                                </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p><a class="nav-link" href="index.php"><- return to homepage</a></p>
    <?php
    $query = "";
    $err_msg = "";
    $selected_date = "";
    if (isset($_POST["selected_date"])){
        $selected_date=$_POST["selected_date"];

        if (isset($_POST["selected_type"])) {
            $selected_type = $_POST["selected_type"];

            if (strcmp($selected_type, "request date")==0) {
                echo "Result will be filtered by request date";

                $query = "SELECT * FROM request WHERE DATE(request_date) = '$selected_date'";

            } elseif (strcmp($selected_type, "pick-up date")==0) {


                echo "Result will be filtered by pick-up date";
                $query = "SELECT * FROM (request JOIN register ON request.customer_number = register.customer_number) WHERE preferredDate = '$selected_date'";
            } else {
                $err_msg .= "<p>Please select date filter type.</p>";
            }

            if ($err_msg != "") {
                echo $err_msg;
                exit();
            }
            $weight =0;
            require_once "settings.php";
            $conn = mysqli_connect($host, $user, $pwd, $sql_db);
            if ($conn) {

                echo "<br><br><br>,<br><br><p>The Database has been Connected successfully!</p>";
                echo "<br>";
                echo "<br>";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $total_revenue = 0;
                    $count = 0;
                    $rowcount = mysqli_num_rows( $result );
                    echo "<h3>Administration Interface</h3>";
                    $record = mysqli_fetch_assoc($result);
                    if ($record) {
                        if (strcmp($selected_type, "request date")==0){
                            echo "<table class='table'>";
                            echo "<tr>";

                            //echo "<th>customer number</th>";
                            echo "<th>customer number</th>";
                            echo "<th>request number</th>";
                            echo "<th>item description</th>";
                            echo "<th>weight</th>";
                            echo "<th>pick-up suburb</th>";
                            echo "<th>preferred pick-up date</th>";
                            echo "<th>delivery suburb</th>";
                            echo "<th>state</th>";

                            echo "</tr>";

                            while ($record) {
                                echo "<tr>";
                                echo "<td>{$record['customer_number']}</td>";
                                echo "<td>{$record['request_number']}</td>";
                                echo "<td>{$record['description']}</td>";
                                echo "<td>{$record['weight']}</td>";
                                echo "<td>{$record['suburb']}</td>";
                                echo "<td>{$record['preferredDate']}</td>";
                                echo "<td>{$record['receiverSuburb']}</td>";
                                echo "<td>{$record['receiverState']}</td>";
                                echo "</tr>";

                                $count++;
                                echo $record['weight'];
                                if ($record['weight'] <= 2) {
                                    $total_revenue += 2;
                                } elseif ($record['weight'] >= 2) {
                                    $total_revenue += ($record['weight'] - 2) * 2 + 2;
                                }
                                $record = mysqli_fetch_assoc($result);
                            }
                            echo "</table>";
                            mysqli_free_result($result);

                            echo "Total requests is " . $count . " and total revenue is " . $total_revenue;
                        }else {
                            echo "<table class='table'>";
                            echo "<tr>";

                            //echo "<th>customer number</th>";
                            echo "<th>customer number</th>";
                            echo "<th>customer name</th>";
                            echo "<th>phone</th>";
                            echo "<th>request number</th>";
                            echo "<th>item description</th>";

                            echo "<th>weight</th>";
                            echo "<th>pick-up address</th>";
                            echo "<th>pick-up suburb</th>";
                            echo "<th>delivery suburb</th>";
                            echo "<th>delivery state</th>";

                            echo "</tr>";

                            while ($record) {
                                echo "<tr>";
                                echo "<td>{$record['customer_number']}</td>";
                                echo "<td>{$record['customer_name']}</td>";
                                echo "<td>{$record['phone']}</td>";
                                echo "<td>{$record['request_number']}</td>";
                                echo "<td>{$record['description']}</td>";

                                echo "<td>{$record['weight']}</td>";
                                echo "<td>{$record['address']}</td>";
                                echo "<td>{$record['suburb']}</td>";
                                echo "<td>{$record['receiverSuburb']}</td>";
                                echo "<td>{$record['receiverState']}</td>";
                                echo "</tr>";

                                $count++;
                                $weight += $record['weight'];

                                $record = mysqli_fetch_assoc($result);
                            }
                            echo "</table>";
                            mysqli_free_result($result);

                            echo "Total requests is " . $count . " and total weight is " . $weight;
                        }
                    } else
                        echo "<p>No record in the application table.</p>";

                } else {
                    echo "<p>Select Unsuccessfull.</p>";
                }
                mysqli_close($conn);

            } else {
                echo "<p>Connection Failed!</p>";
            }
        }
    }else{
        echo"Please select a date<br><br>";
    }

    ?>

    <?php
    }else {
        echo "<h3>Please login first.</h3>";
        echo '<a href="login.php">Login</a>';
        header("location:login.php");
        exit();
    }
    ?>
    <?php
    include_once "footer.inc";
    ?>
</body>
</html>
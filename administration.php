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
    <br><br><br><br>Welcome back,  <?php echo $_SESSION["email"]; ?>. <br>Click here to <a href="logout.php" tite="Logout" class="btn btn-danger">Logout.</a>

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

                        <form action="" method="post">

                            <fieldset class="form-group border p-3">
                                <legend class="w-auto px-2">Date for Retrieve</legend>
                                <div class="form-group">
                                    <label for="select_date"></label>
                                    <div class="col-sm">
                                        <select id="selected_day" name="selected_day" required="required" class="form-control col-2">
                                            <div class="dropdown-menu">
                                                <option value="" class="dropdown-item"  selected="selected">Select a day</option><option value="1" class="dropdown-item">01</option>
                                                <option value="2" class="dropdown-item">02</option><option value="3" class="dropdown-item">03</option>
                                                <option value="4" class="dropdown-item">04</option><option value="5" class="dropdown-item">05</option>
                                                <option value="6" class="dropdown-item">06</option><option value="7" class="dropdown-item">07</option>
                                                <option value="8" class="dropdown-item">08</option><option value="9" class="dropdown-item">09</option>
                                                <option value="10" class="dropdown-item">10</option><option value="11" class="dropdown-item">11</option>
                                                <option value="12" class="dropdown-item">12</option><option value="13" class="dropdown-item">13</option>
                                                <option value="14" class="dropdown-item">14</option><option value="15" class="dropdown-item">15</option>
                                                <option value="16" class="dropdown-item">16</option><option value="17" class="dropdown-item">17</option>
                                                <option value="18" class="dropdown-item">18</option><option value="19" class="dropdown-item">19</option>
                                                <option value="20" class="dropdown-item">20</option><option value="21" class="dropdown-item">21</option>
                                                <option value="22" class="dropdown-item">22</option><option value="23" class="dropdown-item">23</option>
                                                <option value="24" class="dropdown-item">24</option><option value="25" class="dropdown-item">25</option>
                                                <option value="26" class="dropdown-item">26</option><option value="27" class="dropdown-item">27</option>
                                                <option value="28" class="dropdown-item">28</option><option value="29" class="dropdown-item">29</option>
                                                <option value="30" class="dropdown-item">30</option><option value="31" class="dropdown-item">31</option>
                                            </div>
                                        </select>
                                        <select id="selected_month" name="selected_month" required="required" class="form-control col-2">
                                            <div class="dropdown-menu">
                                                <option value="" class="dropdown-item" selected="selected">Select month</option><option value="Jan" class="dropdown-item">Jan</option>
                                                <option value="Feb" class="dropdown-item">Feb</option><option value="Mar" class="dropdown-item">Mar</option>
                                                <option value="April" class="dropdown-item">April</option><option value="May" class="dropdown-item">May</option>
                                                <option value="June" class="dropdown-item">June</option>
                                                <option value="July" class="dropdown-item">July</option><option value="Aug" class="dropdown-item">Aug</option>
                                                <option value="Sep" class="dropdown-item">Sep</option><option value="Oct" class="dropdown-item">Oct</option>
                                                <option value="Nov" class="dropdown-item">Nov</option><option value="Dec" class="dropdown-item">Dec</option>
                                            </div>
                                        </select>
                                        <select id="selected_year" name="selected_year" required="required" class="form-control col-2">
                                            <div class="dropdown-menu">
                                                <option value=""  class="dropdown-item" selected="selected">Select year</option>
                                                <option value="2022" class="dropdown-item">2022</option>
                                                <option value="2023"  class="dropdown-item">2023</option>
                                            </div>
                                        </select>
                                </div>
                                    <br>
                                    <br>
                                <div class="form-group">
                                    <label for="date_type">Select Date Item for Retrieve</label>
                                    <br>
                                    <br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="date_type" id="date_type" value="1">
                                        <label class="form-check-label" for="date_type">
                                            Request Date
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="date_type" id="date_type" value="2">
                                        <label class="form-check-label" for="date_type">
                                            Pick-up Date
                                        </label>
                                    </div>
                                </div>

                            </fieldset>
                            <br>
                            <br>
                            <div class="form-group row text-right">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-customized">Show</button>
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
        $selected_day=$_POST["selected_day"];
        $selected_month=$_POST["selected_month"];
        $selected_year=$_POST["selected_year"];
        $time = strtotime();
        $err_msg = "";
        if (!isset($_POST["date_type"]))
            $err_msg .= "<p>Please select date filter type.</p>";
        else {
            $date_type=$_POST["date_type"].value;
        }

        if ($date_type =="1"){
            echo "Result will be filtered by request date";
            $query = "SELECT * FROM request 
                WHERE ";
        }else if ($date_type == "2") {
            echo "Result will be filtered by pick-up date";
            $query = "SELECT * FROM request 
                WHERE preferredDay = $selected_day and preferredMonth = $selected_month and preferredYear = $selected_year";
        }

        if ($err_msg!=""){
            echo $err_msg;
            exit();
        }



        require_once "settings.php";
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);
        if ($conn) {

            echo "<br><br><br>,<br><br><p>The Database has been Connected successfully!</p>";
            echo "<br>";
            echo "<br>";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<h3>Administration Interface</h3>";
                $record = mysqli_fetch_assoc ($result);
                if ($record) {
                    echo "<table class='table'>";
                    echo "<tr>";
                    echo "<th scope=\"col\">ID</th>";
                    echo "<th scope=\"col\">firstName</th>";
                    echo "<th scope=\"col\">middleName</th>";
                    echo "<th>lastName</th>";
                    echo "<th>email</th>";
                    echo "<th>abn</th>";
                    echo "<th>tfn</th>";
                    echo "<th>phoneNo</th>";
                    echo "<th>birthday_day</th>";
                    echo "<th>birthday_month</th>";
                    echo "<th>birthday_year</th>";
                    echo "<th>person_address</th>";
                    echo "<th>person_state</th>";
                    echo "<th>person_city</th>";
                    echo "<th>person_zip</th>";

                    echo "<th>startAt_day</th>";
                    echo "<th>startAt_month</th>";
                    echo "<th>startAt_year</th>";
                    echo "<th>activity</th>";
                    echo "<th>soleTrader</th>";
                    echo "<th>firstTime</th>";
                    echo "<th>needBusinessName</th>";
                    echo "<th>period</th>";
                    echo "<th>type</th>";
                    echo "<th>businessName</th>";
                    echo "<th>birthLocation</th>";
                    echo "<th>state</th>";
                    echo "<th>suburb</th>";
                    echo "<th>needGST</th>";
                    echo "<th>GST_annual</th>";
                    echo "<th>GST_companyLodge</th>";
                    echo "<th>GST_cashBasis</th>";
                    echo "<th>GST_import</th>";
                    echo "<th>GST_startAt_day</th>";
                    echo "<th>GST_startAt_month</th>";
                    echo "<th>GST_startAt_year</th>";
                    echo "</tr>";


                    while ($record) {
                        echo "<tr>";
                        echo "<td>{$record['id']}</td>";
                        echo "<td>{$record['firstName']}</td>";
                        echo "<td>{$record['middleName']}</td>";
                        echo "<td>{$record['lastName']}</td>";
                        echo "<td>{$record['email']}</td>";
                        echo "<td>{$record['abn']}</td>";
                        echo "<td>{$record['tfn']}</td>";
                        echo "<td>{$record['phoneNo']}</td>";
                        echo "<td>{$record['birthday_day']}</td>";
                        echo "<td>{$record['birthday_month']}</td>";
                        echo "<td>{$record['birthday_year']}</td>";
                        echo "<td>{$record['person_address']}</td>";
                        echo "<td>{$record['person_state']}</td>";
                        echo "<td>{$record['person_city']}</td>";
                        echo "<td>{$record['person_zip']}</td>";

                        echo "<td>{$record['startAt_day']}</td>";
                        echo "<td>{$record['startAt_month']}</td>";
                        echo "<td>{$record['startAt_year']}</td>";
                        echo "<td>{$record['activity']}</td>";
                        echo "<td>{$record['soleTrader']}</td>";
                        echo "<td>{$record['firstTime']}</td>";
                        echo "<td>{$record['needBusinessName']}</td>";
                        echo "<td>{$record['period']}</td>";
                        echo "<td>{$record['type']}</td>";
                        echo "<td>{$record['businessName']}</td>";
                        echo "<td>{$record['birthLocation']}</td>";
                        echo "<td>{$record['suburb']}</td>";
                        echo "<td>{$record['needGST']}</td>";
                        echo "<td>{$record['GST_annual']}</td>";
                        echo "<td>{$record['GST_companyLodge']}</td>";
                        echo "<td>{$record['GST_cashBasis']}</td>";
                        echo "<td>{$record['GST_import']}</td>";
                        echo "<td>{$record['GST_startAt_day']}</td>";
                        echo "<td>{$record['GST_startAt_month']}</td>";
                        echo "<td>{$record['GST_startAt_year']}</td>";
                        echo"</tr>";
                        $record = mysqli_fetch_assoc ($result);

                    }
                    echo "</table>";
                    mysqli_free_result($result);
                }
                else
                    echo "<p>No record in the application table.</p>";
            }
            else {
                echo "<p>Select Unsuccessfull.</p>";
            }
            mysqli_close($conn);
        }
        else {
            echo "<p>Connection Failed!</p>";
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
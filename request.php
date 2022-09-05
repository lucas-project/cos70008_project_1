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
    <title>ShipOnline</title>
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
include_once "nav.inc";
?>

<!--form-->
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
        <form name="info" action="process_request.php" method="post">
            <div class="row"></div>
            <div class="row">
                <div class="col-lg-4 col-md-6 form-group"><label for="description">Description:</label><input type="text" id="description" name="description" class="form-control" /></div>
                <div class="col-lg-6 col-md-6 form-group">
                    <label class="required" for="weight">Weight</label>
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
            <br>

            <br>
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
                            <select id="preferred_day" name="preferred_day" required="required" class="form-control">
                                <div class="dropdown-menu">
                                    <option value="" class="dropdown-item">Select a day</option><option value="1" class="dropdown-item">01</option>
                                    <option value="2" class="dropdown-item">02</option><option value="3" class="dropdown-item">03</option>
                                    <option value="4" class="dropdown-item">04</option><option value="5" class="dropdown-item">05</option>
                                    <option value="6" class="dropdown-item">06</option><option value="7" class="dropdown-item">07</option>
                                    <option value="8" class="dropdown-item">08</option><option value="9" class="dropdown-item">09</option>
                                    <option value="10" class="dropdown-item">10</option><option value="11" class="dropdown-item">11</option>
                                    <option value="12" class="dropdown-item">12</option><option value="13" selected="selected" class="dropdown-item">13</option>
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
                        </div>
                        <div class="col-4">
                            <select id="preferred_month" name="preferred_month" required="required" class="form-control">
                                <div class="dropdown-menu">
                                    <option value="" class="dropdown-item">Select month</option><option value="Jan" class="dropdown-item">Jan</option>
                                    <option value="Feb" class="dropdown-item">Feb</option><option value="Mar" class="dropdown-item">Mar</option>
                                    <option value="April" class="dropdown-item">April</option><option value="May" class="dropdown-item">May</option>
                                    <option value="June" selected="selected" class="dropdown-item">June</option>
                                    <option value="July" class="dropdown-item">July</option><option value="Aug" class="dropdown-item">Aug</option>
                                    <option value="Sep" class="dropdown-item">Sep</option><option value="Oct" class="dropdown-item">Oct</option>
                                    <option value="Nov" class="dropdown-item">Nov</option><option value="Dec" class="dropdown-item">Dec</option>
                                </div>
                            </select>

                        </div>
                        <div class="col-4">
                            <select id="preferred_year" name="preferred_year" required="required" class="form-control">
                                <div class="dropdown-menu">
                                    <option value=""  class="dropdown-item">Select year</option>
                                    <option value="2022" selected="selected"  class="dropdown-item">2022</option>
                                    <option value="2023"  class="dropdown-item">2023</option>
                                </div>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
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
                    <p>*If you don't input minute property, we'll assume you want us to pick the item up at the exact hour.</p>
            </div>
            <h4>Delivery Information</h4>

            <div class="row">
                <div class="col-lg-6 col-md-6 form-group"><label for="receiver" class="required">Receiver's name: *</label><input type="text" id="receiver" name="receiver" required="required" class="form-control" /></div>
                <div class="col-lg-6 col-md-6 form-group"><label for="receiver_address" class="required">Receiver's address: *</label><input type="text" id="receiver_address" name="receiver_address" required="required" class="form-control" /></div>
                <div class="col-lg-6 col-md-6 form-group"><label for="receiver_suburb" class="required">Receiver's suburb: *</label><input type="text" id="receiver_suburb" name="receiver_suburb" required="required" class="form-control" /></div>
            <br>
            <div class="row">
                <div class="col-lg-6 col-md-6 form-group">
                    <label class="required" for="receiver_state">State: *</label>
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
    <br>
    <br>
    <br>
    <br>
    <br>
                <p id="price"></p>
    <button class="btn btn-success float-right btn-lg col-md-2" aria-label="Submit">&nbsp;&nbsp;&nbsp;&nbsp;Request&nbsp;&nbsp;&nbsp;&nbsp;</button>
    </form>
        <br>
        <a type="button" class="btn btn-light" href="index.php">return home</a>

</section>
<?php

?>



<!-- Footer-->
<footer class="bg-light py-5">
    <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2022 - Lucas Qin 103527269, Swinburne University of Technology</div></div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
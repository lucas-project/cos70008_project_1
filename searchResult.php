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
<body>
<?php
include_once "nav.inc";
?>
<?php
if($_SESSION["email"]) {
    ?>
    Welcome to search result, <?php echo $_SESSION["email"]; ?>. <br>Click here to <a href="logout.php" title="Logout" class="btn btn-danger">Logout.</a>
    <!-- search eoi based on position -->
    <?php
    if (!isset($_POST["email"]))
        $query = "SELECT * FROM APPLICATION";
    else {
        $fn=$_POST["firstName"];
        $query = "SELECT * FROM APPLICATION 
                    WHERE firstName LIKE '%$fn%'";
    }
    require_once "settings.php";
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    if ($conn) {
        echo "<p>Database Connected!</p>";
        echo '<a href="administration.php" class="btn btn-success">Return</a>';
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<p>Select successful!</p>";
            $record = mysqli_fetch_assoc ($result);
            if ($record) {
                echo "<table class='table'>";
                echo "<tr>";
                echo "<th>RefNo.</th>";
                echo "<th>Name</th>";
                echo "<th>status</th>";
                echo "<th>email</th>";

                echo"</tr>";
                while ($record) {
                    echo "<tr>";
                    echo "<td>{$record['id']}</td>";
                    echo "<td>{$record['firstName']}</td>";
                    echo "<td>{$record['status']}</td>";
                    echo "<td>{$record['email']}</td>";
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
    echo "<h1>Please login first.</h1>";
    echo '<a href="login.php" class="btn btn-success">Login</a>';

}
?>
</body>
</html>
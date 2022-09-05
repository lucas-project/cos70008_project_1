<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once "head.inc";
?>
    <body id="page-top">
    <?php
    include_once "nav.inc";
    ?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">ShipOnline System Home Page</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">ShipOnline provides an online service for delivering small items for customers from Melbourne to anywhere in Australia.</p>
                        <a class="btn btn-primary btn-xl" href="request.php">Book Now</a>
                    </div>
                </div>
            </div>
        </header>


        <?php
        include_once "footer.inc";
        ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

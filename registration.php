<!DOCTYPE html>
<html lang="en">
<?php
include_once "head.inc";
?>
<body>
<?php
include_once "nav.inc";
?>
<div class="signup-form">
    <form action="processRegistration.php" method="post" enctype="multipart/form-data">
        <h2>Register</h2>
        <p class="hint-text">Create your account</p>
        <div class="form-group">
            <div class="row">
                <div class="col"><input type="text" class="form-control" name="user_name" placeholder="your user name" required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="email" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="enter phone number" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="enter password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="confirm password" required="required">
        </div>


        <div class="form-group">
            <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
        </div>
        <div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
    </form>

</div>
<?php
include_once "footer.inc";
?>
</body>
</html>
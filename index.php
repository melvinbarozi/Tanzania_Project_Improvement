
<?php
  
      require_once('server/connection.php');
    
 ?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Management and Inter-Department Sharing</title>
    <!-- Link Bootstrap CSS file -->
    <link rel="stylesheet" href="Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/w3/w3.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.css">
    <link rel="stylesheet" href="Assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="Assets/bootstrap/css/css.css">
    
</head>

<body>
    <!-- Your HTML content goes here -->
    
    <!-- Link Bootstrap JS file (jQuery is required for Bootstrap JS components) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Assets/bootstrap/bootstrap.min.js"></script>
    <script src="Assets/bootstrap/w3/w3.js"></script>
    <script>
      function validateForm() {
    var id = $("#id").val();
    var password = $("#password").val();
    var loginAs = $("#loginAs").val();
    var isValid = true;

    if (id == "" || password == "" || loginAs == "") {
        isValid = false;
        $("input").each(function(){
            if ($(this).val() == "") {
                $(this).css("border", "2px solid red");
            }
        });
    
        $("#warningPopup").modal("show");
    }

    return isValid;
}

$(document).ready(function(){
                $("#login").click(function(){
                    var id = $("#id").val();
                     var password = $("#password").val();
                    var loginAs = $("#loginAs").val();


                    if(id === '' || id === null ){
                        $('#id').css("border", "4px solid red ").focus();
                        $('#dvError').text('Please Enter Email Id');
                        return false;
                    }   
                    if(password === '' || password === null){
                        $('#password').css("border", "4px solid red ").focus();
                        $('#dvError').text('Please Enter Your Password');
                        return false;
                    }
                    if(loginAs === '' || loginAs === null){
                        $('#loginAs').css("border", "4px solid red ").focus();
                        $('#dvError').text('Please Select Your Login Roles');
                        return false;
                    }
                });
            });
</script>
    <header class="container-fluid bg-primary text-white py-3">
        <div class="row">
            <div class="col">
                <h3>Tanzania Resource Portoal</h3>
            </div>
        </div>
    </header>

    <div class="container">
  
    <div class="row justify-content-center">
    
     

        <div class="col-md-6">
        <h2 class="college-heading fw-bold">
        <img src="Assets/images/logo.png" alt="College Logo" class="college-logo">
        ARUSHA TECHNICAL COLLEGE
        
    </h2>
            <div class="w3-card-4 p-4 login-form">
                <h2 class="text-center mb-4">Resource Management and Inter-Department Sharing</h2>
                <form method="POST" action="" id="insertForm">

    <div class="mb-3">
        <label for="loginAs" class="form-label">Login As</label>
        <select class="w3-select" id="loginAs" name="loginas">
            <option value="internal-Auditor">Internal-Auditor</option>
            <option value="student">Student</option>
            <option value="Store Keeper">Store Keeper</option>
            <option value="otherStaff">Academician</option>
        </select>
    </div>
    <div class="mb-3">
        <input type="text" class="w3-input" id="id" placeholder="Enter username or Email Address" name="id">
    </div>
    <div class="mb-3">
        <input type="password" class="w3-input" id="password" placeholder="Enter password" name="password">
    </div>
    
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
    </div>
</form>

    <div class="d-grid mb-3">
        <a href="" class="btn btn-link">Forgot Password?</a>
        <input  type="submit"  name="login" class="w3-button w3-green btn-block" id="login">
        </div>
    <script>
        $(document).ready(function(){
            $("#submitBtn").click(function(){
                validateForm(); // Call the validation function on button click
            });
        });
    </script>
               
            </div>
        </div>
    </div>
 
</div>
</div>
<footer class="footer w3-margin">
        <div class="container">
            <div class="social-icons">
                <a href="#" class="w3-hover-opacity"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w3-hover-opacity"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram w3-xlarge w3-margin-right"></i></a>
                <a href="#"><i class="fab fa-facebook w3-xlarge w3-margin-right"></i></a>
            </div>
            <p>&copy; 2024 Resource Management System</p>
        </div>
    </footer>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<?php
require_once('../server/connection.php');
    
//  if(!empty($_SESSION['hod'])){
//      header('location:../');
// Include database connection file
if(isset($_POST['Save'])){    
$Fullname = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["FullName"]))));
    $email = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,strtolower($_POST["email"])))));
    $gender = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["gender"]))));
    $departmentName =$_POST["departmentName"];
    $role = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["role"]))));
    $mobile = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["mobile"]))));
    $joinDate = date("Y-M-D");
    $lastLoginTimestamp = date("y-m-d");
    $defaultPassword = 'R2024@atc'; 
    $hashedDefaultPassword = password_hash($defaultPassword, PASSWORD_BCRYPT);
    $errors = [];
    $success = '';   
if ($role === 'Student') {
    $regNo =trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["registrationNumber"]))));
    $program =trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["program"]))));
    if (empty($regNo)) {
        $errors[] = 'Registration number is required for students.';
    }
    if (empty($program)) {
        $errors[] = 'Program/course is required for students.';
    }
    if (empty($errors)) {
        $checkdatta =mysqli_query($conn,"SELECT * FROM students WHERE admissionNo ='$regNo' OR email='$email'");
        if(mysqli_num_rows($checkdatta)>0){
            $errors[] =" Another Student with this Registration".' '.$regNo.' '. "Exist";
        }else{
        if($insert_query =mysqli_query($conn, "INSERT INTO students (admissionNo, Fullanme, Email, DepartmentID, program, password) VALUES
         ('$regNo', '$Fullname', '$email', '$departmentName', '$program', '$hashedDefaultPassword')")){
         echo $role. ":added successifuly";
        } else {
            echo  mysqli_error($conn);
        }    
}
    }
}else{
    if (empty($errors)) {
        $checkdatta =mysqli_query($conn,"SELECT * FROM users WHERE email ='$email'");
        if(mysqli_num_rows($checkdatta)>0){
            $errors[] =" Another user with this email".' '.$email.' '. "Exist";
        }else{
                if($insert_query = mysqli_query($conn,"INSERT INTO users (names,email,Gender,contactInfo,DepartmentID,JoinDate,LastLoginTimestamp,Role,Password)
                VALUES ('$Fullname','$email','$gender','$mobile','$departmentName','$joinDate','$lastLoginTimestamp','$role','$hashedDefaultPassword')")){
            echo $role .":User added successfully.";
        } else {
            echo  mysqli_error($conn);
        }
        }
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Managemnet and inter-department sharinga Analysis Companion</title>
    <script src="../Assets/jquery/jquery.min.js"></script>
<script src="../Assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/w3/w3.css">
    <link rel="stylesheet" href="../Assets/fontawesome/webfonts">
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/bootstrap/css/css.css">
    <link rel="stylesheet" href="../Assets/fontawesome/css/all.min.css">
    <style>
        
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
      $('#role').on('change', function() {
        if ($(this).val() === 'Student') {
          $('#studentFields').show();
          $('#registrationNumber').prop('required', true);
          $('#program').prop('required', true);
        } else {
          $('#studentFields').hide();
          $('#registrationNumber').prop('required', false);
          $('#program').prop('required', false);
        }
      });
    });
    function redirectToRequestInfo(requestId) {
        window.location.href = 'requestinfo.php?id=' + requestId;
    }

    function redirectToCategoryInfo(categoryId) {
        window.location.href = 'resourcedetails.php?id=' + categoryId;
    }



    function toggleStudentFields() {
            var role = document.getElementById('role').value;
            var studentFields = document.getElementById('student-fields');
            if (role === 'student') {
                studentFields.style.display = 'block';
            } else {
                studentFields.style.display = 'none';
            }
        } function toggleStudentFields() {
            var role = document.getElementById('role').value;
            var studentFields = document.getElementById('student-fields');
            if (role === 'student') {
                studentFields.style.display = 'block';
            } else {
                studentFields.style.display = 'none';
            }
        }
    </script>


       
    
</head>
<body style="background-color:white">
<header class="container-fluid bg-primary text-white py-3">
        <div class="row">
            <div class="col">
                <h3>Tanzania Resource Portoal</h3>
            </div>
            <div class="col text-end">
            <a href="#" class="text-white text-decoration-none" title="Welcome [Login User]">
    <span class="badge bg-primary">WELCOME @Santana Barr3ra</span>
</a>
<a href="../users/Account/" class="text-white mx-3 text-decoration-none" title="Change Password">
    <span class="badge bg-primary">CHANGE PASSWORD</span>
</a>
<a href="#" class="text-white text-decoration-none" title="Logout">
    <span class="badge bg-primary">LOGUT</span>
</a>

</div>

        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
       
            <div class="col-md-2 ">
            <div class="container my-3 text-muted">
        <p>Path: ATC /Users / Add Users</p>
</div>
                <div class="list-group">
                    <a href="../dashboard/" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="../dashboard/index3.php" class="list-group-item list-group-item-action ">Resources</a>
                    <div class="list-group">
      <div class="dropdown">
        <a href="#" class="list-group-item list-group-item-action active dropdown-toggle" id="usersDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>
        <div class="dropdown-menu" aria-labelledby="usersDropdown">
          <a class="dropdown-item" href="#">Add Users</a>
          <a class="dropdown-item" href="#">Student</a>
          <a class="dropdown-item" href="#">Users Requested</a>
        </div>
      </div>
    </div>
                    <a href="#" class="list-group-item list-group-item-action">Reports</a>
                    <a href="#" class="list-group-item list-group-item-action">Resource Invetory</a>
                    <a href="#" class="list-group-item list-group-item-action">Real-Time Tracking</a>
                    <a href="#" class="list-group-item list-group-item-action">Departments</a>
                    <a href="#" class="list-group-item list-group-item-action">Eligible users</a>
                    <a href="#" class="list-group-item list-group-item-action">Monthly Reporting</a>
                    <a href="#" class="list-group-item list-group-item-action">Evaluation and Analytics:</a>
                </div>
                <div class="invite-help-buttons">
            <button class="btn btn-dark btn-sm">Invite</button>
            <button class="btn btn-dark btn-sm">Help</button>
        </div>
            </div>
    
            <div class="col-md-9 w3-margin">
                <div class="w3-card w3-padding">
                    <h4>
                    
                    <div class="container mt-4">
                    <h2 class="my-4">Add User</h2>
   <hr>
                    </h4>
                
     
    <form class="add-user-form" method="POST"  name="userforms" action="" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="firstName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="Fullname" name="FullName" placeholder="Enter Full Name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div id="studentFields" style="display: none;">
        <div class="mb-3">
          <label for="registrationNumber" class="form-label">Registration Number</label>
          <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" placeholder="Enter registration number">
        </div>
        <div class="mb-3">
          <label for="program" class="form-label">Program/Course</label>
          <input type="text" class="form-control" id="program" name="program" placeholder="Enter program or course">
        </div>
      </div>
            </div>

        </div>
        <div class="col">
            <div class="mb-3">
                <label for="departmentId" class="form-label">Department</label>
                <select  class="form-control" id="departments" name="departmentName">
                <option value="">--Select Departments--</option>

                 <?php
                $result = mysqli_query($conn, "SELECT  * FROM departments  ");
                if(mysqli_num_rows($result) > 0 ){
                while($data = mysqli_fetch_assoc($result)){ 
                ?>
                <option value="<?php echo $data['DepartmentID'] ?>"><?php echo ucfirst($data['DepartmentName']) ?></option>
                <?php }
                }else { ?>
                <option value="">No Result</option>
                <?php }
                ?>
                </select>
            </div>
            <div class="container mt-3">
    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-select" id="role" name="role" required>
        <option value="">Select role</option>
        <option value="Student">Student</option>
        <option value="Store Keeper">Store Keeper</option>
        <option value="Administrative Staff /HOD">Administrative Staff /HOD</option>
        <option value="Technical Support">Technical Support</option>
      </select>
    </div>
    
  </div>
  <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number" required>
            </div>
        </div>
        
    </div>
    <div class="mb-3">
        <button type="reset" class="btn btn-danger">Cancel</button>
        <button type="submit"  name ="Save"class="btn btn-primary">Save</button>
    </div>
    <?php if (!empty($errors)) {
        echo '<div class="alert alert-danger mb-3">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }

    // if ($success) {
    //     echo '<div class="alert alert-success">' . $success . '</div>';
    // }
    ?>
</form>

</div>

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
</body>
</html>

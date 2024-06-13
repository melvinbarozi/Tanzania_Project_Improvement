<!DOCTYPE html>
<?php
require_once('../server/connection.php');

 if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit();
}
    $user = $_SESSION['user'];
    $role = $_SESSION['role'];
    $data_query = "";
if ($role == 'student') {
    $data_query = "SELECT * FROM students,departments WHERE students.StudentId=departments.DepartmentID AND students.admissionNo  = '{$user['admissionNo']}'";
}
$data_result = mysqli_query($conn, $data_query);
if ($data_result) {
    $user_data = mysqli_fetch_assoc($data_result);
} else {
    echo "<div class='error'>Error fetching data: " . mysqli_error($conn) . "</div>";
    exit();
}
$departments_sql = "SELECT * FROM departments";
$departments_result = $conn->query($departments_sql);

// Fetch resources
$resources_sql = "SELECT * FROM resources";
$resources_result = $conn->query($resources_sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resource Management and Inter-Department Sharing</title>
    <!-- Link Bootstrap CSS file -->
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/w3/w3.css">
    <link rel="stylesheet" href="../Assets/fontawesome/webfonts">
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/bootstrap/css/css.css">
    <link rel="stylesheet" href="../Assets/fontawesome/css/all.min.css">

    <script>
$(document).ready(function() {
    $('.nav-tabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // Show the first tab by default
    $('.nav-tabs a:first').tab('show');
});
</script>

</head>
<body>
    
<header class="container-fluid bg-primary text-white py-3">
        <div class="row">
            <div class="col">
                <h3>Tanzania Resource Portal</h3>
            </div>
            <div class="col text-end">
            <a href="#" class="text-white text-decoration-none" title="Welcome <?php echo $user_data['Fullanme']?> ">
    <span class="badge bg-primary">WELCOME <?php echo $user_data['Email']?></span>
</a>
<a href="#" class="text-white mx-3 text-decoration-none" title="Change Password">
    <span class="badge bg-primary active">CHANGE PASSWORD</span>
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
        <p>Path: ATC /Resources / Requesting..</p>
</div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Dashboard</a>
                    <a href="#" class="list-group-item list-group-item-action">My Account</a>
                    <a href="#" class="list-group-item list-group-item-action ">View Resources</a>
                    <a href="#" class="list-group-item list-group-item-action">View Categories</a>
                    <a href="#" class="list-group-item list-group-item-action">Feedback</a>
                    <a href="#" class="list-group-item list-group-item-action active"> Request stpe 01</a>
                    <a href="#" class="list-group-item list-group-item-action disabled"> Request stpe 02</a>
                    <a href="#" class="list-group-item list-group-item-action disabled"> Request stpe 03</a>



                
                </div>
                <div class="invite-help-buttons">
            <button class="btn btn-dark btn-sm">Invite</button>
            <button class="btn btn-dark btn-sm">Help</button>
        </div>

         <!-- My tutors -->
         <h4 class="text-mued">My Account</h4>
         <hr>
                <div class="card mb-3">
                    <div class="card-header">
                        Info
                        <a href="#" class="float-end"><?php echo $user_data['admissionNo']?> </a>
                    </div>
                    <div class="card-body d-flex">
                        <div class="me-3">
                            <img src="../Assets/images/uploads/users-vector-icon-png_260862.jpg" alt="Tutor" class="rounded-circle" width="50" height="50">
                            <p class="mt-2"><?php echo $user_data['Fullanme'];?> </p>
                        </div>
                        <div>
                            <p><?php echo $user_data['program']?></p>
                            <a href="#" class="btn btn-link p-0"><?php echo $user_data['Email'];?></a>
                        </div>
                    </div>
                </div>
            </div>
        
    
            <div class="col-md-9 main-content w3-margin">
            
            <div class="chart-section">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h3 class="h3">Dashboard</h3>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                </div>
            </div>

    <div class="alert alert-info" role="alert">
                    Currently You dont have any Resource request Your can scow down to view all resourceor click in the link below to start requesting.
                    <a href="request.php" class="alert-link"> Click here</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              

<hr>
    </p>
    <form class="feedback-form" method="post" action="" w3-margin>
<div class="mb-3">
    <label for="category" class="form-label">Which Type </label>
    <div class="row">
        <?php 
         $data = mysqli_query($conn, "SELECT DISTINCT ResourceType FROM resources");
         if (mysqli_num_rows($data) >0) {
             while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <div class="col-auto">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="equipment" name="<?php echo $row['ResourceType'];?>" value="<?php echo $row['ResourceType']?>">
                <label class="form-check-label" for="equipment"><?php echo $row['ResourceType'];?></label>
            </div>
        </div>
        <?php }
         }else {
            ?>
            <div class="col-auto">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="software" name="category" value="software">
                <label class="form-check-label" for="">Currently Not Available</label>
            </div>
        </div>
         <?php }
        ?>
    </div>
</div>
<div class="col-md-12">
        <div class="mb-3">
            <select class="form-select" id="purpose" name="purpose" required>
                <option value="" disabled selected>Select purpose</option>
                <option value="teaching">Teaching</option>
                <option value="research">Research</option>
                <option value="other">Other</option>
                <!-- Add more options as needed -->
            </select>
        </div>
    </div>

<div class="col-md-12">
<div class="mb-3">
        <label for="categoryId" class="form-label">Cataegory Name </label>
    <select class="form-select" onchange="selectResourceType()">
        <option value="consumable">Consumable</option>
        <option value="non-consumable">Non-Consumable</option>
        <option value="other">Other</option>
    </select>
</div>
         </div>
    
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
        <label for="categoryId" class="form-label">Department Name</label>
                <select class="form-select" id="categoryId" name="categoryId" required>
                 <?php
                $result = mysqli_query($conn, "SELECT   DISTINCT DepartmentName,DepartmentID FROM departments ");
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
    </div>
    <div class="col-md-6">
        <div class="mb-3">
        <label for="categoryId" class="form-label">Cataegory Name </label>
                <select class="form-select" id="categoryId" name="categoryId" required>
                    <option value="">Select Category name--</option>
                 <?php
                $result = mysqli_query($conn, "SELECT  DISTINCT categoryName, categoriyId  FROM categories");
                if(mysqli_num_rows($result) > 0 ){
                while($data = mysqli_fetch_assoc($result)){ 
                ?>
                <option value="<?php echo $data['categoriyId'] ?>"><?php echo ucfirst($data['categoryName']) ?></option>
                <?php }
                }else { ?>
                <option value="">No Result</option>
                <?php }
                ?>
                </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
        <label for="categoryId" class="form-label">CateResource Name</label>
                <select class="form-select" id="categoryId" name="resources" required>
                    <option value="">--Select Resource--</option>
                 <?php
                $result = mysqli_query($conn, "SELECT  * FROM resources");
                if(mysqli_num_rows($result) > 0 ){
                while($data = mysqli_fetch_assoc($result)){ 
                ?>
                <option value="<?php echo $data['ResourceID'] ?>"><?php echo ucfirst($data['ResourceName']) ?></option>
                <?php }
                }else { ?>
                <option value="">No Result</option>
                <?php }
                ?>
                </select>
        </div>
    </div>

</div>


        <!-- Submit Button -->
        <button type="reset" class="btn btn-danger">cancel</button>
        <button type="submit" class="btn btn-primary">Next</button>

    </form>
    </div>
</div>
    </div> 
   <?php
   include '../Assets/footer.php';

  
   ?>

    <!-- Link Bootstrap JS file (jQuery is required for Bootstrap JS components) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Additional JS files for your project -->
    <!-- Add your custom JS files here if any -->
</body>
</html>


<!DOCTYPE html>
<?php
require_once('../server/connection.php');
$query = "SELECT ResourceID FROM resources ORDER BY ResourceID DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lastResourceId = $row['ResourceID'];
    $NewResourceIs =$lastResourceId;
    $NewResourceIs ++;
    
} else {
    echo "No resources found.";
}


 require_once('../server/connection.php');
 if(isset($_POST['Save'])){  
 $categoryId = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["categoryId"]))));
$ResourceName =trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["ResourceName"]))));
 $status = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["status"]))));
 $condition= trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["condition"]))));
 $ResourceDescription = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["ResourceDescription"]))));
 $productNo = trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["productNo"]))));
 $checkeddate= trim(htmlspecialchars(stripslashes(mysqli_real_escape_string($conn,$_POST["CheckOutDate"]))));
 $picture =  $_FILES['DeviceSampleImg'];
 
 

 if (empty($categoryId)) {
     $errors[] = "Please Select  category";
 }
 if (empty($ResourceName)) {
    $errors[] = "Enter The Name of this Reource";
}
 if (empty($status)) {
    $errors[] = "Please Select The Current Status";
}
if (empty($condition)) {
    $errors[] = "Please  Select The condition";
}
if (empty($productNo)) {
    $errors[] = "Enter Serial Number Or Model Number";
}
if (empty($checkeddate)) {
    $errors[] = "Enter The last Check date of this Resource";
}
 $query = "SELECT * FROM resources WHERE ResourceSerialNumber = '$productNo'";
 $result = mysqli_query($conn, $query);
 if (mysqli_num_rows($result) > 0) {
    
     $errors[] = "The same resources with"." ".$productNo." "."Exist'";
 }
 
 // If no errors, insert into database
 if (empty($errors)) {
    
    $file = $picture;
    if($file['error'] === 0){
        $fileName = $file['name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileSize = $file['size'];
        
        $allowedExtensions = array('png', 'jpg', 'jpeg');
        if(in_array(strtolower($fileExt), $allowedExtensions)){
                $fileNameNew = uniqid('$', TRUE).'.'.$fileExt;
                $fileDestination = "../Assets/images/uploads/".$fileNameNew;
                if(move_uploaded_file($file['tmp_name'], $fileDestination)){
                  if($result = mysqli_query($conn, "INSERT INTO resources (ResourceID,CategoryID, ResourceName, ResourceDescription, Status, resourceCondition, ResourceSerialNumber, CheckOutDate,SampleImg)
                     VALUES ('$NewResourceIs','$categoryId', '$ResourceName', '$ResourceDescription', '$status', '$condition', '$productNo', '$checkeddate', '$fileDestination')")){
                        echo '<div id="successNotification" class="alert alert-success">User added successfully.</div>';
                    } else {
                        // Error notification
                        echo '<div id="errorNotification" class="alert alert-danger">' . mysqli_error($conn) . '</div>';
                    }
                } else {
                    echo "Error uploading file.";
                }
        } else {
            echo "Invalid file type. Allowed types: png, jpg, jpeg.";
        }
    } else {
        echo "Error uploading file: ".$file['error'];
    }
 }  else{
    $errors[] = "There is Error exit";

 }  
}


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
</head>
<body>
    <!-- Your HTML content goes here -->
    
    <!-- Link Bootstrap JS file (jQuery is required for Bootstrap JS components) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Assets/bootstrap/bootstrap.min.js"></script>
    <script src="../Assets/bootstrap/cutomeJs.js"></script>
    <script src="../Assets/bootstrap/w3/w3.js"></script>
    <script>
    function showNotification(message, type) {
    const notificationElement = document.getElementById("notification");
    const messageElement = document.getElementById("notification-message");
    messageElement.textContent = message;
    notificationElement.classList.add("w3-panel", "alert-" + type);
    notificationElement.style.display = "block";
}

// JavaScript code to hide notification
function hideNotification() {
    const notificationElement = document.getElementById("notification");
    notificationElement.style.display = "none";
}


   </script>
    <header class="container-fluid bg-primary text-white py-3">
        <div class="row">
            <div class="col">
                <h3>Tanzania Resource Portoal</h3>
            </div>
            <div class="col text-end">
            <a href="#" class="text-white text-decoration-none" title="Welcome [Login User]">
    <span class="badge bg-primary">WELCOME @Santana Barr3ra</span>
</a>
<a href="#" class="text-white mx-3 text-decoration-none" title="Change Password">
    <span class="badge bg-primary">CHANGE PASSWORD</span>
</a>
<a href="#" class="text-white text-decoration-none" title="Logout">
    <span class="badge bg-primary">LOGUT</span>
</a>

</div>

        </div>
    </header>

    <!-- Section to indicate the path -->
    <div class="container my-3">
        <p>Path: Admin  / Dashboard / Add Users</p>
    </div>

    <!-- Main content -->
    <div class="container">
        <div class="row">
            <!-- Left navigation section -->
            <div class="col-md-3">
                <button class="btn btn-primary mb-3">My Uploads</button>
                <button class="btn btn-primary mb-3">All Files</button>
                <button class="btn btn-success mb-3">Request Resources</button><br>
                <button class="btn btn-primary mb-3">Add Category</button>
                <button class="btn btn-primary mb-3">Add Resourses </button>
                <button class="btn btn-success mb-3">All resources </button>
                <button class="btn btn-primary mb-3">New Department</button>
                <button class="btn btn-primary mb-3">All Notifications </button>
                <select class="btn btn-default mb-3">
                <option value="" namae>Select department</option>
                    <option value="1">Department 1</option>
                    <option value="2">Department 2</option>
                    <option value="3">Department 3</option>
                     </select>

            </div>

   
  <div class="col-md-7" style="margin-top:-4%">

    <h2 class="college-heading fw-bold">
    <img src="../Assets/images/logo.png" alt="College Logo" class="college-logo">
    ARUSHA TECHNICAL COLLEGE
</h2>
    <div class="container mt-4">
    <h2 class="my-4">Add Resource</h2>
    <form class=" form add-resource" method="post" action="" enctype="multipart/form-data">
    <div class="row">
    <div class="mb-3">
                <label for="categoryId" class="form-label">Category Name</label>
                <select class="form-select" id="categoryId" name="categoryId" required>
                    <option value="">--Select category Name--</option>
                 <?php
                $result = mysqli_query($conn, "SELECT  * FROM categories");
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
        <div class="col-md-6">
        <div class="mb-3 bold">
                <label for="totalAvailable" class="form-label">Name Of The Product/Resource Name:</label>
                <input type="text" class="form-control" id="ResourceName" name="ResourceName" placeholder="Name Of The Product/Resource Name" required>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status"  name="status"required>
                    <option value="">Select status</option>
                    <option value="available">Available and Active</option>
                    <option value="notAvailable">In Use</option>
                    <option value="notAvailable">Available but not Active</option>

                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Resource Conditions</label>
                <select class="form-select" id="condition" name="condition"required>
                    <option value="">Select The condition of the Resource status</option>
                    <option value="Good">Good</option>
                    <option value="Not Good">Not Good</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
        <div class="mb-3">
                <label for="resourceImage" class="form-label">Resource Image</label>
                <input type="file" class="form-control" id="DeviceSampleImg" name="DeviceSampleImg" required>
            </div>

            <div class="mb-3">
                <label for="totalAvailable" class="form-label">Enter Serial Number/Model Number</label>
                <input type="text" class="form-control" id="productNo" name="productNo" placeholder="Enter The Product Number" required>
            </div>
            <div class="mb-3">
                <label for="totalAvailable" class="form-label">Enter Checked Date</label>
                <input type="date" class="form-control" id="CheckOutDate" name="CheckOutDate" placeholder="Enter Checked Date" required>
            </div>
        </div>
        
        <div class="col-md-12">
        <div class="mb-3">
    <label for="ResourceDescription" class="form-label">Resource Descriptions</label>
    <textarea class="form-control" id="ResourceDescription" name="ResourceDescription" placeholder="Enter resource Descriptions" maxlength="250" rows="5" required></textarea>
</div>
            
        </div>
    </div>
    <div class="mb-3">
        <button type="reset" class="btn btn-danger">Cancel</button>
        <button type="submit" class="btn btn-primary" name="Save">Save</button>
    </div>
</form>

</div>
    </div>
    </div>
    </div>
    <footer class="footer w3-margin">
        <div class="container">
            <div class="social-icons">
                <a href="#" class="w3-hover-opacity"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="w3-hover-opacity"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w3-hover-opacity"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="w3-hover-opacity"><i class="fab fa-instagram"></i></a>
            </div>
            <p>&copy; 2024 Resource Management System</p>
        </div>
    </footer>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

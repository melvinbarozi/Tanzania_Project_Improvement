<!DOCTYPE html>

<?php
 require_once('../server/connection.php');
    
//  if(!empty($_SESSION['hod'])){
//      header('location:../');

// Check if data is received through POST request
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
    <!-- Header section with different colors -->
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
        <p>Path: AMREF / CTC / DQA Files</p>
    </div>

    <!-- Main content -->
    <div class="container">
        <div class="row">
            <!-- Left navigation section -->
            <div class="col-md-3">
                <button class="btn btn-primary mb-3">My Uploads</button>
                <button class="btn btn-primary mb-3">All Files</button>
                <button class="btn btn-success mb-3">Request Resources</button>

            </div>
            <!-- Middle content section -->
            <div class="col-md-6">
                <h4 class="mb-3">Guides</h4>
                <p>
    Please make sure the file has the following specifications:
    <ul>
        <li>An extension of "xlsx"</li>
        <li>All resources information must be in sheet named</li>
        <li>No column should be renamed from the original</li>
    </ul>
</p>

                <!-- Form to select entities -->
                <form metho="POST" action "">
                    <div class="mb-3">
                        <label for="entitySelect" class="form-label">Show:</label>
                        <select class="form-select" id="entitySelect">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <!-- Add more options if needed -->
                        </select>
                    </div>
                </form>
                <!-- Form to search contents -->
                
                <!-- Button to request resources -->
            </div>
            <!-- Right search form section -->
            <div class="col-md-3">
                <h4 class="mb-3">Search</h4>
                <form>
                    <div class="mb-3">
                    
                        <input type="text" class="form-control" placeholder="Search...">
                    
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Table section -->
    <div class="container mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Maark</th>
                    <th>#</th>
                    <th>Uploaded Files</th>
                    <th>Status</th>
                    <th>Uploaded By</th>
                    <th>Uploaded At</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <?php
            $data = mysqli_query($conn, "SELECT categories.categoryName,categories.Status,categories.No_of_resources,departments.DepartmentName FROM categories,departments WHERE categories.DepartmentID= departments.DepartmentID" );
            if (mysqli_num_rows($data) >0) {
                $nums =0;
                while ($row = mysqli_fetch_assoc($data)) {
          $nums ++;
          ?>
          <tr>
          <!-- //SELECT * FROM categories.categoryName,categories.categoriyId,categories.No_of_resources -->
          <tr>
    <td> <input type="checkbox" class="form-check-input"> </td>
    <td><?php echo $nums;?></td>  
    <td><?php echo $row['categoryName']?></td>
    <td><?php echo $row['Status']?></td>
    <td><?php echo $row['No_of_resources']?></td>
    <td><?php echo $row['DepartmentName']?></td>
    <td><button class="btn btn-primary">Request</button></td>
    <td> <button class="btn btn-info">View More</button></td>
    <td><button class="btn btn-success">Share</button></td>
</tr>
<?php }
                }else {
  ?>
<tr>
    <td colspan="6">No content available</td>
</tr>
<?php }?>

        </table>
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
    <!-- Link Bootstrap JS file (jQuery is required for Bootstrap JS components) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Additional JS files for your project -->
    <!-- Add your custom JS files here if any -->
</body>
</html>

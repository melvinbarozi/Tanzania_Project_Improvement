<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Link Bootstrap CSS file -->
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../Assets/fontawesome/css/all.min.css">
    <style>
        /* Custom CSS styles can be added here */
    </style>
</head>
<body>
    
    <header class="container-fluid bg-primary text-white py-3">
        <div class="row">
            <div class="col">
                <h3>Tanzania Project Improvement</h3>
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
                    <th>#</th>
                    <th>Uploaded Files</th>
                    <th>Status</th>
                    <th>Uploaded By</th>
                    <th>Uploaded At</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be added dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Link Bootstrap JS file (jQuery is required for Bootstrap JS components) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Additional JS files for your project -->
    <!-- Add your custom JS files here if any -->
</body>
</html>

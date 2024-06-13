<?php
require_once('../server/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Resource Management and Inter-Department Sharing</title>
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/w3/w3.css">
    <link rel="stylesheet" href="../Assets/fontawesome/webfonts">
    <link rel="stylesheet" href="../Assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/bootstrap/css/css.css">
    <link rel="stylesheet" href="../Assets/fontawesome/css/all.min.css">
  <style>
    
    .widget {
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    .chart-container {
      position: relative;
      height: 40vh;
      width: 80vw;
    }
  </style>
</head>
<body>
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
        <p>Path: ATC /Resources / HOD | </p>
</div>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active"> <i class="fas fa-tachometer-alt"></i> Overview</a>
                    <a href="#" class="list-group-item list-group-item-action">All Request</a>
                    <a href="#" class="list-group-item list-group-item-action">MyTask</a>
                    <a href="#" class="list-group-item list-group-item-action">Allocations Query</a>
                    <a href="#" class="list-group-item list-group-item-action ">Resources</a>
                    <a href="#" class="list-group-item list-group-item-action ">Categories</a>
                    <a href="#" class="list-group-item list-group-item-action">Utilizations &Reports</a>
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
            <div class="col-md-10">

  <h2>Overview</h2>
  <div class="row">
    <div class="col-md-3">
      <div class="widget">
        <p>Most of resources requested per month</p>
        <p class="display-6">ICT Res..</p>
        <a class="text-success"><i class="fas fa-arrow-up"></i> 20%</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget">
        <p>Available and active Resources</p>
        <p class="display-6">304</p>
        <p class="text-danger"><i class="fas fa-arrow-down"></i> 78%</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget">
        <p>Useful resources Type/consumable & Non-Consumable</p>
        <p class="display-6">Equipments</p>
        <p class="text-muted">44%</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="widget">
        <p>Resources Per Departments</p>
        <p class="display-4">6</p>
        <p class="text-muted">New</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="widget">
        <h4>Resource Utilizato chart (most Useful)</h4>
        <div class="chart-container">
          <canvas id="lineChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="widget">
        <h4>Resource Type</h4>
        <div class="progress">
          <div class="progress-bar bg-success" style="width:54%">Equipments</div>
        </div>
        <div class="progress">
          <div class="progress-bar bg-info" style="width:31%">Software</div>
        </div>
        <div class="progress">
          <div class="progress-bar bg-warning" style="width:15%">Supplie</div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="widget">
        <h4>Category List</h4>
        <ul class="list-group">
        <?php
         $data = mysqli_query($conn, "SELECT categories.categoriyId,categories.categoryName,categories.Status,categories.No_of_resources,departments.DepartmentName FROM categories,departments WHERE categories.DepartmentID= departments.DepartmentID ");
        if (mysqli_num_rows($data) >0) {
        while ($row = mysqli_fetch_assoc($data)){
         ?>
          <li class="list-group-item"><?php echo $row['categoryName']. ' '. $row['DepartmentName'];?></li>
          <?php }
        } else{ ?>
            <li class="list-group-item">No Any Item Found</li>

        <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
   include '../Assets/footer.php';

  
   ?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
        datasets: [{
          label: 'Current week',
          data: [12, 19, 3, 5, 2, 3, 9],
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          fill: true,
        }, {
          label: 'Previous week',
          data: [7, 11, 5, 8, 3, 7, 4],
          borderColor: 'rgba(153, 102, 255, 1)',
          backgroundColor: 'rgba(153, 102, 255, 0.2)',
          fill: true,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      }
    });

    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Orders',
          data: [12, 19, 3, 5, 2, 3, 9],
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      }
    });
  });
</script>
</body>
</html>

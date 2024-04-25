<?php
require_once("DBConnection.php");
session_start();
if(!isset($_SESSION["sess_user"])){
  header("Location: index.php");
}
else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
         
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel</title>

    <style> * {
  font-family: 'Raleway', sans-serif;
}  

        h1 {
            text-align: center;
            font-size: 2.5em;
            font-weight: bold;
            padding-top: 1em;
        }

        .mycontainer {
            width: 90%;
            margin: 1.5rem auto;
            min-height: 60vh;
        }

        .mycontainer table {
            margin: 1.5rem auto;
        }
    </style>

</head>

<body>
    <nav class="navbar header-nav navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        
            <a class="navbar-brand" href="admin.php">Gate Pass Application</a>
            <!-- <button class="btn-default" onclick="window.location.href='leavehist.php';">Leave History</button> </div> -->
            <!-- <nav class="nav navbar-right">
            <a class="nav-link active" href="#">Active</a>
            
            </nav>

            <button id="logout" onclick="window.location.href='logout.php';">Logout</button> </div> -->

            <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="registeredstudents.php" style="color:white;">Student List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="leave_history.php" style="color:white;">Pass History</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="admin.php" style="color:white;">Pass Requests <span class="badge badge-pill" style="background-color:#2196f3;"><?php include('count_req.php');?></span></a>
            </li>
            <li class="nav-item">
            <button id="logout" onclick="window.location.href='logout.php';">Logout</button> </div>
            </li>
            </ul>
    </nav>

    <h1>Mechanical Engineering  - 4th Year Students List</h1>

    <div class="mycontainer">

        <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped">
                  <thead>
                      <th>#</th>
                      <th>Username</th>
                      <th>Fullname</th>
                      <th>Branch</th>
                      <th>Year</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Contact</th>
                      <th>Guardian Mail</th>
                      <th>Action</th>
                  </thead>
                  <tbody>
                    <!-- loading all leave applications of the user -->
                    <?php
                          $leaves = mysqli_query($conn,"SELECT * FROM users WHERE type = 'Employee' AND department='MEC' AND year='4'");
                          if($leaves){
                            $numrow = mysqli_num_rows($leaves);
                            if($numrow!=0){
                              $cnt=1;
                              while($row1 = mysqli_fetch_array($leaves))
                                
                                echo "<tr>
                                        <td>$cnt</td>
                                        <td>{$row1['name']}</td>
                                        <td>{$row1['fullname']}</td>
                                        <td>{$row1['department']}</td>
                                        <td>{$row1['year']}</td>
                                        <td>{$row1['email']}</td>
                                        <td>{$row1['gender']}</td>
                                        <td>{$row1['phone']}</td>
                                        <td>{$row1['gnmail']}</td>
                                        <td><a href=\"edit.php?id={$row1['id']}\"><button class='btn-warning btn-sm'>Edit</button></a> <a href=\"delete_emp.php?id={$row1['id']}\"><button class='btn-danger btn-sm' >Delete</button></a></td>
                                        
                                      </tr>";
                             $cnt++; }
                             else {
                              echo"<tr class='text-center'><td colspan='12'>YOU DON'T HAVE ANY LEAVE HISTORY! PLEASE APPLY TO VIEW YOUR STATUS HERE!</td></tr>";
                            }
                          }
                          else{
                            echo "Query Error : " . "SELECT descr,status FROM leaves WHERE eid='".$_SESSION['sess_eid']."'" . "<br>" . mysqli_error($conn);;
                          }
                      ?>
                  </tbody>
              </table>
          </div>
    </div>

    <footer class="footer navbar navbar-expand-lg navbar-light bg-light" style="color:white;">
    <div>
    <p class="text-center">&copy; <?php echo date("Y"); ?> - Gate Pass Application</p>
       
    </div>
    </footer>
</body>

</html>

<?php
}

ini_set('display_errors', true);
error_reporting(E_ALL);
?>

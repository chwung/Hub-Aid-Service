<?php
    session_start();

    include ("dbcon.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body class="container-fluid bg-info" style="padding: 100px">
    <div class="row align-items-center" style="margin-top: 200px; flex-wrap: nowrap;">
        <div class="col-4 box bg-white" style="margin-left: 10px;">
          <h1 class="text-center" >Hub Aid Service</h1>
          <form method="POST" id="form" action="login.php">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control sizing" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control sizing" id="password" name="password" required>
            </div>
            <div>
            <button type="submit" class="btn btn-primary w-100" >Login</button>
            </div>
          </form>
          <p class="text-center">
          <a href="register.php" class="mb-0 text-center">Don't have an account?</a>
          </p>  
        </div>

        <div class="col-8">
            <h1>For Donor</h1>
            <a class="btn btn-primary w-100" href="appeals.php" role="button">View Appeals</a>
        </div>
    </div>

    <?php
      if($_SERVER['REQUEST_METHOD'] == "POST")
      {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $patientFlag = 0;
        $staffFlag = 0;
  
        
        $sqlPatient = "SELECT * FROM PATIENTS WHERE username = '$username' AND password = '$password'";
        $patient = $connection->query($sqlPatient);
        
        $sqlStaff = "SELECT * FROM STAFFS WHERE username = '$username' AND password = '$password'";
        $staff = $connection->query($sqlStaff);
        
        if($patient -> num_rows > 0){
            $patientFlag = 1;
        }else if($staff -> num_rows > 0) {
            $staffFlag = 1;
        }
        
        if($staffFlag == 0 && $patientFlag == 0){
            echo '<script type="text/javascript">';
            echo 'alert("Username or Password wrong.");';
            echo '</script>';
        } else if($patientFlag == 1) {
            $_SESSION['patientUsername'] = $username;
            $_SESSION['patientPassword'] = $password;
            header("location: PatientProfile.php");
        } else if($staffFlag == 1){
            $_SESSION['staffUsername'] = $username;
            $_SESSION['staffPassword'] = $password;
            header("location: staffprofile.php");
        }
    }
    ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="Javascript.js"></script>
  </body>
</html>

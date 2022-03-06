<?php 
session_start();
    include("dbcon.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    //something was posted
    $centre_name = $_POST['centreName'];
    $centre_address = $_POST['address'];
    $user_name = $_POST ['name'];
    $full_name = $_POST['fullName'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $staff_id = $_POST['staffID'];
    $flag = 0;

    $sqlQuery = "SELECT * FROM STAFFS";

    $status = $connection->query($sqlQuery);
    
    if($status -> num_rows > 0){                        //checks if there's any patients
        while ($row = $status -> fetch_assoc()) {
          if ($email == $row["email"] || $username ==$row['username'] || $staff_id == $row['staff_id']){
                $flag = 1;
                }
        }
    }

    if ($flag == 1){ 
          echo '<script type="text/javascript">'; //user already exists
          echo 'alert("Account already In Use.")';
          echo '</script>';                                   
        } else {                                        //user doer not exists
            $sqlQuery = "INSERT INTO STAFFS VALUES ('$centre_name', '$centre_address', '$user_name', '$full_name', '$password', '$email', '$staff_id')";
			      $result = $connection -> query($sqlQuery);  //execute query (php)
				    if ($result == TRUE){                   //check status of query
                header("location: login.php");
                die;
			  	}
        }
}

                    
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Registration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class = "bg-info">
      <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4 bg-white rounded p-5 shadow">
          <h1 class="mb-0 text-center font-weight-bold">Create an Account</h1>
          <form id="form" name="staffForm" method="post">
            <div class="mb-4">
              <label for="select" class="form-label font-weight-bold">Choose</label>
              <br>
                <select id="Select" class="form-control" onchange="location = this.value;">
                    <option value="registerStaff.php">Healthcare AdministratorStaff</option>
                    <option value="registerPatient.php">Patient</option>
                </select>
            </div>
            <div class="mb-4">
                
                <select id="choose" class=" form-control" name ="choose" onchange ="myFunction()">
                  <option disabled>--Choose a centre--</option>
                
                  <?php
                    $query = "SELECT DISTINCT centre_name, centre_address FROM staffs";
                    $data = $connection -> query($query);
                    if($data -> num_rows > 0){
                        while($staff = $data -> fetch_assoc()){
                            $centre = $staff['centre_name'];
                            $add = $staff['centre_address'];
                            echo "<option value='$centre-$add'>";
                            echo "$centre"; 
                            echo '</option>';
                            
                        }
                    }

                  ?>
                  <script>
                    function myFunction(){
                    var centre = $('#choose').val().split('-')[0];
                    var address = $('#choose').val().split('-')[1];

                    document.getElementById("centre").value = centre;
                    document.getElementById("address").value = address;
                    }
                   </script>;

                  </select>

            </div>
            <div class="mb-4">
                <label for="selectCentre" class="form-label font-weight-bold">Centre Name</label>
                <input type="text" id="centre" name="centreName" class="form-control" placeholder="Centre Name"/>
                
                <br>
                <label for="address" class="form-label font-weight-bold">Centre Address</label>
                <br>
                <textarea name="address" id="address" rows="5" placeholder="Centre Address" style="width: 100%;"></textarea>
                

            </div>
            <div class="mb-4">
              <label for="username" class="form-label font-weight-bold">Username</label>
              <br>
              <input type="text" id="name" name="name" class="form-control" size="50" maxlength="30" placeholder="Username" required>
            </div>
            <div class="mb-4">
                <label for="fullname" class="form-label font-weight-bold">Full Name</label>
                <br>
                <input type="text" id="fullName" name="fullName"  class="form-control" size="50" maxlength="30" placeholder="Full Name" required>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label font-weight-bold">Password</label>
              <br>
              <input type="password" id="password" name="password"  class="form-control" size="50" maxlength="30" placeholder="Password" required>
            </div>
      
            <div class="mb-4">
              <label for="email" class="form-label font-weight-bold">Email</label>
              <br>
              <input type="email" id="email" name="email" class="form-control" size="50" maxlength="30" pattern=".+@.+\.com" placeholder="Email@gmail.com" required>
            </div>
      
            <div class="mb-4">
              <label for="id" class="form-label font-weight-bold">StaffID</label>
              <br>
              <input type="text" id="staffID" name="staffID" class="form-control" size="50" maxlength="8"  placeholder="00000000" inputmode="numeric" required>
            </div>
      
            <div class="mb-4 text-center">
              <button type="submit" class="btn btn-primary w-25" id="btnSubmit" onclick="validateStaff()">submit</button>
              <button type="button" class="btn btn-reset w-25" id="btnReset" onclick="reset()">reset</button>
            </div>
          </form>
          <p class="mb-0 text-center">Already have an account?<a href="login.php" class="mb-0 text-center text-decoration-none">Signup here!</a></p>
        </div>
      </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="Javascript.js"></script>

  </body>
</html>
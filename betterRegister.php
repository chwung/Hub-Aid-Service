<?php 
session_start();
    include("dbcon.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    //something was posted
    $fullname = $_POST['fullname'];
    $idNo = $_POST['idNo'];
    $email = $_POST['email'];
    $householdIncome = $_POST['householdIncome'];
    $address = $_POST['address'];
    $file = $_POST['file'];
    $description = $_POST['description'];
    $mobileNo = $_POST['mobileNo'];
    $organization = $_POST['orgName'];
    $flag = 0;
    $same = 0;

    $sqlQuery = "SELECT * FROM APPLICANT";

    $status = $connection->query($sqlQuery);
    

    if($status -> num_rows > 0){                        //checks if there's any applicants
        while ($row = $status -> fetch_assoc()) {
          if ($email == $row["email"]){
                $flag = 1;
                }
        }
    }

    if ($flag == 1){ 
          echo '<script type="text/javascript">'; //user already exists
          echo 'alert("Email already in use.")';
          echo '</script>';                                   
        } else {                                        //user doer not exists
            $queryy = "SELECT * FROM APPLICANT";
            $stmt = $connection->prepare($queryy);
            $stmt->execute();
            $stmt->store_result();
            $applicantCount = $stmt -> num_rows;

            $applicantID = 'A'.substr(str_repeat(0,4).$applicantCount+1, -4);
            $randomNumber = rand(100,999);
            

            $sqlQuery = "SELECT * FROM APPLICANT";

            $status = $connection->query($sqlQuery);
    
            if($status -> num_rows > 0){                        //checks if there's any applicants
                while ($row = $status -> fetch_assoc()) {
                  if ($username == $row["username"]){
                        $same = 1;
                        }
                }
            }
            while($same == 1){
              $same = 0;
              if($status -> num_rows > 0){                        //checks if there's any applicants
                while ($row = $status -> fetch_assoc()) {
                  if ($username == $row["username"]){
                        $same = 1;
                        }
                }
            }
            }
              $username = strtok($fullname,  ' ').$randomNumber;
              $password = substr($fullname,0,3).$randomNumber;
              $sqlQuery = "INSERT INTO APPLICANT VALUES ('$username', '$password', '$fullname', '$email', '$mobileNo', '$idNo', '$address', '$householdIncome', '$applicantID', '$organization')";
              
            $docquery = "SELECT * FROM DOCUMENT";
            $stt = $connection->prepare($docquery);
            $stt->execute();
            $stt->store_result();
            $docCount = $stmt -> num_rows;

            $documentID = 'D'.substr(str_repeat(0,4).$docCount+1, -4);
              
            $doc = "INSERT INTO DOCUMENT VALUES ('$documentID', '$file', '$description', '$applicantID')";
			      $result = $connection -> query($sqlQuery);
            $docresult = $connection -> query($doc);                      //execute query (php)
				    if ($result == TRUE && $docresult == TRUE){                   //check status of query
              header("location: betterLogin.php");
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
  <body style="background-image: url('bg2.jpg');
	background-size: cover;
	font-family: 'Montserrat', sans-serif;
	height: 100vh;
	margin: -20px 0 50px;
  background-repeat: no-repeat;">
      <div class="row vh-100 align-items-center justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4 rounded p-5 shadow bg-white" style="background: #FF416C;
	background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
	background: linear-gradient(to right, #FF4B2B, #FF416C);">
          <h1 class="mb-0 text-center font-weight-bold" style="color: white">Create an Account</h1>
          <form id="form" name="staffForm" method="post">
            <div class="mb-4">
                
                <select id="choose" class=" form-control" name ="choose" onchange ="myFunction()" required>
                  <option>--Choose a centre--</option>
                
                  <?php
                    $query = "SELECT * FROM ORGANIZATION";
                    $data = $connection -> query($query);
                    if($data -> num_rows > 0){
                        while($org = $data -> fetch_assoc()){
                            $orgName = $org['orgName'];
                            $orgID = $org['orgID'];
                            echo "<option value='$orgID'>";
                            echo "$orgName"; 
                            echo '</option>';
                            
                        }
                    }
                  ?>
                  <script>
                    function myFunction(){
                    //var orgName = $('#choose');

                    //document.getElementById("orgName").value = orgName;

                    var organization = document.getElementById("choose");
                    var displayText = organization.options[organization.selectedIndex].value;
                    document.getElementById("orgName").value = displayText;
                    }
                   </script>;

                  </select>

            </div>
            <div class="mb-4">
                <input type="hidden" id="orgName" name="orgName">
                <label for="fullName" class="form-label font-weight-bold" style="color: white">Full Name</label>
                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" style="width: 100%;" required>
            </div>
            
            <div class="mb-4">
                <label for="mobileNo" class="form-label font-weight-bold" style="color: white">Mobile No</label>
                <input type="text" id="mobileNo" name="mobileNo" class="form-control" placeholder="0123456789" style="width: 100%;" required>
            </div>

            <div class="mb-4">
              <label for="idNo" class="form-label font-weight-bold" style="color: white">ID Number</label>
              <br>
              <input type="text" id="idNo" name="idNo"  class="form-control" size="50" maxlength="30" placeholder="000000000000" style="width: 100%;" required>
            </div>
            
            <div class="mb-4">
              <label for="email" class="form-label font-weight-bold" style="color: white">Email</label>
              <br>
              <input type="email" id="email" name="email" class="form-control" size="50" maxlength="30" pattern=".+@.+\.com" placeholder="Email@gmail.com" required>
            </div>

            <div class="mb-4">
                <label for="householdIncome" class="form-label font-weight-bold" style="color: white">Household Income</label>
                <br>
                <input type="number" id="householdIncome" name="householdIncome"  class="form-control" size="50" maxlength="30" placeholder="Household Income" style="width: 100%;" required>
            </div>

            <div class="mb-4">
                <label for="address" class="form-label font-weight-bold" style="color: white">Address</label>
                <br>
                <textarea name="address" id="address" rows="2" placeholder="Address" style="width: 100%;"></textarea>
            </div>
      
            <div class="mb-4">
              <label for="file" class="form-label font-weight-bold" style="color: white">File</label>
              <br>
              <input type="file" id="file" name="file" class="form-control-file" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label font-weight-bold" style="color: white">Description</label>
                <br>
                <textarea name="description" id="description" rows="2" placeholder="Description" style="width: 100%;"></textarea>
            </div>
      
            <div class="mb-4 text-center">
              <button type="submit" class="btn btn-primary w-25" id="btnSubmit" onclick="validateStaff()">submit</button>
              <button type="button" class="btn btn-reset w-25" id="btnReset" onclick="reset()">Clear</button>
            </div>

          </form>
          <p class="mb-0 text-center"><a href="betterLogin.php"  style="color: white">Already Have an Account?</a></p>
        </div>
      </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="Javascript"></script>

  </body>
</html>
<?php
session_start();

include ("dbcon.php");

$repEmail = $_SESSION['repEmail'];

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    //something was posted
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $description = $_POST['description'];
    $organization = $_POST['orgName'];
    $flag = 0;
    $same = 0;

    $sqlQuery = "SELECT * FROM APPEAL";

    $status = $connection->query($sqlQuery);
    


    if ($flag == 0){ 
                                                //user doer not exists
            $queryy = "SELECT * FROM APPEAL";
            $stmt = $connection->prepare($queryy);
            $stmt->execute();
            $stmt->store_result();
            $appealCount = $stmt -> num_rows;

            $appealID = 'A'.substr(str_repeat(0,4).$appealCount+1, -4);
            $outcome = 'Active';
              
            $sqlQuery = "INSERT INTO APPEAL VALUES ('$appealID', '$fromDate', '$toDate', '$description', '$outcome', '$organization')";
              
		      	$result = $connection -> query($sqlQuery);                   //execute query (php)
				    if ($result == TRUE){                   //check status of query
                        echo '<script type="text/javascript">'; //appeal already exists
                        echo 'alert("Appeal is created.")';
                        echo '</script>';
                        $_SESSION['repEmail'] = $repEmail;
                         echo '<script type="text/javascript">';
                         echo 'window.location.href="organizeAidAppeal.php"';
                         echo '</script>';      
                die;
			  	}
            
            
        }
}         
?>
<link rel="stylesheet" href="nav.css">
<div class="page">
  <nav class="page__menu menu">
    <ul class="menu__list r-list">
      <li class="menu__group"><a href="orgRegisterApplicant.php" class="menu__link r-link text-underlined">Register Applicant</a></li>
      <li class="menu__group"><a href="organizeAidAppeal.php" class="menu__link r-link text-underlined">Aid Appeals</a></li>
      <li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Record Contribution</a></li>
      <li class="menu__group"><a href="orgRecordDisbursement.php" class="menu__link r-link text-underlined">Record Disbursements</a></li>
      <li class="menu__group" style="margin-left: auto; margin-right: 0;"><a href="betterLogin.php" class="menu__link r-link text-underlined">Log out</a></li>
    </ul>
  </nav>
</div>

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
  <body >
  
       <?php
          $emailquery = "SELECT orgID FROM organizationrep WHERE email = '$repEmail'";
          $emailcon = $connection->query($emailquery);
          $email = $emailcon -> fetch_assoc();
          $emailID = $email['orgID'];

          $orgquery = "SELECT orgName FROM organization WHERE orgID = '$emailID'";
          $orgcon = $connection->query($orgquery);
          $org = $orgcon -> fetch_assoc();
          $orgnam = $org['orgName'];

          $today = date("Y-m-d");
       ?>
      <p1 class="font-weight-bolder row mt-5 align-items-center justify-content-center" id="nameOrganization" id="fullname" name="fullname"><?php echo $orgnam ?></p1>
            
      <div class="row align-items-center justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4 rounded p-5 shadow bg-white" style="background: #FF416C;
	background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
	background: linear-gradient(to right, #FF4B2B, #FF416C);">
          <h1 class="mb-0 text-center font-weight-bold" style="color: white">Create an Appeal</h1>
          <form id="form" name="staffForm" method="post">
            <div class="mb-4">
                <input type="hidden" id="orgName" name="orgName" value="<?php echo $emailID ?>">
                <label for="fromDate" class="form-label font-weight-bold" style="color: white">From Date: </label>
                <input type="date" id="fromDate" name="fromDate" class="form-control" min="<?php echo $today ?>" style="width: 100%;" onchange ="displayDate()" required>
              <Script>
                        function displayDate(){
                            var displaydate = document.getElementById("fromDate").value
                            document.getElementById("toDate").min = displaydate;
                        }
            </Script>
    
            </div>
            
            <div class="mb-4">
                <label for="toDate" class="form-label font-weight-bold" style="color: white">To Date: </label>
                <input type="date" id="toDate" name="toDate" class="form-control" style="width: 100%;" required>
                
            </div>

            <div class="mb-4">
                <label for="description" class="form-label font-weight-bold" style="color: white">Description: </label>
                <br>
                <textarea name="description" id="description" rows="2" placeholder="Description" style="width: 100%;" required></textarea>
            </div>
      
            <div class="mb-4 text-center">
              <button type="submit" class="btn btn-primary w-25" id="btnSubmit" onclick="validateStaff()">submit</button>
              <button type="button" class="btn btn-reset w-25" id="btnReset" onclick="reset()">Clear</button>
            </div>

          </form>
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
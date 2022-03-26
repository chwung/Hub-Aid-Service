<?php
    session_start();

    include ("dbcon.php");
    $repEmail = $_SESSION['repEmail'];

    $emailquery = "SELECT orgID FROM organizationrep WHERE email = '$repEmail'";
    $emailcon = $connection->query($emailquery);
    $email = $emailcon -> fetch_assoc();
    $emailID = $email['orgID'];
    
    
    $orgquery = "SELECT orgName FROM organization WHERE orgID = '$emailID'";
    $orgcon = $connection->query($orgquery);
    $org = $orgcon -> fetch_assoc();
    $orgnam = $org['orgName'];
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Disbursements</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Staff.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="nav.css">
</head>
<nav>
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
</nav>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            
            <br>
            <h3><?php echo $orgnam ?></h3>
            <select id="choose" class="m-2 w-50" name ="choose" onchange ="displaylist()">
                    <option selected disabled>--Select an Appeal--</option>
                    <?php
                                    
                                    

                                    $query = "SELECT * FROM APPEAL WHERE orgID = '$emailID'";
                                    $data = $connection -> query($query);
                                    if($data -> num_rows > 0){
                                      
                                        while($org = $data -> fetch_assoc()){
                                            //$orgName = $org['orgName'];
                                            $orgID = $org['appealID'];
                                            $fromDate = $org['fromDate'];
                                            $toDate = $org['toDate'];
                                            echo "<option value='$fromDate.$toDate'>";
                                            echo "$orgID"; 
                                            echo '</option>';
                                        }
                                    }

                                    

                    ?>
            </select>
            <Script>
                        function displaylist(){

                          var centre = $('#choose').val().split('.')[0];
                          var address = $('#choose').val().split('.')[1];
                          console.log(centre);
                          // document.getElementById("centre").value = centre;
                          // document.getElementById("address").value = address;

                            var organization = document.getElementById("choose");
                            var displayText = organization.options[organization.selectedIndex].value;
                            var displayID = organization.options[organization.selectedIndex].text;
                            document.getElementById("nameOrganization").style.marginLeft = "180px";
                            document.getElementById("nameOrganization").style.textAlign = "center";
                            document.getElementById("nameOrganization").innerHTML = centre;
                            document.getElementById("idOrg").value = displayID;

                            document.getElementById("nameOrganization").style.visibility= "visible";
                            document.getElementById("name").disabled = false;
                            document.getElementById("fullName").disabled = false;
                            document.getElementById("mobileNo").disabled = false;
                            document.getElementById("email").disabled = false;
                            document.getElementById("jobTitle").disabled = false;
                            document.getElementById("confirm").disabled = false;
                            
                        

                        }

            </Script>
            <!--Trigger modal-->
            <p class="h6 ml-2 font-weight-bolder text-primary" style="width:170px" data-toggle="modal" data-target="#addOrganizationModal"><u>Add new organization</u></p>

            <!--Modal-->
            <div class="modal fade" id="addOrganizationModal" tabindex="-1" role="dialog" aria-labelledby="addOrganizationLabel" aria-hidden="true" >
                <div class="modal-dialog modal-dialog-centered" role="document" >
                <div class="modal-content" style="background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);">
                    <div class="modal-header">
                    <h5 class="modal-title text-white" id="addOrganizationLabel">Add New Organization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body" >
                            <div class="mb-4">
                                <label for="organizationName" class="form-label font-weight-bold text-white">Name: </label>
                                <br>
                                <input type="text" class="form-organizationName form-control" name="orgName" size="50" maxlength="30" placeholder="Organization Name" id="orgName" required>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label font-weight-bold text-white">Address: </label>
                                <br>
                                <textarea class="form-address form-control" name="orgAddress" id="orgAddress" size="50" maxlength="200" placeholder="Organization Address" required></textarea>
                            </div>
                        </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                    
                </div>
                </div>
            </div>
            <br>

        </div>
        
        <div class="col-lg-6">
            <p1 class="font-weight-bolder" id="nameOrganization" style="visibility: hidden;">  Organization Name</p1>
            <br>
            <div class="card m-2" style="width: 30rem;" id="orgRepForm">
            <div class="card-body bg-light rounded " style="background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);">
                <h5 class="card-title text-white text-center">Add New Representative</h5>
                <form method="POST">
                    <input type="text" id="idOrg" name="idOrg" size="50" maxlength="20" placeholder="ID" style="visibility: hidden;">
                    <div class="mb-4">
                        <label for="name" class="form-label font-weight-bold text-white">Username: </label>
                        <input type="text" id="name" name="name" class="form-control" size="50" maxlength="20" placeholder="Username" required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="fullname" class="form-label font-weight-bold text-white">Full Name: </label>
                        <input type="text" id="fullName" name="fullName"  class="form-control" size="50" maxlength="30" placeholder="Full Name" required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="mobileNo" class="form-label font-weight-bold text-white">Mobile No: </label>
                        <input type="text" id="mobileNo" name="mobileNo" class="form-control" maxlength="11"  placeholder="012-412-6588/0124126588" required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label font-weight-bold text-white">Email</label>
                        <input type="email" id="email" name="email" class="form-control" size="50" maxlength="40" pattern=".+@.+\.com" placeholder="Email@gmail.com" required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="jobTitle" class="form-label font-weight-bold text-white">Job Title: </label>
                        <input type="text" class="form-control" name="jobTitle" size="50" maxlength="20" placeholder="Job Tittle" id="jobTitle" required disabled>
                    </div>
                    
                    <button type="submit" name="confirm" id="confirm" class="m-2 float-right btn btn-primary" disabled >Confirm</button>
                </form>
                
            </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['confirm'])){

    $username = $_POST['name'];
    $fullName = $_POST['fullName'];
    $mobileNo = $_POST['mobileNo'];
    $email = $_POST['email'];
    $jobTitle = $_POST['jobTitle'];
    $idOrg = $_POST['idOrg'];

    $flag = 0;

    $query = "SELECT * FROM USER";
    $data = $connection->query($query);
    $collection = "SELECT * FROM ORGANIZATIONREP";
    $collect = $connection->query($collection);


    if($data -> num_rows > 0){                        
        while ($row = $data -> fetch_assoc()) {
            if ($email == $row["email"]){
                $flag = 1;
                }
        }
    }
    if ($flag == 1){                                  
        echo '<script type="text/javascript">';
        echo 'alert("Organization Representative already exists.");';
        echo '</script>';
        

    }else{
        $randomNumber = rand(100,999);
        $password = substr($fullName,0,3).$randomNumber;


        
        $sqlQuery = "INSERT INTO `user`(`username`, `password`, `fullname`, `email`, `mobileNo`) VALUES ('$username','$password','$fullName', '$email','$mobileNo')";
        $sql = "INSERT INTO `organizationrep`(`email`, `jobTitle`, `orgID`) VALUES ('$email', '$jobTitle', '$idOrg')";
        $result = $connection -> query($sqlQuery);  //execute query (php)
        $output = $connection -> query($sql);

        echo '<script type="text/javascript">';
        echo 'alert("Organization Representative has been added.\nUsername: '.$username.'\nPassword: '.$password.'");';
        echo '</script>';
        
    }

}
?>
</body>      
                    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--<script src="table.js"></script>-->
</html>
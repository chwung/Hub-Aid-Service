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

    $today = date("Y-m-d");

    $appealID = $_GET['appealID'];
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Select Applicant</title>
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
      <li class="menu__group"><a href="recordContribution.php" class="menu__link r-link text-underlined">Record Contribution</a></li>
      <li class="menu__group"><a href="orgRecordDisbursement.php" class="menu__link r-link text-underlined">Record Disbursements</a></li>
      <li class="menu__group" style="margin-left: auto; margin-right: 0;"><a href="betterLogin.php" class="menu__link r-link text-underlined">Log out</a></li>
    </ul>
  </nav>
</div>
</nav>
<body style="background-image: url('honeycombGrey.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    height: 100%;
    background-repeat: no-repeat;">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <br>
            <h3 style='color: white;'><?php echo $orgnam ?></h3>
            <select id="choose" class="m-2 w-50" name ="choose" onchange ="displaylist()">
                    <option selected disabled>--Select an Applicant--</option>
                    <?php
                        $query = "SELECT * FROM applicant WHERE orgID = '$emailID'";
                        $data = $connection -> query($query);
                        if($data -> num_rows > 0){
                            while($applicant = $data -> fetch_assoc()){
                                //$orgName = $org['orgName'];
                                $appEmail = $applicant['email'];
                                $appAdd = $applicant['address'];
                                $appInc = $applicant['householdIncome'];
                                $appID = $applicant['applicantID'];
                                $IDno = $applicant['idNo'];

                                $find = "SELECT * FROM user WHERE email = '$appEmail'";
                                $findData = $connection -> query($find);
                                $applicant2 = $findData -> fetch_assoc();
                                $fullname = $applicant2['fullname'];
                                echo "<option value='$fullname/$appAdd/$appInc/$IDno'>";
                                echo "$appID"; 
                                echo '</option>';
                            }
                        }
                    ?>
            </select>
            <Script>
                        function displaylist(){

                          var fullname = $('#choose').val().split('/')[0];
                          var appAdd = $('#choose').val().split('/')[1];
                          var income = $('#choose').val().split('/')[2];
                          var id = $('#choose').val().split('/')[3];
                          var appID = $("#choose option:selected").text();
                          // document.getElementById("centre").value = centre;
                          // document.getElementById("address").value = address;

                            // var organization = document.getElementById("choose");
                            // var displayText = organization.options[organization.selectedIndex].value;
                            // var displayID = organization.options[organization.selectedIndex].text;
                            document.getElementById("fullname").innerHTML = fullname;
                            document.getElementById("address").innerHTML = appAdd;
                            document.getElementById("income").innerHTML = income;
                            document.getElementById("appealID").value = appID;
                            document.getElementById("IDno").value = id;

                            document.getElementById("date").disabled = false;
                            document.getElementById("amount").disabled = false;
                            document.getElementById("goods").disabled = false;
                            document.getElementById("confirm").disabled = false;
                        }

            </Script>
            <p class="h6 ml-2 font-weight-bolder text-primary" style="width:170px"><h2 style="display: inline-flex; color: white;">Full Name: </h2> <h2 id='fullname' style="display: inline-flex; color: white;"></h2> </p>
            <p class="h6 ml-2 font-weight-bolder text-primary" style="width:170px"><h2 style="display: inline-flex; color: white;">Address: </h2> <h2 id='address' style="display: inline-flex; color: white;"></h2> </p>
            <p class="h6 ml-2 font-weight-bolder text-primary" style="width:170px"><h2 style="display: inline-flex; color: white;">Household Income: RM</h2> <h2 id='income' style="display: inline-flex; color: white;"></h2></p> 


        </div>
        
        <div class="col-lg-6">
            <div class="card m-2" style="width: 30rem;" id="orgRepForm">
            <div class="card-body bg-light rounded " style="background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);">
                <h5 class="card-title text-white text-center">Create Disbursement</h5>
                <form method="POST">
                    <input type="hidden" id="appealID" name="appealID">
                    <input type="hidden" id="IDno" name="IDno">
                    <div class="mb-4">
                        <label for="date" class="form-label font-weight-bold text-white">Disbursement Date: </label>
                        <input type="date" id="date" name="date" class="form-control" min="<?php echo $today ?>" required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="form-label font-weight-bold text-white">Cash Amount: </label>
                        <input type="number" id="amount" name="amount" class="form-control" size="50" maxlength="40" placeholder="RM0.00" type=number min=0 step=0.01 name=price required disabled>
                    </div>
                    <div class="mb-4">
                        <label for="goods" class="form-label font-weight-bold text-white">Goods: </label>
                        <textarea name="goods" id="goods" cols="56" rows="3" required disabled></textarea>
                        <!-- <input type="text area" class="form-control" name="goods" id="goods" size="50" maxlength="20"  required disabled> -->
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

    $appeal = $_POST['appealID'];
    $date = $_POST['date'];
    $cash = $_POST['amount'];
    $good = $_POST['goods'];
    $id = $_POST['IDno'];

    //update appeal outcome

    $queryy = "SELECT * FROM DISBURSEMENT";
    $stmt = $connection->prepare($queryy);
    $stmt->execute();
    $stmt->store_result();
    $disbursementCount = $stmt -> num_rows;

    $disbursementID = 'D'.substr(str_repeat(0,4).$disbursementCount+1, -4);

    $sqlQuery = "INSERT INTO DISBURSEMENT VALUES ('$date','$cash','$good', '$appealID','$disbursementID', '$id')";
    $result = $connection -> query($sqlQuery);  //execute query (php)

    $inactive = "Inactive";
    //update appeal outcome
    $update = "UPDATE APPEAL set OUTCOME = '$inactive' WHERE appealID = '$appealID'";
    $result = $connection -> query($update);  //execute query (php)

    echo '<script type="text/javascript">';
    echo "alert('Disbursement for Appeal $appealID create');";
    echo '</script>';
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
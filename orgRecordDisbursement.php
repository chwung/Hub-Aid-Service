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
    <link rel="stylesheet" href="tablescroll.css">
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

            <h1 style='color: white;'><?php echo $orgnam ?></h1>
            <!-- disable link if no contributions made -->
            <?php  
              if($_SERVER['REQUEST_METHOD'] == "POST"){
                $thing = $_POST['choose'];
                // echo '<script type="text/javascript">';
                // echo "alert('$emailID')";
                // echo '</script>';

                $query = "SELECT * FROM contribution WHERE appealID = '$thing'";
              $contribution = $connection->query($query);
              if($contribution -> num_rows > 0)
              {
                echo '<a href="orgRecordDisbursementSelectApplicant.php';
                echo "?appealID=$thing";
                echo '">';
                echo "View Applicants";
                echo "</a>";
              }
            }
            ?>
            <form action="orgRecordDisbursement.php" method="POST">
            <select id="choose" class="m-2 w-50" name ="choose" onchange ="this.form.submit();">
                    <option selected disabled>--Select an Appeal--</option>
                    <?php
                      $active = "Active";
                      $query = "SELECT * FROM APPEAL WHERE orgID = '$emailID' AND outcome ='$active'";
                      $data = $connection -> query($query);
                      if($data -> num_rows > 0){
                          while($org = $data -> fetch_assoc()){
                              //$orgName = $org['orgName'];
                              $appealID = $org['appealID'];
                              $fromDate = $org['fromDate'];
                              $toDate = $org['toDate'];
                              // $fromDate.$toDate
                              echo "<option value='$appealID'>";
                              echo "$appealID"; 
                              echo '</option>';
                          }
                      }
                    ?>
            </select>
            </form>
                  <Script>
                    function displaylist(){

                      var centre = $('#choose').val().split('.')[0];
                      var address = $('#choose').val().split('.')[1];

                        document.getElementById("fromDate").innerHTML = centre;
                        document.getElementById("toDate").innerHTML = address;
                        document.getElementById("idOrg").value = displayID;
                    }
                  </Script>

              <div class="col-lg-12">
                <?php
                  if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $thing = $_POST['choose'];
                    $query = "SELECT * FROM APPEAL WHERE appealID = '$thing'";
                    $data = $connection -> query($query);
                      if($data -> num_rows > 0){
                          while($yes = $data -> fetch_assoc()){
                            $from = $yes['fromDate'];
                            $to = $yes['toDate'];

                            echo "<div class='row'>";
                            echo "<h1 style='color: white;'>From Date: </h1> <h1 id='fromDate' style='text-indent: 10px; color: white;'>$from</h1> <br>";
                            echo "</div>";
                            echo "<div class='row'>";
                            echo "<h1 style='color: white;'>To Date: </h1> <h1 id='toDate' style='text-indent: 10px; color: white;'>$to</h1>";
                            echo "</div>";
                          }
                      }
                  }
                ?>
              </div>
          
        </div>
    </div>
</div>
<div class="container">
                        <div class=" row align-items-center justify-content-center">
                            <div class="  col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-dark rounded p-5 shadow">
                                <h4 class=" text-light">Goods</h4>
                                <div class="parent-container">
                                    <div class="container">
                                        <div class="row">
                                            <div class=" col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-light table-container">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Received Date</th>
                                                        <th scope="col">Contribution ID</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Estimated Value</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    <?php
                                                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                                                      $thing = $_POST['choose'];
                                                      // echo '<script type="text/javascript">';
                                                      // echo "alert('$emailID')";
                                                      // echo '</script>';

                                                      $query = "SELECT * FROM contribution WHERE appealID = '$thing'";
                                                    $contribution = $connection->query($query);
                                                    if($contribution -> num_rows > 0)
                                                    {
                                                       $row = 1;
                                                           while($contribution_data = $contribution -> fetch_assoc()){
                                                            $contributionID = $contribution_data['contributionID'];
                                                            $receivedDate = $contribution_data['receivedDate'];
                                                            $good = "SELECT * FROM goods WHERE contributionID = '$contributionID'";
                                                            $goods = $connection->query($good);
                                                            if($goods -> num_rows > 0)
                                                            {
                                                                while($goods_data = $goods -> fetch_assoc()){
                                                                  $conID = $goods_data['contributionID'];
                                                                  $description = $goods_data['description'];
                                                                  $estimatedValue = $goods_data['estimatedValue'];
                                                                  
                                                                  echo '<tr>';
                                                                  
                                                                  echo "<td>";
                                                                  echo "$row";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$receivedDate";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$conID";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$description";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$estimatedValue";
                                                                  echo "</td>";

                                                                  echo '</tr>';
                                                                  $row++;
                                                                }
                                                            }
                                                          }
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                        
                            </div>
                    
                        </div>
                    </div>
                </main>  
            </div>
        </div>
    </div>
    <br>
    <div class="container">
                        <div class=" row align-items-center justify-content-center">
                            <div class="  col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-dark rounded p-5 shadow">
                                <h4 class=" text-light">Cash Donations</h4>
                                <div class="parent-container">
                                    <div class="container">
                                        <div class="row">
                                            <div class=" col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-light table-container">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Received Date</th>
                                                        <th scope="col">Contribution ID</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Payment Channel</th>
                                                        <th scope="col">Reference No</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    <?php
                                                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                                                      $thing = $_POST['choose'];
                                                      // echo '<script type="text/javascript">';
                                                      // echo "alert('$emailID')";
                                                      // echo '</script>';

                                                      $query = "SELECT * FROM contribution WHERE appealID = '$thing'";
                                                    $contribution = $connection->query($query);
                                                    if($contribution -> num_rows > 0)
                                                    {
                                                       $row = 1;
                                                           while($contribution_data = $contribution -> fetch_assoc()){
                                                            $contributionID = $contribution_data['contributionID'];
                                                            $receivedDate = $contribution_data['receivedDate'];
                                                            $cashdonation = "SELECT * FROM cashdonation WHERE contributionID = '$contributionID'";
                                                            $cashdona = $connection->query($cashdonation);
                                                            if($cashdona -> num_rows > 0)
                                                            {
                                                                while($cash_data = $cashdona -> fetch_assoc()){
                                                                  $conID = $cash_data['contributionID'];
                                                                  $amount = $cash_data['amount'];
                                                                  $channel = $cash_data['paymentChannel'];
                                                                  $refer = $cash_data['referenceNo'];
                                                                              
                                                                  echo '<tr>';
                                                                  
                                                                  echo "<td>";
                                                                  echo "$row";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$receivedDate";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$conID";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$amount";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$channel";
                                                                  echo "</td>";

                                                                  echo "<td>";
                                                                  echo "$refer";
                                                                  echo "</td>";

                                                                  echo '</tr>';
                                                                  $row++;
                                                                }
                                                            }
                                                          }
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                        
                            </div>
                    
                        </div>
                    </div>
                </main>  
            </div>
        </div>
    </div>
</body>      
                    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--<script src="table.js"></script>-->
</html>
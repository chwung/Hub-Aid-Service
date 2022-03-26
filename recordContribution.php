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
<link rel="stylesheet" href="nav.css">
<div class="page">
  <nav class="page__menu menu">
    <ul class="menu__list r-list">
      <li class="menu__group"><a href="orgRegisterApplicant.php" class="menu__link r-link text-underlined">Register Applicant</a></li>
      <li class="menu__group"><a href="organizeAidAppeal.php" class="menu__link r-link text-underlined">Aid Appeals</a></li>
      <li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Record Contribution</a></li>
      <li class="menu__group"><a href="#0" class="menu__link r-link text-underlined">Record Disbursements</a></li>
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
    <link rel="stylesheet" href="tableCSS.css">
  </head>
  <body >
  <div class="container mt-5">
                        <div class=" row align-items-center justify-content-center">
                            <div class="  col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-dark rounded p-5 shadow">
                                <h4 class=" text-light"><?php echo $orgnam ?> Appeals</h4>
                                <div class="parent-container">
                                    <div class="container">
                                        <div class="row">
                                            <div class=" col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-light">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">No.</th>
                                                        <th scope="col">Appeal ID</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Organization ID</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    <?php
                                                    $query = "SELECT * FROM appeal WHERE toDate >= CURDATE() AND orgID = '$emailID'";
                                                    $appeal = $connection->query($query);
                                                    if($appeal -> num_rows > 0)
                                                    {
                                                       $row = 1;
                                                           while($appeal_data = $appeal -> fetch_assoc()){
                                                            
                                                            $orgID = $appeal_data['orgID'];
                                                            $org = "SELECT * FROM organization WHERE orgID = '$orgID'";
                                                            $organization = $connection->query($org);
                                                            if($organization -> num_rows > 0)
                                                            {
                                                                $org_data = $organization -> fetch_assoc();
                                                            }
                                                            $appealID = $appeal_data['appealID'];
                                                            $from_date = $appeal_data['fromDate'];
                                                            $to_date = $appeal_data['toDate'];
                                                            $description = $appeal_data['description'];
                                                            $outcome = $appeal_data['outcome'];
                                                            $num_str = sprintf("%03d", $row);
                                                            
                                                            $name = $org_data['orgName'];
                                                            $address = $org_data['orgAddress'];
                                                            
                                                            echo '<tr>';
                                                            
                                                            echo '<td>';
                                                            echo "<a href='contributionGoods.php"; 
                                                            echo "?orgName=$name";
                                                            echo "&orgAddress=$address";
                                                            echo "&appealID=$appealID'";
                                                            echo ' class="mb-0 text-center text-decoration-none text-dark">';
                                                            echo "$row";
                                                            echo '</a>';
                                                            echo "</td>";

                                                            echo "<td>";
                                                            echo "<a href='contributionGoods.php"; 
                                                            echo "?orgName=$name";
                                                            echo "&orgAddress=$address";
                                                            echo "&appealID=$appealID'";
                                                            echo ' class="mb-0 text-center text-decoration-none text-dark">';
                                                            echo "$appealID";
                                                            echo '</a>';
                                                            echo "</td>";

                                                            echo "<td>";
                                                            echo "<a href='contributionGoods.php"; 
                                                            echo "?orgName=$name";
                                                            echo "&orgAddress=$address";
                                                            echo "&appealID=$appealID'";
                                                            echo ' class="mb-0 text-center text-decoration-none text-dark">';
                                                            echo "$description";
                                                            echo '</a>';
                                                            echo "</td>";

                                                            echo "<td>";
                                                            echo "<a href='contributionGoods.php"; 
                                                            echo "?orgName=$name";
                                                            echo "&orgAddress=$address";
                                                            echo "&appealID=$appealID'";
                                                            echo ' class="mb-0 text-center text-decoration-none text-dark">';
                                                            echo "$orgID";
                                                            echo '</a>';
                                                            echo "</td>";

                                                            echo '</tr>';
                                                            $row++;
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
  
       
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="Javascript"></script>

  </body>
</html>
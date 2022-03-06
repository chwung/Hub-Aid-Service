<?php
    session_start();

    include ("dbcon.php");

    if(isset($_POST['submit'])){

        $orgName = $_POST['orgName'];
        $orgAddress = $_POST['orgAddress'];

        $flag = 0;
    
        $query = "SELECT * FROM organization";
        $data = $connection->query($query);

        $queryy = "SELECT * FROM ORGANIZATION";
        $stmt = $connection->prepare($queryy);
        $stmt->execute();
        $stmt->store_result();
        $orgCount = $stmt -> num_rows;

        $orgID = 'B'.substr(str_repeat(0,4).$orgCount+1, -4);

        if($data -> num_rows > 0){                        
            while ($row = $data -> fetch_assoc()) {
                if ($orgName == $row["orgName"]){
                    $flag = 1;
                    }
            }
        }
        if ($flag == 1){                                  
            echo '<script type="text/javascript">';
            echo 'alert("Organization already exists.");';
            echo '</script>';
            

        }else{
            

            $sqlQuery = "INSERT INTO `organization`(`orgID`, `orgName`, `orgAddress`) VALUES ('$orgID', '$orgName', '$orgAddress')";
            $result = $connection -> query($sqlQuery);  //execute query (php)

            echo '<script type="text/javascript">';
            echo 'alert("Organization has been added.");';
            echo '</script>';
            
        }
    
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Manage Organisation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="navbar.css">
</head>
  <body class="bg-light">
      <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-danger" style="background: #FF416C;
    background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
    background: linear-gradient(to right, #FF4B2B, #FF416C);">
  <div class="container-fluid">
  <h2 class="text-center">HUBAID</h1>
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="me-3">
        <div class="form-white input-group" style="width: 250px;">
        </div>
      </form>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link border border-dark border-top-0 border-bottom-0"><i class="fa fa-address-book-o fa-fw "></i><span class="d-inline p-2 font-weight-bolder"><u>Manage Organization</u></span></a>
        </li>
        
      </ul>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: auto; margin-right: 0;">
        <li class="nav-item ">
            <a class="nav-link" href="betterLogin.php"><i class="fa fa-sign-out fa-fw "></i><span class="d-inline p-2 font-weight-bolder">Log Out</span></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            
            <br>
            <select id="choose" class="m-2 w-50" name ="choose" onchange ="displaylist()">
                    <option selected disabled>--Choose a Organization--</option>
                    <?php
                                    $query = "SELECT * FROM ORGANIZATION";
                                    $data = $connection -> query($query);
                                    if($data -> num_rows > 0){
                                        while($org = $data -> fetch_assoc()){
                                            $orgName = $org['orgName'];
                                            $orgID = $org['orgID'];
                                            echo "<option value='$orgName' href='manageOrganization.php?orgID=$orgID'>";
                                            echo "$orgID"; 
                                            echo '</option>';
                
                                        }
                                    }

                                    

                    ?>
            </select>
            <Script>
                        function displaylist(){

                            var organization = document.getElementById("choose");
                            var displayText = organization.options[organization.selectedIndex].value;
                            var displayID = organization.options[organization.selectedIndex].text;
                            document.getElementById("nameOrganization").style.marginLeft = "100px";
                            document.getElementById("nameOrganization").style.textAlign = "center";
                            document.getElementById("nameOrganization").innerHTML = displayText;
                            document.getElementById("idOrg").value = displayID;
                            

                            <?php
                                
                            ?>

                            document.getElementById("nameOrganization").style.visibility= "visible"; 
                            document.getElementById("listRep").style.visibility= "visible"; 
                            

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


            
            <p1 class="font-weight-bolder" id="nameOrganization" style="visibility: hidden;">  Organization Name</p1>
            <br>
            <div class="card m-2" style="width: 20rem; visibility: hidden;" id="listRep">
            <div class="card-body bg-light rounded" style="background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);">
                <h5 class="card-title text-white">Organization Representatives</h5>
                <div class="list-group">
                    <?php
                        $query = "SELECT * FROM organizationrep";
                        $data = $connection -> query($query);
                        if($data -> num_rows > 0){
                            while($rep = $data -> fetch_assoc()){
                                $orgEmail = $rep['email'];
                                echo '<a href="#" class="list-group-item list-group-item-action">';
                                echo "$orgEmail"; 
                                echo '</a>';
                            }
                        }

                      
                    ?>
                </div>
                <button type="submit" name="ok" class="m-2 float-right btn btn-primary" onclick="displayform()" >Add New Rep</button>
            </div>
            </div>
        </div>
        <Script>
            function displayform(){
                document.getElementById("orgRepForm").style.visibility= "visible"; 
             }

         </Script>
        <div class="col-lg-6">
            
            <br>
            <div class="card m-2" style="width: 30rem; visibility: hidden" id="orgRepForm">
            <div class="card-body bg-light rounded " style="background: #FF416C;
            background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background: linear-gradient(to right, #FF4B2B, #FF416C);">
                <h5 class="card-title text-white text-center">Add New Representative</h5>
                <form method="POST">
                    <input type="text" id="idOrg" name="idOrg" size="50" maxlength="20" placeholder="ID" style="visibility: hidden;">
                    <div class="mb-4">
                        <label for="name" class="form-label font-weight-bold text-white">Username: </label>
                        <input type="text" id="name" name="name" class="form-control" size="50" maxlength="20" placeholder="Username" required>
                    </div>
                    <div class="mb-4">
                        <label for="fullname" class="form-label font-weight-bold text-white">Full Name: </label>
                        <input type="text" id="fullName" name="fullName"  class="form-control" size="50" maxlength="30" placeholder="Full Name" required>
                    </div>
                    <div class="mb-4">
                        <label for="mobileNo" class="form-label font-weight-bold text-white">Mobile No: </label>
                        <input type="text" id="mobileNo" name="mobileNo" class="form-control" maxlength="11"  placeholder="012-412-6588/0124126588" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label font-weight-bold text-white">Email</label>
                        <input type="email" id="email" name="email" class="form-control" size="50" maxlength="40" pattern=".+@.+\.com" placeholder="Email@gmail.com" required>
                    </div>
                    <div class="mb-4">
                        <label for="jobTitle" class="form-label font-weight-bold text-white">Job Title: </label>
                        <input type="text" class="form-control" name="job_title" size="50" maxlength="20" placeholder="Job Tittle" id="jobTitle" required>
                    </div>
                    
                    <button type="submit" name="confirm" class="m-2 float-right btn btn-primary" onclick="" >Confirm</button>
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
    $jobTittle = $_POST['jobTittle'];
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
        $sql = "INSERT INTO `organizationrep`(`email`, `jobTitle`, `orgID`) VALUES ('$email', '$jobTittle', '$idOrg')";
        $result = $connection -> query($sqlQuery);  //execute query (php)
        $output = $connection -> query($sql);

        echo '<script type="text/javascript">';
        echo 'alert("Organization Representative has been added.");';
        echo '</script>';
        
    }

}
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
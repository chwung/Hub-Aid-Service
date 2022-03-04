<?php
    session_start();

    include ("dbcon.php");
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
  <body>
      <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-danger bg-danger">
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
          <a class="nav-link" href="#"><i class="fa fa-address-book-o fa-fw"></i>Manage Organization</a>
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
            <select id="choose" class="m-2 w-50" name ="choose" onchange ="">
                            <option >--Choose a Organization--</option>
            </select>

            <!--Trigger modal-->
            <p class="h6 ml-2 font-weight-bolder text-primary" data-toggle="modal" data-target="#addOrganizationModal"><u>Add new organization</u></p>

            <!--Modal-->
            <div class="modal fade" id="addOrganizationModal" tabindex="-1" role="dialog" aria-labelledby="addOrganizationLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addOrganizationLabel">Add New Organization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <form method="">
                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="organizationName" class="form-label font-weight-bold">Name: </label>
                                <br>
                                <input type="text" class="form-organizationName form-control" name="organization_name" size="50" maxlength="30" placeholder="Organization Name" id="Organization Name" required>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label font-weight-bold">Address: </label>
                                <br>
                                <textarea class="form-address form-control" name="address" id="address" size="50" maxlength="200" placeholder="Organization Address" required></textarea>
                            </div>
                        </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary" onclick="" data-dismiss="modal">Confirm</button>
                            </div>
                    </form>
                    
                </div>
                </div>
            </div>
            <br>
            <p1 class="m-5 font-weight-bolder" id="nameOrganization"> &emsp;&emsp;&nbsp; Organisation Name</p1>
            <br>
            <div class="card m-2" style="width: 20rem;">
            <div class="card-body bg-light">
                <h5 class="card-title">Organization Representatives</h5>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">Organization Rep</a>
                    <a href="#" class="list-group-item list-group-item-action">Organization Rep</a>
                    <a href="#" class="list-group-item list-group-item-action">Organization Rep</a>
                </div>
                <button type="submit" name="submit" class="m-2 float-right btn btn-primary" onclick="" >Add New Rep</button>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            
            <br>
            <div class="card m-2" style="width: 30rem;">
            <div class="card-body bg-light">
                <h5 class="card-title">Add New Representative</h5>
                <form>
                    <div class="mb-4">
                        <label for="name" class="form-label font-weight-bold">Username: </label>
                        <input type="text" id="name" name="name" class="form-control" size="50" maxlength="30" placeholder="Username" required>
                    </div>
                    <div class="mb-4">
                        <label for="fullname" class="form-label font-weight-bold">Full Name: </label>
                        <input type="text" id="fullName" name="fullName"  class="form-control" size="50" maxlength="30" placeholder="Full Name" required>
                    </div>
                    <div class="mb-4">
                        <label for="mobileNo" class="form-label font-weight-bold">Mobile No: </label>
                        <input type="text" id="mobileNo" name="mobileNo" class="form-control" maxlength="10"  placeholder="012-412-6588/0124126588" required>
                    </div>
                    <div class="mb-4">
                        <label for="jobTitle" class="form-label font-weight-bold">Job Title: </label>
                        <input type="text" class="form-control" name="job_title" size="50" maxlength="30" placeholder="Job Tittle" id="jobTitle" required>
                    </div>
                    
                    <button type="submit" name="submit" class="m-2 float-right btn btn-primary" onclick="" >Confirm</button>
                </form>
                
            </div>
            </div>
        </div>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
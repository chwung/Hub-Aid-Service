<?php
    session_start();

    include ("dbcon.php");
?>

<head>
  <title>Login/Sign Up Form</title>
  <link rel="stylesheet" href="betterLogin.css">
</head>
<body>
  <div class="container" id="container" style="opacity: 91%">
    <!-- sign in page -->
    <div class="form-container sign-in-container">
      <form method="POST" action="betterLogin.php" class="form" id="login">
        <h1 class="form__title">Login</h1>
        <div class="form__input-group">
          <label for="username">Username: </label>
          <input type="text" class="form__input" name="username" id="username" maxlength="20" required> 
        </div>
        <div class="form__input-group">
          <label for="pass">Password: </label>
          <input type="password" class="form__input" name="password" id="password" maxlength="20" required> 
        </div>
        <div class="form__input-group">
          <button type="submit" class="form__button">Submit</button>
        </div>
        <a href="betterRegister.php" style="margin-top: 20px">Register as an Applicant Here</a>
     </form>
     
    </div>
    
   <div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Hello, Rich People!</h1>
				<p>If you have a lot of money you can donate to some to these struggling people</p>
				<button class="ghost" id="signUp" onclick="location.href='appeals.php'">View Appeals</button>
			</div>
		</div>
	</div>
 </div>
  
</body>
<?php
      if($_SERVER['REQUEST_METHOD'] == "POST")
      {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $applicantFlag = 0;
        $orgFlag = 0;
        $adminFlag = 0;
  
        
        $sqlApplicant = "SELECT * FROM APPLICANT WHERE username = '$username' AND password = '$password'";
        $applicant = $connection->query($sqlApplicant);
        
        $sqlOrgRep = "SELECT * FROM ORGANIZATIONREP WHERE username = '$username' AND password = '$password'";
        $rep = $connection->query($sqlOrgRep);
        
        $sqlAdmin = "SELECT * FROM ADMIN WHERE username = '$username' AND password = '$password'";
        $admin = $connection->query($sqlOrgRep);

        if($applicant -> num_rows > 0){
            $applicantFlag = 1;
        }else if($rep -> num_rows > 0) {
            $orgFlag = 1;
        }else if($admin > 0){
            $adminFlag = 1;
        }
        
        if($applicantFlag == 0 && $orgFlag == 0 && $adminFlag == 0){
            echo '<script type="text/javascript">';
            echo 'alert("Username or Password wrong.");';
            echo '</script>';
        } else if($applicantFlag == 1) {
            $_SESSION['applicantUsername'] = $username;
            $_SESSION['applicantPassword'] = $password;
            header("location: appeals.php");
        } else if($orgFlag == 1){
            $_SESSION['repUsername'] = $username;
            $_SESSION['repPassword'] = $password;
            header("location: orgRegisterApplicant.php");
        } else if($adminFlag == 1){
          header("location: manageOrganization.php");
      }
        
    }
    ?>
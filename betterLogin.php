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
        <h1 class="form__title">Login Here!</h1>
        <div class="form__input-group">
          <label for="username">Username: </label>
          <input type="text" class="form__input" name="username" id="username" maxlength="20" required> 
        </div>
        <div class="form__input-group">
          <label for="pass">Password: </label>
          <input type="password" class="form__input" name="password" id="password" maxlength="20" required> 
        </div>
        <div class="form__input-group">
          <button type="submit" class="form__button">Login</button>
        </div>
        <a href="betterRegister.php" style="margin-top: 20px">Register as an Applicant Here</a>
     </form>
     
    </div>
    
   <div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Welcome to Hub Aid Service!</h1>
				<p>Any donations made will be sent towards helping the needy. <br> Click the button below to start donating today!</p>
				<button class="ghost" id="signUp" onclick="location.href='currentAppeals.php'">View Appeals</button>
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
        $userFlag = 0;
        $applicantFlag = 0;
        $orgFlag = 0;
        $adminFlag = 0;
  
        
        $sqlUser = "SELECT email FROM USER WHERE username = '$username' AND password = '$password'";
        $user = $connection->query($sqlUser);
        $email = $user -> fetch_assoc();
        $emailvalue = $email['email'];
        
        //$sqlOrgRep = "SELECT * FROM ORGANIZATIONREP WHERE username = '$username' AND password = '$password'";
        //$rep = $connection->query($sqlOrgRep);
        
        $sqlAdmin = "SELECT * FROM ADMIN WHERE username = '$username' AND password = '$password'";
        $admin = $connection->query($sqlAdmin);

        if($user -> num_rows > 0){
            $userFlag = 1;

            $sqlapplicant = "SELECT * FROM APPLICANT WHERE email = '$emailvalue'";
            $applicant = $connection->query($sqlapplicant);
            if($applicant -> num_rows > 0){
              $applicantFlag = 1;
              echo 'wrong';
            } 
            
            $sqlorgrep = "SELECT * FROM ORGANIZATIONREP WHERE email = '$emailvalue'";
            $orgrep = $connection->query($sqlorgrep);
            if($orgrep -> num_rows > 0){
              $orgFlag = 1;
              echo 'success';
            }
        //}else if($rep -> num_rows > 0) {
        //    $orgFlag = 1;
        }else if($admin -> num_rows > 0){
            $adminFlag = 1;
        }
        
        if($userFlag == 0 && $adminFlag == 0){
            echo '<script type="text/javascript">';
            echo 'alert("Username or Password wrong.");';
            echo '</script>';
        } else if($applicantFlag == 1) {
            $_SESSION['applicantUsername'] = $username;
            $_SESSION['applicantPassword'] = $password;
            header("location: appeals.php");
        } else if($orgFlag == 1){
            $_SESSION['repEmail'] = $emailvalue;
            //$_SESSION['repPassword'] = $password;
            header("location: orgRegisterApplicant.php");
        } 
        else if($adminFlag == 1){
          header("location: manageOrganization.php");
      }
        
    }
    ?>
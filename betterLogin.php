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
     </form>
    </div>
    
   <div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Hello, Rich People!</h1>
				<p>If you have a lot of money you can donate to some to these struggling people</p>
				<button class="ghost" id="signUp">View Appeals</button>
			</div>
		</div>
	</div>
 </div>
  
  <script src="scripts/main.js"></script>
  
</body>
<?php
      if($_SERVER['REQUEST_METHOD'] == "POST")
      {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $patientFlag = 0;
        $staffFlag = 0;
  
        
        $sqlPatient = "SELECT * FROM PATIENTS WHERE username = '$username' AND password = '$password'";
        $patient = $connection->query($sqlPatient);
        
        $sqlStaff = "SELECT * FROM STAFFS WHERE username = '$username' AND password = '$password'";
        $staff = $connection->query($sqlStaff);
        
        if($patient -> num_rows > 0){
            $patientFlag = 1;
        }else if($staff -> num_rows > 0) {
            $staffFlag = 1;
        }
        
        if($staffFlag == 0 && $patientFlag == 0){
            echo '<script type="text/javascript">';
            echo 'alert("Username or Password wrong.");';
            echo '</script>';
        } else if($patientFlag == 1) {
            $_SESSION['patientUsername'] = $username;
            $_SESSION['patientPassword'] = $password;
            header("location: PatientProfile.php");
        } else if($staffFlag == 1){
            $_SESSION['staffUsername'] = $username;
            $_SESSION['staffPassword'] = $password;
            header("location: staffprofile.php");
        }
    }
    ?>
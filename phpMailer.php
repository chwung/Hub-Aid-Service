<?php
session_start();
include("dbcon.php");

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
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
    echo '<script type="text/javascript">';
    echo 'window.location.href="manageOrganization.php"';
    echo '</script>'; 

}else{
    $randomNumber = rand(100,999);
    $password = substr($fullName,0,3).$randomNumber;


    
    $sqlQuery = "INSERT INTO `user`(`username`, `password`, `fullname`, `email`, `mobileNo`) VALUES ('$username','$password','$fullName', '$email','$mobileNo')";
    $sql = "INSERT INTO `organizationrep`(`email`, `jobTitle`, `orgID`) VALUES ('$email', '$jobTitle', '$idOrg')";
    $result = $connection -> query($sqlQuery);  //execute query (php)
    $output = $connection -> query($sql);  

    
        //Server settings     
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vincentkaw2001@gmail.com';                     //SMTP username
        $mail->Password   = 'rA68QCStEgc9NdJw';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('vincentkaw2001@gmail.com', 'Admin');
        $mail->addAddress($email);     //Add a recipient
    
        $body = "Username: $username \n & Password: $password";
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Username & Password";
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);
    
       
        if(!$mail->send()){
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    
        }else{

            echo "<script>
                window.location.href = 'manageOrganization.php';
                alert('Organization Representative has been added, check the $email email to see the username and password');
            </script>";
        }
    
}


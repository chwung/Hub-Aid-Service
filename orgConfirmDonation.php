<?php
session_start();
include("dbcon.php");

$amount = $_POST['amount'];
$channel = $_POST['channel'];

$orgName = $_SESSION['sesOrgName'];
$orgAddress = $_SESSION["sesOrgAdd"];
$appealID = $_SESSION["sesAppealID"];
$reference = uniqid();
$date = date('Y-m-d');

$queryy = "SELECT * FROM CONTRIBUTION";
$stmt = $connection->prepare($queryy);
$stmt->execute();
$stmt->store_result();
$applicantCount = $stmt -> num_rows;

$contributionID = 'C'.substr(str_repeat(0,4).$applicantCount+1, -4);

$query_data = "INSERT INTO CONTRIBUTION VALUES ('$appealID','$date','$contributionID')";
$connection->query($query_data);

$query_data = "INSERT INTO CASHDONATION VALUES('$contributionID','$amount','$channel','$reference')";
$connection->query($query_data);


echo '<script type="text/javascript">';
echo "alert('Donation of RM$amount successfully made');";
echo "window.location.href = 'recordContribution.php?orgName=$orgName&orgAddress=$orgAddress&appealID=$appealID';";
echo '</script>';
?>
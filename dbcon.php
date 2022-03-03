<?php
$connection = new mysqli ("localhost", "root", "", "hubaid");

if ($connection -> connect_error){
    die($connection -> connect_error);
}else{
    #echo '<script type="text/javascript">';
    #echo 'alert("Connection success.")';
    #echo '</script>';
}
?>
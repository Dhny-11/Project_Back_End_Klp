<?php
require "Konek.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$qry = mysqli_query($con, "SELECT * FROM username WHERE Username = '$username' AND Password = '$password'");
$data = mysqli_fetch_array($qry);

if($data){
    $_SESSION['Username'] = $data['username'];
    $_SESSION['Username'] = $data['nama'];
    echo "<script>alert('Login successful, welcome ".$username ."'); window.location='home.php';</script>";
}else {
    echo "<script>alert('Login failed'); window.location='login.php';</script>";
}
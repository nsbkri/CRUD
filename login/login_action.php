<?php
session_start();

include "../connection/connect.php";

//menerima data
$username = $_POST["username"];
$pass     = md5($_POST["password"]);

$sql    = "SELECT  * from table_user where username='$username' and password='$pass'";
$hasil  = mysqli_query ($connect,$sql);
$jumlah = mysqli_num_rows($hasil);


	if ($jumlah>0) {
		$row = mysqli_fetch_assoc($hasil);
		$_SESSION["id_user"]=$row["id_user"];
		$_SESSION["username"]=$row["username"];
		$_SESSION["name"]=$row["name"];
		$_SESSION["email"]=$row["email"];
		$_SESSION["photo"]=$row["photo"];
	

		header("Location:../index.php");
		
	}else {
		echo "Username atau password salah <br><a href='login.php'>Kembali</a>";
	}
?>
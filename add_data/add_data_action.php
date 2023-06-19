<?php
session_start();

include "../connection/connect.php";

date_default_timezone_set('Indonesia/Makassar');
$date = date('YmdHis');

//menerima data
$username = $_POST["username"];
$name     = $_POST["name"];
$email    = $_POST["email"];
$pass     = md5($_POST["password"]);

if($_POST['submit']){

    $ekstensi_diperbolehkan	= array('png','jpg');
    $photo_name             = $_FILES['photo']['name']; //nama foto
    $x                      = explode('.',$photo_name);  //mengambil ekstensi dari file name
    $ekstensi               = strtolower(end($x)); //membuat ekstensi menjadi huruf kecil
    $ukuran	                = $_FILES['photo']['size']; //ukuran photo
    $file_tmp               = $_FILES['photo']['tmp_name'];	//isi photo yang diupload
    $photo_name_modified    = $date . "_" . $photo_name;

    /*
    echo $photo_name."<br>";
    var_dump ($x);
    echo $ekstensi."<br>";
    echo $ukuran."<br>";
    echo $file_tmp."<br>";*/

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1024000){			
            move_uploaded_file($file_tmp, '../assets/images/'.$photo_name_modified);
            $sql    = "INSERT INTO table_user (username,name,email,password,photo) VALUE ('$username','$name','$email','$pass','$photo_name_modified')";
            $query  = mysqli_query ($connect,$sql);

            if($query){
                header("Location:../index.php?message=success"); //sukses
            }else{
                header("Location:../index.php?message=failed_image"); //gagal upload gambar
            }
        }
        
        else{
           header("Location:../index.php?message=big_size"); //ukuran gambar terlalu besar
        }
    }
    
    else{
        header("Location:../index.php?message=failed_extension"); //ekstensi tidak sesuai/tidak diizinkan
        
    }
}
?>
	

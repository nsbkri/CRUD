<?php
    session_start();

    include "../connection/connect.php";

    date_default_timezone_set('Indonesia/Makassar');
    $date = date('YmdHis');
    if (isset($_POST['id_user'])) {
        $id_user= $_POST['id_user'];
        $query = mysqli_query($connect, "SELECT * FROM table_user WHERE id_user='$id_user'");
        $data = mysqli_fetch_array($query); 
    } 

    // Menghapus gambar lama
    $oldPhoto = $data['photo'];
        if (!empty($oldPhoto)) {
            unlink("../assets/images/" . $oldPhoto);
        }
    //menerima data
    $id_user  = $_POST["id_user"];
    $username = $_POST["username"];
    $name     = $_POST["name"];
    $email    = $_POST["email"];
    $pass     = md5($_POST["password"]);

    if (isset($_POST['id_user'])) {
        $id_user= $_POST['id_user'];
        $query = mysqli_query($connect, "SELECT * FROM table_user WHERE id_user='$id_user'");
        $data = mysqli_fetch_array($query); 
    } 

    // Menghapus gambar lama
    $oldPhoto = $data['photo'];
        if (!empty($oldPhoto)) {
            unlink("../assets/images/" . $oldPhoto);
        }


    if($_POST['submit']){
 
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
        $photo_name             = $_FILES['photo']['name']; //nama foto
        $x                      = explode('.',$photo_name);  //mengambil ekstensi dari file name
        $ekstensi               = strtolower(end($x)); //membuat ekstensi menjadi huruf kecil
        $ukuran	                = $_FILES['photo']['size']; //ukuran photo
        $file_tmp               = $_FILES['photo']['tmp_name'];	//isi photo yang diupload
        $photo_name_modified    = $date . "_" . $photo_name;
        
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 1024000){			
                move_uploaded_file($file_tmp, '../assets/images/'.$photo_name_modified);
                $sql    = "UPDATE table_user 
                        SET photo='$photo_name_modified', username='$username', name='$name', email='$email', password='$pass' 
                        WHERE id_user='$id_user'";
                $query  = mysqli_query ($connect,$sql);

                if($query) {
                    header("Location:../index.php?message=success_edit"); //sukses
                }
                else{
                    header("Location:../index.php?message=failed_image"); //gagal upload gambar
                }
            }
            else {
                header("Location:../index.php?message=big_size"); //ukuran gambar terlalu besar
            }
        }
        else{
            header("Location:../index.php?message=failed_extension"); //ekstensi tidak sesuai/tidak diizinkan  
        }
    }
?>
	

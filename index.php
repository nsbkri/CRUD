<?php
  //koneksi ke database
  include "connection/connect.php";

  //start session
  session_start();

  if (isset($_GET['id_user'])) {
    
    $id_user= $_GET['id_user'];
    
    //ambil data 
    $get_data = mysqli_fetch_array(mysqli_query($connect, "SELECT photo FROM table_user WHERE id_user='$id_user'"));
 
    //delete data pada database
    $query = mysqli_query($connect, "DELETE FROM table_user WHERE id_user='$id_user'");
 
    if($query) {
      unlink("assets/images/".$get_data['photo']); // delete file
      header("Location:index.php?message=delete");
    }
    else {
    header("Location:index.php?message=failed");
    }
  }
?>

<!DOCTYPE html>
  <html>
  
  <head>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
  </head>

  <body>
    <?php
      if (!isset($_SESSION["name"])) {
        echo "<div class='jumbotron text-center'>
              <h1>Anda tidak bisa mengakses halaman ini. Anda harus login terlebih dahulu </h1>
              <a href='login/login.php' class='btn btn-warning' role='button'>Klik disini</a>
              </div>";
	      exit;
      }
    ?>

    <div class="jumbotron text-center">
      <a href="login/logout.php" class="btn btn-warning" role="button">Logout</a><br>
      <img style='margin-top:10px; border:1px solid black;' src='assets/images/<?php echo $_SESSION['photo']?>' 
           height='100px' width='100px'></img>
      <h1>Selamat Datang <b> <?php echo $_SESSION['name']; ?></b></h1>
    </div>

    <?php
      if(isset($_GET['message'])) {  
        if($_GET['message']== "success") {
          echo "<div style='margin-left: 100px; margin-right:10px;' class='alert alert-success' role='alert'>
                  Berhasil Menambahkan Data
                </div>";
        }
        else if ($_GET['message']== "success_edit") {
          echo "<div style='margin-left: 100px; margin-right:10px;' class='alert alert-success' role='alert'>
                  Berhasil Mengubah Data
                </div>";
        }
        else if ($_GET['message']== "failed_image"){
          echo "<div style='margin-left: 100px; margin-right:10px;' class='alert alert-danger' role='alert'>
                  Gagal mengupload foto. Periksa koneksi anda 
                </div>";
        }
        else if ($_GET['message']== "big_size") {
          echo "<div style='margin-left: 100px; margin-right:10px;' class='alert alert-danger' role='alert'>
                  Gagal mengupload foto. Gambar terlalu besar max 1 MB.
                </div>";
        }
        else if ($_GET['message']== "failed_extension") {
          echo "<div style='margin-left: 100px; margin-right:10px;' class='alert alert-danger' role='alert'>
                  Gagal mengupload foto. Ekstensi gambar tidak sesuai. Pastikan menggunakan ekstensi PNG/JPG.
                </div>";
        }
        else {
          echo "<div style='margin-left: 100px; margin-right:10px;' class='alert alert-danger' role='alert'>
                  Berhasil Menghapus Data
                </div>";
        }
      }
    ?>

    <div style="margin-left: 100px; margin-top:10px; margin-right:10px;" >
      <a style="margin-bottom:10px;" href="add_data/add_data.php" class="btn btn-success" role="button" >Tambah Data</a>
 
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Photo</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            $query = mysqli_query($connect, "SELECT * FROM table_user");
            $no=1;
            while($data = mysqli_fetch_array($query)) {
          ?>
          <tr>
            <td scope="row"><?php echo $no++; ?></td>
            <td>
              <?php
                if(empty($data['photo'])) {
                  echo "<img src='assets/images/no_image.jpg' height='100px' width='100px'></img>";
                }
                else {
                  echo "<img src='assets/images/".$data['photo']."' height='100px' width='100px'></img>";
                }
              ?>
            </td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['password']; ?></td>
            <td><a href="edit_data/edit_data.php?id_user=<?php echo $data['id_user'];?>" class="btn btn-primary" 
                   role="button">Edit</a> | 
                <a href="index.php?id_user=<?php echo $data['id_user'];?>" class="btn btn-danger" role="button" 
                   Onclick=" return confirm('Apakah anda yakin ingin menghapus data ini ?');">Hapus</a>
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html> 
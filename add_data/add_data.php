<?php
include "../connection/connect.php";
//start session
session_start();
$name = $_SESSION["name"];

?>
<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="jumbotron text-center">
  <a href="login/logout.php" class="btn btn-warning" role="button">Logout</a>
  <h1>Selamat Datang <b> <?php echo $name ?></b></h1>

</div>
    <div class="container">
        <h2>Tambah Data </h2><br>
        <form method="post" action="add_data_action.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Masukan Username" required>
        </div>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Masukan Name" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" name="email" placeholder="Masukan Email" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
        </div>
        <div class="form-group">
        <label>Photo:</label><br>
            <img src='../assets/images/no_photo.png' height='150px' width='150px'></img>
            <input type="file" name="photo" required >
        </div>
        
        <div class="form-group">
            <input type="submit"  class="btn btn-primary"  name="submit" value="Send Data" Onclick=" return confirm('Apakah anda yakin data ini sudah benar ?');">
            <input type="button"  class="btn btn-danger" onclick="window.location.href = '../index.php'" value="Cancel">
        </div>
        </form>
    </div>
</body>
</html>
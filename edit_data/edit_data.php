<?php
    include "../connection/connect.php";

    //start session
    session_start();

    $name = $_SESSION["name"];

    //Ambil data yang diedit
    if (isset($_GET['id_user'])) {
        $id_user= $_GET['id_user'];
        $query = mysqli_query($connect, "SELECT * FROM table_user WHERE id_user='$id_user'");
        $data = mysqli_fetch_array($query); 
    } 
?>

<!DOCTYPE html>
    <html>
        <head>
            <!-- Load file CSS Bootstrap -->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        </head>

        <body>
            <?php
                if (!isset($_SESSION["username"])) {
                    echo "<div class='jumbotron text-center'>
                            <h1>Anda tidak bisa mengakses halaman ini. Anda harus login terlebih dahulu </h1>
                            <a href='../login/login.php' class='btn btn-warning' role='button'>Klik disini</a>
                        </div>";
                exit;
                }
            ?>

            <div class="jumbotron text-center">
                <a href="../login/logout.php" class="btn btn-warning" role="button">Logout</a>
                <h1>Selamat Datang <b> <?php echo $_SESSION['name']; ?></b></h1>
            </div>

            <div class="container">
                <h2>Edit Data </h2><br>

                <form method="post" action="edit_data_action.php" enctype="multipart/form-data">
                    <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">

                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $data['password']; ?>" required>
                    </div>

                    <div class="form-group">
                    <label>Photo:</label><br>
                        <img src='../assets/images/<?php echo $data['photo']; ?>' height='150px' width='150px'></img>
                        <input type="file" name="photo">
                    </div>
                
                    <div class="form-group">
                        <input type="submit"  class="btn btn-primary"  name="submit" value="Confirm" 
                               Onclick=" return confirm('Apakah anda yakin data ini sudah benar ?');">
                        <input type="button"  class="btn btn-danger" onclick="window.location.href = '../index.php'" 
                               value="Cancel">
                    </div>
                </form>
            </div>
        </body>
    </html>
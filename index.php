<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Address Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <?php require_once 'db.php'; ?>

    <?php
        if(isset($_SESSION['message'])):
    ?>
    
    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);

    ?>

    </div>

    <?php endif ?>
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'address_book_pweb')
            or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM address_book")
            or die($mysqli->error);

        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

    ?>


    <div class="container">
        <div class="jumbotron">
            <h1>Address Book</h1>
        </div>
    </div>
    <form action="db.php" method="POST">
        <input type="hidden" name="NRP" value="<?php echo $nrp ?>">
        <div class="form-group">
            <label for="NRP">NRP :</label>
            <input type="text" class="form-contorl" 
                value="<?php echo $nrp; ?>" name="NRP" required>
        </div>
        <div class="form-group">
            <label for="Nama">Nama :</label>
            <input type="text" class="form-contorl" 
                value="<?php echo $nama; ?>" name="Nama" required>
        </div>
        <div class="form-group">
            <label for="NoTelpon">No Telpon :</label>
            <input type="text" class="form-contorl"
                value="<?php echo $notelpon; ?>" name="NoTelpon" required>
        </div>
        <div class="form-group">
            <label for="Alamat">Alamat :</label>
            <input type="text" class="form-contorl"
                value="<?php echo $alamat; ?>" name="Alamat" required>
        </div>
        <?php
            if($update == true):
        ?>
        <button type="submit" class="btn btn-default" name="update">Update</button>
        <?php
            else:
        ?>
        <button type="submit" class="btn btn-default" name="tambah">Tambah</button>
        <?php
            endif;
        ?>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NRP</th>
                <th>Nama</th>
                <th>No Telpon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <?php
            while($row = $result->fetch_assoc()):
        ?>
        <tbody>
            <tr>
                <td><?php echo $row['NRP']; ?></td>
                <td><?php echo $row['Nama']; ?></td>
                <td><?php echo $row['NoTelpon']; ?></td>
                <td><?php echo $row['Alamat']; ?></td>
                <td>
                    <a href="index.php?ubah=<?php echo $row['NRP']; ?>"
                        class="btn btn-info">ubah</a>
                    <a href="db.php?hapus=<?php echo $row['NRP']; ?>"
                        class="btn btn-danger">hapus</a>
                </td>
            </tr>
        </tbody>
            <?php endwhile; ?>
    </table>
    
</body>
</html>
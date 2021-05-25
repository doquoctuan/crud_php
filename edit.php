<!DOCTYPE html>
<?php
    require 'config.php';
    $pdo = Database::connect();
      
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $MonHocErr = null;
        $GiangVienErr = null;
         
        // keep track post values
        $MonHoc = $_POST['MonHoc'];
        $GiangVien = $_POST['GiangVien'];
         
        // validate input
        $valid = true;
        if (empty($MonHoc)) {
            $MonHocErr = 'Please enter MonHoc';
            $valid = false;
        }
         
        if (empty($GiangVien)) {
            $GiangVienErr = 'Please enter GiangVien';
            $valid = false;
        }

         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE MonHoc set MonHoc = ?, GiangVien = ? WHERE id = ?";
            $query = $pdo->prepare($sql);
            $query->execute(array($MonHoc,$GiangVien,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM MonHoc where id = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $MonHoc = $data['MonHoc'];
        $GiangVien = $data['GiangVien'];
        Database::disconnect();
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a MonHoc</h3>
                    </div>
             
                    <form class="form-horizontal" action="edit.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($MonHocErr)?'error':'';?>">
                        <label class="control-label">MonHoc</label>
                        <div class="controls">
                            <input name="MonHoc" type="text"  placeholder="MonHoc" value="<?php echo !empty($MonHoc)?$MonHoc:'';?>">
                            <?php if (!empty($MonHocErr)): ?>
                                <span class="help-inline"><?php echo $MonHocErr;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($GiangVienErr)?'error':'';?>">
                        <label class="control-label">GiangVien</label>
                        <div class="controls">
                            <input name="GiangVien" type="text" placeholder="GiangVien" value="<?php echo !empty($GiangVien)?$GiangVien:'';?>">
                            <?php if (!empty($GiangVienErr)): ?>
                                <span class="help-inline"><?php echo $GiangVienErr;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
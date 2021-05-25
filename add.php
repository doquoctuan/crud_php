<!DOCTYPE html>
<?php

    require 'config.php';
    $pdo = Database::connect();
    
    if ( !empty($_POST)) {
        // keep track validation errors
        $MonHocErr = null;
        $GiangVienErr = null;
        $valid = true;

        // keep track post values
        $MonHoc = $_POST['MonHoc'];
        $GiangVien = $_POST['GiangVien'];

        // Validate address
    if(empty($MonHoc)){
        $MonHocErr = "Please enter an MonHoc.";   
        $valid = false;  
    } 

    if(empty($GiangVien)){
        $GiangVienErr = "Please enter an GiangVien.";   
        $valid = false;  
    } 


        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO monhoc (MonHoc, GiangVien) values(?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute(array($MonHoc, $GiangVien));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Tao moi mon hoc</h3>
                    </div>
             
                    <form class="form-horizontal" action="add.php" method="post">
                      <div class="control-group <?php echo !empty($MonHocErr)?'error':'';?>">
                        <label class="control-label">MonHoc</label>
                        <div class="controls">
                            <input name="MonHoc" type="text"  placeholder="MonHoc" value="<?php echo !empty($MonHoc)?$MonHoc:'';?>">
                            <?php if (!empty($MonHocErr)): ?>
                                <span class="help-inline"><?php echo  $MonHocErr;?></span>
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
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn btn-default" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
    </div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link  href="css/bootstrap.min.css" rel="stylesheet">
    <link  href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Crud Php Pdo</h3>
            </div>
            <?php
                require 'config.php';
                $pdo = Database::connect();
            ?>
            <div class="row">
                <p>
                    <a href="add.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Ten Mon</th>
                          <th>Giang Vien</th>
                          <th>Thao tac</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       $sql = 'SELECT * FROM monhoc';
                       $message = 'Bạn có muốn xóa ?';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row[1] . '</td>';
                                echo '<td>'. $row[2] . '</td>';
                                echo '<td width=250>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="edit.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'&del=delete">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
            </div>
            
    </div>
  </body>
</html>
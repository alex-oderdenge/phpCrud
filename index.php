<!DOCTYPE html>
   <html lang="en">
   <head>
      <!--bootstrap-->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>PHP Crud Test</title>
   </head>
   <body>
      <?php require_once 'process.php'; ?>
      <?php if (isset($_SESSION['message'])): ?>
      <div   class="alert alert-<?=$_SESSION['msg_type']?>">
         <?php
            
            echo $_SESSION['message'];
            unset($_SESSION['message']);
         ?>
      </div>
      <?php endif ?>
      <div class="container">
         <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die (mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM DATA") or die ($mysqli->error);
            //pre_r($result);
         ?>

         <div class="row justify-content-center">
            <table class="table">
               <thead>
                  <tr>
                     <th>Name</th>
                     <th>Location</th>
                     <th colspan="2">Action</th>
                  </tr>
               </thead>

               <?php while ($row = $result->fetch_assoc()): ?>

               <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['location']; ?></td>
                  <td>
                     <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                     <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Remove</a>
                  </td>
               </tr>
               <?php endwhile; ?>
            </table>
         </div>

         <?php
            //pre_r($result->fetch_assoc());
            function pre_r($array) {
               echo '<pre>';
               print_r($array);
               echo '</pre>';

            }
         ?>
         <div class="row justify-content-center">
            <form action="process.php" method="post">
               <input type="hidden" name="id" value="<?php echo $id;?>">
               <?php for ($i = 0; $i <= count($columns)-1; $i++): ?>
               <div class="form-group">
                  <label><?php echo $columns[$i];?></label>
                  <input type="text" name="<?php echo $columns[$i];?>" class="form-control" value="<?php echo $name ?>" placeholder="Enter your <?php echo $columns[$i];?>">
               </div>
               <?php endfor ?>
               <div class="form-group">
                  <?php if ($update == true): ?>
                     <button type="submit" class="btn btn-info" name="update">Update</button>
                  <?php else: ?>
                     <button type="submit" class="btn btn-primary" name="save">Save</button>
                  <?php endif ?>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>
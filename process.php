<?php
//Youtube video used to make this repo: https://www.youtube.com/watch?v=3xRMUDC74Cw

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die (mysqli_error($mysqli));
$id = 0;
$update = false;
$name = '';
$location = '';
$columns = array("name", "location");
$values = "";

if (isset($_POST['save'])) {
   $name = $_POST['name'];
   $location = $_POST['location'];
   
   for ($i = 0; $i < count($columns); $i++) {
      $values = $values . "$" . $columns[$i];
      if ($i < count($columns) -1) {
         $values = $values .", ";
      }
   }
   echo 'INSERT INTO data ('.implode(",", $columns).') VALUES ("'.$values.'")';


   //$mysqli->query("INSERT INTO data (implode(",", $columns)) VALUES ('$name', '$location')") or die(mysqli_error($mysqli));
   
  
   $_SESSION['message'] = "Record has been saved!";
   $_SESSION['msg_type'] = "success";

   //header("location: index.php");
}

// FIXME
if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM data WHERE id=$id") or die (mysqli_error($mysqli));
   //This line below isn't been read inside this if condition
   $_SESSION['message'] = "Record has been deleted!";
   $_SESSION['msg_type'] = "danger";
   header("location: index.php");
}

if (isset($_GET['edit'])){
   $id = $_GET['edit'];
   $update = true;
   $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die (mysqli_error($mysqli));
   if (count(array($result)) == 1) {
      $row = $result->fetch_array();
      $name = $row['name'];
      $location = $row['location'];
   }
}

if (isset($_POST['update'])) {
   $id = $_POST['id'];
   $name = $_POST['name'];
   $location = $_POST['location'];

   $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id = $id") or die (mysqli_error($mysqli));

   $_SESSION['message'] = "Record has been updated!";
   $_SESSION['msg_type'] = "warning";
   header("location: index.php");

}

?>

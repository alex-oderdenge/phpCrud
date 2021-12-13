<?php


$msqli = new mysqli('localhost', 'root', '', 'crud') or die (mysqli_error($mysqli));


if (isset($_POST['save'])) {
   $name = $_POST['name'];
   $location = $_POST['location'];
   $msqli->query("INSERT INTO data (name, location) VALUES ('$name', '$location')") or die(mysqli_error($mysqli));

}
// FIXME 
if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM data WHERE id=$id");
}

?>
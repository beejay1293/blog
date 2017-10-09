<?php

session_start();
include 'includes/functions.php';
include 'includes/db.php';


if(isset($_GET['category_id'])){

	utils::deleteCategory($conn, $_GET['category_id']);
}
  


?>


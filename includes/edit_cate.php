<?php
session_start();

$title="Edit Category"

include 'includes/header2.php';
include 'includes/function.php';
include 'includes/db.php';

  if(isset($_GET['category_id'])){
  	$catID =$_GET['category_id'];
  }

  $cat = utils::getCategoryById($conn, $catID);

  $errors = [];

  if(array_key_exists('edit', $_POST)){
  	if(empty($_POST['cat_name'])){
  		$errors['cat_name'] = "please enter a new category name";
  	}

  	if(empty($errors)){
  		$clean = array_map('trim', $_POST);
  		$clean['cid'] = $catID;

  		utils::editCategory($conn, $clean);
  		header("Location:view_category.php");
  	}
  }
?>

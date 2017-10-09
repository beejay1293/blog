<?php

session_start();

include 'includes/functions.php';
$title = "ADD category";

include 'includes/db.php';
include 'includes/header2.php';

$errors =[];
  if(array_key_exists('add', $_POST)){
  	if(empty($_POST['cat_name'])){
  		 $errors['cat_name'] = "please enter a category name";
  	}
  	if(empty($errors)){
  		$clean = array_map('trim', $_POST);

  		Utils::addcategory($conn, $clean);

  		header("Location:view_category.php");
  	}
  } 

?>

<div class="wrapper">
	<div id="stream">
		<h1 id="register-label">Add category</h1>
		<hr>
		<form id="register" action="add_category.php" method="POST">
			<div>
				<?php utils::displayError('cat_name', $errors);   ?>
				<label>category name:</label>
				<input type="text" name="cat_name" placeholder="category name">

			</div>
       <input type="submit" name="add" value="add">

		</form>
	</div>
</div>

<?php
 include 'includes/footer.php';
?>
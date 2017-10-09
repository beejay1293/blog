<?php
session_start();

$title="Edit Category";

include 'includes/header2.php';
include 'includes/functions.php';
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

<div class="wrapper"><div id="stream">
	<h1 id="register-label">Edit category</h1>
	<hr>
	<form id="register" action="" method="POST">
		<div>
			<?php utils::displayError('cat_name', $errors); ?>
			<label>New category Name:</label>
			<input type="text" name="cat_name" value="<?php echo $cat['category_name']; ?>">
		</div>
		<input type="submit" name="edit" value="Edit">

	</form>
</div></div>

<?php include 'includes/footer.php' ?>

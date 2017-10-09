<?php

include 'includes/functions.php';
include 'includes/db.php';
 $title = "edit post";
 include 'includes/header2.php';

if(isset($_GET['post_id'])){
	$postID = $_GET['post_id'];
}

$post = utils::getPostById($conn, $postID);

/*$category = utils::getCategoryById($conn, $item['category']);*/

$errors = [];

if(array_key_exists('edit', $_POST)){
	if(empty($_POST['author'])){
		$errors['author'] = "please add an author";
	}
	if(empty($_POST['title'])){
		$errors['title'] = "please add a title";
    }
	if(empty($_POST['content'])){
		$errors['content'] = "please add a content";
	}
	if(empty($_POST['category'])){
		$errors['category'] = "please choose a category";
	}
 
    if(empty($errors)){
        $clean = array_map('trim', $_POST);

       
        utils::editPost($conn, $clean);
        header("Location:view_post.php");
    }

 }


?>



<div class="wrapper"><div id="stream">
<h1 id="register-label">EDIT POST</h1>
<hr>
<form id="register" action="edit_post.php" method="POST">
<input type="hidden" name="postID" value="<?php echo $postID; ?>">
	<div>
	    <?php utils::displayError('author', $errors);   ?>
		<label>author:</label>
		<input type="text" name="author" value="<?php echo $post['author'];  ?>">

	</div>
    <div>
    <?php utils::displayError('title', $errors); ?>
    	<label>title:</label>
    	<input type="text" name="title" value="<?php echo $post['title']; ?>">
    </div>

    <div>
     <?php utils::displayError('content', $errors); ?>
    <label>content:</label>
    <input type="text" name="content" value="<?php echo $post['content']; ?>">
    	

    </div>
    <div>
    <?php utils::displayError('category', $errors); ?>
    	<label>category:</label>
    	<select name="category">
    	<option value="<?php echo $post['category']; ?>"><?php echo $post['category']; ?></option>
    		<?php 
    		$statement = $conn->prepare("SELECT * FROM category");
    		$statement ->execute();
    		while($row = $statement->fetch(PDO::FETCH_ASSOC)){ ?>
    <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>

    	<?php	} ?>
    	</select>
    </div>

   
    <input type="submit" name="edit" value="edit">


</form>
</div>
</div>

<?php include 'includes/footer.php'; ?>
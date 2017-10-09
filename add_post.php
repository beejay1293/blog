<?php 

session_start();
include 'includes/functions.php';
include 'includes/db.php';
 $title = "add post";
 include 'includes/header2.php'; 

 $errors = [];
 if(array_key_exists('add', $_POST)){
 	if(empty($_POST['author'])){
 	$erros['author'] = "please add an author";
 	}
 	if(empty($_POST['title'])){
 		$errors['title'] = "please add a title";
 	}
 	if(empty($_POST['content'])){
 		$errors['content'] = "please add content";
 	}
 	if(empty($_POST['category'])){
 		$errors['category'] = "please add category";
 	}
 	     $destination = "";
 	   define('MAX_FILE_SIZE', '2097152');
 	   $ext = ["image/jpg","image/png","image/jpeg"];
        
        #is a file selected
 	 if(empty($_FILES['img']['name'])){
        $errors['img'] = "please select an image";
    }

 #to check the size of the file
     if($_FILES['img']['size'] > MAX_FILE_SIZE){
     	$errors['img']= "file too large, 2mb allowed";
     }

      #to check format
     if(!in_array(strtolower($_FILES['img']['type']), $ext)){
     	$errors['img']= "file format not supported";
     }

    $check = utils::uploadFile("upload/", $_FILES, "img");
 	 if($check[0]){
 	 	 $destination = $check[1];
 	 }else{
 	 	$errors['img'] = "files not uploaded";
 	 }
    
 	if(empty($errors)){
 		$clean = array_map('trim', $_POST);

 		$clean['loc'] = $destination;
 		utils::addPost($conn, $clean);
 		header("Location:view_post.php");
 	}

 }



 ?>

<div class="wrapper">
<div id="stream">
<h1 id="register-label"> Add post</h1>
<hr>
<form id="register" action="add_post.php" method="POST" enctype="multipart/form-data">
	<div>
		 <?php utils::displayError('author', $errors); ?>
		<label>Author:</label>
		<input type="text" name="author" placeholder="author" value="<?php if(isset($_POST['author'])){ echo $_POST['author']; }  ?>">
	</div>

	<div>
		<?php utils::displayError('title', $errors); ?>
		<label>Title:</label>
		<input type="text" name="title" placeholder="title" value="<?php if(isset($_POST['title'])){echo $_POST['title'];}  ?>">
	</div>

	<div>
		<?php utils::displayError('content', $errors); ?>
		<label>content:</label><br><br>
		<textarea  type="text" name="content" rows="5" cols="5" placeholder="content" value="<?php if(isset($_POST['content'])){ echo $_POST['content'];}  ?>"></textarea>
		
	</div>

	<div>
	<?php utils::displayError('category', $errors); ?>
	<label>category:</label>
		<select name="category">
		<option value=""> select category</option>
			<?php 
			$statement = $conn->prepare("SELECT * FROM category");
			$statement->execute();
	while($row = $statement->fetch(PDO::FETCH_ASSOC)){ ?>
	<option value="<?php echo $row['category_name'];  ?>"> <?php echo $row['category_name']; ?></option>
	<?php } ?>
			
		</select>
	</div>
	<div>
        <?php utils::displayError('img', $errors); ?>
        <label>select an image:</label>
        <input type="file" name="img">
    </div>
	<input type="submit" name="add" value="add">
</form>
	
</div></div>

<?php include 'includes/footer.php'; ?>
<?php

session_start();
 $title = "title";

 include 'includes/header.php';
 include 'includes/db.php';
 include 'includes/functions.php';

 ?>

 <?php
  
  $errors = array();
  if(isset($_POST['login'])){
  	if(empty($_POST['email'])){
  		$errors['email'] = "please enter your email";
  	}

  	if(empty($_POST['password'])){
  		 $errors['password'] = "please enter your password";
  	}


  	if(empty($errors)){
  		$dum = array_map('trim', $_POST);
  		
  		  $check = utils::login($conn , $dum);

  		  $_SESSION['id'] = $check[1]['admin_id'];
  		  $_SESSION['email'] = $check[1]['email'];
  		  
  		  utils::redirect("home.php?msg=welcome");

  		
  	}
  }
  if(isset($_GET['msg'])){
  	echo "<p style='color: green;' > ".$_GET['msg']." </p>";
  }



 ?>

<div class="wrapper">
		<h1 id="login-label">Admin login</h1>
		<hr>
		<form id="login"  action ="login.php" method ="POST">
			<div>
				<?php utils::displayError('email', $errors); ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email"  value="<?php if(isset($_POST['email'])){echo $_POST['email']; }?>">
			</div>
			<div>
                <?php utils::displayError('password', $errors); ?>			   
				<label>password:</label>	
				<input type="password" name="password" placeholder="password" value="<?php if(isset($_POST['password'])){echo $_POST['password']; }?>">
			</div><div>
			<input type="submit" name="login" value="login"></div>
		</form>

		<h4 class="jumpto">Have an account? <a href="register.php">register</a></h4>
 
	

	<?php include 'includes/footer.php'; ?>
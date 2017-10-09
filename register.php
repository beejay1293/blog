<?php
$title = "Home";


include 'includes/header.php';
include 'includes/db.php';
include 'includes/functions.php';


// $dum = array_map('trim', $_POST);
//     register($conn, $dum);
  
 

?>
	

	<?php

	  
$errors = array();
  if(array_key_exists('register', $_POST)){
 
  	if(empty($_POST['firstname'])){
  		$errors['firstname'] = "please enter your firstname";
  	}

  	if (empty($_POST['lastname'])) {
  		$errors['lastname'] = "please enter your lastname";
  	}

  	if (empty($_POST['email'])) {
  		$errors['email'] = "please enter your email";
  		# code...
  	}
    
   if (empty($_POST['password'])) {
    	$errors['password'] = "please enter your password";
    }

    if(empty($_POST['pword'])){
    	$errors['pword'] = "please comfirm your password";
    }else{
    	if($_POST['password'] != $_POST['pword']){
   	 $errors['pword'] = "incorrect password";
   }
    }

    $check = utils::doesEmailExist($conn, $_POST['email']);
      if($check){
      	$errors['email'] = "email already exist";
      }

   


 if(empty($errors)){
 	$dum = array_map('trim', $_POST);
 	$hash = md5($dum ['password']);
 	$dum['password'] = $hash;
 	   Utils::register($conn, $dum);

 	   utils::register($conn, $dum);

 	   utils::redirect("login.php?+msg=thanks for joining us");

 	 
 }
  }


	?>
	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php utils::displayError('firstname', $errors); ?>
				<label>first name:</label>
				<input type="text" name="firstname" placeholder="first name"  value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname']; }?>">
			</div>
			<div>
			    <?php utils::displayError('lastname', $errors); ?>
				<label>last name:</label>	
				<input type="text" name="lastname" placeholder="last name" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname']; }?>">
			</div>

			<div>
			    <?php utils::displayError('email', $errors);  ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email" value="<?php if(isset($_POST['email'])){echo $_POST['email']; }?>">
			</div>
			<div>
			   <?php utils::displayError('password', $errors); ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password" value="<?php if(isset($_POST['password'])){echo $_POST['password']; }?>">
			</div>
 
			<div>
			<?php utils::displayError('pword', $errors); ?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password"  value="<?php if(isset($_POST['pword'])){echo $_POST['pword']; }?>">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>
	<?php
    include 'includes/footer.php';


	?>

	
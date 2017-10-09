<?php
   session_start();
$title = "view category";
include 'includes/header2.php';
include 'includes/db.php';
include 'includes/functions.php';

?>

<div class="wrapper">
<h1 id="register-label">view category</h1>
<hr>
<div id="stream">
	
   <table id="tab">
   	<thead>
   		<tr>
   			<th>category ID</th>
   			<th>category Name</th>
   			<th>Edit</th>
   			<th>Delete</th>
</tr>
</thead>
     <tbody>
     	 <?php 
                $select = $conn->prepare("SELECT * FROM category");
                   $select->execute();
                   $view = utils::viewCat($select);
                   echo $view;

     	   ?>
     </tbody>
   </table>
</div>	
   <div class="paginated">
   	 <a href="#">1</a>
   	 <a href="#">2</a>
   	 <span>3</span>
   	 <a href="#">2</a>
   </div>
</div>

<?php
 include 'includes/footer.php';

?>
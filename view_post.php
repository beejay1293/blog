<?php
include 'includes/functions.php';
$title = "view posts";
include 'includes/db.php';
include 'includes/header2.php';




?>

<div class="wrapper">
<h1 id="register-label">View post</h1>
<hr>
<div id="stream">
<table id="tab">
	<thead>
		<tr>
		<th>post id</th>
		<th>author</th>
		<th>title</th>
		<th>content</th>
		<th>category</th>
		<th>image</th>
		<th>edit</th>
		<th>delete</th>
	
</tr>
	
	</thead>
	<tbody>
		<?php
		$select = $conn ->prepare("SELECT * FROM post");
		$select->execute();
		$view = utils::viewPost($select);
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

<?php include 'includes/footer.php'; ?>
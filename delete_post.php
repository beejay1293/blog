<?php

session_start();

include 'includes/functions.php';
include 'includes/db.php';

if(isset($_GET['post_id'])){
	utils::deletePost($conn, $_GET['post_id']);
}

?>
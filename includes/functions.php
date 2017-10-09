<?php

class Utils{
public static function Register($dbconn, $dummy){
	$statement= $dbconn -> prepare("INSERT INTO admin(firstname,lastname,email,hash)

      VALUES(:fn,:ln,:e,:h)");

	$result = [
	            
	   			":fn" => $dummy['firstname'],
	           ":ln" =>  $dummy['lastname'],
	           ":e"  => $dummy['email'],
	            ":h" => $dummy['password']
	           
	           ];

	            $statement -> execute($result);
	        }


	    public static function doesEmailExist($dbconn, $email){
	    	$result = false;

	    	$statement = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");
	    	$statement->bindParam(":e", $email);

	    	$statement->execute();

	    	$count =$statement->rowCount();

	    	if($count > 0){
	    		$result = true;
	    	}

	    	return $result;
	    }


	public static function displayError($key, $arr){

      if (isset($arr[$key])){
      	echo "<span class = 'err'>" .$arr[$key]. "</span>";
      }



	}



		 public static function login($dbconn, $dummy){
		 	$result = [];

		 	$statement = $dbconn->prepare("SELECT hash, admin_id FROM admin WHERE email=:e");
		 	   $statement->bindParam(":e", $dummy['email']);

		 	   $statement->execute();

		 	   $row = $statement->fetch(PDO::FETCH_ASSOC);
		 	 if(count($row) > 0 && password_verify($dummy['password'], $row['hash'])){
		 	 	$SESSION['id'] = $row['admin_id'];
		 	 	$SESSION['name'] = $row['firstname'].''.$row['lastname'];

		 	 	  
         
        
		 	 	    
               
		 	 }else{
         $result[] = true;
         $result[] = $row;
		 	 
              
            

		 	 	
		 	 	
		 	 }

		 	  return $result;
		 	  
		}


  		public static function redirect($loc, $msg){
  	    		header("location:".$loc.$msg);
  		}

 public static function addPOST($dbconn, $dummy){
 	$statement = $dbconn->prepare("INSERT INTO post(author,title,content,category, image_path) VALUES (:a, :t, :c, :ca, :loc)");
 	$result = [
            ":a" => $dummy['author'],
            ":t" => $dummy['title'],
            ":c" => $dummy['content'],
            ":ca" => $dummy['category'],
            ":loc" => $dummy['loc']
           

 	      ];

 	      $statement ->execute($result);
 }



public static function addCategory($dbconn, $dummy){
	$statement = $dbconn->prepare("INSERT INTO category(category_name) VALUES (:c)");
	$statement->bindparam(":c", $dummy['cat_name']);

	$statement->execute();
}

  public static function viewCat($sr){
  	$result = "";

  	while($row = $sr->fetch(PDO::FETCH_ASSOC)){
  		$cat_id = $row['category_id'];
  		$cat_name = $row['category_name'];

  		$result.= '<tr><td>'.$cat_id.'</td>';
  		$result.= '<td>'.$row['category_name'].'</td>';
  		$result.= "<td><a href='edit_cate.php?category_id=$cat_id'>edit</a></td>";
  		$result.= "<td><a href='delete_cate.php?category_id=$cat_id'>delete</a></td></tr>";
  	} 

  	return $result; 
  }

  public static function viewPost($sr){
  	$result = "";

  	while($row = $sr->fetch(PDO::FETCH_ASSOC)){
  		$post_id = $row['post_id'];
  		$author = $row['author'];
      

  		$result .= '<tr><td>'.$post_id. '</td>';
  		$result .= '<td>'  .$row['author']. '</td>';
  		$result .= '<td>' .$row['title']. '</td>';
  		$result .= '<td>' .$row['content']. '</td>';
  		$result .= '<td>' .$row['category'].  '</td>';
      $result .= '<td><img src ="' .$row['image_path']. '" height ="60" width ="60"></td>';
  		$result .= "<td><a href='edit_post.php?post_id=$post_id'>edit</a></td>";
  		$result .= "<td><a href='delete_post.php?post_id=$post_id'>delete</a></td></tr>";
  	}

  	return $result;
  }

  public static function editCategory($dbconn, $dummy){
  	 $statement= $dbconn->prepare("UPDATE category SET category_name = :cn WHERE category_id = :cid");
  	   $result = [
  	            ':cn' => $dummy['cat_name'],
  	            ':cid'=> $dummy['cid']
  	            ];
  	            $statement->execute($result);
  }
   public static function getCategoryById($dbconn, $dummy){
   	   $statement = $dbconn->prepare("SELECT * FROM category WHERE category_id = :id");
   	   $statement ->bindparam(':id', $dummy);

   	   $statement->execute();
   	   $row = $statement->fetch(PDO::FETCH_ASSOC);

   	   return $row;
   } 

   public static function deleteCategory($dbconn, $dummy){
   	$statement = $dbconn->prepare("DELETE FROM category WHERE category_id = :id");
   	$statement->bindParam(':id',$dummy);
   	$statement->execute();
   	utils::redirect("view_category.php?+msg=", "successfully deleted");
   }


   public static function editPost($dbconn, $dummy){
   	$statement = $dbconn->prepare("UPDATE post SET author = :a,title = :t,content = :c,category = :ca WHERE post_id = :pid ");

   	$result = [
   	       ':a' => $dummy['author'],
            ':t' => $dummy['title'],
            ':c' => $dummy['content'],
            ':ca' => $dummy['category'],
            ':pid' => $dummy['postID']
            
   	];

   	$statement ->execute($result);
   }

    public static function getPostById($dbconn, $dummy){
   	  $statement = $dbconn->prepare("SELECT * FROM post WHERE post_id = :id");
   	  $statement ->bindParam(':id', $dummy);

   	  $statement->execute();
   	  $row = $statement->fetch(PDO::FETCH_ASSOC);

   	  return $row;
   }


   public static function deletePost($dbconn, $dummy){
   	$statement = $dbconn->prepare("DELETE FROM post WHERE post_id = :id");
   	$statement->bindParam(':id', $dummy);
   	$statement->execute();
   	utils::redirect("view_post.php?+msg", "successfully deleted");
   }


   public static function uploadFile($destination, $files, $key){
     $result = [];
     $rnd = rand(0000,9999);
     $file_name = str_replace(" ","_",$files[$key]['name']);

     $file_name = $rnd.$file_name;
     $destination =$destination.$file_name;

     if(move_uploaded_file($files[$key]['tmp_name'], $destination)){
        $result[] = true;
        $result[]= $destination;
     }else{
        $result[]= false;
     }
       return $result;
   }







}
?>
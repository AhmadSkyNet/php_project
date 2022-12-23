<?php 
/* 	include "db.php";

    $name=trim($_POST['name']);
    $mobile=trim($_POST['mobile']);
  //  $pass2=trim($_POST['pass2']);
    $email=trim($_POST['email']);
	  
        $query="INSERT INTO users (user_name,user_password,user_email,user_role)VALUES(?,?,?,?)";
        $result=$conn->prepare($query);
        $result->execute([$name,$mobile,$email,'user']);

	    if($result>0)
	    {
	        echo "user added successfully";
	    }
	    
	     */

  
      include "db.php";
      if ($_SERVER['REQUEST_METHOD'] == "POST"){
      
        $username = filter_var($_POST['username'] , FILTER_SANITIZE_STRING) ;
        $email    = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
        $password =  $_POST['password'] ;
      
        // check if user excist
      
        $stmtcheck = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
        $stmtcheck->execute(array($email)) ;
        $row = $stmtcheck->rowcount() ;
        if ($row > 0 ) {
          echo json_encode(array('status' => "email already found"));
        }else { // if user not exist =>  not rigister => start register
          $stmt   = $conn->prepare("INSERT INTO users(`user_name` , `user_email` , `user_password`) VALUES (? , ? , ?)") ;
          $stmt->execute(array($username , $email , $password)) ;
          $row = $stmt->rowcount() ;
          if ($row > 0) {
            // echo "success" ;
            echo json_encode(array('username' => $username ,'email' => $email ,'password' => $password , 'status' => "success"));
          }
        }
        // End Check
      }
   
      
	

	    
	    
	    ?>
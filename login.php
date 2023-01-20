<?php include "header.php"; ?>

<?php
if(isset($_POST['submit'])){
    $username=trim($_POST['username']); // trim remove any space on the first or end in the name if the user write it "just in first and end"!
    $password= trim($_POST['password']);
    $error=['user'=> '' ,'pass'=>'','email'=>'']; // array to show the error to user!

    $query="SELECT * FROM users WHERE user_name='$username'";
    $result=$conn->prepare($query);
    $result->execute();
    $row=$result->fetch();

   if (!empty($row['user_password'])) {
        $username=$row['user_name'];
        $password2=$row['user_password'];
        $user_id= $row['user_id'];
        $email=$row['user_email'];
        $user_role=$row['user_role'];

        if ($password !== $password2) {
           $error['pass']='Wrong Password';
        }
        else {
        $_SESSION['user_id']=$user_id;
        $_SESSION['username']=$username;
        $_SESSION['email']=$email;
        $_SESSION['user_role']=$user_role;
    
        header('location: index.php');

        }
    } else {
      $error['user']='Username not exist';
    }

}
?>

<div class="container">
    <div class="text-center pt-3">
        <img src="/php_project/images/login.png" class="img-fluid" alt="login" style= "width:200px ; height:200px;" >
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <form method="post">
               <div class="input-group flex-nowrap p-1">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-vcard-fill"></i></span>
                    <input type="text" value="" name="username" class="form-control " placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
               </div>
               <p class="text-danger ms-4"> <?php echo isset($error['user']) ? $error['user'] : ''; // here is  if Statement ?> </p>
               <div class="input-group flex-nowrap p-1">
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key-fill"></i></span>
                    <input type="Password" value="" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                </div>
                <p class="text-danger ms-4"> <?php echo isset($error['pass']) ? $error['pass'] : ''; // here is  if Statement ?> </p>
                <div class="form-check">
                    <input class="form-check-input ms-1" type="checkbox" id="gridCheck">
                    <label class="form-check-label ms-2" for="gridCheck">Keep me logged in</label>
                </div>
                <div class="input-group flex-nowrap p-2">
                    <button type="submit" value="Login" name="submit" class="form-control btn btn-dark"><span><i class="bi bi-box-arrow-in-right"></i> Log in</span></button>
                </div>
                <div class="input-group flex-nowrap p-2 ms-3">
                 <a href="#" >Forgot your password?</a>
                </div>
                <div class="input-group flex-nowrap p-4">
                 <span>Don’t have an account? <a href="register.php"><button type="button" class="btn btn-dark">Register</button></a></span>
                </div>
            </form>
      </div>
   </div>
</div>
</br></br>
<?php include "footer.php"; ?>

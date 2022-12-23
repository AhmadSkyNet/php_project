<?php include "header.php"; ?>
<br></br><br></br><br></br>

<?PHP 
if(isset($_POST['submit'])){
$user=trim($_POST['user']);
$pass=trim($_POST['pass']);
$pass2=trim($_POST['pass2']);
$email=trim($_POST['email']);
$error=['user'=>'','pass'=>'','email'=>''];

if(strlen($user)<3){

    $error['user']='username must be longer';
}

if($pass!=$pass2){
    $error['pass']='password are not the same';
}


$query="SELECT COUNT(*) FROM users WHERE user_name='$user'";
$result=$conn->prepare($query);
$result->execute();

$count=$result->fetchcolumn();
if(!empty($count)){
    $error['user']='username exist';
}

$query="SELECT COUNT(*) FROM users WHERE user_email='$email'";
$result=$conn->prepare($query);
$result->execute();
$count=$result->fetchcolumn();
if(!empty($count)){
    $error['email']='email exist';
}

if(array_filter($error)){}
else {
$query="INSERT INTO users (user_name,user_password,user_email,user_role)VALUES(?,?,?,?)";
$result=$conn->prepare($query);
$result->execute([$user,$pass,$email,'user']);
$user_id=$conn->lastinsertid();

$_SESSION['user']=$user;
$_SESSION['email']=$email;
$_SESSION['user_id']=$user_id;
header('location: index.php');

}}
?>

<div class="container">
 <div class="row">
   <div class="col-3">
        <form method="post">
        <input type="text" value="<?php echo isset($user) ? $user : '';?>" name="user" placeholder="Name" class="form-control m-2" required autocomplete="on">
        <p class="text-danger m-2"> <?php echo isset($error['user']) ? $error['user'] : '';?> </p>
        <input type="password" value="<?php echo isset($pass) ? $pass : '';?>" name="pass" placeholder="Password" class="form-control m-2" required>
        <p class="text-danger m-2"> <?php echo isset($error['pass']) ? $error['pass'] : '';?> </p>
        <input type="password" value="<?php echo isset($pass2) ? $pass2 : '';?>" name="pass2" placeholder="Confirm Password" class="form-control m-2" required>
        <input type="email" value="<?php echo isset($email) ? $email : '';?>" name="email" placeholder="Email" class="form-control m-2" required>
        <p class="text-danger m-2"> <?php echo isset($error['email']) ? $error['email'] : '';?> </p>
        <input type="submit" value="Reister" name="submit" class="form-control m-2 btn btn-primary">
        </form>
   </div>
  </div>
</div>
<?php include "footer.php"; ?>

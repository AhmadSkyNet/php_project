<?php include "header.php"; ?>
<br></br><br></br><br></br>

<?PHP 
if(isset($_POST['submit'])){
    $user=trim($_POST['user']);
    $pass=trim($_POST['pass']);
$error=['user'=>'','pass'=>'','email'=>''];

$query="SELECT COUNT(*) FROM users WHERE user_name='$user'";
$result=$conn->prepare($query);
$result->execute();
$count =$result->fetchColumn();

if(empty($count)){
    $error['user']='username not exist';
}

$pass2="";
$query="SELECT * FROM users WHERE user_name='$user'";
$result=$conn->prepare($query);
$result->execute();
$row=$result->fetch();
    $pass2=$row['user_password'];
    if($pass!=$pass2){
    $error['pass']='Wrong Password'; }

if(array_filter($error)){}
else {
    $query="SELECT * FROM users WHERE user_name='$user'";
    $result=$conn->prepare($query);
    $result->execute();

while($row=$result->fetch()){
$user=$row['user_name'];
$pass=$row['user_password'];
$email=$row['user_email'];
$user_id=$row['user_id'];
$user_role=$row['user_role'];


}
$_SESSION['user_id']=$user_id;
$_SESSION['user']=$user;
$_SESSION['email']=$email;
$_SESSION['user_role']=$user_role;

header('location: index.php');

}}
?>

<div class="container">
<div class="row">
<div class="col-3">
<form method="post">
<input type="text" value="" name="user" placeholder="Name" class="form-control m-2" required>
<p class="text-danger"> <?php echo isset($error['user']) ? $error['user'] : '';?> </p>
<input type="password" value="" name="pass" placeholder="Password" class="form-control m-2" required>
<p class="text-danger"> <?php echo isset($error['pass']) ? $error['pass'] : '';?> </p>
<input type="submit" value="login" name="submit" class="form-control m-2 btn btn-primary">
</form>
</div>
</div>
</div>
<?php include "footer.php"; ?>

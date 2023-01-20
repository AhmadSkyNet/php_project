<?php include "header.php"; ?>

<?php  // to logout just add null to the session.
$_SESSION['username']=null;
$_SESSION['email']=null;
$_SESSION['user_id']=null;
$_SESSION['user_role']=null;

header('location: index.php'); // this code It redirects the user to the home page!
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/php_project/css/zero.css">

    <title>Project Zero</title>
    <div class="text-center">
      <img src="/php_project/images/hedr1.jpg" class="img-fluid" alt="header" >
    </div>
  </head>
  <body>

  <?php include "db.php"; ?>

  <nav class="navbar navbar-expand-lg navbar sticky-top navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" style="color:red" href="/php_project/index.php">PROJECT ZERO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="color:white" href="index.php"><i class="bi bi-house-fill"></i> Home</a>
        </li>
        <?php if(isset($_SESSION['user_id'])){ ?>
          <li class="nav-item">
            <a class="nav-link"style="color:white" href="#"><i class="bi bi-at"></i> <?php  echo isset( $_SESSION['user']) ? $_SESSION['user'] : "User"; ?></a>
            <?php } else { ?>
              <a class="nav-link" style="color:white" href="/php_project/login.php"><i class="bi bi-person-fill"></i> Login</a>
              <a class="nav-link" style="color:white" href="/php_project/register.php"><i class="bi bi-person-plus-fill"></i> Register</a>
          </li>
        <?php } ?>
        <?php if(isset($_SESSION['user_id'])){ ?>
          <li class="nav-item">
            <a class="nav-link" style="color:white" href="/php_project/admin/index.php"> <i class="bi bi-person-fill-gear"></i> Myadmin</a>
          </li>
        <?php } ?>
        <?php if(isset($_SESSION['user_id'])){ ?>
          <li class="nav-item">
          <a class="nav-link" type="button" style="color:white" href="/php_project/login.php"><i class="bi bi-bell-fill"></i><span class="badge rounded-pill text-bg-danger">1</span></a>
          </li>
        <?php } ?>
        <?php if(isset($_SESSION['user_id'])){ ?>
          <li class="nav-item">
            <a class="nav-link" style="color:white" href="/php_project/logout.php"><i class="bi bi-person-fill-slash"></i> Logut</a>
          </li>
        <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color:white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-list-stars"></i> Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>
</nav>
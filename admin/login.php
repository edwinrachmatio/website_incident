<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.1.1">
  <title>Signin Admin</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="assets/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form method="post" action="include/plogin.php" class="form-signin">
    <a href="../index.php">
      <img class="mb-4" src="assets/brand/chart-line.svg" alt="" width="72" height="72">
    </a>
    <h1 class="h3 mb-3 font-weight-normal">Welcome To <br> Incident Management</h1>
    <label for="inputEmail" class="sr-only">Username</label>
    <input type="username" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2020-2022</p>
  </form>
  <script type="text/javascript">
    function validasi() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      if (username != "" && password != "") {
        return true;
      } else {
        alert('Username dan Password harus di isi !');
        return false;
      }
    }
  </script>
</body>

</html>
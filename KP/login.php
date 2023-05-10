<?php
@ob_start();
session_start();
require 'config.php';
include $view;
$lihat = new view($config);
$toko = $lihat->toko();
if (isset($_POST['proses'])) {
	require 'config.php';

	$user = strip_tags($_POST['user']);
	$pass = strip_tags($_POST['pass']);

	$sql = 'select *
				from member
				where username =? and pass = ?';
	$row = $config->prepare($sql);
	$row->execute(array($user, $pass));
	$jum = $row->rowCount();


	if ($jum > 0) {
		$hasil = $row->fetch();


		if ($hasil['leveljabatan'] == "admin") {
			$idmember = $hasil['id_member'];
			// buat session login dan username
			$_SESSION['username'] = $user;
			$_SESSION['id_member'] = $idmember;
			$_SESSION['leveljabatan'] = "admin";
			$_SESSION['admin'] = $hasil['leveljabatan'];
			echo '<script>window.location="index.php"</script>';
		} elseif ($hasil['leveljabatan'] == "kasir") {
			$idmember = $hasil['id_member'];
			// buat session login dan username
			$_SESSION['username'] = $user;
			$_SESSION['id_member'] = $idmember;
			$_SESSION['leveljabatan'] = "kasir";
			$_SESSION['kasir'] = $hasil['leveljabatan'];
			echo '<script>window.location="index.php"</script>';
		} elseif ($hasil['leveljabatan'] == "manager") {
			$idmember = $hasil['id_member'];
			// buat session login dan username
			$_SESSION['username'] = $user;
			$_SESSION['id_member'] = $idmember;
			$_SESSION['leveljabatan'] = "manager";
			$_SESSION['manager'] = $hasil['leveljabatan'];
			echo '<script>window.location="index.php"</script>';
		} else {
			echo '<script>alert("Login Gagal");history.go(-1);</script>';
		}
	} else {
		echo '<script>alert("Login Gagal");history.go(-1);</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword">

	<title>Login To Admin</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<!--external css-->
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/style-responsive.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background:#004643;color:#fff;">

	<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	<div id="login-page" style="padding-top:3pc;">
		<div class="container">

			<form class="form-login" method="POST">
				<h2 class="form-login-heading"><?php echo $toko['nama_toko']; ?></h2>
				<p style="text-align:center;"><img src="assets\img\kp.jpg" alt="kp" class="center" width="50%" height="50%"></p>
				<div class="login-wrap">
					<input type="text" class="form-control" name="user" placeholder="User ID" autofocus>
					<br>
					<input type="password" class="form-control" name="pass" placeholder="Password">
					<br>
					<button class="btn btn-primary btn-block" name="proses" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
				</div>
			</form>

		</div>
	</div>
	<!-- js placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php 

	@ob_start();
	session_start();


	if(!empty($_SESSION['admin'])){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		//  admin
			include 'admin/template/header.php';
			include 'admin/template/sidebaradmin.php';
				if(!empty($_GET['page'])){
					include 'admin/module/'.$_GET['page'].'/index.php';
				}else{
					include 'admin/template/homea.php';
				}
			include 'footer.php';
		// end admin

		
	}elseif(!empty($_SESSION['kasir'])){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		//  admin
			include 'kasir/template/header.php';
			include 'kasir/template/sidebarkasir.php';
				if(!empty($_GET['page'])){
					include 'kasir/module/'.$_GET['page'].'/index.php';
				}else{
					include 'kasir/template/homek.php';
				}
			include 'footer.php';
		// end admin


	}elseif(!empty($_SESSION['manager'])){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		//  admin
			include 'manager/template/header.php';
			include 'manager/template/sidebarmanager.php';
				if(!empty($_GET['page'])){
					include 'manager/module/'.$_GET['page'].'/index.php';
				}else{
					include 'manager/template/homem.php';
				}
			include 'footer.php';
		// end admin
	}
	else{
		echo '<script>window.location="login.php";</script>';
	}
?>


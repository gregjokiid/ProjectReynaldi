<?php 
session_start();
if(!empty($_SESSION['admin'])){
	require '../../config.php';
	if(!empty($_GET['kategori'])){
		$nama= $_POST['kategori'];
		$tgl= date("j F Y, G:i");
		$data[] = $nama;
		$data[] = $tgl;
		$sql = 'INSERT INTO kategori (nama_kategori,tgl_input) VALUES(?,?)';
		$row = $config -> prepare($sql);
		if($row -> execute($data)){
			echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';

			die;
		}else{
			echo '<script>window.location="../../index.php?page=kategori&&gagal=tambah-data"</script>';

		};
	}
	if(!empty($_GET['barang'])){
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$nama = $_POST['nama'];
		$deskripsi = $_POST['deskripsi'];
		$beli = $_POST['beli'];
		$jual = $_POST['jual'];
		$satuan = $_POST['satuan'];
		$stok = $_POST['stok'];
		$tgl = $_POST['tgl'];
				
		$data[] = $id;
		$data[] = $kategori;
		$data[] = $nama;
		$data[] = $deskripsi;
		$data[] = $beli;
		$data[] = $jual;
		$data[] = $satuan;
		$data[] = $stok;
		$data[] = $tgl;
		$sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,deskripsi,harga_beli,harga_jual,satuan_barang,stok,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		if($row -> execute($data)){
			echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
			die;
		}else{
			echo '<script>window.location="../../index.php?page=barang&gagal=tambah-data"</script>';
		}
	}

	if(!empty($_GET['member'])){
		$id_member = $_POST['id_member'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$nm_member = $_POST['nm_member'];
		$alamat_member = $_POST['alamat_member'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];
		$NIK = $_POST['NIK'];
		$leveljabatan = $_POST['leveljabatan'];
				
		$data[] = $id_member;
		$data[] = $username;
		$data[] = $pass;
		$data[] = $nm_member;
		$data[] = $alamat_member;
		$data[] = $telepon;
		$data[] = $email;
		$data[] = $NIK;
		$data[] = $leveljabatan;

		$sql = 'INSERT INTO member (id_member,username,pass,nm_member,alamat_member,telepon,email,NIK,leveljabatan) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
		$row = $config -> prepare($sql);
		$row -> execute($data);
		echo '<script>window.location="../../index.php?page=user&success=tambah-data"</script>';
	}
	
	if(!empty($_GET['jual'])){
		$id = $_GET['id'];
		
		// get tabel barang id_barang 
		$sql = 'SELECT * FROM barang WHERE id_barang = ?';
		$row = $config->prepare($sql);
		$row->execute(array($id));
		$hsl = $row->fetch();

		if($hsl['stok'] > 0)
		{
			//$kasir =  $_GET['id_kasir'];
			$kasir =  $_SESSION['id_member'] ;
			$jumlah = 1;
			$total = $hsl['harga_jual'];
			$tgl = date("j F Y, G:i");
			
			
			$data1[] = $id;
			$data1[] = $kasir;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $tgl;
			
			$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);

			echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';

		}else{
			echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}
	}
}



elseif (!empty($_SESSION['kasir'])) {
	require '../../config.php';
	if(!empty($_GET['jual'])){
		$id = $_GET['id'];
		
		// get tabel barang id_barang 
		$sql = 'SELECT * FROM barang WHERE id_barang = ?';
		$row = $config->prepare($sql);
		$row->execute(array($id));
		$hsl = $row->fetch();


		if($hsl['stok'] > 0)
		{
			//$kasir =  $_GET['id_kasir'];
			$kasir =  $_SESSION['id_member'] ;
			$jumlah = 1;
			$total = $hsl['harga_jual'];
			$tgl = date("j F Y, G:i");

			$data1[] = $id;
			$data1[] = $kasir;
			$data1[] = $jumlah;
			$data1[] = $total;
			$data1[] = $tgl;
			// var_dump($kasir);
			// die();
			$sql1 = 'INSERT INTO penjualan (id_barang,id_member,jumlah,total,tanggal_input) VALUES (?,?,?,?,?)';
			$row1 = $config -> prepare($sql1);
			$row1 -> execute($data1);

			echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';

		}else{
			echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
		}
	}

}
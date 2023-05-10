 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
	$id = $_GET['member'];
	$hasil = $lihat -> user_edit($id);

?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<a href="index.php?page=user"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3>Details user</h3>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit user Berhasil !</p>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus user Berhasil !</p>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						</div>
						<?php }?>
						<table class="table table-striped">
						<form action="fungsi/edit/edit.php?member=edit" method="POST">
								<tr>
									<td>ID Member</td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo $hasil['id_member'];?>" name="id_member"></td>
								</tr>
								<tr>
									<td>Username</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['username'];?>" name="username"></td>
								</tr>
								<tr>
									<td>Password</td>
									<td><input type="password" class="form-control" value="<?php echo $hasil['pass'];?>" name="pass"></td>
								</tr>
								<tr>
									<td>Nama</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['nm_member'];?>" name="nm_member"></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['alamat_member'];?>" name="alamat_member"></td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td><input type="number" class="form-control" value="<?php echo $hasil['telepon'];?>" name="telepon"></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><input type="text" class="form-control" value="<?php echo $hasil['alamat_member'];?>" name="alamat_member"></td>
								</tr>
								<tr>
									<td>Email</td>
									<td><input type="email" class="form-control" value="<?php echo $hasil['email'];?>" name="email"></td>
								</tr>
								<tr>
									<td>NIK</td>
									<td><input type="number" class="form-control" value="<?php echo $hasil['NIK'];?>" name="NIK"></td>
								</tr>
								
								<tr>
									<td></td>
									<td><button class="btn btn-primary"><i class="fa fa-edit"></i> Update Data</button></td>
								</tr>
							</form>
						</table>
						<div class="clearfix" style="padding-top:16%;"></div>
				  </div>
              </div>
          </section>
      </section>


	  
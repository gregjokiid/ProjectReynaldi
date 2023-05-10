 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
		  $id = $_SESSION['admin'];
		  $hasil = $lihat -> member_edit($id);
      ?>

      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>User</h3>
						<br>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-success">
							<p>Hapus Data Berhasil !</p>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						</div>
						<?php }?>
							<button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-plus"></i> Insert User</button>
						<a href="index.php?page=user" style="margin-right :0.5pc;" 
							class="btn btn-success btn-md pull-right">
							<i class="fa fa-refresh"></i> Refresh Data</a>
						<div class="clearfix"></div>
						<br/>


							<!-- view member -->	
						<div class="modal-view">
							<table class="table table-bordered table-striped" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<th>Username</th>
										<th>Password</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Telepon</th>
										<th>Email</th>
										<th>NIK</th>
										<th>Level</th>
										<th>Aksi</th>
										
									</tr>
								</thead>
								
									<tbody>
								
								<?php
								$hasil = $lihat -> memberview();
								foreach($hasil as $isi) {?>
									<tr>
										<td><?php echo $isi['username'];?></td>
										<td><input type="password" readonly="readonly" value="<?php echo $isi['pass'];?>"></td>
										<td><?php echo $isi['nm_member'];?></td>
										<td><?php echo $isi['alamat_member'];?></td>
										<td><?php echo $isi['telepon'];?></td>
										<td><?php echo $isi['email'];?></td>
										<td><?php echo $isi['NIK'];?></td>	
										<td><?php echo $isi['leveljabatan'];?></td>
										<td>
										<a href="index.php?page=user/edit&member=<?php echo $isi['id_member'];?>"><button class="btn btn-warning 
										 btn-xs">Edit</button></a>
										<a href="fungsi/hapus/hapus.php?member=hapus&id=<?php echo $isi['id_member'];?>" onclick="javascript:return
										 confirm('Hapus User ?');">
										<button class="btn btn-danger btn-xs">Hapus</button></a>
								</td>
											
									</tr>
									<?php } ?>
								
								</tbody>
							</table>
						</div>


						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content" style=" border-radius:0px;">
								<div class="modal-header" style="background:#285c64;color:#fff;">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah User</h4>
								</div>										
								<form action="fungsi/tambah/tambah.php?member=tambah" method="POST">
									<div class="modal-body">
								
										<table class="table table-striped bordered">
											
											<?php
												$format = $lihat -> member_id();
											?>
											<tr>
												<td>ID Member</td>
												<td><input type="text" readonly="readonly" required value="<?php echo $format;?>" class="form-
												control"  name="id_member"></td>
											</tr>
											<tr>
												<td>Username</td>
												<td><input type="text" placeholder="Username" required class="form-control" name="username"></td>
											</tr>
											<tr>
												<td>Password</td>
												<td><input type="password" placeholder="Password" required class="form-control" name="pass"></td>
											</tr>
											<tr>
												<td>Nama</td>
												<td><input type="text" placeholder="Nama" required class="form-control"  name="nm_member"></td>
											</tr>
											<tr>
												<td>Alamat</td>
												<td><input type="text" placeholder="Alamat" required class="form-control"  name="alamat_member">
											</td>
											</tr>
											<tr>
												<td>Telepon</td>
												<td><input type="number" placeholder="Telepon" required class="form-control"  name="telepon"></td>
											</tr>
											<tr>
												<td>Email</td>
												<td><input type="email" placeholder="Email" required class="form-control"  name="email"></td>
											</tr>
											<tr>
												<td>NIK</td>
												<td><input type="number" placeholder="NIK" required class="form-control"  name="NIK"></td>
											</tr>
											<tr>
												<td>Pilih Jabatan</td>
												<td>
													<select name="leveljabatan" class="form-control" required>
														<option value="admin">admin</option>
														<option value="kasir">kasir</option>
														<option value="manager">manager</option>
													</select>
												</td>
											</tr>
										</table>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Insert Data</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						



						</div>
					</div>
				  </div>
              </div>
          </section>
      </section>
	

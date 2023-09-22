      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
      	<!-- ============================================================== -->
      	<!-- Bread crumb and right sidebar toggle -->
      	<!-- ============================================================== -->
      	<div class="page-breadcrumb">

      	</div>
      	<!-- ============================================================== -->
      	<!-- End Bread crumb and right sidebar toggle -->
      	<!-- ============================================================== -->
      	<!-- ============================================================== -->
      	<!-- Container fluid  -->
      	<!-- ============================================================== -->
      	<div class="container-fluid">
      		<!-- -------------------------------------------------------------- -->
      		<!-- Start Page Content -->
      		<!-- -------------------------------------------------------------- -->
      		<div class="row">
      			<div class="col-12">
      				<div class="card">
      					<div class="card-header bg-info">
      						<h4 class="card-title text-white">
      							Data Calon Pelanggan
      						</h4>
      					</div>
      					<div class="card-body">
      					<?php
							$attributes 	= array('class' => 'form-horizontal');
							echo form_open('Admin/hapus_capel_selected', $attributes);
						?>
							<button id="addRow" class="btn btn-danger" type="submit" name="hapus_capel">
								<i data-feather="minus" class="feather-sm"></i> Hapus Data
							</button>
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>
							<div class="table-responsive">
								<table style="width: 100%" id="tabel-view-allcapel" class="no-wrap table-bordered table-hover table">
									<thead>
										<!-- start row -->
										<tr>
											<th width="5%">
												<div class="d-flex justify-content-center">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" id="checklist-user">
													</div>
												</div>
											</th>
											<th>Nama ULP</th>
											<th>Tgl Disetujui</th>
											<th>Status Capel</th>
											<th>Status Material</th>
											<th>Nama Capel</th>
																						
										</tr>
										<!-- end row -->
									</thead>
									<tbody>
										<?php foreach ($data_capel->result() as $data) : ?>
											<tr>
												<td>
													<div class="d-flex justify-content-center">
														<div class="form-check">
															<input class="form-check-input" style="position: relative; right: 7px;" type="checkbox" value="<?php echo $data->id_capel; ?>" id="flexCheckDefault" name="check[]">
														</div>
													</div>
												</td>
												<td><?= $data->nama_ulp; ?></td>
												<td><?= date_format(date_create($data->tgl_persetujuan), "d-m-Y"); ?></td>
												<td><?= $data->status_capel; ?></td>
												<td><?= $data->status_material; ?></td>													
												<td><?= $data->nama_capel; ?></td>
												

											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php echo form_close(); ?>	
      					</div>
      				</div>
      			</div><!-- end <div class="col-12"> -->
      		</div>
      		<!-- End Row -->
      	</div>
      	<!-- ============================================================== -->
      	<!-- End Container fluid  -->
      	<!-- ============================================================== -->

      	<!-- ============================================================== -->
      	<!-- footer -->
      	<!-- ============================================================== -->
      	<footer class="footer text-center">

      	</footer>
      	<!-- ============================================================== -->
      	<!-- End footer -->
      	<!-- ============================================================== -->
      </div>
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
      							Data Pelanggan Belum Terpenuhi
      						</h4>
      					</div>
      					<div class="card-body">
      						<h6 class="card-subtitle mb-3">
							<div class="table-responsive">
								<table id="tabel-view-materialkurang" class="table table-striped table-bordered text-nowrap" style="width: 100%;">

									<thead>
										<!-- start row -->
										<tr>
											<th width = "5%">Detail</th>	
											<th>Nama ULP</th>
											<th>Nama Pelanggan</th>
											<th>Jml Item Material</th>
											<th>Status Material</th>						
										</tr>
										<!-- end row -->
									</thead>
									<tbody>
										<?php foreach ($data_capel->result() as $data) : ?>
											<tr>
												<td>
													<div class="d-flex justify-content-around">
														<a href="<?php echo base_url('Capel/Update_material/') . $data->id_capel; ?>">
															<span style="position: relative; bottom:2px;" class="text-info"><i data-feather="edit"></i></span>
														</a>
													</div>
												</td>												
												<td><?= $data->nama_ulp; ?></td>
												<td><?= $data->nama_capel; ?></td>
												<td><?= $data->KEKURANGAN_MAT; ?></td>
												
												<td><?= $data->status_material; ?></td>		
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
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
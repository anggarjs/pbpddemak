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
      							Data Material belum terpenuhi
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
											<th>Koordinat Longt</th>
											<th>Jumlah Pelanggan</th>						
										</tr>
										<!-- end row -->
									</thead>
									<tbody>
										<?php foreach ($anomali_lat->result() as $data) : ?>
											<tr>
												<td>
													<div class="d-flex justify-content-around">
														<a href="<?php echo base_url('fso/detail_plgn_by_longt/') . $data->longt; ?>">
															<span style="position: relative; bottom:2px;" class="text-info"><i data-feather="edit"></i></span>
														</a>
													</div>
												</td>												
												<td><?= $data->longt; ?></td>
												<td><?= number_format($data->jumlah_data); ?></td>		
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
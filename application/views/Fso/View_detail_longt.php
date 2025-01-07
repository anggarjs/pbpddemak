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
							Data Rincian Plgn by Longitude
						</h4>
					</div>
					<div class="card-body">
						<h6 class="card-subtitle mb-3">
							<div class="table-responsive">
								      								<table                       id="file_export"
                      class="
                        table table-striped table-bordered
                        display
                        text-nowrap
                      " style="width: 100%;" >
									<thead>
										<tr>

											<th>Nama ULP</th>
											<th>Nama Capel</th>
											
											<th>Status Capel</th>
											<th>Nama Material</th>
											<th>Volume</th>
											<th>Volume</th>
										</tr>
									</thead>
									<tbody>
										
										<?php foreach ($detail_plgn_by_longt->result() as $data) : ?>
											<tr>								
												<td><?php echo html_escape($data->id_ulp); ?></td>
												<td><?php echo html_escape($data->nama_plgn); ?></td>
											
												<td><?php echo html_escape($data->alamat_plgn); ?></td>
												<td><?php echo html_escape($data->nama_petugas); ?></td>
												<td><?php echo html_escape($data->lat); ?></td>
												<td><?php echo html_escape($data->longt); ?></td>
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
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
      						<h6 class="card-subtitle mb-3">
      							<div class="table-responsive">
      								<table id="zero_config" class="table table-striped table-bordered text-nowrap">
      									<thead>
      										<!-- start row -->
      										<tr>
												<th>Nama ULP</th>
												<th>Tgl Disetujui</th>
      											<th>Nama Capel</th>
      											<th>Daya Capel</th>
												<th>BP</th>
												<th>RAB</th>
      											<th>Status Permohonan</th>						
      										</tr>
      										<!-- end row -->
      									</thead>
      									<tbody>
      										<?php foreach ($data_capel->result() as $data) : ?>
      											<tr>
												
													<td><?= $data->nama_ulp; ?></td>
													<td><?= date_format(date_create($data->tgl_persetujuan),"d-m-Y"); ?></td>
													<td><?= $data->nama_capel; ?></td>
													<td><?= $data->daya_baru; ?></td>
													<td><?= number_format($data->biaya_penyambungan); ?></td>
													<td><?= number_format($data->biaya_investasi); ?></td>
													<td><?= $data->status_capel; ?></td>			
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
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
      							Data Calon Pelanggan Yang Sudah Disetujui
      						</h4>
      					</div>
      					<div class="card-body">
      						<h6 class="card-subtitle mb-3">
      							<div class="table-responsive">
      								<table id="tabel-view-allcapel" style="width: 100%;" class="table table-striped table-bordered text-nowrap">

      									<thead>
      										<!-- start row -->
      										<tr>
      											<th width="5%">Detail</th>
      											<th>Nama ULP</th>
      											<th>Tgl Disetujui</th>
												<th>Tgl Byr Plgn</th>
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
      													<div class="d-flex justify-content-around">
      														<a href="<?php echo base_url('Capel/Update/') . $data->id_capel; ?>">
      															<span style="position: relative; bottom:2px;" class="text-info"><i data-feather="edit"></i></span>
      														</a>
      													</div>
      												</td>
      												<td><?= $data->nama_ulp; ?></td>
      												<td><?= date_format(date_create($data->tgl_persetujuan), "d-m-Y"); ?></td>
														<td>
															<?php
																if(is_null($data->rencana_tgl_byr_plgn))
																	echo '-';
																else
																	echo date_format(date_create($data->rencana_tgl_byr_plgn), "d-m-Y");
																	
															?>
														</td>
      												<td><?= $data->status_capel; ?></td>
      												<td><?= $data->status_material; ?></td>													
      												<td><?= $data->nama_capel; ?></td>
      												

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
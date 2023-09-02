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
      							Data User
      						</h4>
      					</div>
      					<div class="card-body">
      						<h6 class="card-subtitle mb-3">
      							<div class="table-responsive mt-3">
      								<table id="tabel-view-user" class="table table-striped table-bordered text-nowrap" style="width: 100%">
      									<thead>
      										<!-- start row -->
      										<tr>
      											<th>Action</th>
      											<th>Nama User</th>
      											<th>Asal Unit Kerja</th>
      											<th>Role User</th>
      										</tr>
      										<!-- end row -->
      									</thead>
      									<tbody>
      										<?php
												foreach ($data_users->result() as $row) {
													echo '<tr>';
												?>
      											<td>
      												<div class="d-flex justify-content-around">
      													<a href="<?php echo base_url('User/Edit/'). $row->id_user; ?>">
      														<span style="position: relative; bottom:7px;" class="text-info"><i data-feather="edit"></i></span>
      													</a>
      												</div>
      											</td>
      										<?php
													echo '<td>' . $row->nama_user . '</td>';
													echo '<td>' . $row->nama_ulp . '</td>';
													echo '<td>' . $row->nama_role . '</td>';
													echo '</tr>';
												}
												?>
      										<!-- end row -->
      									</tbody>
      									<!-- <tfoot> -->
      									<!-- start row -->
      									<!-- <tr>
      											<th>Action</th>
      											<th>Nama User</th>
      											<th>Asal Unit Kerja</th>
      											<th>Role User</th>
      										</tr> -->
      									<!-- end row -->
      									<!-- </tfoot> -->
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
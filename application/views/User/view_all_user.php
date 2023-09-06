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
      							<div class="mt-3 overflow-scroll">
      								<?php if ($this->session->flashdata('success_insert')) : ?>
      									<div class="alert alert-success alert-dismissible fade show" role="alert">
      										<i data-feather="check"></i>
      										<strong><?php echo $this->session->flashdata('success_insert'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<?php if ($this->session->flashdata('success_edit')) : ?>
      									<div class="alert alert-success alert-dismissible fade show" role="alert">
      										<i data-feather="check"></i>
      										<strong><?php echo $this->session->flashdata('success_edit'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<?php if ($this->session->flashdata('success_hapus')) : ?>
      									<div class="alert alert-success alert-dismissible fade show" role="alert">
      										<i data-feather="check"></i>
      										<strong><?php echo $this->session->flashdata('success_hapus'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<?php if ($this->session->flashdata('gagal_hapus')) : ?>
      									<div class="alert alert-danger alert-dismissible fade show" role="alert">
      										<i data-feather="alert-triangle"></i>
      										<strong><?php echo $this->session->flashdata('gagal_hapus'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<form action="<?php echo base_url('User/hapus_user_selected'); ?>" method="post">
      									<table style="width: 100%" id="tabel-view-user" class="table table-striped table-bordered display nowrap">
      										<thead>
      											<!-- start row -->
      											<tr style="vertical-align: middle;">
      												<th>
      													<div class="d-flex justify-content-around">
      														<button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
															  <i data-feather="trash"></i>
      														</button>

      														<!-- Modal -->
      														<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      															<div class="modal-dialog">
      																<div class="modal-content">
      																	<div class="modal-header">
      																		<h1 class="modal-title fs-5" id="exampleModalLabel">Hapus User</h1>
      																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      																	</div>
      																	<div class="modal-body">
      																		Apakah yakin ingin dihapus ?
      																	</div>
      																	<div class="modal-footer">
      																		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      																		<button type="submit" class="btn btn-danger hapus-data-surat" name="hapus_user">Save changes</button>
      																	</div>
      																</div>
      															</div>
      														</div>
      														<div class="form-check">
      															<input class="form-check-input" type="checkbox" id="checklist-user" style="position: relative; top: 8px; left:6px;">
      														</div>
      													</div>
      												</th>
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
      													<div class="d-flex justify-content-evenly">
      														<div class="form-check">
      															<input class="form-check-input" type="checkbox" value="<?php echo $row->id_user; ?>" id="flexCheckDefault" name="check[]">
      														</div>

      													</div>
      												</td>
      												<td>
      													<div class="d-flex justify-content-around">
      														<a href="<?php echo base_url('User/Edit/') . $row->id_user; ?>">
      															<span style="position: relative; bottom:2px;" class="text-info"><i data-feather="edit"></i></span>
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
      									</table>
      								</form>
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
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
      					<form action="<?php echo base_url('User/proses_edit_user/' . $id_user); ?>" method="post">
      						<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
      						<div class="card-header bg-info">
      							<h4 class="card-title text-white">
      								Form Edit Data User
      							</h4>
      						</div>
      						<div class="card-body">
      							<div class="mb-3">
      								<label>Nama User</label>
      								<input type="text" class="form-control <?php echo (form_error('username')) ? 'is-invalid' : ''; ?>" value="<?php echo $data_user['nama_user']; ?>" name="username" />
      								<div class="invalid-feedback">
      									<?php if (form_error('username') == true) : ?>
      										<?php echo form_error('username'); ?>
      									<?php endif; ?>
      								</div>
      							</div>

      							<div class="mb-3">
      								<label>Asal Unit Kerja</label>
      								<?php
										echo $selected_value = '(' . $data_user['nama_ulp'] . ')';
										?>
      								<?php echo form_dropdown('pilihan_ulp', $pilihan_ulp, $data_user['nama_ulp'], 'class="form-select ' . (form_error('pilihan_ulp') ? 'is-invalid' : '') . '"'); ?>
      								<div class="invalid-feedback">
      									<?php echo form_error('pilihan_ulp'); ?>
      								</div>
      							</div>

      							<div class="mb-3">
      								<label>Role Kerja</label>
      								<?php
										echo $selected_value = '(' . $data_user['nama_role'] . ')';
										?>
      								<?php echo form_dropdown('pilihan_role', $pilihan_role, set_value('pilihan_role'), 'class="form-select ' . (form_error('pilihan_role') ? 'is-invalid' : '') . '"'); ?>
      								<div class="invalid-feedback">
      									<?php echo form_error('pilihan_role'); ?>
      								</div>
      							</div>
      						</div>
      						<div class="p-3 border-top">
      							<div class="text-end">
      								<button type="submit" class="btn btn-info rounded-pill px-4 waves-effect waves-light">
      									Save
      								</button>
      							</div>
      						</div>
      					</form>
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
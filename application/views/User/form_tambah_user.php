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
      					<?php
							$attributes 	= array('class' => 'form-horizontal');
							echo form_open('User/Tambah', $attributes);
							?>
      					<div class="card-header bg-info">
      						<h4 class="card-title text-white">
      							Form Penambahan Data User
      						</h4>
      					</div>
      					<div class="card-body">
      						<div class="mb-3">
      							<label>Nama User</label>
      							<input type="text" class="form-control <?php echo (form_error('username')) ? 'is-invalid' : ''; ?>" name="username" />
      							<div class="invalid-feedback">
      								<?php if (form_error('username') == true) : ?>
      									<?= form_error('username'); ?>
      								<?php endif; ?>
      							</div>
      						</div>

      						<div class="mb-3">
      							<label>Asal Unit Kerja</label>
      							<?php
									if (set_value('pilihan_ulp') != '') $set_select = set_value('pilihan_ulp');
									else $set_select = '';
									echo form_dropdown('pilihan_ulp', $pilihan_ulp, $set_select, 'class="form-control ' . (form_error('pilihan_ulp') ? 'is-invalid' : '') . '"');
									?>
      							<div class="invalid-feedback">
      								<?php if (form_error('pilihan_ulp') == true) : ?>
      									<?= form_error('pilihan_ulp'); ?>
      								<?php endif; ?>
      							</div>
      						</div>

      						<div class="mb-3">
      							<label>Role Kerja</label>
      							<?php
									if (set_value('pilihan_role') != '') $set_select = set_value('pilihan_role');
									else $set_select = '';
									echo form_dropdown('pilihan_role', $pilihan_role, $set_select, 'class="form-control ' . (form_error('pilihan_role') ? 'is-invalid' : '') . '"');
									?>
      							<div class="invalid-feedback">
      								<?php if (form_error('pilihan_role') == true) : ?>
      									<?= form_error('pilihan_role'); ?>
      								<?php endif; ?>
      							</div>
      						</div>

      					</div>
      					<div class="p-3 border-top">
      						<div class="text-end">
      							<button type="submit" class="
								btn btn-info
								rounded-pill
								px-4
								waves-effect waves-light
								">
      								Save
      							</button>
      						</div>
      					</div>
      					<!-- </form> -->
      					<?php echo form_close(); ?>
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
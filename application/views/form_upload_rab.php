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
      				<!-- ----------------------------------------- -->
      				<!-- 3. Custom File Upload -->
      				<!-- ----------------------------------------- -->
      				<div class="card">
      					<div class="card-header bg-info">
      						<h4 class="card-title text-white">
      							Form Upload RAB
      						</h4>
      					</div>
      					<div class="card card-body">
      						<div class="mb-3">
      							<form action="<?php echo base_url('index.php/Input/proses_upload_rab') ?>" enctype="multipart/form-data"" method="post">
      								<input class="form-control <?php echo ($this->session->flashdata('error') == true) ? 'is-invalid' : ''; ?>" type="file" name="excel_file" accept=".xlsx" id="excel_file" />
      								<div class="invalid-feedback">
      									<?php if ($this->session->flashdata('error')) : ?>
      										<div class="error"><?php echo $this->session->flashdata('error'); ?>
      										</div>
      									<?php endif; ?>
      								</div>
      								<hr />
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
      							</form>
      						</div>
      					</div>

      				</div>
      			</div>
      		</div>
      		<!-- Row -->
      	</div>
      	<!-- ============================================================== -->
      	<!-- End Container fluid  -->
      	<!-- ============================================================== -->

      	<!-- ============================================================== -->
      	<!-- footer -->
      	<!-- ============================================================== -->
      	<footer class="footer text-center">
      		All Rights Reserved by Nice admin.
      	</footer>
      	<!-- ============================================================== -->
      	<!-- End footer -->
      	<!-- ============================================================== -->
      </div>
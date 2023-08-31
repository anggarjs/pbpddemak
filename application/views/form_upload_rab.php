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
      					<?php echo $this->session->flashdata('error'); ?>
      					<form action="<?php echo base_url('Input/proses_upload_rab'); ?>" method="post" enctype="multipart/form-data">
      					<div class="card-header bg-info"> 
      						<h4 class="card-title text-white">
      							Form Upload Hasil Survei
      						</h4>
      					</div>
      					<div class="card-body">
      						<div class="mb-3">
      							<label>Upload File Hasil Survei</label>
      							<input type="file" class="form-control" name="excel_file" accept=".xlsx" />
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
      					</form>
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
      	</footer>
      	<!-- ============================================================== -->
      	<!-- End footer -->
      	<!-- ============================================================== -->
      </div>
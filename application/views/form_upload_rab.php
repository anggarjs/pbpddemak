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
							echo form_open_multipart('Input/Upload_rab2',$attributes);
						?>					
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Form Upload Hasil Survei
							</h4>
						</div>
						<div class="card-body">		
							<div class="mb-3">
								<label>Upload File Hasil Survei</label>
								<input type="file" class="form-control" name="filerab" />
							</div>
							<?php echo form_error('username'); ?>
							
							
						</div>
						<div class="p-3 border-top">
							<div class="text-end">
								<button
								type="submit"
								class="
								btn btn-info
								rounded-pill
								px-4
								waves-effect waves-light
								"
								>
								Save
								</button>
							</div>
						</div>
						<!-- </form> -->
						<?php echo form_close(); ?>
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
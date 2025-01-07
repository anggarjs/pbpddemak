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
							echo form_open_multipart('Fso/Upload_excel/',$attributes);
							/* echo '<input type="hidden" value="'.$id_capel.'" name="id_capel" />'; */
						?>
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Data Detail Surat Permohonan
							</h4>
						</div>
						<div class="card-body">
							<div class="row pt-3">
								<?php if (isset($_SESSION['alert_upload_excel'])) { ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<i data-feather="alert-triangle"></i>
									<strong><?php echo $_SESSION['alert_upload_excel']; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								<?php 
									$this->session->unset_userdata('alert_upload_excel');
								} ?>
							</div>
							<!-- ROW #1 -->
							<div class="row">
								<div class="col-md-6">						
									<div class="mb-3">
										<label>Asal Unit Kerja</label>
										<?php
											if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
											else $set_select = '';					
											echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-select"');
										?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Permohonan Daya :</label>
									
									</div>
									
								</div>							
							</div>
						
							<div class="row">								
								<div class="mb-3">
									<label>Upload File Koordinat FSO</label>
									<input type="file" class="form-control" name="filerab" id="filerab" />	
								</div>									
							</div>
							<?php echo form_error('filerab'); ?>							
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
								">Upload
      							</button>
      						</div>
      					</div>
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


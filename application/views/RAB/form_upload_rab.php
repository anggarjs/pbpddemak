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
							echo form_open_multipart('Input/Upload_rab',$attributes);
						?>					
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Form Upload Hasil Survei
							</h4>
						</div>
						<div class="card-body">
							<div class="row pt-3">
								<div class="col-md-6">						
									<div class="mb-3">
										<label>Asal Unit Kerja</label>
										<?php
											if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
											else $set_select = '';					
											echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-select"');
										?>
									</div>
									<?php echo form_error('pilihan_ulp'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Nomor Surat AMS / BA Persetujuan</label>
										<input
										  type="text"
										  class="form-control"
										  value="<?php if(set_value('nomor_persetujuan')!='') echo set_value('nomor_persetujuan');?>"
										  name="nomor_persetujuan"
										/>
									</div>
									<?php echo form_error('nomor_persetujuan'); ?>
								</div>							
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label class="control-label">Tgl Diterima Surat Pelanggan</label>
										<input type="date" class="form-control" name="tgl_surat_diterima" 
										value="<?php if(set_value('tgl_surat_diterima')!='') echo set_value('tgl_surat_diterima');?>"/>
									</div>
									<?php echo form_error('tgl_surat_diterima'); ?>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="control-label">Tgl Persetujuan Pelanggan</label>
										<input type="date" class="form-control" name="tgl_persetujuan"
										value="<?php if(set_value('tgl_persetujuan')!='') echo set_value('tgl_persetujuan');?>"/>
									</div>
									<?php echo form_error('tgl_persetujuan'); ?>
								</div>
								<!--/span-->
							</div>							
 							<!-- <div class="mb-3">
								<label>Upload File Surat Permohonan Pelanggan</label>
								<input type="file" class="form-control" name="filerab" />
							</div> -->
							
							
							<div class="row">								
								<div class="mb-3">
									<label>Upload File RAB Hasil Survei</label>
									<input type="file" class="form-control" name="filerab" />	
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
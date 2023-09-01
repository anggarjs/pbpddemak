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
							<div class="mb-3">
								<label>Asal Unit Kerja</label>
								<?php
									if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
									else $set_select = '';					
									echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-select"');
								?>
							</div>
							<?php echo form_error('pilihan_ulp'); ?>
							
							<div class="mb-3">
								<label>Nomor Surat AMS ke UP3</label>
								<input
								  type="text"
								  class="form-control"
								  value="<?php if(set_value('no_surat_ke_up3')!='') echo set_value('no_surat_ke_up3');?>"
								  name="no_surat_ke_up3"
								/>
							</div>
							<?php echo form_error('no_surat_ke_up3'); ?>							
						
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
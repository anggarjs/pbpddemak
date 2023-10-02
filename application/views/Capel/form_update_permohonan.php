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
							echo form_open_multipart('Capel/Update_permohonan/'.$id_capel,$attributes);
							echo '<input type="hidden" value="'.$id_capel.'" name="id_capel" />';
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
										<label>Asal Unit Kerja :</label>
										<?php 			
											echo '<b>'.$id_ulp.'</b>';
										?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Permohonan Daya :</label>
										<?php 			
											echo '<b>'.number_format($srt_daya_awal_capel).' VA'.'</b>';
										?>										
									</div>
									
								</div>							
							</div>
							<!-- ROW #2 -->
							<div class="row">
								<div class="col-md-6">						
									<div class="mb-3">
										<label>Nama Pelanggan :</label>
										<?php 			
											echo '<b>'.$srt_nama_capel.'</b>';
										?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Alamat Pelanggan :</label>
										<?php 			
											echo '<b>'.$srt_alamat_capel.'</b>';
										?>
									</div>
									
								</div>	
							</div>
							<!-- ROW #4 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>Tgl Diterima Surat :</label>
										<?php 			
											$date2 = date_create($tgl_surat_diterima);
											echo '<b>'.date_format($date2,"d-m-Y").'</b>';
										?>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Link Surat Permohonan :</label>
										<a href="<?php echo base_url().$path_file; ?>">Download File</a>
									</div>
								</div>	
							</div>							

							<!-- ROW #5 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>No Surat AMS Surat Diterima :</label>
										<?php 			
											echo '<b>'.$srt_no_ams_capel.'</b>';
										?>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">			
									</div>	
								</div>	
							</div>
											
							
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>	
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Hasil Survei Perluasan :</b></label>
										<?php
											if(set_value('status_perluasan')!='') $set_select = set_value('status_perluasan');
											else $set_select = $id_status_perluasan;	
											echo form_dropdown('status_perluasan',$status_perluasan,$set_select,'class="form-select" id="status_perluasan" onChange="getOption()"');
										?>										
									</div>
									<?php echo form_error('status_perluasan'); ?>
								</div>
							</div>
							<div class="row">								
								<div class="mb-3">
									<label>Upload File RAB Hasil Survei</label>
									<input type="file" class="form-control" name="filerab" id="filerab" disabled />	
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
								">Simpan
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

<script>
    function getOption() {
		var e = document.getElementById("status_perluasan").value;
		if(e < 2)
			document.getElementById("filerab").disabled = true;
		else
			document.getElementById("filerab").disabled = false;
    }	
</script>
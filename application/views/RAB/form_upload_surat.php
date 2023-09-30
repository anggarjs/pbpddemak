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
							echo form_open_multipart('',$attributes);
						?>					
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Form Upload Surat Pelanggan
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
										<label class="control-label">Nama Calon Pelanggan</label>
										<input type="text" class="form-control" name="tgl_surat_diterima" 
										value="<?php if(set_value('tgl_surat_diterima')!='') echo set_value('tgl_surat_diterima');?>"/>
									</div>									

								</div>							
							</div>
							<div class="row">
								<div class="col-md-6">

									<div class="mb-3">
										<label>Nomor Surat AMS Surat Masuk</label>
										<input
										  type="text"
										  class="form-control"
										  value="<?php if(set_value('nomor_surat_')!='') echo set_value('nomor_persetujuan');?>"
										  name="nomor_persetujuan"
										/>
									</div>									
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="control-label">Alamat Calon Pelanggan</label>
										<input type="text" class="form-control" name="tgl_surat_diterima" 
										value="<?php if(set_value('tgl_surat_diterima')!='') echo set_value('tgl_surat_diterima');?>"/>
									</div>		
								</div>
								<!--/span-->
							</div>	
							<div class="row">
								<div class="col-md-6">

									<div class="mb-3">
										<label class="control-label">Tgl AMS Surat Masuk Surat Pelanggan</label>
										<input type="date" class="form-control" name="tgl_surat_diterima" 
										value="<?php if(set_value('tgl_surat_diterima')!='') echo set_value('tgl_surat_diterima');?>"/>
									</div>
									<?php echo form_error('tgl_surat_diterima'); ?>									
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="control-label">Daya Calon Pelanggan</label>
										<input type="text" class="form-control" name="daya_capel_surat"  id="daya_capel_surat"
										/>
									</div>
								</div>
								<!--/span-->
							</div>		
							
							<div class="row">								
								<div class="mb-3">
									<label>Upload File Surat Permohonan Pelanggan</label>
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
<!--	  
<script>
	$(document).ready(function(){
		$('#daya_capel_surat').keyup(function(){
			var search = $(this).val();
			if(search != ''){
				$.ajax({
					type: "POST", // Method pengiriman data bisa dengan GET atau POST
					url: "search.php", // Isi dengan url/path file php yang dituju
					data: {nis : $("#nis").val()}, // data yang akan dikirim ke file proses
					dataType: "json",
					beforeSend: function(e) {
						if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
						}
					},
					success: function(response){ // Ketika proses pengiriman berhasil
						$("#loading").hide(); // Sembunyikan loadingnya

						if(response.status == "success"){ // Jika isi dari array status adalah success
							$("#nama").val(response.nama); // set textbox dengan id nama
							$("#jenis_kelamin").val(response.jenis_kelamin); // set textbox dengan id jenis kelamin
							$("#telepon").val(response.telepon); // set textbox dengan id telepon
							$("#alamat").val(response.alamat); // set textbox dengan id alamat
						}
						else{ // Jika isi dari array status adalah failed
							alert("Data Tidak Ditemukan");
						}
					},
					error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.responseText);
					}
				});
			}

		});
		
	});
</script>
-->
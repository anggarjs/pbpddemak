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
							echo form_open_multipart('Logistik/upload_trafo_rusak',$attributes);
						?>					
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Form Permohonan Trafo Pengganti
							</h4>
						</div>
						<div class="card-body">
							<div class="row pt-3">
								<?php if (isset($_SESSION['alert_upload'])) { ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<i data-feather="alert-triangle"></i>
									<strong><?php echo $_SESSION['alert_upload']; ?></strong>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
								<?php 
									$this->session->unset_userdata('alert_upload');
								} ?>
							</div>		
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
										<label class="control-label">Tgl Trafo Rusak</label>
										<input type="date" class="form-control" name="tgl_trafo_rusak" 
										value="<?php if(set_value('tgl_trafo_rusak')!='') echo set_value('tgl_trafo_rusak');?>"/>
									</div>
									<?php echo form_error('tgl_trafo_rusak'); ?>		
								</div>							
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label>Tipe Trafo</label>
										<?php
											if(set_value('pilihan_tipe_trafo')!='') $set_select = set_value('pilihan_tipe_trafo');
											else $set_select = '';					
											echo form_dropdown('pilihan_tipe_trafo',$pilihan_tipe_trafo,$set_select,'class="form-select"');
										?>
									</div>
									<?php echo form_error('pilihan_tipe_trafo'); ?>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="control-label">No Pole Trafo Rusak <b>(Ganti Tanda "/" dengan "-")</b></label>
										<input type="text" class="form-control" name="no_pole_trafo" 
										value="<?php if(set_value('no_pole_trafo')!='') echo set_value('no_pole_trafo');?>"/>
									</div>
									<?php echo form_error('no_pole_trafo'); ?>
								</div>
								<!--/span-->
							</div>	
							<div class="row">
								<div class="col-md-6">

									<div class="mb-3">
										<label>Merk Trafo</label>
										<?php
											if(set_value('pilihan_merk_trafo')!='') $set_select = set_value('pilihan_merk_trafo');
											else $set_select = '';					
											echo form_dropdown('pilihan_merk_trafo',$pilihan_merk_trafo,$set_select,'class="form-select"');
										?>
									</div>
									<?php echo form_error('pilihan_merk_trafo'); ?>							
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="mb-3">

									</div>
									
								</div>
								<!--/span-->
							</div>		
							
							<div class="row">								
								<div class="mb-3">
									<label>Upload File BA Kronologis dan Hasil Uji Tahanan Isolasi</label>
									<input type="file" class="form-control" name="filesurat" />	
								</div>									
							</div>
							<?php echo form_error('filesurat'); ?>
							
							
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
	function get_merk_trafo(x){
		var $y = jQuery.noConflict();
	    var prp = x.options[x.selectedIndex].value;
		  	$y.ajax({
				url: "<?php echo base_url()?>index.php/logistik/get_merk_trafo/",
				global: false,
				type: "POST",
				async: false,
				dataType: "html",
				data: "lokasi="+ prp, //the name of the $_POST variable and its value
				success: function (response) {
					var dynamic_options2 = $y("*").index( $y('.dynamic6')[0] );
					if ( dynamic_options2 != (-1)) 
						$y(".dynamic6").remove();
						$y("#pilihan_tipe_trafo").append(response);
						$y(".third").attr({selected: ' selected'});
	            }          
			});
		  return false;
	}	
	</script>	  
	  
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
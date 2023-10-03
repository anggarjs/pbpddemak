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
							echo form_open('Capel/ACC_Pelanggan/'.$id_capel,$attributes);
							echo '<input type="hidden" value="'.$id_capel.'" name="id_capel" />';
							echo '<input type="hidden" value="'.$id_ulp.'" name="id_ulp" />';
						?>					
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Konfirmasi Data Upload
							</h4>
						</div>
						<div class="card-body">
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
										<label>Daya Lama Pelanggan :</label>
										<?php 			
											echo '<b>'.number_format($daya_lama).' VA'.'</b>';
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
											echo '<b>'.$nama_capel.'</b>';
										?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Daya Baru Pelanggan :</label>
										<?php 			
											echo '<b>'.number_format($daya_baru).' VA'.'</b>';
										?>
									</div>
									
								</div>	
							</div>
							<!-- ROW #3 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>Tgl Diterima Surat Pelanggan :</label>
										<?php 			
											$date = date_create($tgl_surat_diterima);
											echo '<b>'.date_format($date,"d-m-Y").'</b>';
										?>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Biaya Penyambungan :</label>
										<?php 			
											echo '<b>'.'Rp '.number_format($biaya_penyambungan).'</b>';
										?>
									</div>
								</div>	
							</div>
							<!-- ROW #4 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>Tgl Persetujuan :</label>
										<?php 														
											if(!is_null($tgl_persetujuan)){
												/* echo '<b>'.$tgl_lengkap_material.'</b>'; */
												$date4 = date_create($tgl_persetujuan);
												echo '<b>'.date_format($date4,"d-m-Y").'</b>';
											}											
										?>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Biaya Investasi :</label>
										<?php 			
											echo '<b>'.'Rp '.number_format($biaya_investasi).'</b>';
										?>
									</div>
								</div>	
							</div>							

							<!-- ROW #5 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>No Surat AMS / BA Persetujuan :</label>
										<?php 			
											echo '<b>'.$nomor_persetujuan.'</b>';
										?>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Link RAB :</label>
										<a href="<?php echo base_url().$path_file; ?>">Download File</a>
									</div>	
								</div>	
							</div>
							
							<!-- ROW #5 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>Status Material :</label>
										<?php 			
											echo '<b>'.$status_material.'</b>';
										?>	
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Keterangan Material :</label>
										<?php 			
											echo '<b>'.$keterangan_material.'</b>';
										?>									
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label>Tgl Pengecekan Material :</label>
										<?php
											if(!is_null($tgl_lengkap_material)){
												/* echo '<b>'.$tgl_lengkap_material.'</b>'; */
												$date3 = date_create($tgl_lengkap_material);
												echo '<b>'.date_format($date3,"d-m-Y").'</b>';
											}
										?>	
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Tgl Pembayaran Pelanggan :</label>
										<?php
											if(!is_null($tgl_bayar_plgn)){
												/* echo '<b>'.$tgl_lengkap_material.'</b>'; */
												$date2 = date_create($tgl_bayar_plgn);
												echo '<b>'.date_format($date2,"d-m-Y").'</b>';
											}
										?>								
									</div>	
								</div>	
							</div>
							
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>
							<!-- ROW #8 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Tanggal Persetujuan dari UP3 :</b></label>
										<input type="date" class="form-control" name="tgl_persetujuan" 
										value="<?php if(set_value('tgl_persetujuan')!='') echo set_value('tgl_persetujuan');?>"/>										
									</div>
									<?php echo form_error('tgl_persetujuan'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label>No Surat AMS Persetujuan dari UP3 :</label>
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
						
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>								
							<!-- ROW #7 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Data List Material :</b></label>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
									</div>	
								</div>	
							</div>
							<div class="table-responsive">
								<table id="tabel-update-capel" style="width: 100%;" class="table table-striped table-bordered text-nowrap" >
									<thead>
									
										<tr>
											<th>No</th>
											<th>Nama Material</th>
											<th>Satuan</th>
											<th>Volume</th>
											<th>Status Ketersediaan</th>
										</tr>
										
									</thead>
									<tbody>
										<?php
										$i		= 1;
										foreach ($data_material->result() as $row) {
											echo '<tr>';
											echo '<td>' . $i . '</td>';
											echo '<td>' . $row->nama_detail_mdu . '</td>';
											echo '<td>' . $row->satuan . '</td>';
											echo '<td>' . $row->volume_mdu . '</td>';
											if($row->status_tersedia > 0){
												echo '<td> <input type="checkbox" disabled class="form-check-input" id="customCheck3" checked name="status_tersedia[]" value="'.$row->id_rincian_mdu.'"/></td>';
											} else {
												echo '<td> <input type="checkbox" disabled class="form-check-input" id="customCheck3" name="status_tersedia[]" value="'.$row->id_rincian_mdu.'"/></td>';												
											}
											echo '</tr>';
											$i++;
										}
										?>
									</tbody>

								</table>
							</div>					
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
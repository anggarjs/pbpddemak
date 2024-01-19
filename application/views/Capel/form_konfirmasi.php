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
							echo form_open('Capel/Update_Persetujuan/'.$id_capel,$attributes);
							echo '<input type="hidden" value="'.$id_capel.'" name="id_capel" />';
							echo '<input type="hidden" value="'.$path_file.'" name="path_file" />';
							echo '<input type="hidden" value="'.$payback_period.'" name="payback_period" />';
							echo '<input type="hidden" value="'.$kesimpulan.'" name="kesimpulan" />';
							echo '<input type="hidden" value="'.$daya_baru.'" name="daya_baru" />';
							echo '<input type="hidden" value="'.$id_ulp.'" name="id_ulp" />';
							echo '<input type="hidden" value="'.$nama_capel.'" name="nama_capel" />';
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
										<?php echo '<b>'.$id_ulp.'</b>'; ?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Permohonan Daya Awal :</label>
										<?php 			
											echo '<b>'.number_format($srt_daya_awal_capel).' VA'.'</b>';
										?>									
									</div>
									
								</div>
							</div>	
							<div class="row">
								<div class="col-md-6">						
									<div class="mb-3">
										<label>Nama Pelanggan di Surat :</label>
										<?php echo '<b>'.$srt_nama_capel.'</b>'; ?>
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
										<label>Nama Pelanggan Hasil Survei :</label>
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
										<label>Hasil KKF Payback Period :</label>
										<?php 			
											/* echo '<b>'.$payback_period.' Tahun </b>'; */
											echo '<b>'.number_format($payback_period,2).' Tahun </b>';
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
										<label>Kesimpulan :</label>										
										<?php 			
											echo '<b>'.$kesimpulan.'</b>';
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
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>
							<!-- ROW #8 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Tanggal Persetujuan :</b></label>
										<input type="date" class="form-control" name="tgl_persetujuan" 
										value="<?php if(set_value('tgl_persetujuan')!='') echo set_value('tgl_persetujuan');?>"/>										
									</div>
									<?php echo form_error('tgl_persetujuan'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label>No BA Persetujuan dari ULP :</label>
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
							<!-- ROW #8 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Rencana Tanggal Bayar Plgn :</b></label>
										<input type="date" class="form-control" name="rencana_tgl_byr_plgn" 
										value="<?php if(set_value('rencana_tgl_byr_plgn')!='') echo set_value('rencana_tgl_byr_plgn');?>"/>										
									</div>
									<?php echo form_error('rencana_tgl_byr_plgn'); ?>
								</div>
								<div class="col-md-6">
								</div>	
							</div>									

							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>								
							<!-- ROW #7 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Data List Tiang Beton :</b></label>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
									</div>	
								</div>	
							</div>
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered text-nowrap" >
									<thead>
									<!-- start row -->
										<tr>
											<th>No</th>
											<th>Tipe Tiang Beton</th>
											<th>Satuan</th>
											<th>Volume</th>
										</tr>
										<!-- end row -->
									</thead>
									<tbody>
										<?php
										$i		= 1;
										foreach ($data_tibet as $row) {
											echo '<tr>';
											echo '<td>' . $i . '</td>';
											echo '<td>' . $row['nama'] . '</td>';
											echo '<td>' . $row['satuan'] . '</td>';
											echo '<td>' . $row['volume'] . '</td>';
											echo '</tr>';
											$i++;
										}
										?>
									</tbody>

								</table>
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
								<table id="zero_config" class="table table-striped table-bordered text-nowrap" >
									<thead>
									<!-- start row -->
										<tr>
											<th>No</th>
											<th>Nama Material</th>
											<th>Satuan</th>
											<th>Volume</th>
										</tr>
										<!-- end row -->
									</thead>
									<tbody>
										<?php
										$i		= 1;
										foreach ($data_material as $row) {
											echo '<tr>';
											echo '<td>' . $i . '</td>';
											echo '<td>' . $row['nama'] . '</td>';
											echo '<td>' . $row['satuan'] . '</td>';
											echo '<td>' . $row['volume'] . '</td>';
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
								type="button"
								class="								
								btn btn-danger
								rounded-pill
								px-4
								waves-effect waves-light"
								
								onclick="location.href='<?php echo base_url()?>Capel/Batal_Upload/<?php echo $id_ulp ?>/<?php echo $id_capel ?>';"
								>
      								Batal
      							</button>							
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
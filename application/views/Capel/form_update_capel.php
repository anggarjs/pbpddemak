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
							echo form_open('Capel/Update/'.$id_capel,$attributes);
							echo '<input type="hidden" value="'.$id_capel.'" name="id_capel" />';
						?>
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Update Progress Capel
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
										<label>Tgl Surat Permohonan Plgn :</label>
										<?php 			
											$date = date_create($tgl_surat_plgn);
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
										<label>Tgl Surat AMS ke UP3 :</label>
										<?php 			
											$date2 = date_create($tgl_ams_up3);
											echo '<b>'.date_format($date2,"d-m-Y").'</b>';
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
										<label>No Surat AMS ke UP3 :</label>
										<?php 			
											echo '<b>'.$nomor_surat_ulp_up3.'</b>';
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
										<label><b>Update Progress Pelanggan :</b></label>
										<?php
											if(set_value('status_capel')!='') $set_select = set_value('status_capel');
											else $set_select = $id_status_capel;				
											echo form_dropdown('status_capel',$status_capel,$set_select,'class="form-select"');
										?>										
									</div>
									<?php echo form_error('status_capel'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label>Nomor Surat AMS ke ULP</label>
										<input
										  type="text"
										  class="form-control"
										  value="<?php if(set_value('nomor_surat_up3_ulp')!='') echo set_value('nomor_surat_up3_ulp');?>"
										  name="nomor_surat_up3_ulp"
										/>									
									</div>
									<?php echo form_error('nomor_surat_up3_ulp'); ?>
								</div>	
							</div>

							<!-- ROW #8 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label class="control-label">Tgl Surat AMS Persetujuan ke ULP</label>
										<input type="date" class="form-control" name="tgl_persetujuan_up3" 
										value="<?php if(set_value('tgl_persetujuan_up3')!='') echo set_value('tgl_persetujuan_up3');?>"/>
									</div>
									<?php echo form_error('tgl_persetujuan_up3'); ?>
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
								<table id="zero_config" class="table table-striped table-bordered text-nowrap" >
									<thead>
									
										<tr>
											<th>No</th>
											<th>Nama Material</th>
											<th>Satuan</th>
											<th>Volume</th>
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
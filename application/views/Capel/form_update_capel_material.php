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
							echo form_open('Capel/Update_material/'.$id_capel,$attributes);
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
											$date2 = date_create($tgl_persetujuan);
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
						
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>
							<!-- ROW #8 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Update Progress Material :</b></label>
										<?php
											if(set_value('status_material')!='') $set_select = set_value('status_material');
											else $set_select = $id_status_material;				
											echo form_dropdown('status_material',$status_material,$set_select,'class="form-select"');
										?>										
									</div>
									<?php echo form_error('status_material'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label>Keterangan Tambahan</label>
										<textarea class="form-control"
										name="keterangan_material"
										rows="5"><?php 
										if(set_value('keterangan_material')!='') 
											echo set_value('keterangan_material');
										else
											echo $keterangan_material;
										?></textarea>
									</div>
									<?php echo form_error('keterangan_material'); ?>
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
								<table id="zero_config" class="table table-striped table-bordered text-nowrap">
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
											if($row->status_tersedia == 1)
												echo '<td> <input type="checkbox" class="form-check-input" id="customCheck3" checked name="status_tersedia[]" value="'.$row->id_rincian_mdu.'"/></td>';
											else
												echo '<td> <input type="checkbox" class="form-check-input" id="customCheck3" name="status_tersedia[]" value="'.$row->id_rincian_mdu.'"/></td>';
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
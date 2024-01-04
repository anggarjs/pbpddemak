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
							echo form_open_multipart('Logistik/Update_Material_Rusak/'.$id_material_rusak,$attributes);
							echo '<input type="hidden" value="'.$id_material_rusak.'" name="id_material_rusak" />';

							
						?>
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Update Status Material Rusak
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
										<label>No Pole Material Rusak :</label>
										<?php 			
											echo '<b>'.$no_pole_material_rusak.'</b>';
										?>
									</div>
								</div>
							</div>
							
							<!-- ROW #2 -->
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label>Jenis Material Rusak :</label>
										<?php 			
											echo '<b>'.$nama_detail_mdu.'</b>';
										?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Merk Material Rusak :</label>
										<?php 			
											echo '<b>'.$nama_merk_material.'</b>';
										?>
									</div>
								</div>
							</div>
							
							<!-- ROW #3 -->
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label>Tanggal Kerusakan Material :</label>
										<?php 			
											/* echo '<b>'.$tgl_lengkap_material.'</b>'; */
											$date2 = date_create($tgl_material_rusak);
											echo '<b>'.date_format($date2,"d-m-Y").'</b>';													
										?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Link BA Kronologis :</label>
											<a href="<?php echo base_url().$path_file; ?>">Download File</a>
									</div>
									
								</div>							
							</div>

							
							
							<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>
							<!-- ROW #8 -->
							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Update Status Material Rusak :</b></label>
										<?php
											if(set_value('status_material')!='') $set_select = set_value('status_material');
											else $set_select = $id_status_material_rusak;			
											echo form_dropdown('status_material',$status_material,$set_select,'class="form-select" ');
										?>										
									</div>
									<?php echo form_error('status_material'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label class="control-label"><b>Tgl Penggantian Material</b></label>
										<input type="date" class="form-control" name="tgl_diganti_material" 
										value="<?php 
										if(set_value('tgl_diganti_material')!='') 
											echo set_value('tgl_diganti_material');
										else
											echo $tgl_diganti_material;
										?>"/>
										
									</div>
									<?php echo form_error('tgl_diganti_material'); ?>
								</div>	
							</div>

							<div class="row">
								<div class="col-md-6">	
									<div class="mb-3">
										<label><b>Vendor Pengembali Material :</b></label>
										<input
										  type="text"
										  class="form-control"
										  value="<?php if(set_value('catatan_vendor_retur')!='') echo set_value('catatan_vendor_retur');?>"
										  name="catatan_vendor_retur"
										/>										
									</div>
									<?php echo form_error('catatan_vendor_retur'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">	
										<label class="control-label"><b>Tgl Retur ke Gudang</b></label>
										<input type="date" class="form-control" name="tgl_material_retur" 
										value="<?php 
										if(set_value('tgl_material_retur')!='') 
											echo set_value('tgl_material_retur');
										else
											echo $tgl_material_retur;
										?>"/>
									</div>
									<?php echo form_error('tgl_material_retur'); ?>
								</div>
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
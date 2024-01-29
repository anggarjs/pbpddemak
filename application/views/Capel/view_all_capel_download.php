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
      					<div class="card-header bg-info">
      						<h4 class="card-title text-white">
      							Data Seluruh Pelanggan
      						</h4>
      					</div>
      					<div class="card-body">
      						<h6 class="card-subtitle mb-3">
      							<div class="table-responsive">
      								<table                       id="file_export"
                      class="
                        table table-striped table-bordered
                        display
                        text-nowrap
                      " style="width: 100%;" >
      									<thead>
      										<!-- start row -->
      										<tr>
												
												<th>Nama ULP</th>
      											<th>Nama Plgn</th>
												<th>Daya Lama</th>
      											<th>Potensi Daya Baru</th>
												<th>BP</th>
												<th>RAB</th>
												<th>Status Capel</th>
      											<th>Status Material</th>
												<th>Tgl Surat Diterima</th>
												<th>Tanggal Entri Aplikasi</th>
												<th>Tanggal Persetujuan dari UP3</th>
      											<th>Tgl Lgkp Material</th>
												<th>Selisih Hari</th>
<th>Rencana Tgl Bayar</th>														
      										</tr>
      										<!-- end row -->
      									</thead>
      									<tbody>
      										<?php foreach ($data_capel->result() as $data) : ?>
      											<tr>
											
													<td><?= $data->nama_ulp; ?></td>
													<td><?php 
														if($data->nama_capel)
															echo $data->nama_capel;
														else
															echo $data->srt_nama_capel;														
													?></td>
													<td><?= number_format($data->daya_lama); ?></td>
													<td><?php 
														if($data->srt_daya_awal_capel < 1)
															echo number_format($data->daya_baru);
														else
															echo number_format($data->srt_daya_awal_capel);														
													?></td>
													<td><?= number_format($data->biaya_penyambungan); ?></td>
													<td><?= number_format($data->biaya_investasi); ?></td>
													<td><?= $data->status_capel; ?></td>		
													<td><?= $data->status_material; ?></td>
													<td><?= date_format(date_create($data->tgl_surat_diterima),"d-m-Y"); ?></td>
													<td>
														<?php 
															if(!is_null($data->tgl_entry_aplikasi))
															echo date_format(date_create($data->tgl_entry_aplikasi), "d-m-Y");
														?>
													</td>
													<td>
													<?php 
															if(!is_null($data->tgl_persetujuan))
															echo date_format(date_create($data->tgl_persetujuan), "d-m-Y");
														?>
													</td>
													<td><?php
														if(!is_null($data->tgl_lengkap_material))
															echo date_format(date_create($data->tgl_lengkap_material),"d-m-Y"); 
														

														?>
													</td>
													<td><?= $data->SELISIH_HARI; ?> Hari </td>
													<td><?php
														if(!is_null($data->rencana_tgl_byr_plgn))
															echo date_format(date_create($data->rencana_tgl_byr_plgn),"d-m-Y"); 
														

														?> </td>	
      											</tr>
      										<?php endforeach; ?>
      									</tbody>
      								</table>
      							</div>
      					</div>
      				</div>
      			</div><!-- end <div class="col-12"> -->
      		</div>
      		<!-- End Row -->
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
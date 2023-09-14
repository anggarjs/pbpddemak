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
      							Data Material belum terpenuhi
      						</h4>
      					</div>
      					<div class="card-body">
      						<h6 class="card-subtitle mb-3">
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered text-nowrap">
										<thead>
											<tr>
												<th>Nama ULP</th>
												<th>Nama Capel</th>
												<th>Daya Capel</th>
												<th>Nama Material</th>
												<th>Volume</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($material_kurang as $material) : ?>
											<tr>
												<td><?php echo html_escape($material->nama_ulp); ?></td>
												<td><?php echo html_escape($material->nama_capel); ?></td>
												<td><?php echo html_escape(number_format($material->daya_baru)); ?></td>
												<td><?php echo html_escape($material->nama_detail_mdu); ?></td>
												<td><?php echo html_escape($material->volume_mdu); ?></td>
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
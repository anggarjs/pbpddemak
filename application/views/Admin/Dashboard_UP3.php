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
			<div class="card-group">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
									<i class="ri-emotion-line fs-6 text-muted"></i>
									<p class="fs-4 mb-1">Pelanggan Disetujui</p>
									</div>
									<div class="ms-auto">
									<h1 class="fw-light text-end"><?php echo $total_plgn ?></h1><h4>Plgn</h4>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="progress">
									<div
									class="progress-bar bg-info"
									role="progressbar"
									style="width: 75%; height: 6px"
									aria-valuenow="25"
									aria-valuemin="0"
									aria-valuemax="100"
									></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
									 <i class="ri-bar-chart-fill fs-6 text-muted"></i>
									<p class="fs-4 mb-1">Total Daya Disetujui</p>
									</div>
									<div class="ms-auto">
									<h1 class="fw-light text-end"><?php echo number_format($delta_daya,2) ?></h1><h4>MVA</h4>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="progress">
									<div
									class="progress-bar bg-info"
									role="progressbar"
									style="width: 75%; height: 6px"
									aria-valuenow="25"
									aria-valuemin="0"
									aria-valuemax="100"
									></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
									<i class="ri-money-dollar-circle-line fs-6 text-muted"></i>
									<p class="fs-4 mb-1">Total Biaya Penyambungan</p>
									</div>
									<div class="ms-auto">
									<h1 class="fw-light text-end"><?php echo number_format($biaya_penyambungan) ?></h1><h4>Juta Rp</h4>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="progress">
									<div
									class="progress-bar bg-info"
									role="progressbar"
									style="width: 75%; height: 6px"
									aria-valuenow="25"
									aria-valuemin="0"
									aria-valuemax="100"
									></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="d-flex no-block align-items-center">
									<div>
									<i class="ri-money-dollar-circle-line fs-6 text-muted"></i>
									<p class="fs-4 mb-1">Total Biaya Investasi</p>
									</div>
									<div class="ms-auto">
									<h1 class="fw-light text-end"><?php echo number_format($biaya_investasi) ?></h1><h4>Juta Rp</h4>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="progress">
									<div
									class="progress-bar bg-info"
									role="progressbar"
									style="width: 75%; height: 6px"
									aria-valuenow="25"
									aria-valuemin="0"
									aria-valuemax="100"
									></div>
								</div>
							</div>
						</div>
					</div>
				</div>					
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
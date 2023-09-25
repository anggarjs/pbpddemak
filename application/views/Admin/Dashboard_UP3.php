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
				<div class="col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-7">
									<i class="ri-emotion-line fs-6 text-info"></i>
									<p class="fs-4 mb-1">Capel</p>
								</div>
								<div class="col-5">
									<h2 class="fw-light text-end mb-0"><?php echo $total_plgn ?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-5">
									<i class="ri-money-dollar-circle-line fs-6 text-purple"></i>
									<p class="fs-4 mb-1">BP (Rp)</p>
								</div>
								<div class="col-7">
									<h2 class="fw-light text-end mb-0"><?php echo number_format($biaya_penyambungan,2) ?> M</h2>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-5">
									<i class="ri-money-dollar-circle-line fs-6 text-purple"></i>
									<p class="fs-4 mb-1">Inv (Rp)</p>
								</div>
								<div class="col-7">
									<h2 class="fw-light text-end mb-0"><?php echo number_format($biaya_investasi,2) ?> M</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="card">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-4">
									<i class="ri-bar-chart-fill fs-6 text-danger"></i>
									<p class="fs-4 mb-1">Daya</p>
								</div>
								<div class="col-8">
									<h2 class="fw-light text-end mb-0"><?php echo number_format($delta_daya,2) ?> MVA</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-lg-4 d-flex align-items-stretch">
					<div class="card w-100">
						<div class="card-body">
						<h4 class="card-title">Progress Pelanggan</h4>
						<div id="pelanggan-status" class="status mt-4"></div>
						<div class="row mt-4">
							<div class="col-4 border-end">
								<i
								class="ri-checkbox-blank-circle-fill fs-4 text-primary"
								></i>
								<h4 class="mb-0 font-weight-medium"><?php echo $lengkap ?></h4>
								<span>Lengkap Material</span>
							</div>
							<div class="col-4 border-end">
								<i
								class="ri-checkbox-blank-circle-fill fs-4 text-info"
								></i>
								<h4 class="mb-0 font-weight-medium"><?php echo $blm_lengkap ?></h4>
								<span>Belum Lengkap Material</span>
							</div>
							<div class="col-4 p-l-20">
								<i
								class="ri-checkbox-blank-circle-fill fs-4 text-success"
								></i>
								<h4 class="mb-0 font-weight-medium"><?php echo $blm_pengecekan ?></h4>
								<span>Belum Pengecekan</span>
							</div>
						</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-lg-8 d-flex align-items-stretch">
					<div class="card w-100">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h4 class="card-title">Yearly Comparison</h4>
								</div>
								<div class="ms-auto">
								<div class="">
									<select class="form-select">
									<option value="0" selected="">2021</option>
									<option value="1">2015</option>
									<option value="2">2016</option>
									<option value="3">2017</option>
									</select>
								</div>
								</div>
							</div>
						<div id="yearly-comparison" class="mt-4"></div>
						<ul class="list-inline mt-4 text-center fs-2">
							<li class="list-inline-item text-muted">
								<i
								class="
								ri-checkbox-blank-circle-fill
								fs-3
								align-middle
								text-info
								me-1
								"
								></i>
								This Year
							</li>
							<li class="list-inline-item text-muted">
								<i
								class="
								ri-checkbox-blank-circle-fill
								fs-3
								align-middle
								text-light
								me-1
								"
								></i>
								Last Year
							</li>
							</ul>
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
	  
<script>
// -------------------------------------------------------------------------------------------------------------------------------------------
// Dashboard 3 : Chart Init Js
// -------------------------------------------------------------------------------------------------------------------------------------------
$(function () {
  "use strict";
  var campaign_status = {
   <?php echo $js_script ?>
    chart: {
      type: "donut",
      fontFamily: "Rubik,sans-serif",
      height: 250,
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      width: 0,
    },
    plotOptions: {
      pie: {
        expandOnClick: true,
        donut: {
          size: "73",
          labels: {
            show: true,
            name: {
              show: true,
              offsetY: 10,
            },
            value: {
              show: false,
            },
            total: {
              show: true,
              fontSize: "13px",
              color: "#a1aab2",
              label: "Status",
            },
          },
        },
      },
    },
    colors: ["#137eff", "#8b5edd", "#5ac146"],
    tooltip: {
      show: true,
      fillSeriesColor: false,
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 426,
        options: {
          chart: {
            height: 220,
          },
        },
      },
    ],
  };

  var chart_pie_donut = new ApexCharts(
    document.querySelector("#pelanggan-status"),
    campaign_status
  );
  chart_pie_donut.render();

});

</script>
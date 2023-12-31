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
									<p class="fs-4 mb-1">Potensi Capel</p>
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
								<h4 class="mb-0 font-weight-medium"><?php echo $lengkap ?></h4> Plgn
								<span>Lengkap Material</span>
							</div>
							<div class="col-4 border-end">
								<i
								class="ri-checkbox-blank-circle-fill fs-4 text-info"
								></i>
								<h4 class="mb-0 font-weight-medium"><?php echo $blm_lengkap ?></h4> Plgn
								<span>Belum Lengkap Material</span>
							</div>
							<div class="col-4 p-l-20">
								<i
								class="ri-checkbox-blank-circle-fill fs-4 text-success"
								></i>
								<h4 class="mb-0 font-weight-medium"><?php echo $blm_pengecekan ?></h4> Plgn
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
									<h4 class="card-title">Potensi Pelanggan Belum Peremajaan</h4>
								</div>
							</div>
						<div id="yearly-comparison" class="mt-4"></div>

						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
            <!-- column -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Durasi Capel Belum Pembayaran</h4>
							<h6 class="card-title">Note : Sudah Disetujui dan Lengkap Material</h6>
						</div>
						<div id="yearly-comparison" class="mt-4"></div>
					</div>
				</div>
            <!-- column -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-body">
							<div class="to-do-widget mt-3 common-widget scrollable" style="height: 438px" >
							<ul class="list-task todo-list list-group mb-0" data-role="tasklist">
							</ul>
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

	var options = {
 <?php echo $js_series_plgn ?>

	  chart: {
	  type: 'bar',
	  height: 350
	},
	plotOptions: {
	  bar: {
		horizontal: false,
		columnWidth: '55%',
		endingShape: 'rounded'
	  },
	},
	dataLabels: {
	  enabled: false
	},
	stroke: {
	  show: true,
	  width: 2,
	  colors: ['transparent']
	},
	xaxis: {
	  <?php echo $js_nama_ulp ?>
	},
	yaxis: {
	  title: {
		text: '(kVA)'
	  }
	},
	fill: {
	  opacity: 1
	},
	tooltip: {
	  y: {
		formatter: function (val) {
		  return "Daya : " + val + " kVA"
		}
	  }
	}
	};

	var chart = new ApexCharts(document.querySelector("#yearly-comparison"), options);
	chart.render();

});

</script>
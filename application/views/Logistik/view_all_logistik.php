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
							Data Material Kurang PBPD
						</h4>
					</div>
					<div class="card-body">
						<form class="" method="get">
							<div class="input-group mb-3">
								<button class="btn btn-outline-secondary" type="submit"><i data-feather="search"></i></button>
								<input type="search" class="form-control" name="nama_detail_mdu" placeholder="Cari Data" value="<?= html_escape($nama_detail_mdu) ?>" required />
							</div>
						</form>
						<div class="mt-3 overflow-scroll">
							<table style="width: 100%;" class="table table-bordered table hover no-wrap" id="tabel-view-materialkurang">
								<?php if ($search_mdu) : ?>
									<thead>
										<tr>
											<th>Pengecekan</th>
											<th>Nama Detail MDU</th>
											<th>Volume MDU</th>
											<th>Jumlah Pelanggan</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($search_mdu as $mdu) : ?>
											<tr>
												<td class="text-info text-center"><a href="<?php echo base_url('Logistik/detailMaterial'); ?>"><i data-feather="edit"></i></a></td>
												<td><?php echo html_escape($mdu->nama_detail_mdu); ?></td>
												<td><?php echo html_escape($mdu->volume); ?></td>
												<td><?php echo html_escape($mdu->jumlah_pelanggan); ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								<?php else : ?>
									<?php if ($nama_detail_mdu) : ?>
										<tbody>
											<tr>
												<td><strong>Data Tidak Ditemukan</strong></td>
											</tr>
										</tbody>
									<?php endif; ?>
								<?php endif; ?>
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
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
      							Data User
      						</h4>
      					</div>
      					<div class="card-body">
      						<h6 class="card-subtitle mb-3">
      							<div class="table-responsive">
      								<?php if ($this->session->flashdata('success_insert')) : ?>
      									<div class="alert alert-success alert-dismissible fade show" role="alert">
      										<i data-feather="check"></i>
      										<strong><?php echo $this->session->flashdata('success_insert'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<?php if ($this->session->flashdata('success_edit')) : ?>
      									<div class="alert alert-success alert-dismissible fade show" role="alert">
      										<i data-feather="check"></i>
      										<strong><?php echo $this->session->flashdata('success_edit'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<?php if ($this->session->flashdata('success_hapus')) : ?>
      									<div class="alert alert-success alert-dismissible fade show" role="alert">
      										<i data-feather="check"></i>
      										<strong><?php echo $this->session->flashdata('success_hapus'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
      								<?php if ($this->session->flashdata('gagal_hapus')) : ?>
      									<div class="alert alert-danger alert-dismissible fade show" role="alert">
      										<i data-feather="alert-triangle"></i>
      										<strong><?php echo $this->session->flashdata('gagal_hapus'); ?></strong>
      										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      									</div>
      								<?php endif; ?>
								
      								<form action="<?php echo base_url('User/hapus_user_selected'); ?>" method="post">
										<button id="addRow" 
											class="btn btn-info"
											onclick="location.href='<?php echo base_url()?>User/Tambah/';"
										>
											<i data-feather="plus" class="feather-sm"></i>&nbsp; Tambah Data
										</button>
										<button id="addRow" 
											class="btn btn-danger"
											type="submit"
											name="hapus_user"
										>
											<i data-feather="minus" class="feather-sm"></i>&nbsp; Hapus Data
										</button>
										<h5 class="card-subtitle mb-3 border-bottom pb-3"></h5>		
										
      									<table style="width: 100%" id="tabel-view-user" class="no-wrap table-bordered table-hover table">
      										<thead>
      											<!-- start row -->
      											<tr style="vertical-align: middle;">
      												<th width = "5%">
      													<div class="d-flex justify-content-center">
      														<div class="form-check">
      															<input class="form-check-input" type="checkbox" id="checklist-user">
      														</div>
      													</div>
      												</th>
      												<th width = "5%">Action</th>
      												<th>Nama User</th>
      												<th>Asal Unit Kerja</th>
      												<th>Role User</th>
      											</tr>
      											<!-- end row -->
      										</thead>
      										<tbody>
      											<?php foreach ($data_users->result() as $row) : ?>
      												<tr>
      													<td>
      														<div class="d-flex justify-content-center">
      															<div class="form-check">
      																<input class="form-check-input" style="position: relative; right: 7px;" type="checkbox" value="<?php echo $row->id_user; ?>" id="flexCheckDefault" name="check[]">
      															</div>
      														</div>
      													</td>
      													<td>
      														<div class="d-flex justify-content-around">
      															<a href="<?php echo base_url('User/Edit/') . $row->id_user; ?>">
      																<span style="position: relative; bottom:2px;" class="text-info"><i data-feather="edit"></i></span>
      															</a>
      														</div>
      													</td>
      													<td><?php echo $row->nama_user; ?></td>
      													<td><?php echo $row->nama_ulp; ?></td>
      													<td><?php echo $row->nama_role; ?></td>
      												<?php endforeach; ?>
      												<!-- end row -->
      												</tr>
      										</tbody>
      									</table>
      								</form>
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
      <script>
      	// Membuat checklist
      	document.addEventListener("DOMContentLoaded", function() {
      		// Daftar elemen checkbox "checklist all" dan checkbox data
      		var checkboxGroups = [{
      			checklistAll: document.getElementById("checklist-user"),
      			checkboxes: document.querySelectorAll('input[name="check[]"]')
      		}, ];
      		// end checklist

      		// Tambahkan event listener untuk setiap grup checkbox
      		checkboxGroups.forEach(function(group) {
      			group.checklistAll.addEventListener("change", function() {
      				// Set status checkbox data berdasarkan status checkbox "checklist all"
      				group.checkboxes.forEach(function(checkbox) {
      					checkbox.checked = group.checklistAll.checked;
      				});
      			});
      		});
      	});

      	// sweetalert hapus
      	document.addEventListener('DOMContentLoaded', function() {
      		// Daftar tombol hapus
      		var deleteButtons = document.querySelectorAll('.hapus-data-user');

      		// Tambahkan event listener untuk setiap tombol hapus
      		deleteButtons.forEach(function(button) {
      			button.addEventListener('click', function(event) {
      				event.preventDefault(); // Mencegah aksi default dari tombol hapus

      				// Tampilkan SweetAlert konfirmasi
      				Swal.fire({
      					title: 'Konfirmasi',
      					text: 'Apakah Anda yakin ingin menghapus data ini?',
      					icon: 'warning',
      					showCancelButton: true,
      					confirmButtonText: 'Hapus',
      					cancelButtonText: 'Batal'
      				}).then((result) => {
      					if (result.isConfirmed) {
      						// Arahkan ke URL penghapusan data
      						button.closest('form').submit();
      					}
      				});
      			});
      		});
      	});
      	// end sweetalert hapus
      </script>
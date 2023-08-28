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
      							Form Penambahan Data Capel
      						</h4>
      					</div>
      					<div class="card-body">
							<div class="mb-3">
								<form action="<?php echo base_url('index.php/Capel/Tambah');?>" method="post">
      							<label>Nama Capel</label>
      							<input type="text" name="nama_capel" id="nama_capel" class="form-control <?php echo (form_error('nama_capel')) ? 'is-invalid' : ''; ?>" />
      							<div class="invalid-feedback">
									<?php if(form_error('nama_capel') == true) : ?>
										<?= form_error('nama_capel'); ?>
									<?php endif; ?>
								</div>
      						</div>
      						<div class="mb-3">
      							<label>Daya Capel</label>
      							<input type="number" name="daya_capel" id="daya_capel" class="form-control <?php echo (form_error('daya_capel')) ? 'is-invalid' : ''; ?>" />
								<div class="invalid-feedback">
									<?php if(form_error('daya_capel') == true) : ?>
										<?= form_error('daya_capel'); ?>
									<?php endif; ?>
								</div>
							</div>
      						<div class="mb-3">
      							<label>Biaya Penyambungan</label>
      							<input type="number" name="biaya_penyambungan" id="biaya_penyambungan" class="form-control <?php echo (form_error('biaya_penyambungan')) ? 'is-invalid' : ''; ?>" />
								<div class="invalid-feedback">
									<?php if(form_error('biaya_penyambungan') == true) : ?>
										<?= form_error('biaya_penyambungan'); ?>
									<?php endif; ?>
								</div>
							</div>
      						<div class="mb-3">
      							<label>Biaya Investasi</label>
      							<input type="number" name="biaya_investasi" id="biaya_investasi" class="form-control <?php echo (form_error('biaya_investasi')) ? 'is-invalid' : ''; ?>" />
								<div class="invalid-feedback">
									<?php if(form_error('biaya_investasi') == true) : ?>
										<?= form_error('biaya_investasi'); ?>
									<?php endif; ?>
								</div>
							</div>
      						<div class="mb-3">
      							<label>Nama ULP</label>
      							<?php
								if (set_value('pilihan_ulp') != '') $set_select = set_value('pilihan_ulp');
								else $set_select = '';
								echo form_dropdown('pilihan_ulp', $pilihan_ulp, $set_select, 'class="form-select"');
								?>
      						</div>
      					</div>
      					<div class="p-3 border-top">
      						<div class="text-end">
      							<button type="submit" class="
								btn btn-info
								rounded-pill
								px-4
								waves-effect waves-light
								">
      								Save
      							</button>
      						</div>
      					</div>
      					<!-- </form> -->
						</form>
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
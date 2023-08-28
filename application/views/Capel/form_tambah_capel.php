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
							Form Penambahan Data User
							</h4>
						</div>
						
						<?php 
						$attributes 	= array('class' => 'was-validated');
						echo form_open('User/Tambah',$attributes);
						?>
						<div class="card-body">
							<div class="mb-3">
								<label for="validationTextarea">Username</label>
								<input
								type="text"
								name="username"
								class="form-control"
								required
								/>
							</div>

							<div class="form-group mb-3">
								<label for="validationTextarea">Asal Unit Kerja</label>
								<?php
									if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
									else $set_select = '';					
									echo form_dropdown('pilihan_ulp',$set_select,'class="form-select" required');
								?>
								<div class="invalid-feedback">
								Pilih Unit Kerja
								</div>
							</div>
							
							<div class="form-group mb-3">
								<label for="validationTextarea">Role Kerja</label>
								<?php
									if(set_value('pilihan_role')!='') $set_select = set_value('pilihan_role');
									else $set_select = '';					
									echo form_dropdown('pilihan_role',$set_select,'class="form-select" required ');
								?>					  
								<div class="invalid-feedback">
								Pilih Role User
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
								"
								>
								Save
								</button>
							</div>
						</div>
					<!-- </form> -->
					<?php echo form_close(); ?>
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
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
							echo form_open('User/Tambah',$attributes);
						?>					
						<div class="card-header bg-info">
							<h4 class="card-title text-white">
							Form Penambahan Data User
							</h4>
						</div>
						<div class="card-body">		
							<div class="mb-3">
								<label>Nama User</label>
								<input
								  type="text"
								  class="form-control"
								  value="<?php if(set_value('username')!='') echo set_value('username');?>"
								  name="username"
								/>
							</div>
							<?php echo form_error('username'); ?>
							
							<div class="mb-3">
								<label>Asal Unit Kerja</label>
								<?php
									if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
									else $set_select = '';					
<<<<<<< HEAD
									echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-select" required');
=======
									echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-select col-12" ');
>>>>>>> aff40e034b15018b040e18cae743b3bbfa8c2cc9
								?>
							</div>
							<?php echo form_error('pilihan_ulp'); ?>
							
							<div class="mb-3">
								<label>Role Kerja</label>
								<?php
									if(set_value('pilihan_role')!='') $set_select = set_value('pilihan_role');
									else $set_select = '';					
									echo form_dropdown('pilihan_role',$pilihan_role,$set_select,'class="form-select" ');
								?>
							</div>
							<?php echo form_error('pilihan_role'); ?>
							
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
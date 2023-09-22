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
							echo form_open('User/Tambah', $attributes);
						?>
      					<div class="card-header bg-info">
      						<h4 class="card-title text-white">
      							Form Penambahan Data User
      						</h4>
      					</div>
      					<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label>Username :</label>
										<input type="text" class="form-control" name="username" 
										value="<?php 
										if(set_value('username')!='') 
											echo set_value('username');
										?>"/>
									</div>
									<?php echo form_error('username'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Role :</label>
										<?php
											if(set_value('pilihan_role')!='') $set_select = set_value('pilihan_role');
											else $set_select = '';	
											echo form_dropdown('pilihan_role',$pilihan_role,$set_select,'class="form-select" ');
										?>
									</div>
									<?php echo form_error('pilihan_role'); ?>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label>Email :</label>
										<input type="text" class="form-control" name="email_user" 
										value="<?php 
										if(set_value('email_user')!='') 
											echo set_value('email_user');
										?>"/>
									</div>
									<?php echo form_error('email_user'); ?>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label>Asal Unit Kerja :</label>
										<?php
											if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
											else $set_select = '';	
											echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-select" ');
										?>
									</div>
									<?php echo form_error('pilihan_ulp'); ?>
								</div>								
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
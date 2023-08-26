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
							<table
							  id="zero_config"
							  class="table table-striped table-bordered text-nowrap">
								<thead>
									<!-- start row -->
									<tr>
									<th>Nama User</th>
									<th>Asal Unit Kerja</th>
									<th>Role User</th>
									</tr>
									<!-- end row -->
								</thead>
								<tbody>
									<?php
									foreach($data_users->result() as $row){
										//$data_user[$row->id_user] = $row->nama_role;
										echo '<tr>';
										echo '<td>'.$row->nama_user.'</td>';
										echo '<td>'.$row->nama_ulp.'</td>';
										echo '<td>'.$row->nama_role.'</td>';
										echo '</tr>';
									}
									?>
									<!-- start row 
									<tr>
									<td>Tiger Nixon</td>
									<td>System Architect</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td>2011/04/25</td>
									<td>$320,800</td>
									</tr>
									<!-- start row 
									<tr>
									<td>Ashton Cox</td>
									<td>Junior Technical Author</td>
									<td>San Francisco</td>
									<td>66</td>
									<td>2009/01/12</td>
									<td>$86,000</td>
									</tr>
									<!-- end row -->
								</tbody>
								<tfoot>
									<!-- start row -->
									<tr>
									<th>Nama User</th>
									<th>Asal Unit Kerja</th>
									<th>Role User</th>
									</tr>
									<!-- end row -->
								</tfoot>
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
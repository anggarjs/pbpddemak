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
                                    <div class="mt-3 overflow-scroll">
                                          <table style="width: 100%;" class="table table-bordered table hover no-wrap" id="tabel-view-materialkurang">
                                                <thead>
                                                      <tr>
                                                            <th>Nama Detail MDU</th>
                                                            <th>Volume MDU</th>
                                                            <th>Nama Capel</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php foreach($material_kurang as $material) : ?>
                                                      <tr>
                                                            <td><?php echo html_escape($material->nama_detail_mdu); ?></td>
                                                            <td><?php echo html_escape($material->volume_mdu); ?></td>
                                                            <td><?php echo html_escape($material->nama_capel); ?></td>
                                                      </tr>
                                                      <?php endforeach; ?>
                                                </tbody>
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
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title">Form Tambah User</h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Form Basic
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
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
                <form class="form-horizontal">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 row">
                          <label
                            for="fname2"
                            class="
                              col-sm-3
                              text-end
                              control-label
                              col-form-label
                            "
                            >Nama</label
                          >
                          <div class="col-sm-9">
                            <input
                              type="text"
                              class="form-control"
                              id="fname2"
                              placeholder=""
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 row">
                          <label
                            for="lname2"
                            class="
                              col-sm-3
                              text-end
                              control-label
                              col-form-label
                            "
                            >Asal Unit Kerja</label
                          >
						<div class="col-md-9">
						  <!-- <select class="form-control form-select">
							<option value="">Male</option>
							<option value="">Female</option>

						  </select> -->
							<?php
							if(set_value('pilihan_ulp')!='') $set_select = set_value('pilihan_ulp');
							else $set_select = '0';					
							echo form_dropdown('pilihan_ulp',$pilihan_ulp,$set_select,'class="form-control form-select" ');?>
						</div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 row">
                          <label
                            for="uname1"
                            class="
                              col-sm-3
                              text-end
                              control-label
                              col-form-label
                            "
                            >Password</label
                          >
                          <div class="col-sm-9">
                          <input
                            type="password"
                            class="form-control"
                            id="exampleInputpwd4"
                            placeholder=""
                          />
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <hr />

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
                </form>
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
          All Rights Reserved by Nice admin.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
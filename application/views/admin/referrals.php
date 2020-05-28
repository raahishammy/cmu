<?php $this->load->view('admin/global/header'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Referrals</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Referrals</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-md-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Share Referral Link and Invite your Contacts to earn more.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div> -->
                <div class="input-group mb-3">
                  <input readonly type="text" name="referral_link" id="referral_link" value="<?=base_url().'join/'.md5($this->aauth->get_user_id())?>" class="form-control">
                  <div class="input-group-append">
                    <button type="button" id="copy_referral" class="btn btn-sm btn-success"> <i class="nav-icon fas fa-copy"></i> Copy</button>
                  </div>
                </div>

                <p class="card-text">Copy Above link and share with your contacts and friends to earn more and more.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php $this->load->view('admin/global/footer'); ?>
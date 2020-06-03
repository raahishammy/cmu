<?php $this->load->view('admin/global/header'); ?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/tree-child.css">
<!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/tree-parent.css"> -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/tree-style.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Plan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Create Plan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content basic-style">
        <div class="container-fluid">
            <div class="row">
                <div class="hv-container">
                   <!-- Key component -->
                        <div class="hv-item">
                          <section class="content">
                            <div class="container-fluid">
                              <div class="row">
                                <!-- left column -->
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                  <?php if ($this->session->flashdata('fail')): ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>
                                             <strong>
                                                <i class="ace-icon fa fa-times"></i>
                                            </strong>

                                            <?php echo $this->session->flashdata('fail') ?>
                                            <br />
                                        </div>
                                    <?php elseif ($this->session->flashdata('errors')): ?>
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>

                                            <strong>
                                                <i class="ace-icon fa fa-times"></i>
                                            </strong>
                                            <?php foreach($this->session->flashdata('errors') as $errormsg){ echo $errormsg; } ?>
                                            <br />
                                        </div>
                                    <?php elseif ($this->session->flashdata('success')): ?>
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="ace-icon fa fa-times"></i>
                                            </button>

                                            <strong>
                                                <i class="ace-icon fa fa-check"></i>
                                            </strong>

                                            <?php echo $this->session->flashdata('success') ?>
                                            <br />
                                        </div>
                                    <?php endif; ?>
                                  <!-- general form elements -->
                                  <div class="card card-primary">
                                  <div class="card-header">
                                    <h3 class="card-title">Add Plan</h3>
                                    </div>

                                    <form action="" method="post">
                                      <div class="card-body">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Plan Name</label>
                                          <input type="text" class="form-control" id="planName"name="plan_name"  value=""placeholder="Enter Plan Name" required>
                                        </div>
                                          <div class="form-group">
                                          <label for="amount">Amount</label>
                                          <input type="number" class="form-control" id="amount" name="plan_amount" value="" placeholder="Enter Amount" required>
                                        </div>
                                          <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" style="width: 100%;" name="status" required>
                                          <option value="1">Activate</option>
                                          <option value="0">Deactivate</option>
                                        </select>
                                      </div>
                                      </div>
                                      <!-- /.card-body -->
                                        <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="addPlan">Add Plan</button>
                                      </div>
                                    </form>
                                  </div>
                                 </div>
                                 <div class="col-md-3"></div>
                              </div>
                            </div><!-- /.container-fluid -->
                          </section>
                        </div>
                 </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
  
<?php $this->load->view('admin/global/footer'); ?>
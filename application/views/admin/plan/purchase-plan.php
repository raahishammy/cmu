<?php $this->load->view('admin/global/header'); ?>

<link rel="stylesheet" href="<?=base_url()?>assets/css/tree-child.css">
<!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/tree-parent.css"> -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/tree-style.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Purchase Plan </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Purchase Plan</li>
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
                    <div class="hv-wrapper">

                        <!-- Key component -->
                        <div class="hv-item">
                          <div class="row">
          <?php foreach($plans as $plan){?>
          <div class="col-md-6">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"  style="float:none !important;text-align: center;"><?php echo $plan->plan_name;?></h3>
             </div>
              <div class="card-body" style="text-align:center;">
                  Price: <?php echo $plan->amount;?> INR
              </div>
              <button type="button" class="btn btn-warning text-white" data-id="<?php echo $plan->id;?>">Buy</button>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        <?php } ?>
        </div>
        <!-- /.row -->

                        </div>
                     </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php $this->load->view('admin/global/footer'); ?>
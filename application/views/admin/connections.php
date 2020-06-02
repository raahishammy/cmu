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
            <h1 class="m-0 text-dark">Connections</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Connections</li>
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
                            <?php  if($this->uri->segment(2) !="" || !empty($connections)){?>
                            <div class="hv-item-parent">
                                <p class="simple-card"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                  <?php  if($this->uri->segment(2) ==""){?>
                                 <?=$this->aauth->get_user_name();?>
                                 <?php  }else{ ?>
                                  <?php if($parent !=""){?>
                                  <?= $parent->name;?>
                                <?php  } } ?> </font></font></p>
                            </div>
                          <?php  }else{?>
                            No user found.
                         <?php  } ?>

                            <?php if(!empty($connections)){ ?>
                               <?php echo  create_connections_tree_view($connections); ?>
                            <?php } ?>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
  
<?php $this->load->view('admin/global/footer'); ?>
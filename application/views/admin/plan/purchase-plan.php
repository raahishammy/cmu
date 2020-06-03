<?php $this->load->view('admin/global/header'); ?>
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
      <section class="content">
      <!-- Key component -->
        <div class="hv-item">
          <div class="alert" id="flashdisplay" style="display:none;">
          <button type="button" class="close" data-dismiss="alert">
          <i class="fa fa-times"></i>
          </button>
          <br />
          </div>
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
                        <button type="button" class="buyPlan btn btn-warning text-white" data-id="<?php echo $plan->id;?>">Buy</button>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
              </div>
            <?php } ?>
          </div>
        <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/global/footer'); ?>
<script>
  $(".buyPlan").on("click",function(){
    var id = $(this).attr("data-id");
    var userId = '<?php echo $this->aauth->get_user_id();?>';
    $.ajax({
            url:'<?php echo base_url('plan/buy-plan') ?>',
            type:'POST',
            dataType:'json',
            data: {
                    package_id: id,
                    user_id: userId
               },
              success:function(result){
              if(result.response ==''){
                console.log(result.response);
              }else{
                var status = result['status'];
                var message = result['message'];
                $('.alert').css('display','block');
                $( "#flashdisplay" ).addClass(status);
                $('.close').after(message);
                $(".alert").delay(5000).fadeOut();
                 var $container = $("#flashdisplay");
                 var refreshId = setInterval(function()
                 {
                  $container.load();
                  }, 9000);
               }
            }
      });
  });
 </script>
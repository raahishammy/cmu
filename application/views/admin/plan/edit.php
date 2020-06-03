<?php $this->load->view('admin/global/header'); ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/tree-style.css">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Plan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Plan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
				<!-- left column -->
				<div class="col-md-3"></div>
					<div class="col-md-6">
					<?php $this->load->view('flash-messages'); ?>
					<!-- general form elements -->
						<div class="card card-primary">
							<div class="card-header">
							<h3 class="card-title">Edit Plan</h3>
							</div>
							<form action="" method="post">
								<div class="card-body">
									<div class="form-group">
										<input type="hidden" name="plan_id" value="<?php echo $plan->id;?>">
										<label for="exampleInputEmail1">Plan Name</label>
										<input type="text" class="form-control" id="planName"name="plan_name"  value="<?php echo !empty(trim(set_value('plan_name'))) ? set_value('plan_name') : (isset($plan->plan_name) ? $plan->plan_name : "") ?>"placeholder="Enter Plan Name">
									</div>
									<div class="form-group">
										<label for="amount">Amount</label>
										<input type="number" class="form-control" id="amount" name="plan_amount" value="<?php echo !empty(trim(set_value('plan_amount'))) ? set_value('plan_amount') : (isset($plan->amount) ? $plan->amount : "") ?>" placeholder="Enter Amount" >
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control select2" style="width: 100%;" name="status">
										<option value="1" <?php if($plan->status == '1'){ echo "selected"; } ?>>Activate</option>
										<option value="0" <?php if($plan->status == '0'){ echo "selected"; } ?>>Deactivate</option>
										</select>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer">
								<button type="submit" class="btn btn-primary" name="addPlan">Update Plan</button>
								</div>
							</form>
						</div>
					</div>
				<div class="col-md-3"></div>
				</div>
			</div><!-- /.container-fluid -->
		</section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('admin/global/footer'); ?>
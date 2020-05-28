<?php if (!empty(validation_errors())): ?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">
    <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo validation_errors('<br />', '') ?>
</div>
<?php endif; ?>
<?php if ($this->session->flashdata('fail')): ?>
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">
    <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo show_flash_messages($this->session->flashdata('fail')); ?>
</div>
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
    <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo show_flash_messages($this->session->flashdata('success')); ?>
</div>
<?php endif; ?>
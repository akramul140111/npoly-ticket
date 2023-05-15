<div class="x_content bs-example-popovers hide-message">
<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-dismissible " role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>
<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-dismissible " role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>
<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-dismissible " role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <strong><?php echo e($message); ?></strong>
</div>
</div>
<?php endif; ?>
<?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-dismissible " role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <strong> <?php echo e($message); ?>!</strong>
</div>
<?php endif; ?>
</div>
<script>
setTimeout("$('.alert-success').fadeOut('slow')", 1000)
setTimeout("$('.alert-danger').fadeOut('slow')", 1000)
</script>
<?php /**PATH E:\xampp\htdocs\npoly-ticket\resources\views/layouts/flashMessage.blade.php ENDPATH**/ ?>
<?php if(Session::has('verification')): ?>
<!-- <div class="container">
<div class="alert alert-danger" role="alert">
	<strong class="lead" style="text-decoration: underline;">Notice:</strong>
	<span class="lead"><?php echo e(Session::get('verification')); ?>, Click <a href="<?php echo e(route('verification.resend')); ?>"> HERE </a> to resend </span>
</div>
</div> -->
<script>
function warning_notif(){
var msgs = "<?php echo Session::get('verification');
?> Click <a href='<?php echo route('verification.resend') ?>' "> HERE </a> to resend \"";

Lobibox.notify('warning', {
pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
position: 'center top',
icon: 'fa fa-exclamation-circle',
msg: msgs
});
}

window.onload = warning_notif();

</script>
<?php endif; ?>


<?php if(Session::has('danger')): ?>
<script>
function error_notif(){
	var msgs = "<?php echo Session::get('danger') ?>";

Lobibox.notify('error', {
	pauseDelayOnHover: true,
			continueDelayOnInactiveTab: false,
	position: 'center top',
	icon: 'fa fa-times-circle',
	msg: msgs
	});
}
	window.onload = error_notif();

</script>
<?php endif; ?>

<?php if(count($errors) >0): ?>
<div class="alert alert-danger" role="alert">
	<ul>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><?php echo e($error); ?></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>

<?php endif; ?>

<?php if(Session::has('success')): ?>
<script>
function success_notif(){
	var msgs = "<?php echo Session::get('success') ?>";
Lobibox.notify('success', {
	pauseDelayOnHover: true,
			continueDelayOnInactiveTab: false,
	position: 'center top',
	icon: 'fa fa-check-circle',
	msg: msgs
	});
}

window.onload = success_notif;
</script>

<?php endif; ?>

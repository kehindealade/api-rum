<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-sm-9">
      <h4 class="page-title">My Hostels</h4>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
          <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Profile</li>
       </ol>
   </div>
   <div class="col-sm-3">
     <div class="btn-group float-sm-right">
      <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Settings</button>
      <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
      <span class="caret"></span>
      </button>
      <div class="dropdown-menu">
        <a href="<?php echo e(route('hostel.create')); ?>" class="dropdown-item" data-toggle="modal"
data-target="#successmodal">Create Hostel</a>
        <a href="<?php echo e(route('hostel.showlisting')); ?>" class="dropdown-item">Manage Hostels</a>
        <a href="<?php echo e(route('hostel.showBookedOrder')); ?>" class="dropdown-item">Show Booked Orders</a>

        
      </div>
    </div>
   </div>
   </div>
  <!-- End Breadcrumb-->

  <div class="container-fluid">
  <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card mb-3">
			  <img class="card-img-top" src="<?php echo e(asset('images/uploads/' . $hostel->image )); ?>" alt="Card image cap" height="200px">
			  
			  <div class="card-body">
			  	<br><br><br>
				<h5 class="card-title card-text"><?php echo e($hostel->description); ?></h5>
				
				<p class="card-text"><small><?php echo e($hostel->created_at->diffForHumans()); ?></small></p>
			  </div>
			</div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
        Comments
       <?php if(auth()->guard('roomer')->user()): ?>
          <?php echo e("roomer"); ?>

       <?php endif; ?>
        </div>
    </div>


<p class="heading">Undecided Booked Order</p>
<?php $__currentLoopData = $newBookOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newBookOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="row">
    	<div class="col-lg-12">

    	<div id="accordion8">

		   <div class="card mb-2 border border-success">
                <div class="card-header">
                    <button class="btn btn-link shadow-none text-success" data-toggle="collapse" data-target="#collapse-22" aria-expanded="true" aria-controls="collapse-22">
                    	<?php echo e($newBookOrder->roomer->name); ?>

                    </button>
                </div>

                <div id="collapse-22" class="collapse show" data-parent="#accordion8">
                  <div class="card-body">

                  			<div class="row"> 
                  			<div class="col-lg-9">	
							<?php if(($newBookOrder->order_notes) != null): ?>
								<?php echo e($newBookOrder->order_notes); ?>


							<?php else: ?>
							<?php echo e("No order notes"); ?>

							<?php endif; ?>

						</div>
						<div class="col-lg-3">
						<form action = "<?php echo e(route('hostel.room.bookaction', ['hid' => $newBookOrder->hostel_id, 'rid' => $newBookOrder->roomer_id, 'bid' => $newBookOrder->id])); ?>" method="post">
						<?php echo csrf_field(); ?>
						
							<button class="btn btn-link shadow-none text-success" type="submit" name="accept" value="accept"> Accept</button>
							<button class="btn btn-link shadow-none text-danger" type="submit" name="ignore" value="ignore"> Ignore</button>
</form>
						</div>	

                   	</div>
					
                   
                  </div>
                </div>
              </div>
          </div>
      </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.leaserpartials.leaser_temp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
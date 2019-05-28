<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  
  <div class="container-fluid">
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
        
      </div>
    </div>
   </div>
   </div>
  <!-- End Breadcrumb-->
      <div class="row">
        <?php $__currentLoopData = $myHostels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myHostel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4">

         <div class="card">
          <img src="<?php echo e(asset('images/uploads/' . $myHostel->image )); ?>" class="card-img-top" alt="Card image cap" height="120px">
          <div class="card-body">
            
            <p class="card-text card-title"><a href="<?php echo e(route('hostel.show', $myHostel->id)); ?>"><?php echo e(substr($myHostel->description, 0, 25)); ?>...</a></p>
          </div>
           <ul class="list-group list-group-flush list shadow-none">
            <li class="list-group-item d-flex justify-content-between align-items-center">Budget <span class="badge badge-info badge-pill">#<?php echo e($myHostel->budget); ?></span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Rooms  <span class="badge badge-success badge-pill"><?php echo e($myHostel->no_of_rooms); ?></span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center">Spaces Left <span class="badge badge-success badge-pill"><?php echo e($myHostel->rooms_left); ?></span></li>
            <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo e($myHostel->location); ?> </li>
          </ul>
          
        </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div class="modal fade" id="successmodal">
                  <div class="modal-dialog">
                    <div class="modal-content border-success">
                      <div class="modal-header bg-success">
                        <h5 class="modal-title text-white">Create New Hostel</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo e(route('hostel.store')); ?>" method="post" enctype ="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <label for="description">Description</label>
                        <input type="text" name="description" required class="form-control">
                        
                        <div class="input-group mb-3" style="margin-top: 12px;">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Upload</span>
                        </div>

                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" required>
                          <label class="custom-file-label" for="inputGroupFile01" ></label>
                        </div>
                      </div>

                        <label for="location">Location</label>
                        <input type="text" name="location" required class="form-control">

                        <label for="no_of_rooms">Number of Rooms</label>
                        <input type="number" name="no_of_rooms" required class="form-control">

                        <label for="budget">Budget(Each Rooms)</label>
                        <input type="number" name="budget" required class="form-control">

                        
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-inverse-success" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Create</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div><!--End Modal -->
  </div>

	  <?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.leaserpartials.leaser_temp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
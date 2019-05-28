<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  
<div class="container-fluid">

  <div class="card">
            <div class="card-body">
              <h5 class="card-title">My Hostels</h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Description</th>
                      <th scope="col">Location</th>
                      <th scope="col">Room(s)</th>
                      <th scope="col">Rooms Left</th>
                      <th scope="col">Budget</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Action(s)</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  	<?php $__currentLoopData = $myHostels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myHostel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row">1</th>
                      <td><?php echo e(substr($myHostel->description, 0, 10)); ?>...</td>
                      <td><?php echo e(substr($myHostel->location, 0, 8)); ?>...</td>
                      <td><?php echo e($myHostel->no_of_rooms); ?></td>
                      <td><?php echo e($myHostel->rooms_left); ?></td>
                      <td><?php echo e($myHostel->budget); ?></td>
                      <td><?php echo e($myHostel->created_at->diffForHumans()); ?></td>
                      <td> <a href="<?php echo e(route('hostel.edit', $myHostel->id)); ?>" class="btn btn-success btn-sm">Edit</a>
                      	

                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					 </tbody>
                    
                </table>
              </div>
            </div>
          </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.leaserpartials.leaser_temp', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
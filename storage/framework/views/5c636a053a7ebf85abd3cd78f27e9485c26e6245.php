<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

     <!-- Vector CSS -->
    <link href="<?php echo e(asset('plugins/vectormap/jquery-jvectormap-2.0.2.css')); ?> " rel="stylesheet"/>
     <!-- simplebar CSS-->
      <link href="<?php echo e(asset('plugins/simplebar/css/simplebar.css')); ?>" rel="stylesheet"/>
      <!-- Bootstrap core CSS-->
      <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet"/>
      <!-- animate CSS-->
      <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet" type="text/css"/>
      <!-- Icons CSS-->
      <link href="<?php echo e(asset('css/icons.css')); ?>" rel="stylesheet" type="text/css"/>
      <!-- Sidebar CSS-->
      <link href="<?php echo e(asset('css/sidebar-menu.css')); ?>" rel="stylesheet"/>
      <!-- Custom Style-->
      <link href="<?php echo e(asset('css/app-style.css')); ?>" rel="stylesheet"/>

      <link rel="stylesheet" href="<?php echo e(asset('plugins/notifications/css/lobibox.min.css')); ?>">
</head>
<body>
  <!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
   <!-- end loader -->
  <div id="wrapper">

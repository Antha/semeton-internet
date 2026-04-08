<?php $this->extend('/templates/main') ?>

<?php $this->section('content') ?>
  
  <!-- Header -->
  <?= $this->include('/includes/header'); ?>   
  
  <div class="container">
    <div class="row">
      <div class="col-10 mt-5 pt-5 align-center text-center mx-auto">
        <div class="d-block fs-1">
          <i class="fa-solid fa-triangle-exclamation text-danger"></i>
        </div>
        
        <div class="d-inline-block fs-4 mt-2 text-danger">
          Outlet Tidak Ditemukan
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?= $this->include('/includes/footer'); ?>   

<?php $this->endSection() ?>
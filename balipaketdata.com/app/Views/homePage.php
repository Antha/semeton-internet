<?php $this->extend('/templates/main') ?>

<?php $this->section('content') ?>
  
  <!-- Header -->
  <?= $this->include('/includes/header'); ?>   
  
  <?php if(session()->getFlashdata('outlet_not_found')){ ?>
    <div class="container">
      <div class="row">
        <div class="col-10 mt-5 pt-5 align-center text-center mx-auto">
          <div class="d-block fs-1">
            <i class="fa-solid fa-triangle-exclamation text-danger"></i>
          </div>
          
          <div class="d-inline-block fs-4 mt-2 text-danger">
            <?= session()->getFlashdata('outlet_not_found'); ?>
          </div>
        </div>
      </div>
    </div>
  <?php }else{ ?>
    <!-- Menu Option -->
    <section class="container my-5">
      <h2 class="text-danger mb-4 text-center">HALO <?php echo session()->get('outlet_name'); ?></h2>
      <div class="row justify-content-center">
        <div class="col-md-3">
          <!-- Card dengan trigger modal -->
          <div class="card shadow-sm mb-3" 
              style="cursor:pointer;">
            <a href="<?= base_url('/outlet_store') ?>" class="link-style">
              <div class="card-body text-center">
                <div class="block fs-1">
                  <i class="fa-solid fa-sim-card"></i>
                </div>
                <h3 class="card-title">VOUCHER</h3>
              </div>
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm mb-3"
            style="cursor:pointer;"
            >
            <a href="<?= base_url('/outlet_store/history') ?>" class="link-style">
              <div class="card-body text-center">
                <div class="block fs-1">
                  <i class="fa-solid fa-book-open"></i>
                </div>
                <h3 class="card-title">HISTORI</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>

<?php $this->endSection() ?>
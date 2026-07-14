<?php $this->extend('/templates/main') ?>

<?php $this->section('content') ?>

<!-- Header -->
<?= $this->include('/includes/header'); ?>  
  
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body text-center">
      <h3 class="mb-3">Payment Status</h3>
      <p><strong>Order ID:</strong> <?= esc($orderId) ?></p>
      <p><strong>Status:</strong> <?= esc($status) ?></p>

      <?php if ($status === 'settlement'): ?>
        <div class="alert alert-success">Pembayaran berhasil!</div>
      <?php elseif ($status === 'pending'): ?>
        <div class="alert alert-warning">Pembayaran masih pending.</div>
      <?php else: ?>
        <div class="alert alert-danger">Pembayaran gagal atau ditolak.</div>
      <?php endif; ?>

      <a href="/outlet_store" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
  </div>
</div>

<?= $this->include('/includes/footer'); ?>  

<?php $this->endSection() ?>
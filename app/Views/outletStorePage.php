<?php $this->extend('/templates/main') ?>

<?php $this->section('content') ?>

  <div id="loading-overlay" style="display:none;">
    <div class="loading-overlay-spinner"></div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="simpatiModal" tabindex="-1" aria-labelledby="simpatiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
        <!-- Header -->
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title beliPaketLabel">Voucher Fisik 4 GB (1 hari-24 jam)</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <!-- Body -->
        <div class="modal-body">
          <!-- Informasi Pelanggan -->
          <form id="form-submit">
            <div class="mb-3">
              <label for="nomorTelkomsel" class="form-label">Masukkan Nomor Telkomsel</label>
              <input type="text" class="form-control msisdn" placeholder="+62 8123456789" id="text-phone" required>
            </div>

            <div class="mb-3">
              <fieldset disabled>
              <label class="form-label">Harga</label>
              <input type="text" class="form-control hargaVoucher" id="text-price" readonly>
              </fieldset>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
              <label class="form-label">Metode Pembayaran</label>
              <div class="card p-3">
                <img src="<?php echo base_url("images/method-snap.jpeg") ?>" alt="QRIS" width="400">
              </div>
            </div>
          </div>
          
          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-orange" id="btn-buy">Beli</button>
          </div>
        </form>
      </div>
 
    </div>
  </div>

  <div class="modal fade" id="byuModal" tabindex="-1" aria-labelledby="simpatiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
        <!-- Header -->
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title beliPaketLabel">BONUS INTERNET SIMPATI</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <!-- Body -->
        <div class="modal-body">
          <!-- Informasi Pelanggan -->
          <form id="form-submit-blue">
            <div class="mb-3">
              <label for="nomorTelkomsel" class="form-label">Masukkan Nomor Telkomsel</label>
              <input type="text" class="form-control msisdn" placeholder="+62 8123456789" id="text-phone-blue" required>
            </div>

            <div class="mb-3">
              <fieldset disabled>
              <label class="form-label">Harga</label>
              <input type="text" class="form-control hargaVoucher" id="text-price-blue" readonly>
              </fieldset>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
              <label class="form-label">Metode Pembayaran</label>
              <div class="card p-3">
                <img src="<?php echo base_url("images/method-snap.jpeg") ?>" alt="QRIS" width="400">
              </div>
            </div>
          </div>
          
          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning" id="btn-buy-blue">Beli Paket</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Header -->
  <?= $this->include('/includes/header'); ?>  

  <!-- Promo -->
  <section class="container-fluid mt-4 mt-md-5">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <div class="store-title">
          <h3><?php echo session()->get('outlet_name'); ?></h3>
        </div>
      </div>

      <div class="col-12 col-md-10 mt-3 mt-md-5">
        <div class="container-fluid">
          <div class="row g-0">
            <div class="offset-9 col-3 offset-lg-10 col-lg-2 mb-4 text-end">
              <img class="img-fluid w-50" src="<?= esc(base_url('images/logo_catalist.png')); ?>"/>
            </div>
          </div>
          <div class="row justify-content-start g-0 simpati-section">
            <div class="col-5 col-lg-2">
              <h5 class="fw-bold title-accor">PAKET SIMPATI</h5>
            </div>
          </div>
          <div class="row simpati-section">
            <div class="col-12">
              <div class="accordion" id="accordionExampleSimpati">
                <?php foreach($listDisplaySimpati as $rows){ ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $rows['group_display']; ?>">
                      <button class="accordion-button collapsed" type="button" 
                      data-bs-toggle="collapse" 
                      data-bs-target="#collapse<?php echo $rows['group_display']; ?>" 
                      aria-expanded="false" 
                      aria-controls="collapse<?php echo $rows['group_display']; ?>">
                        <?php 
                          // ambil satu nama voucher untuk header
                          foreach($listGroupVfSimpati as $items){ 
                            if($items['group_display'] == $rows['group_display']){
                              echo $items['group_voucher']; 
                              break; // keluar setelah ketemu
                            }
                          }
                        ?>
                      </button>
                    </h2>
                    <div id="collapse<?php echo $rows['group_display']; ?>" 
                    class="accordion-collapse collapse" 
                    aria-labelledby="heading<?php echo $rows['group_display']; ?>" 
                    data-bs-parent="#accordionExampleSimpati">
                      <div class="accordion-body">
                          <div class="container-fluid">
                            <div class="row justify-content-center">
                              <?php foreach($cardItemSimpati as $itemsDetail){ 
                                if($itemsDetail['group_display'] == $rows['group_display']){?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                  <div class="custom-card"  
                                        data-group="<?php echo $itemsDetail['group_voucher']; ?>"
                                        data-nama="<?php echo $itemsDetail['nama_voucher']; ?>"
                                        data-kuota="<?php echo $itemsDetail['kuota']; ?>"
                                        data-validity="<?php echo $itemsDetail['validity']; ?>"
                                        data-harga="<?php echo $itemsDetail['harga']; ?>"
                                        data-kategori="SIMPATI"
                                        data-modal="#simpatiModal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#simpatiModal"
                                        role="button">

                                    <!-- HEADER -->
                                    <div class="custom-card-header">
                                      <h6>Paket Internet</h6>
                                      <h5><?php echo $itemsDetail['kuota']; ?> | <?php echo $itemsDetail['validity']; ?></h5>
                                    </div>

                                    <!-- BODY -->
                                    <div class="custom-card-body">
                                      <div class="card-info">
                                        <span>Internet</span>
                                        <strong><?php echo $itemsDetail['kuota']; ?></strong>
                                      </div>

                                      <div class="card-info">
                                        <span>Masa aktif</span>
                                        <strong><?php echo $itemsDetail['validity']; ?></strong>
                                      </div>
                                    </div>

                                    <!-- FOOTER -->
                                    <div class="custom-card-footer">
                                      <div class="card-price">Rp <?php echo nf0($itemsDetail['harga']); ?></div>
                                    </div>

                                  </div>
                                </div>
                              <?php }} ?>
                            </div>
                          </div>
                      </div>
                    </div>
                  
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-10 mt-3 mt-md-5">
        <div class="container-fluid">
          <div class="row justify-content-start g-0 byu-section">
            <div class="col-5 col-lg-2">
              <h5 class="fw-bold title-accor">PAKET BYU</h5>
            </div>
          </div>
          <div class="row byu-section">
            <div class="col-12">
              <div class="accordion" id="accordionExampleByu">
                <?php foreach($listDisplayByu as $rows){ ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $rows['group_display']; ?>">
                      <button class="accordion-button collapsed" type="button" 
                      data-bs-toggle="collapse" 
                      data-bs-target="#collapseByu<?php echo $rows['group_display']; ?>" 
                      aria-expanded="false" 
                      aria-controls="collapseByu<?php echo $rows['group_display']; ?>">
                        <?php 
                          // ambil satu nama voucher untuk header
                          foreach($listGroupVfByu as $items){ 
                            if($items['group_display'] == $rows['group_display']){
                              echo $items['group_voucher']; 
                              break; // keluar setelah ketemu
                            }
                          }
                        ?>
                      </button>
                    </h2>
                    <div id="collapseByu<?php echo $rows['group_display']; ?>" 
                    class="accordion-collapse collapse" 
                    aria-labelledby="heading<?php echo $rows['group_display']; ?>" 
                    data-bs-parent="#accordionExampleByu">
                      <div class="accordion-body">
                          <div class="container-fluid">
                            <div class="row justify-content-center">
                              <?php foreach($cardItemByu as $itemsDetail){ 
                                if($itemsDetail['group_display'] == $rows['group_display']){?>
                                <div class="col-md-3 mb-2">
                                  <div class="custom-card byu-card"  
                                        data-group="<?php echo $itemsDetail['group_voucher']; ?>"
                                        data-nama="<?php echo $itemsDetail['nama_voucher']; ?>"
                                        data-kuota="<?php echo $itemsDetail['kuota']; ?>"
                                        data-validity="<?php echo $itemsDetail['validity']; ?>"
                                        data-harga="<?php echo $itemsDetail['harga']; ?>"
                                        data-kategori="BYU"
                                        data-modal="#byuModal"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#byuModal"
                                        role="button">

                                    <!-- HEADER -->
                                    <div class="custom-card-header">
                                      <h6>Paket Internet</h6>
                                      <h5><?php echo $itemsDetail['kuota']; ?> | <?php echo $itemsDetail['validity']; ?></h5>
                                    </div>

                                    <!-- BODY -->
                                    <div class="custom-card-body">
                                      <div class="card-info">
                                        <span>Internet</span>
                                        <strong><?php echo $itemsDetail['kuota']; ?></strong>
                                      </div>

                                      <div class="card-info">
                                        <span>Masa aktif</span>
                                        <strong><?php echo $itemsDetail['validity']; ?> hari</strong>
                                      </div>
                                    </div>

                                    <!-- FOOTER -->
                                    <div class="custom-card-footer">
                                      <div class="card-price">Rp <?php echo nf0($itemsDetail['harga']); ?></div>
                                    </div>

                                  </div>
                                </div>
                              <?php }} ?>
                            </div>
                          </div>
                      </div>
                    </div>
                  
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
   
  </section>

  <!-- Header -->
  <?= $this->include('/includes/footer'); ?>  
  <script>
    function formatRupiah(angka) {
      return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    var simpatiModal = document.getElementById('simpatiModal');
    simpatiModal.addEventListener('show.bs.modal', function (event) {
      // Card yang diklik
      var card = event.relatedTarget;

      // Ambil data dari atribut
      var nama = card.getAttribute('data-nama');
      var kuota = card.getAttribute('data-kuota');
      var validity = card.getAttribute('data-validity');
      var harga = card.getAttribute('data-harga');

      // Isi ke elemen modal
      simpatiModal.querySelector('.modal-title').textContent = nama + " (" + kuota + " | " + validity + ")";
      simpatiModal.querySelector('.hargaVoucher').value = formatRupiah(harga);
    });

    var byuModal = document.getElementById('byuModal');
    byuModal.addEventListener('show.bs.modal', function (event) {
      // Card yang diklik
      var card = event.relatedTarget;

      // Ambil data dari atribut
      var nama = card.getAttribute('data-nama');
      var kuota = card.getAttribute('data-kuota');
      var validity = card.getAttribute('data-validity');
      var harga = card.getAttribute('data-harga');

      // Isi ke elemen modal
      byuModal.querySelector('.modal-title').textContent = nama + " (" + kuota + " | " + validity + ")";
      byuModal.querySelector('.hargaVoucher').value = formatRupiah(harga);
    });

    $('#loading-overlay').hide();

    $('#form-submit').on('submit', function(e) {
      e.preventDefault()

      let grossAmount = $('#text-price').val(); // ambil nilai dari input
      let phone = $("#text-phone").val()
      grossAmount = grossAmount.replace(/[^0-9]/g, '');

      postPaymentCreate(grossAmount, phone)
    });

    $('#form-submit-blue').on('submit', function(e) {
      e.preventDefault()

      let grossAmount = $('#text-price-blue').val(); // ambil nilai dari input
      let phone = $("#text-phone-blue").val()

      grossAmount = grossAmount.replace(/[^0-9]/g, '');

      postPaymentCreate(grossAmount, phone);
    });

    function postPaymentCreate(gross_amount, phone){
      $('#loading-overlay').show();
      $.ajax({
        url: 'api/payment/create',   // endpoint CI4 kamu
        type: 'POST',
        data: { gross_amount, phone }, // kirim ke backend
        success: function(response) {
          // redirect ke Midtrans Snap page
          window.location.href = response.data.redirect_url;
          $('#loading-overlay').hide();
        },
        error: function(xhr, status, error) {
          console.log('Transaction failed: ' + error);
        }
      });
    }

  </script>
<?php $this->endSection() ?>
<?php $this->extend('/templates/main') ?>

<?php $this->section('content') ?>
  
  <!-- Modal -->
  <div class="modal fade" id="simpatiModal" tabindex="-1" aria-labelledby="simpatiLabel" aria-hidden="true">
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
          <div class="mb-3">
            <label for="nomorTelkomsel" class="form-label">Masukkan Nomor Telkomsel</label>
            <input type="text" class="form-control msisdn" placeholder="+62 8123456789">
          </div>

          <!-- Pilih Paket -->
          <div class="mb-3">
            <label class="form-label">Pilih Paket</label>
            <select class="form-control pilihPaket mb-3">
              <option value="">Pilih Paket</option>
            </select>
          </div>

          <div class="mb-3">
            <fieldset disabled>
            <label class="form-label">Harga</label>
            <input type="text" class="form-control hargaVoucher" readonly>
            </fieldset>
          </div>

          <!-- Metode Pembayaran -->
          <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <div class="card p-3">
              <p>QRIS untuk semua pembayaran</p>
              <img src="https://tse1.mm.bing.net/th/id/OIP.SJk3_1NbGUAvZ-bJslHM4wHaC0?rs=1&pid=ImgDetMain&o=7&rm=3" alt="QRIS" width="100">
            </div>
          </div>
        </div>
        
        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-warning">Beli Paket</button>
        </div>
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
          <div class="mb-3">
            <label for="nomorTelkomsel" class="form-label">Masukkan Nomor Telkomsel</label>
            <input type="text" class="form-control msisdn" placeholder="+62 8123456789">
          </div>

          <!-- Pilih Paket -->
          <div class="mb-3">
            <label class="form-label">Pilih Paket</label>
            <select class="form-control pilihPaket mb-3">
              <option value="">Pilih Paket</option>
            </select>
          </div>

          <div class="mb-3">
            <fieldset disabled>
            <label class="form-label">Harga</label>
            <input type="text" class="form-control hargaVoucher" readonly>
            </fieldset>
          </div>

          <!-- Metode Pembayaran -->
          <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <div class="card p-3">
              <p>QRIS untuk semua pembayaran</p>
              <img src="https://tse1.mm.bing.net/th/id/OIP.SJk3_1NbGUAvZ-bJslHM4wHaC0?rs=1&pid=ImgDetMain&o=7&rm=3" alt="QRIS" width="100">
            </div>
          </div>
        </div>
        
        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-warning">Beli Paket</button>
        </div>
      </div>
 
    </div>
  </div>

  <!-- Header -->
  <?= $this->include('/includes/header'); ?>  

  <!-- Promo -->
  <section class="container-fluid my-5">
    <div class="row justify-content-center mb-4">
      <div class="col-sm-8 col-12">

        <h2 class="text-danger fw-bold text-start">
          <i class="fa-solid fa-diamond me-2"></i>CATALIST
        </h2>
              
      </div>
    </div>

     <div class="row justify-content-center mb-5">
      <div class="col-sm-8 col-12">
        <h3 class="text-danger text-end"><?php echo session()->get('outlet_name'); ?></h3>
        <div class="line">
          <div class="line-red"></div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center simpati-section">
      <div class="col-12 mb-2">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-8 col-12">
              <h5 class="text-danger text-start">
                <i class="fa-solid fa-star me-2"></i>SIMPATI
              </h5>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-8 col-12">
              <div class="row">
                <?php foreach($listGroupVfSimpati as $rows){ ?>
                  <div class="col-sm-4 col-6">
                    <!-- Card dengan trigger modal -->
                    <div class="card shadow-sm mb-3 bg-light card-voucher"
                        data-group="<?= $rows['group_voucher']; ?>"
                        data-kategori="SIMPATI"
                        data-modal="#simpatiModal"
                        data-bs-toggle="modal" 
                        data-bs-target="#simpatiModal" 
                        style="cursor:pointer;">
                      <img src="<?= esc(base_url('images/simpati-card-v2.png')); ?>" 
                        class="card-img-top img-card-custom" alt="SIMPATI">
                      <div class="card-body bg-secondary-custom card-body-simpati">
                        <p class="card-text fw-bold text-white"><?php echo $rows['group_voucher']; ?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="row justify-content-center byu-section mt-5">
      <div class="col-12 mb-2">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-8 col-12">
              <h5 class="text-byu text-start">
                <i class="fa-solid fa-star me-2"></i>ByU
              </h5>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
          <div class="row justify-content-center">
            <div class="col-sm-8 col-12">
              <div class="row">
                <?php foreach($listGroupVfByu as $rows){ ?>
                  <div class="col-sm-4 col-6">
                    <!-- Card dengan trigger modal -->
                    <div class="card shadow-sm mb-3 bg-light card-voucher"
                        data-group="<?= $rows['group_voucher']; ?>"
                        data-kategori="BYU"
                        data-modal="#byuModal" 
                        data-bs-toggle="modal" 
                        data-bs-target="#byuModal" 
                        style="cursor:pointer;">
                      <img src="<?= esc(base_url('images/byu-card.png')); ?>" 
                        class="card-img-top img-card-custom" alt="ByU">
                      <div class="card-body bg-secondary-custom card-body-byu">
                        <p class="card-text fw-bold text-white"><?php echo $rows['group_voucher']; ?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
  <script>

    document.querySelectorAll(".card-voucher").forEach(card => {

    card.addEventListener("click", function(){

    let group = this.dataset.group;
    let kategori = this.dataset.kategori;
    let modalId   = this.dataset.modal;

    let modal = document.querySelector(modalId);

    let label    = modal.querySelector(".beliPaketLabel");
    let dropdown = modal.querySelector(".pilihPaket");
    let harga    = modal.querySelector(".hargaVoucher");

    // ubah judul modal
    label.textContent = group;

    // reset isi
    dropdown.innerHTML = '<option value="">Loading paket...</option>';
    harga.value = "";

    fetch("<?= base_url('outlet_store/getVoucher') ?>",{
    method:"POST",
    headers:{
    "Content-Type":"application/x-www-form-urlencoded"
    },
    body:"group="+encodeURIComponent(group)+"&kategori="+kategori
    })
    .then(response => response.json())
    .then(data => {

    dropdown.innerHTML = '<option value="">Pilih Paket</option>';

    data.forEach(v => {

    let option = document.createElement("option");

    option.value = v.harga;
    option.text = v.nama_voucher;
    option.dataset.harga = v.harga;

    dropdown.appendChild(option);

    });

    });

    });

    });


    // harga otomatis
    document.querySelectorAll(".pilihPaket").forEach(select => {

      select.addEventListener("change", function(){

        let harga = this.options[this.selectedIndex].dataset.harga;

        let modal = this.closest(".modal");

        modal.querySelector(".hargaVoucher").value =
          harga ? "Rp "+parseInt(harga).toLocaleString("id-ID") : "";

      });

    });

  </script>
<?php $this->endSection() ?>
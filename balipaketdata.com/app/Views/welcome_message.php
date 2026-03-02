<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semeton Internet</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="simpatiModal" tabindex="-1" aria-labelledby="simpatiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        
        <!-- Header -->
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="beliPaketLabel">BONUS INTERNET SIMPATI</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <!-- Body -->
        <div class="modal-body">
          <!-- Informasi Pelanggan -->
          <div class="mb-3">
            <label for="nomorTelkomsel" class="form-label">Masukkan Nomor Telkomsel</label>
            <input type="text" class="form-control" id="nomorTelkomsel" placeholder="+62 8123456789">
          </div>

          <!-- Pilih Paket -->
          <div class="mb-3">
            <label class="form-label">Pilih Paket</label>
            <input type="text" class="form-control mb-2" placeholder="Cari paket...">
            <div class="card p-3">
              <h6>Bonus Internet SIMPATI</h6>
              <p>Internet 2GB - 5GB</p>
              <span class="badge bg-success">Rp 0 (Gratis)</span>
            </div>
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
  <header class="bg-danger text-white text-center p-5 header-custom">
    <h1 class="fw-bold">Semeton Internet</h1>
    <p>Beli Paket Internet, Pulsa, Diamond Games, Netflix, Viu, Disney, Vidio, dll. disini lebih murah!</p>
  </header>
  

  <!-- Search -->
  <section class="container my-4">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Cari paket...">
      <button class="btn btn-danger">Cari</button>
    </div>
  </section>

  <!-- Promo -->
  <section class="container my-5">
    <h2 class="text-danger mb-4 text-center">PROMO TERBAIK</h2>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <!-- Card dengan trigger modal -->
        <div class="card shadow-sm mb-3" 
            data-bs-toggle="modal" 
            data-bs-target="#simpatiModal" 
            style="cursor:pointer;">
          <div class="card-body">
            <h3 class="card-title text-warning">SIMPATI</h3>
            <p class="card-text">SIMPATI - SURPRISE DEAL BEBAS NONTON</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm mb-3"
          data-bs-toggle="modal" 
          data-bs-target="#simpatiModal" 
          style="cursor:pointer;"
          >
          <div class="card-body">
            <h3 class="card-title text-warning">SIMPATI</h3>
            <p class="card-text">Telkomsel Prepaid - Kuota GB 24 Jam</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm mb-3"
          data-bs-toggle="modal" 
          data-bs-target="#simpatiModal"
          style="cursor:pointer;"
          >
          <div class="card-body">
            <h3 class="card-title text-warning">BYU</h3>
            <p class="card-text">SIMPATI - SURPRISE DEAL BEBAS NONTON</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow-sm mb-3">
          <div class="card-body">
            <h3 class="card-title text-warning">BYU</h3>
            <p class="card-text">Telkomsel Prepaid - Kuota GB 24 Jam</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
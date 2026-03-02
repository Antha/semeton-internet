<?php $this->extend('/templates/main') ?>

<?php $this->section('content') ?>
  
  <!-- Header -->
  <?= $this->include('/includes/header'); ?>   
  
  <div class="container">
    <div class="row">
      
      <div class="col-10 mt-5 align-center mx-auto">
        <div class="d-inline-block mb-4">
          <a href="<?= esc(base_url('o/'.session()->get('outlet_slug'))); ?>" class="fs-6 link-style">
            <i class="fa-solid fa-angles-left me-1"></i>HOME
          </a>
        </div>
        <div class="btn-capture-dl-wrapper container-fluid mt-4 mb-2">
            <div class="row justify-content-end">
                <div class= "col-sm-4 col-3 text-end pe-lg-0 pe-1">
                    <button id="dlImg" class="submit_btn rounded p-2 btn-green border-0 me-2">CAPTURE</button>
                    <button id="exportCsv" class="submit_btn rounded p-2 float-end btn-green border-0">DOWNLOAD</button>
                </div>
            </div>
        </div>
        <div id="table_history_trx" class="col-12 mb-5">
            <div class="table-responsive">
                <table id="dataTable" class="table table-sm table-bordered table-hover table-cstm">
                    <thead>
                        <tr class="text-center align-middle">
                            <th rowspan="3" class="deep_blue align-middle" scope="col">Tanggal TRX</th>
                            <th rowspan="3" class="deep_blue align-middle" scope="col">ID Outlet</th>
                            <th rowspan="3" class="deep_blue align-middle" scope="col">MSISDN</th>
                            <th rowspan="3" class="deep_blue align-middle" scope="col">Product</th>
                            <th rowspan="3" class="deep_blue align-middle" scope="col">Kode Voucher</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
              </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url('/script/jszip.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/script/FileSaver.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/script/xlsx.full.min.js') ?>"></script>
  <script>
    $('#exportCsv').click(function () {

        var table = document.getElementById("dataTable");

        // convert table ke workbook
        var workbook = XLSX.utils.table_to_book(table, {
            sheet: "History",
            raw: true
        });

        // nama file
        const dateformat = new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0,14);
        const filename = `history_trx_report_${dateformat}.xlsx`;

        // download
        XLSX.writeFile(workbook, filename);

    });

     $('#dlImg').on('click', function () {

        const wrapper = document.querySelector('#table_history_trx .table-responsive');
        const table   = document.querySelector('#dataTable');

        // SIMPAN style asli
        const oldOverflowX = wrapper.style.overflowX;
        const oldOverflowY = wrapper.style.overflowY;
        const oldMaxWidth  = wrapper.style.maxWidth;

        // BUKA scroll sementara
        wrapper.style.overflowX = 'visible';
        wrapper.style.overflowY = 'visible';
        wrapper.style.maxWidth  = 'none';

        html2canvas(table, {
            scale: window.devicePixelRatio * 2,
            useCORS: true,
            backgroundColor: '#ffffff'
        }).then(canvas => {

            // KEMBALIKAN style semula
            wrapper.style.overflowX = oldOverflowX;
            wrapper.style.overflowY = oldOverflowY;
            wrapper.style.maxWidth  = oldMaxWidth;

            // DOWNLOAD IMAGE
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = `history_report_${Date.now()}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

        }).catch(err => {
            console.error('Capture error:', err);
        });

    });

  </script>
<?php $this->endSection() ?>
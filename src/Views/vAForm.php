<?= $this->extend('IM\CI\Views\vA') ?>

<?= $this->section('content') ?>
<?= form_open('', $form_open); ?>
<div class="card card-custom card-sticky" id="kt_page_sticky_card">
  <div class="card-header">
    <div class="card-title">
      <h3 class="card-label">
        <small class="text-danger">Pastikan semua data terisi dengan benar</small></h3>
    </div>
    <div class="card-toolbar">
      <div class="btn-group mr-2">
        <?= form_button($btnSubmit); ?>
      </div>
      <div class="btn-group">
        <?= form_button($btnReset); ?>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-xl-2"></div>
      <div class="col-xl-8">
        <div class="my-5">
          <?= $this->include('IM\CI\Views\vAFormBuilder'); ?>
        </div>
      </div>
      <div class="col-xl-2"></div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
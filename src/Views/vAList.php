<?= $this->extend('IM\CI\Views\vA') ?>

<?= $this->section('content') ?>
<div class="card card-custom">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <div class="card-title">
      <h3 class="card-label"><?= $title; ?>
        <span class="d-block text-muted pt-2 font-size-sm"><?= $subTitle; ?></span>
      </h3>
    </div>
    <div class="card-toolbar">
      <div class="input-icon mr-2">
        <input type="text" class="form-control" placeholder="Quick Search..." id="kt_datatable_search_query" />
        <span>
          <i class="flaticon2-search-1 text-muted"></i>
        </span>
      </div>
      <div data-toggle="tooltip" title="" data-original-title="Custom Filter" data-theme="dark">
        <button type="button" id="filter-modal-trigger" class="btn btn-icon btn-light-info mr-2" data-toggle="modal" data-target="#filter-modal">
          <i class="fas fa-filter"></i>
        </button>
      </div>
      <div class="dropdown dropdown-inline mr-2" data-toggle="tooltip" title="" data-original-title="Export" data-theme="dark">
        <a href="#" class="btn btn-icon btn-light-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-file-export"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <ul class="navi flex-column navi-hover py-2">
            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
            <li class="navi-item">
              <a href="<?= site_url('support/print/' . $module); ?>" class="navi-link">
                <span class="navi-icon">
                  <i class="la la-print"></i>
                </span>
                <span class="navi-text">Print</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="#" class="navi-link">
                <span class="navi-icon">
                  <i class="la la-copy"></i>
                </span>
                <span class="navi-text">Copy</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="<?= site_url('support/export/excel/' . $module); ?>" class="navi-link">
                <span class="navi-icon">
                  <i class="la la-file-excel-o"></i>
                </span>
                <span class="navi-text">Excel</span>
              </a>
            </li>
            <li class="navi-item">
              <a href="<?= site_url('support/export/pdf/' . $module); ?>" class="navi-link">
                <span class="navi-icon">
                  <i class="la la-file-pdf-o"></i>
                </span>
                <span class="navi-text">PDF</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <a href="<?= current_url() . '/create'; ?>" class="btn btn-icon btn-light-success font-weight-bolder mr-2" data-toggle="tooltip" title="" data-original-title="Create New" data-theme="dark">
        <i class="ki ki-solid-plus"></i>
      </a>
      <button type="button" id="reload-button" class="btn btn-icon btn-secondary mr-2" data-toggle="tooltip" title="" data-original-title="Reload Data" data-theme="dark">
        <i class="ki ki-reload"></i>
      </button>
    </div>
  </div>
  <div class="card-body">

    <div class="datatable datatable-bordered datatable-head-custom" id="<?= $table; ?>"></div>

  </div>
</div>

<?= $this->include('IM\CI\Views\vAModalFilter'); ?>
<?= $this->endSection(); ?>
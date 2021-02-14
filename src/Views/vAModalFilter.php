<div class="modal fade" id="filter-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Custom Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i aria-hidden="true" class="ki ki-close"></i>
        </button>
      </div>
      <div class="modal-body">
        <form class="form">
          <?= $this->include('IM\CI\Views\vAFormBuilder'); ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
        <button type="button" id="modal-reset-filter-button" class="btn btn-light-warning font-weight-bold">Reset</button>
        <button type="button" id="modal-filter-button" class="btn btn-info font-weight-bold" data-action="" data-nya="">Filter</button>
      </div>
    </div>
  </div>
</div>
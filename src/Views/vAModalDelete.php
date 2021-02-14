<p>Anda yakin akan menghapus data berikut?</p>
<?= $this->include('IM\CI\Views\vAModalDetail'); ?>
<?php if ($softDelete) : ?>
  <label class="checkbox mt-3">
    <input type="checkbox" name="isPermanent"><span class="mr-2"></span>Hapus permanen data
  </label>
<?php endif; ?>
</p>
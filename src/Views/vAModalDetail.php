<div class="accordion accordion-toggle-arrow" id="detailAccordion">
  <?php foreach ($data as $key => $value) : ?>
    <div class="card">
      <div class="card-header">
        <div class="card-title collapsed" data-toggle="collapse" data-target="#<?= $key; ?>">
          <?= ucfirst($key); ?>
        </div>
      </div>
      <div id="<?= $key; ?>" class="collapse" data-parent="#detailAccordion">
        <div class="card-body">
          <?php
          $array = json_decode($value);
          if ($key == 'note' && json_last_error() === JSON_ERROR_NONE) {
            $list = '';
            foreach ($array as $key => $value1) {
              if ($key == 'b') {
                $list .= '<p>Before</p>';
              } else if ($key == 'a') {
                $list .= '<p>After</p>';
              }
              if (is_object($value1)) {
                $list .= '<ul>';
                foreach ($value1 as $key => $value2) {
                  $list .= '<li>' . $key . ' : ' . $value2 . '</li>';
                }
                $list .= '</ul>';
              }
            }
            echo $list;
          } else {
            echo $value;
          }
          ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php

namespace IM\CI\Models\App;

use IM\CI\Models\Modelku;

class M_bannedIP extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = '_banned_ip';
  protected $primaryKey = 'id';

  protected $kolom       = 'ip';
  protected $gabung      = [];
  protected $sama        = [];
  protected $grupSama    = [];
  protected $seperti     = [];
  protected $grupSeperti = [];
  protected $group       = [];
  protected $punya       = [];
  protected $urut        = [
    ['id', 'asc']
  ];

  protected $theFields = ['ip'];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

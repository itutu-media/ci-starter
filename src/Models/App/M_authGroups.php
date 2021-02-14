<?php

namespace IM\CI\Models\App;

use IM\CI\Models\Modelku;

class M_authGroups extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = 'auth_groups';
  protected $primaryKey = 'id';

  protected $kolom       = 'id id, id no, name, description';
  protected $gabung      = [];
  protected $sama        = [];
  protected $grupSama    = [];
  protected $seperti     = [];
  protected $grupSeperti = [];
  protected $group       = ['id'];
  protected $punya       = [];
  protected $urut        = [
    ['id', 'asc']
  ];

  protected $theFields = ['name', 'description'];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

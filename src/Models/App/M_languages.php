<?php

namespace IM\CI\Models\App;

use IM\CI\Models\Modelku;

class M_languages extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = '_languages';
  protected $primaryKey = 'id';

  protected $kolom       = 'id, name, slug, directory, code, image, default, active';
  protected $gabung      = [];
  protected $sama        = [];
  protected $grupSama    = [];
  protected $seperti     = [];
  protected $grupSeperti = [];
  protected $group       = [];
  protected $punya       = [];
  protected $urut        = [
    ['slug', 'asc']
  ];

  protected $theFields = ['name', 'slug', 'directory', 'code', 'image', 'default', 'active'];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

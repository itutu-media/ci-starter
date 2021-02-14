<?php

namespace IM\CI\Models\Menu;

use IM\CI\Models\Modelku;

class M_menuItems extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = '_menus';
  protected $primaryKey = 'id';

  protected $kolom       = 'id, menu_id, parent_id, order, icon';
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

  protected $theFields = ['menu_id', 'parent_id', 'order', 'styling'];
  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

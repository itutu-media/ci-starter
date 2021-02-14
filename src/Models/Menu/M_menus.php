<?php

namespace IM\CI\Models\Menu;

use IM\CI\Models\Modelku;

class M_menus extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = '_menus';
  protected $primaryKey = 'id';

  protected $kolom      = 'b.id, parent_id, styling, c.title, icon, url, absolute_path';
  protected $gabung     = [
    ['_menu_items b', 'b.menu_id = a.id', ''],
    ['_menu_item_translations c', 'c.item_id = b.id', '']
  ];
  protected $sama        = [];
  protected $grupSama    = [];
  protected $seperti     = [];
  protected $grupSeperti = [];
  protected $group       = [];
  protected $punya       = [];
  protected $urut       = [
    ['b.order', 'asc'],
    ['b.id', 'asc']
  ];

  protected $theFields = ['title'];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

  public function getMenu($title)
  {
    return $this->_query()->where(['a.title' => $title, 'language_slug' => session('setLang')])->get()->getResultArray();
  }
}
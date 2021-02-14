<?php

namespace IM\CI\Models\Menu;

use CodeIgniter\Model;

class M_menuItemTranslations extends Model
{
  protected $DBGroup    = 'default';
  protected $table      = '_menu_item_translations';
  protected $primaryKey = 'id';
  protected $kolom      = 'id, item_id, language_slug, title, url, absolute_path';
  protected $gabung     = [];
  protected $sama       = [];
  protected $seperti    = [];
  protected $urut       = [
    ['id', 'asc']
  ];

  protected $theFields = ['item_id', 'language_slug', 'title', 'url', 'absolute_path'];
  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

}

<?php

namespace IM\CI\Models\App;

use IM\CI\Models\Modelku;

class M_groups extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = 'auth_groups';
  protected $primaryKey = 'id';

  protected $kolom       = 'id, id no, name, description, manage, COUNT(user_id) users';
  protected $gabung      = [
    ['auth_groups_users b', 'group_id = a.id', 'LEFT']
  ];
  protected $sama        = [
    ['id >', '1', 'AND']
  ];
  protected $grupSama    = [];
  protected $seperti     = [];
  protected $grupSeperti = [];
  protected $group       = ['id'];
  protected $punya       = ['id >' => '0'];
  protected $urut        = [
    ['name', 'asc']
  ];

  protected $theFields = ['name', 'description', 'manage'];
  protected $allowedFields = ['name', 'description', 'manage'];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

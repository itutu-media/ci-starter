<?php

namespace IM\CI\Models\App;

use IM\CI\Models\Modelku;

class M_userDetail extends Modelku
{
  protected $DBGroup    = 'default';
  protected $table      = 'users_details';
  protected $primaryKey = 'user_id';

  protected $kolom       = 'b.id id, b.id no, fullname, GROUP_CONCAT(d.description) group_name, active';
  protected $gabung      = [
    ['users b', 'b.id = a.user_id', ''],
    ['auth_groups_users c', 'c.user_id = b.id', 'left'],
    ['auth_groups d', 'd.id = group_id', '']
  ];
  protected $sama        = [
    ['b.id >', '1', 'AND'],
    ['group_id <>', '1', 'AND'],
    // ['manage', '1', 'AND']
  ];
  protected $grupSama    = [];
  protected $seperti     = [];
  protected $grupSeperti = [];
  protected $group       = ['b.id'];
  protected $punya       = [];
  protected $urut        = [
    ['fullname', 'asc']
  ];

  protected $theFields = ['user_id', 'fullname', 'address', 'phone', 'concentration', 'purpose', 'complete_reg'];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

<?php

namespace IM\CI\Models\App;

use CodeIgniter\Model;

class M_configuration extends Model
{
  protected $DBGroup    = 'default';
  protected $table      = '_configurations';
  protected $primaryKey = 'id';

  protected $returnType     = 'array';
  protected $useSoftDeletes = false;

  protected $allowedFields = ['config_name', 'value'];

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;
}

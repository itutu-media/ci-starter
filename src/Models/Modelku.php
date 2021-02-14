<?php

namespace IM\CI\Models;

use CodeIgniter\Model;

class Modelku extends Model
{
  protected $returnType      = 'array';
  protected $useSoftDeletes  = false;
  protected $useTimestamps   = false;
  protected $updatedField    = 'updated_at';
  protected $deletedField    = 'deleted_at';
  protected $createdField    = 'created_at';
  protected $restoredField   = 'restored_at';
  protected $createdByField  = 'created_by';
  protected $updatedByField  = 'updated_by';
  protected $deletedByField  = 'deleted_by';
  protected $restoredByField = 'restored_by';

  public function _query(array $params = [])
  {
    $builder = $this->db->table($this->table . ' a');

    if (isset($params['select']))
      $builder->select($params['select']);
    else if ($this->kolom)
      $builder->select($this->kolom);

    if ($this->gabung) {
      foreach ($this->gabung as $join) {
        $builder->join($join[0], $join[1], $join[2]);
      }
    }

    if ($this->sama) {
      foreach ($this->sama as $where) {
        if ($where[2] == 'AND')
          $builder->where($where[0], $where[1]);
        else if ($where[2] == 'OR')
          $builder->orWhere($where[0], $where[1]);
      }
    }
    if (isset($params['where']) && $params['where'] != NULL) {
      foreach ($params['where'] as $where) {
        if ($where[2] == 'AND')
          $builder->where($where[0], $where[1]);
        else if ($where[2] == 'OR')
          $builder->orWhere($where[0], $where[1]);
      }
    }

    if ($this->seperti) {
      foreach ($this->seperti as $like) {
        if ($like[2] == 'AND')
          $builder->like($like[0], $like[1], $like[2]);
        else if ($like[2] == 'OR')
          $builder->orLike($like[0], $like[1], $like[2]);
      }
    }
    if (isset($params['like']) && $params['like'] != NULL) {
      foreach ($params['like'] as $like) {
        if ($like[2] == 'AND')
          $builder->like($like[0], $like[1], $like[2]);
        else if ($like[2] == 'OR')
          $builder->orLike($like[0], $like[1], $like[2]);
      }
    }

    if ($this->grupSeperti) {
      $builder->groupStart();
      foreach ($this->grupSeperti as $like) {
        if ($like[2] == 'AND')
          $builder->like($like[0], $like[1], $like[2]);
        else if ($like[2] == 'OR')
          $builder->orLike($like[0], $like[1], $like[2]);
      }
      $builder->groupEnd();
    }
    if (isset($params['groupLike']) && $params['groupLike'] != NULL) {
      $builder->groupStart();
      foreach ($params['groupLike'] as $like) {
        if ($like[2] == 'AND')
          $builder->like($like[0], $like[1], $like[2]);
        else if ($like[2] == 'OR')
          $builder->orLike($like[0], $like[1], $like[2]);
      }
      $builder->groupEnd();
    }

    if (isset($params['group'])) {
      foreach ($params['group'] as $group) {
        $builder->groupBy($group);
      }
    } else if ($this->group) {
      foreach ($this->group as $group) {
        $builder->groupBy($group);
      }
    }

    if (isset($params['punya'])) {
      $builder->having($params['punya']);
    } else if ($this->punya) {
      $builder->having($this->punya);
    }

    if (isset($params['order'])) {
      foreach ($params['order'] as $order) {
        $builder->orderBy($order[0], $order[1]);
      }
    } else if ($this->urut) {
      foreach ($this->urut as $order) {
        $builder->orderBy($order[0], $order[1]);
      }
    }

    return $builder;
  }

  public function bertingkat(array $params = [])
  {
    $query1 = '(' . $this->_query()->getCompiledSelect(false) . ') TB';
    $total = $this->db->table($query1)->countAllResults();
    $query2 = $this->db->table($query1);

    if (isset($params['where']) && $params['where'] != NULL) {
      foreach ($params['where'] as $where) {
        if ($where[2] == 'AND')
          $query2->where($where[0], $where[1]);
        else if ($where[2] == 'OR')
          $query2->orWhere($where[0], $where[1]);
      }
    }

    if (isset($params['groupLike']) && $params['groupLike'] != NULL) {
      $query2->groupStart();
      foreach ($params['groupLike'] as $like) {
        if ($like[2] == 'AND')
          $query2->like($like[0], $like[1], $like[2]);
        else if ($like[2] == 'OR')
          $query2->orLike($like[0], $like[1], $like[2]);
      }
      $query2->groupEnd();
    }

    if (isset($params['limit']))
      $query2->limit($params['limit']['perpage'], $params['limit']['page']);
    $data = $query2->get()->getResultArray();
    return ['total' => $total, 'rows' => $data];
  }

  public function semua(array $params = [])
  {
    $total = $this->_query($params)->countAllResults();
    $query = $this->_query($params);

    if (isset($params['limit']))
      $query->limit($params['limit']['perpage'], $params['limit']['page']);

    $data = $query->get()->getResultArray();
    return ['total' => $total, 'rows' => $data];
  }

  public function eksis(array $params = [])
  {
    $total = $this->_query($params)->where('a.deleted', 0)->countAllResults();
    $query = $this->_query($params);

    if (isset($params['limit']))
      $query->limit($params['limit']['perpage'], $params['limit']['page']);

    $data = $query->where('a.deleted', 0)->get()->getResultArray();
    return ['total' => $total, 'rows' => $data];
  }

  public function aktif(array $params = [])
  {
    $total = $this->_query($params)->where('a.active', 1)->countAllResults();
    $query = $this->_query($params);

    if (isset($params['limit']))
      $query->limit($params['limit']['perpage'], $params['limit']['page']);

    $data = $query->where('a.active', 1)->get()->getResultArray();
    return ['total' => $total, 'rows' => $data];
  }

  public function efektif(array $params = [])
  {
    $total = $this->_query($params)->where('a.deleted', 0)->where('a.active', 1)->countAllResults();
    $query = $this->_query($params);

    if (isset($params['limit']))
      $query->limit($params['limit']['perpage'], $params['limit']['page']);

    $data = $query->where('a.deleted', 0)->where('a.active', 1)->get()->getResultArray();
    return ['total' => $total, 'rows' => $data];
  }

  public function sampah(array $params = [])
  {
    $total = $this->_query($params)->where('a.deleted', 1)->countAllResults();
    $query = $this->_query($params);

    if (isset($params['limit']))
      $query->limit($params['limit']['perpage'], $params['limit']['page']);

    $data = $query->where('a.deleted', 1)->get()->getResultArray();
    return ['total' => $total, 'rows' => $data];
  }

  public function baris(int $id, array $params = [])
  {
    $query = $this->_query($params);
    // if ($this->primaryKey == 'id')
    //   $query->where('a.id', $id);
    // else
    $query->where('a.' . $this->primaryKey, $id);
    $query->limit(1);
    return $query->get()->getRowArray();
  }

  public function tambah($data)
  {
    $systemFields        = [$this->createdField, $this->createdByField];
    $this->allowedFields = array_merge($this->theFields, $systemFields);

    $data[$this->createdField]   = date('Y-m-d H:i:s');
    $data[$this->createdByField] = (user()->id) ?? NULL;
    return $this->insert($data);
  }

  public function ubah($id, $data)
  {
    $systemFields        = [$this->updatedField, $this->updatedByField];
    $this->allowedFields = array_merge($this->theFields, $systemFields);

    $data[$this->updatedField]   = date('Y-m-d H:i:s');
    $data[$this->updatedByField] = (user()->id) ?? NULL;
    return $this->update($id, $data);
  }

  public function hapus($id)
  {
    $systemFields        = ['deleted', $this->deletedField, $this->deletedByField];
    $this->allowedFields = array_merge($this->theFields, $systemFields);

    $data[$this->primaryKey]     = $id;
    $data['deleted']             = 1;
    $data[$this->deletedField]   = date('Y-m-d H:i:s');
    $data[$this->deletedByField] = (user()->id) ?? NULL;
    return $this->save($data);
  }

  public function pulih($id)
  {
    $systemFields        = ['deleted', $this->restoredField, $this->restoredByField];
    $this->allowedFields = array_merge($this->theFields, $systemFields);

    $data[$this->primaryKey]      = $id;
    $data['deleted']              = 0;
    $data[$this->restoredField]   = date('Y-m-d H:i:s');
    $data[$this->restoredByField] = (user()->id) ?? NULL;
    return $this->save($data);
  }

  public function hapusPermanen($id)
  {
    return $this->delete($id);
  }
}

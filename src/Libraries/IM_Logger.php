<?php

namespace IM\CI\Libraries;

class IM_Logger
{
  private $tableName   = '_logs';
  private $tableFields = [
    'id'         => 'id',
    'created_at' => '_logs.created_at',
    'time'       => 'time',
    'user_id'    => '_logs.user_id',
    'ip_address' => 'ip_address',
    'action'     => 'action',
    'module'     => 'module',
    'module_id'  => 'module_id',
    'note'       => 'note',
    'status'     => 'status',
  ];
  private $theLogId    = NULL;
  private $user_id     = NULL;
  private $ipAddress   = NULL;
  private $theAction   = NULL;
  private $theModule   = NULL;
  private $theModuleId = NULL;
  private $theNote     = NULL;
  private $theStatus   = NULL;
  private $theDate     = NULL;
  private $thisDay     = NULL;
  private $theTime     = NULL;
  private $fromDate    = NULL;
  private $toDate      = NULL;
  private $order       = ['_logs.id', 'desc'];

  public function __construct()
  {
    $this->request = \Config\Services::request();
    $this->db      = \Config\Database::connect();
    $this->builder = $this->db->table($this->tableName);
  }

  public function id($theLogId)
  {
    $this->theLogId = $theLogId;
    return $this;
  }

  public function user($user_id)
  {
    $this->user_id = $user_id;
    return $this;
  }

  public function ip($ipAddress)
  {
    $this->ipAddress = $ipAddress;
    return $this;
  }

  public function action($theAction)
  {
    $this->theAction = $theAction;
    return $this;
  }

  public function module($theModule)
  {
    $this->theModule = $theModule;
    return $this;
  }

  public function moduleId($theModuleId)
  {
    $this->theModuleId = $theModuleId;
    return $this;
  }

  public function note($theNote)
  {
    if (is_array($theNote))
      $this->theNote = json_encode($theNote);
    else
      $this->theNote = $theNote;
    return $this;
  }

  public function status($theStatus)
  {
    $this->theStatus = $theStatus;
    return $this;
  }

  public function today()
  {
    $this->theDate = date('Y-m-d');
    return $this;
  }

  public function date($theDate)
  {
    $this->theDate = $theDate;
    return $this;
  }

  public function time($theTime)
  {
    $this->theTime = $theTime;
    return $this;
  }

  public function dateRange($from, $to)
  {
    $this->fromDate = $from;
    $this->toDate   = $to;
    return $this;
  }

  public function orderBy($order)
  {
    $this->order = $order;
    return $this;
  }

  public function log()
  {
    $data        = array(
      $this->tableFields['created_at'] => date('Y-m-d'),
      $this->tableFields['time']       => date('H:i:s'),
      $this->tableFields['user_id']    => ($this->user_id) ?? user()->id,
      $this->tableFields['ip_address'] => $this->request->getIPAddress(),
      $this->tableFields['action']     => $this->theAction,
      $this->tableFields['module']     => $this->theModule,
      $this->tableFields['module_id']  => $this->theModuleId,
      $this->tableFields['note']       => $this->theNote,
      $this->tableFields['status']     => $this->theStatus,
    );
    $this->builder->insert($data);
    $this->flushParameter();
  }

  public function last()
  {
    return $this->builder->orderBy('id', 'desc')->limit(1)->get()->getRow();
  }

  protected function _getQueryMaker()
  {
    $this->builder->select('id, _logs.created_at, time, _logs.user_id, fullname user, ip_address, action, module, module_id, note, status');
    $this->builder->join('users_details b', 'b.user_id = _logs.user_id', 'left');
    if ($this->theLogId)
      $this->builder->where($this->tableFields['id'], $this->theLogId);
    if ($this->user_id)
      $this->builder->where($this->tableFields['user_id'], $this->user_id);
    if ($this->ipAddress)
      $this->builder->where($this->tableFields['ip_address'], $this->ipAddress);
    if ($this->theAction)
      $this->builder->where($this->tableFields['action'], $this->theAction);
    if ($this->theModule)
      $this->builder->where($this->tableFields['module'], $this->theModule);
    if ($this->theModuleId)
      $this->builder->where($this->tableFields['module_id'], $this->theModuleId);
    if ($this->theNote)
      $this->builder->where($this->tableFields['note'], $this->theNote);
    if ($this->theStatus != NULL)
      $this->builder->where($this->tableFields['status'], $this->theStatus);
    if ($this->thisDay)
      $this->builder->where($this->tableFields['created_at'], $this->thisDay);
    if ($this->theDate)
      $this->builder->where($this->tableFields['created_at'], $this->theDate);
    if ($this->theTime)
      $this->builder->where($this->tableFields['time'], $this->theTime);
    if ($this->fromDate)
      $this->builder->where("{$this->tableFields['created_at']} >", $this->fromDate);
    if ($this->toDate)
      $this->builder->where("{$this->tableFields['created_at']} >", $this->toDate);
  }

  public function total()
  {
    $this->_getQueryMaker();
    return $this->builder->countAllResults();
  }

  public function get($return = NULL, $perpage, $page)
  {
    $this->_getQueryMaker();
    $total = $this->builder->countAllResults();
    $this->_getQueryMaker();
    $this->builder->orderBy($this->order[0], $this->order[1]);
    $this->builder->limit($perpage, $page);
    if ($return === 'array')
      return ['total' => $total, 'rows' => $this->builder->get()->getResultArray()];
    else
      return $this->_dbcleanresult();
  }

  public function lastQuery()
  {
    return (string) $this->db->getLastQuery();
  }

  public function removeLog()
  {
    $this->_getQueryMaker();
    $this->builder->truncate();
  }

  public function getById($id)
  {
    $this->_getQueryMaker();
    return $this->builder->where('_logs.id', $id)->get()->getRowArray();
  }

  public function getIds()
  {
    $this->_getQueryMaker();
    $ids = $this->builder->select('_logs.id id')->get()->getResultArray();
    return array_column($ids, 'id');
  }

  protected function _dbcleanresult()
  {
    if ($this->builder->countAllResults() > 1)
      return $this->builder->get()->getResult();
    if ($this->builder->countAllResults() == 1)
      return $this->builder->get()->getRow();
    else
      return FALSE;
  }

  public function flushParameter()
  {
    $this->theLogId    = NULL;
    $this->user_id     = NULL;
    $this->ipAddress   = NULL;
    $this->theAction   = NULL;
    $this->theModule   = NULL;
    $this->theModuleId = NULL;
    $this->theNote     = NULL;
    $this->thestatus   = NULL;
    $this->thisDay     = NULL;
    $this->theDate     = NULL;
    $this->theTime     = NULL;
    $this->fromDate    = NULL;
    $this->toDate      = NULL;
    $this->order       = ['_logs.id', 'desc'];
  }
}

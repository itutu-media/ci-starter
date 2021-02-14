<?php

namespace IM\CI\Libraries;

class Elogger
{
  private $tableName   = '_logs';
  private $tableFields = [
    'id'         => 'id',
    'created_at' => 'created_at',
    'time'       => 'time',
    'user_id'    => 'user_id',
    'ip_address' => 'ip_address',
    'action'     => 'action',
    'module'     => 'module',
    'module_id'  => 'module_id',
    'note'       => 'note',
  ];
  private $theLogId     = 0;
  private $kyano      = 0;
  private $ipAddress;
  private $theAction    = false;
  private $theModule    = false;
  private $theModuleId = false;
  private $theNote      = '';
  private $thisDay;
  private $theDate = 0;
  private $theTime;
  private $fromDate;
  private $toDate;
  private $order = ['id', 'desc'];

  public function __construct()
  {
    $this->request = \Config\Services::request();
    $db            = \Config\Database::connect();
    $this->builder = $db->table($this->tableName);
  }

  public function id($theLogId)
  {
    $this->theLogId = $theLogId;
    return $this;
  }

  public function user($kyano)
  {
    $this->kyano = $kyano;
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
    $this->theNote = $theNote;
    return $this;
  }

  public function today()
  {
    $this->theDate = date('Y-m-d');
    return $this;
  }

  public function date($theNote)
  {
    $this->theNote = $theNote;
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
      $this->tableFields['kyano']      => session('kyano'),
      $this->tableFields['ip_address'] => $this->request->getIPAddress(),
      $this->tableFields['action']     => $this->theAction,
      $this->tableFields['module']     => $this->theModule,
      $this->tableFields['module_id']  => $this->theModuleId,
      $this->tableFields['note']       => $this->theNote,
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
    if ($this->theLogId)
      $this->builder->where($this->tableFields['id'], $this->theLogId);
    if ($this->kyano)
      $this->builder->where($this->tableFields['kyano'], $this->kyano);
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
    if ($this->thisDay)
      $this->builder->where($this->tableFields['created_at'], $this->thisDay);
    if ($this->theDate)
      $this->builder->where($this->tableFields['created_at'], $this->theDate);
    if ($this->theTime)
      $this->builder->where($this->tableFields['time'], $this->theTime);
    if ($this->fromDate)
      $this->builder->where("{$this->tableFields['created_on']} >", $this->fromDate);
    if ($this->toDate)
      $this->builder->where("{$this->tableFields['created_on']} >", $this->toDate);
  }

  public function total()
  {
    $this->_getQueryMaker();
    return $this->builder->countAllResults();
  }

  public function get($return = NULL)
  {
    $this->_getQueryMaker();
    $this->builder->orderBy($this->order[0], $this->order[1]);
    if ($return === 'array')
      return $this->builder->get()->getResultArray();
    else
      return $this->_dbcleanresult();
  }

  public function removeLog() {
    $this->_getQueryMaker();
    $this->builder->truncate();
  }
  
  public function getIds() {
    $this->_getQueryMaker();
    $ids = $this->builder->select('id')->get()->getResultArray();
    return array_column($ids, 'id');
  }

  protected function _dbcleanresult()
  {
    if ($this->builder->countAllResults() > 1)
      return $this->builder->get()->getResult();
    if ($this->builder->countAllResults() == 1)
      return $this->builder->get()->getRow();
    else
      return false;
  }

  public function flushParameter()
  {
    $theLogId    = 0;
    $kyano       = 0;
    $ipAddress   = 0;
    $theAction   = false;
    $theModule   = false;
    $theModuleId = false;
    $theNote     = '';
    $thisDay     = 0;
    $theDate     = 0;
    $theTime     = 0;
    $fromDate    = 0;
    $toDate      = 0;
    $order       = ['id', 'desc'];
  }
}

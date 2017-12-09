<?php

class DB {
  protected $c;

  public function __construct() {
    $options = [
        PDO::ATTR_PERSISTENT         => true,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];
    $this->c = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS, $options);
  }
  
  public function fetch($query, $args) {
      $stmt = $this->c->prepare($query);
      foreach($args as $key => $arg) {
          $stmt->bindValue(($key+1), $arg['value'], $arg['type']);
      }
      if(!$stmt->execute()) return false;
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($stmt->rowCount() == 0) return false;
      return $data;
  }
  public function fetchAll($query, $args) {
      $stmt = $this->c->prepare($query);
      foreach($args as $key => $arg) {
          $stmt->bindValue(($key+1), $arg['value'], $arg['type']);
      }
      if(!$stmt->execute()) return false;
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if ($stmt->rowCount() == 0) return false;
      return $data;
  }


}

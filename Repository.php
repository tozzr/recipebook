<?php

class Repository {

  private $db;

  function __construct() {
    $this->db = new PDO("mysql:host=localhost;dbname=recipebook", "chef", "menu")
      or die ("error: no connection to db. wrong credentials.");
  }

  function __destruct() {
    $this->db = null;
  }

  function findItems($query) {
    $statement = $this->query($query);
    return $statement->fetchAll();
  }

  function findItemById($name, $id) {
    $statement = $this->query("SELECT * FROM " . $name . " WHERE id = :id;", array("id" => $id));
    $items = array();
    while ($row = $statement->fetch()) {
      array_push($items, $row) or die('could not add to array');
    }
    return $items[0];
  }

  function findItemByPosition($name, $pos) {
    $statement = $this->query("SELECT * FROM " . $name . " WHERE position = :pos;", array("pos" => $pos));
    $items = array();
    while ($row = $statement->fetch()) {
      array_push($items, $row) or die('could not add to array');
    }
    return $items[0];
  }

  function countItems($name) {
    $statement = $this->query("SELECT COUNT(id) AS count FROM " . $name . ";");
    $res = array();
    while ($row = $statement->fetch()) {
      array_push($res, $row) or die('could not add to array');
    }
    return $res[0];
  }

  function create($query, $params) {
    $this->query($query, $params);
    return $this->db->lastInsertId();
  }

  function query($sql, $params = null) {
    $statement = $this->db->prepare($sql) or die("statement wrong");
    if ($params)
      $statement->execute($params) or die("execute failed with params: " . $this->db->errorInfo());
    else
      $statement->execute() or die("exuecte failed with params: " . $this->db->errorInfo());
    return $statement;
  }

  function saveBlob($sql, $id, $data) {
    $statement = $this->db->prepare($sql);
    $statement->bindParam(':image', $data, PDO::PARAM_LOB);
    $statement->bindParam(':id', $id);
    $statement->execute();
  }

  function delete($name, $id) {
    $this->query("DELETE FROM " . $name . " WHERE id = :id", array("id" => $id));
  }
}

?>

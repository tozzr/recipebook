<?php

class Repository {

  private $db;

  function __construct() {
    $this->db = mysqli_connect(
      'localhost',
      "chef",
      "menu",
      "recipebook"
    ) or die ("error: no connection to db. wrong credentials.");
  }

  function __destruct() {
    $this->db->close();
  }

  function findItems($query) {
    $res = $this->db->query($query) or die("query " . $query . " is wrong: " . mysql_error());
    $items = array();
    $res->data_seek(0);
    while ($row = $res->fetch_assoc()) {
      array_push($items, $row) or die('could not add to array');
    }

    return $items;
  }

  function findItem($query) {
    $res = $this->db->query($query) or die("query " . $query . " is wrong: " . mysql_error());
    $items = array();
    $res->data_seek(0);
    while ($row = $res->fetch_assoc()) {
      array_push($items, $row) or die('could not add to array');
    }
    return $items[0];
  }

  function create($query) {
    $this->db->query($query) or die("query " . $query . " is wrong: " . mysql_error());
    return mysqli_insert_id($this->db);
  }

  function query($query) {
    $this->db->query($query) or die("query " . $query . " is wrong: " . mysql_error());
  }
}

?>

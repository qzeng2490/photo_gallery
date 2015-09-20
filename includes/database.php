<?php
require_once('config.php');
class MySQLDatabase {

  private $connection;

  function __construct() {
    $this->open_connection();
  }

  public function open_connection() {

    if (isset($_SERVER['SERVER_SOFTWARE']) &&
      strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
        // Connect from App Engine.
           $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME,DB_PORT,DB_SOCKET);
      } else {
        // Connect from a development environment.
           $this->connection = mysqli_connect(DB_IP, DB_USER, DB_PASS,DB_NAME);
    }
    if(mysqli_connect_errno()) {
      die("Database connection failed: " .
          mysqli_connect_error() .
          " (" . mysqli_connect_errno() . ")"
      );
    }
  }

  public function close_connection() {
    if(isset($this->connection)) {
      mysqli_close($this->connection);
      unset($this->connection);
    }
  }

  public function query($sql) {
    $result = mysqli_query($this->connection, $sql);
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result) {
    if (!$result) {
      die("Database query failed.");
    }
  }

  public function escape_value($string) {
    $escaped_string = mysqli_real_escape_string($this->connection, $string);
    return $escaped_string;
  }

  // "database neutral" functions

  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
  }

  public function num_rows($result_set) {
    return mysqli_num_rows($result_set);
  }

  public function insert_id() {
    // get the last id inserted over the current db connection
    return mysqli_insert_id($this->connection);
  }

  public function affected_rows() {
    return mysqli_affected_rows($this->connection);
  }

}

$database = new MySQLDatabase();
$db =& $database;

?>
<?php
class User
{
  private $_db;

  function __construct()
  {
    global $db;
    $this->_db = $db;
  }

  public function auth($username, $password)
  {
    $query = mysql_query('SELECT id FROM users WHERE username = "' . @mysql_escape_string($username) . '" AND password = "' . @mysql_escape_string($password) . '"');
    $result = mysql_fetch_assoc($query);
    mysql_free_result($query);
    return $result ? $result['id'] : false;
  }

  /**
   * 获取用户列表
   * @param void
   * @return array
   */
  public function getList()
  {
    $query = mysql_query('SELECT * FROM users');
    $list = array();
    while ($row = mysql_fetch_assoc($query)) {
      $list[] = $row;
    }
    mysql_free_result($query);
    return $list;
  }

  public function get($userId)
  {
    $query = mysql_query('SELECT * FROM users WHERE id = "' . @mysql_escape_string($userId) . '"');
    $result = mysql_fetch_assoc($query);
    mysql_free_result($query);
    return $result;
  }

  public function insert($username, $password, $nickname, $sex, $age)
  {
    $username = @mysql_escape_string($username);
    $password = @mysql_escape_string($password);
    $nickname = @mysql_escape_string($nickname);
    $sex = @mysql_escape_string($sex);
    $age = @mysql_escape_string($age);
    mysql_unbuffered_query('INSERT IGNORE INTO users (username, password, nickname, sex, age) VALUES ("' .
        $username . '", "' . $password . '", "' . $nickname . '", "' . $sex . '", "' . $age . '")');
    return mysql_insert_id();
  }

  public function update($userId, $username, $password, $nickname, $sex, $age)
  {
    $username = @mysql_escape_string($username);
    $password = @mysql_escape_string($password);
    $nickname = @mysql_escape_string($nickname);
    $sex = @mysql_escape_string($sex);
    $age = @mysql_escape_string($age);
    mysql_unbuffered_query('UPDATE users SET username = "' . $username . '",  password = "' . $password . '",  nickname = "' . $nickname . '",  sex = "' . $sex . '",  age = "' . $age . '" WHERE id = "' . @mysql_escape_string($userId) . '"');
    return mysql_affected_rows();
  }

  public function delete($userId)
  {
    mysql_unbuffered_query('DELETE FROM users WHERE id = "' . @mysql_escape_string($userId) . '"');
    return mysql_affected_rows();
  }
}

<?php

    class Database{
        private $db_host = "localhost";
        private $db_user = "root";
        private $db_pass = "";
        private $db_name = "oop_crud";


        private $mysqli = "";
        private $result = array();
        private $conn = false;

        // database connection
        public function __construct()
        {
            if (!$this->conn) {
                $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
                $this->conn = true;

                if ($this->mysqli->connect_error) {
                    array_push($this->result, $this->mysqli->connect_error);
                    return false;
                }
            } else {
                return true;
            }
        }

        // Insert into the database
        public function insert($table, $params=array())
        {
            if ($this->tableExists($table)) {
                // print_r($params);
                $tableColumns = implode(', ', array_keys($params));
                $tableValue = implode("', '", $params);

                $sql = "INSERT INTO $table ($tableColumns) VALUES ('$tableValue')";
                if ($this->mysqli->query($sql)) {
                    array_push($this->result, $this->mysqli->insert_id);
                    return true;
                } else {
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }

            } else {
               return false;
            }
        }

        // Update into the database
        public function update($table, $params=array(), $where = null)
        {
            if ($this->tableExists($table)) {
                // print_r($params);
                $args = array();
                foreach ($params as $key => $value) {
                    $args[] = "$key = '$value'";
                }
                // print_r($args);

                $sql = "UPDATE $table SET " . implode(', ', $args);

                if ($where != null) {
                    $sql .= " WHERE $where";
                }
                // echo $sql;

                if ($this->mysqli->query($sql)) {
                    array_push($this->result, $this->mysqli->affected_rows);
                    return true;
                } else {
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
                
            } else {
                return false;
             }
        }

        // Delete into the database
        public function delete($table, $where = null)
        {
            if ($this->tableExists($table)) {
                $sql = "DELETE FROM $table";
                if ($where != null) {
                    $sql .= " WHERE $where";
                }
                // echo $sql;
                if ($this->mysqli->query($sql)) {
                    array_push($this->result, $this->mysqli->affected_rows);
                    return true;
                } else {
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            } else {
                return false;
            }
            
        }

        // Select into the database

        public function select($table, $rows = "*", $join = null, $where = null, $order = null, $limit = null)
        {
            if ($this->tableExists($table)) {
                $sql = "SELECT $rows FROM $table";
                if ($join != null) {
                    $sql .= " JOIN $join";
                }
                if ($where != null) {
                    $sql .= " WHERE $where";
                }
                if ($order != null) {
                    $sql .= " ORDER BY $order";
                }
                if ($limit != null) {
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $start = ($page - 1) * $limit;
                    $sql .= " LIMIT $start, $limit";
                }

                // echo $sql;

                $query = $this->mysqli->query($sql);
                if ($query) {
                    $this->result = $query->fetch_all(MYSQLI_ASSOC);
                    return true;
                } else {
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
                
            } else {
                return false;
            }
        }

        // pagination
        public function pagination($table, $join = null, $where = null, $limit = null)
        {
            if ($this->tableExists($table)) {
                if ($limit != null) {
                    $sql = "SELECT COUNT(*) FROM $table";
                    if ($join != null) {
                        $sql .= " JOIN $join";
                    }
                    if ($where != null) {
                        $sql .= " WHERE $where";
                    }
                } else {
                    return false;
                }

                $query = $this->mysqli->query($sql);
                $total_records = $query->fetch_array();
                print_r($total_records);
            } else {
                return false;
            }
        }

        public function sql($sql)
        {
            $query = $this->mysqli->query($sql);
            if ($query) {
                $this->result = $query->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
            
        }

        // Table exists / check in database

        private function tableExists($table)
        {
            $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
            $tableInDb = $this->mysqli->query($sql);
            if ($tableInDb) {
                if ($tableInDb->num_rows == 1) {
                    return true;
                } else {
                    array_push($this->result, $table. "Does not exists in this database.");
                    return false;  
                }
            }
        }

        // get result / show result
        public function getResult()
        {
            $val = $this->result;
            $this->result = array();
            return $val;
        }

        // close connection
        public function __destruct()
        {
            if ($this->conn) {
                if ($this->mysqli->close()) {
                    $this->conn = false;
                    return true;
                }
            } else {
                return false;
            }
            
        }
    }

?>
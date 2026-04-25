<?php
/**
 * Database Class
 * Handles database operations, prepared statements, and queries
 * 
 * Usage:
 *   require '../src/Database/Database.php';
 *   $db = new Database($conn);
 *   $result = $db->query("SELECT * FROM users WHERE id = ?", [$id]);
 */

class Database {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Execute prepared statement
     */
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        if ($params) {
            $types = $this->getParamTypes($params);
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt;
    }

    /**
     * Determine parameter types for bind_param
     */
    private function getParamTypes($params) {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        return $types;
    }
}
?>

<?php
/**
 * AuthHandler Class
 * Handles user authentication (login, register, validation)
 * 
 * Usage:
 *   require '../src/Auth/AuthHandler.php';
 *   $auth = new AuthHandler($conn);
 *   $auth->register($name, $email, $password);
 */

class AuthHandler {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Login a user
     */
    public function login($email, $password) {
        // Logic here
    }

    /**
     * Register a new user
     */
    public function register($name, $email, $password, $phone = null) {
        // Logic here
    }

    /**
     * Hash password
     */
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Verify password
     */
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
?>

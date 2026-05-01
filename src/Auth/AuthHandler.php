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
     * @return array ['success' => bool, 'message' => string, 'data' => array]
     */
    public function login($email, $password) {
        // Trim inputs
        $email = trim($email);

        if (empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Email and Password are required!'];
        }

        $stmt = $this->conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
        
        if (!$stmt) {
            return ['success' => false, 'message' => 'Database error!'];
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Initialize variables to prevent IDE unassigned variable warnings
            $id = $name = $retrievedEmail = $hashedPassword = $role = null;
            
            $stmt->bind_result($id, $name, $retrievedEmail, $hashedPassword, $role);
            $stmt->fetch();

            if (password_verify($password, (string)$hashedPassword)) {
                $stmt->close();
                return [
                    'success' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'user_id' => $id,
                        'user_name' => $name,
                        'user_email' => $retrievedEmail,
                        'user_role' => $role
                    ]
                ];
            } else {
                $stmt->close();
                return ['success' => false, 'message' => 'Invalid password!'];
            }
        }
        $stmt->close();
        return ['success' => false, 'message' => 'No account found with that email!'];
    }

    /**
     * Register a new user
     * @return array ['success' => bool, 'message' => string]
     */
    public function register($name, $email, $password, $phone = null) {
        // Trim and validate inputs
        $name = trim($name);
        $email = trim($email);
        $phone = !empty($phone) ? trim($phone) : null;

        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'Name, Email and Password are required!'];
        }

        // Name validation (at least 2 characters)
        if (strlen($name) < 2) {
            return ['success' => false, 'message' => 'Name must be at least 2 characters!'];
        }

        // Name validation (max 100 characters)
        if (strlen($name) > 100) {
            return ['success' => false, 'message' => 'Name must not exceed 100 characters!'];
        }

        // Email format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email format!'];
        }

        // Password strength validation
        if (strlen($password) < 8) {
            return ['success' => false, 'message' => 'Password must be at least 8 characters!'];
        }

        // Phone validation (if provided)
        if (!empty($phone) && !preg_match('/^[0-9+\-\(\)\s]{7,20}$/', $phone)) {
            return ['success' => false, 'message' => 'Invalid phone number format!'];
        }

        // Check if email already exists
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return ['success' => false, 'message' => 'Email already registered!'];
        }
        $stmt->close();

        // Insert user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone, profile_pic, role) VALUES (?, ?, ?, ?, 'default.png', 'user')");
        
        if (!$stmt) {
            return ['success' => false, 'message' => 'Database error: ' . $this->conn->error];
        }

        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $phone);
        
        if ($stmt->execute()) {
            $stmt->close();
            return ['success' => true, 'message' => 'Registration successful! You can now login.'];
        } else {
            $error = $stmt->error;
            $stmt->close();
            return ['success' => false, 'message' => 'Something went wrong. Try again.'];
        }
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

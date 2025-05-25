<?php

/**
 * User class to handle user-related database operations.
 */
class User {
    /**
     * @var Database The database connection instance.
     */
    private $db;

    /**
     * Constructor to inject the Database dependency.
     *
     * @param Database $db The Database instance.
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Finds a user by their login.
     *
     * @param string $login The user's login.
     * @return array|null An associative array of user data, or null if not found.
     */
    public function findByLogin(string $login): ?array {
        $stmt = $this->db->query("SELECT * FROM users WHERE login = ?", [$login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Creates a new user in the database.
     *
     * @param string $login The user's login.
     * @param string $password The user's plain password.
     * @return void
     */
    public function create(string $login, string $password): void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO users (login, password) VALUES (?, ?)", [$login, $hashedPassword]);
    }

    /**
     * Verifies a plain password against a hashed password.
     *
     * @param string $password The plain password.
     * @param string $hashedPassword The hashed password from the database.
     * @return bool True if the password matches, false otherwise.
     */
    public function verifyPassword(string $password, string $hashedPassword): bool {
        return password_verify($password, $hashedPassword);
    }
}
?>
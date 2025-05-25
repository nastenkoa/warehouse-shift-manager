<?php

/**
 * Auth class to handle user authentication and session management.
 */
class Auth {
    /**
     * @var User The User instance for interacting with user data.
     */
    private $user;

    /**
     * Constructor to inject the User dependency and start the session.
     *
     * @param User $user The User instance.
     */
    public function __construct(User $user) {
        $this->user = $user;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Attempts to log in a user.
     *
     * @param string $login The user's login.
     * @param string $password The user's plain password.
     * @return bool True on successful login, false otherwise.
     */
    public function login(string $login, string $password): bool {
        $user = $this->user->findByLogin($login);
        if ($user && $this->user->verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        return false;
    }

    /**
     * Logs out the current user by destroying the session.
     *
     * @return void
     */
    public function logout(): void {
        session_destroy();
    }

    /**
     * Checks if a user is currently logged in.
     *
     * @return bool True if a user ID is set in the session, false otherwise.
     */
    public static function check(): bool {
        return isset($_SESSION['user_id']);
    }

    /**
     * Gets the ID of the currently logged-in user.
     *
     * @return int|null The user ID if logged in, null otherwise.
     */
    public function getUserId(): ?int {
        return $_SESSION['user_id'] ?? null;
    }
}
?>
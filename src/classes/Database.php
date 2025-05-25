<?php

/**
 * Database class to handle database connections and queries using PDO.
 */
class Database {
    /**
     * @var PDO The PDO database connection instance.
     */
    private $pdo;

    /**
     * Constructor to establish a database connection.
     *
     * @param string $db_path The path to the SQLite database file.
     */
    public function __construct(string $db_path) {
        $this->pdo = new PDO('sqlite:' . $db_path); 
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Executes a prepared SQL query.
     *
     * @param string $sql The SQL query string.
     * @param array $params An array of parameters to bind to the query.
     * @return PDOStatement The executed PDO statement.
     */
    public function query(string $sql, array $params = []): PDOStatement {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Returns the underlying PDO instance.
     *
     * @return PDO The PDO instance.
     */
    public function getPdo(): PDO {
        return $this->pdo;
    }
}
?>
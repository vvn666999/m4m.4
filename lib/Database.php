<?php
/**
 * Simple MySQLi wrapper class for basic database operations.
 */
class Database {
    /** @var mysqli */
    private $connection;

    /**
     * Constructor - establishes the database connection using provided config.
     *
     * @param array $config Array containing host, user, pass, and name.
     * @throws Exception When connection fails.
     */
    public function __construct(array $config)
    {
        $this->connection = new mysqli(
            $config['host'] ?? 'localhost',
            $config['user'] ?? 'root',
            $config['pass'] ?? '',
            $config['name'] ?? ''
        );

        if ($this->connection->connect_error) {
            throw new Exception('Connection failed: ' . $this->connection->connect_error);
        }
    }

    /**
     * Execute a parameterized query and return the mysqli result.
     *
     * @param string $sql SQL statement with placeholders.
     * @param string $types Parameter types for bind_param.
     * @param array $params Parameters to bind.
     * @return mysqli_result|bool
     */
    public function query(string $sql, string $types = '', array $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $this->connection->error);
        }

        if ($types && $params) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    /**
     * Convenience method to fetch all rows from a query.
     *
     * @param string $sql
     * @param string $types
     * @param array $params
     * @return array
     */
    public function fetchAll(string $sql, string $types = '', array $params = []): array
    {
        $result = $this->query($sql, $types, $params);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Convenience method to fetch a single row.
     *
     * @param string $sql
     * @param string $types
     * @param array $params
     * @return array|null
     */
    public function fetchRow(string $sql, string $types = '', array $params = []): ?array
    {
        $result = $this->query($sql, $types, $params);
        return $result ? $result->fetch_assoc() : null;
    }

    /**
     * Close the database connection.
     */
    public function close(): void
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}

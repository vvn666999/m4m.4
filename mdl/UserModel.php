<?php
require_once __DIR__ . '/../lib/Database.php';

class UserModel {
    private Database $db;
    private string $table = 'users';

    public function __construct(Database $db) {
        $this->db = $db;
        $this->createTableIfNotExists();
    }

    private function createTableIfNotExists(): void {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(50),
            password VARCHAR(255) NOT NULL,
            type VARCHAR(50),
            is_active TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->db->query($sql);
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO {$this->table} (full_name, email, phone, password, type, is_active) VALUES (?,?,?,?,?,?)";
        $this->db->query($sql, 'sssssi', [
            $data['full_name'],
            $data['email'],
            $data['phone'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['type'] ?? '',
            isset($data['is_active']) ? (int)$data['is_active'] : 1
        ]);
        return true;
    }

    public function findByEmail(string $email): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        return $this->db->fetchRow($sql, 's', [$email]);
    }
}

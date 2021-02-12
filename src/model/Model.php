<?php

class Model
{
    protected $connection;
    protected $tableName;
    protected $tableFields;

    /**
     * Model constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function read(int $id): array
    {
        $this->checkIfQueryExist($id);
        $sql = "SELECT * FROM $this->tableName WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(array $data): int
    {
        $this->validateFields($data);
        $placeholders = rtrim(str_repeat("?,", count($data)), ",");
        $fields = implode(",", array_keys($data));
        $sql = "INSERT INTO $this->tableName ($fields) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute(array_values($data));
    }

    public function readAll(): array
    {
        $sql = "SELECT * FROM " . $this->tableName;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update(array $data, int $id): int
    {
        $this->checkIfQueryExist($id);
        $set = "";
        $params = [];
        foreach ($data as $key => $value) {
            $set .= $key . '=' . '?,';
            $params[] = $value;
        }
        $set = rtrim($set, " ,");
        $params[] = $id;
        $sql = "UPDATE $this->tableName SET $set WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete(int $id): int
    {
        $this->checkIfQueryExist($id);
        $sql = "DELETE FROM `$this->tableName` WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function checkIfQueryExist(int $id): void
    {
        $sql = "SELECT * FROM $this->tableName WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new InvalidArgumentException("Invalid ID");
        }

    }

    public function validateFields(array $data): void
    {
        $diff = array_diff(array_keys($data), $this->tableFields);
        if ($diff) {
            throw new InvalidArgumentException("Unknown fields: " . implode($diff));
        }
    }
}
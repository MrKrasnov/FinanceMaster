<?php

namespace App\Services\SQLQueryBuilder;

use PDO;

final class InsertQueryBuilder extends QueryBuilder
{
    public function insertInto(string $table): self
    {
        $this->query = "INSERT INTO $table";
        return $this;
    }

    public function setValues(array $data): self
    {
        $columns = [];
        $placeholders = [];

        foreach ($data as $key => $value) {
            $columns[] = $key;
            $paramName = $this->generateParamName();
            $placeholders[] = $paramName;
            $this->params[$paramName] = $value;
        }

        $this->query .= " (" . implode(', ', $columns) . ")";
        $this->query .= " VALUES (" . implode(', ', $placeholders) . ")";

        return $this;
    }

    public function execute(PDO $pdo): bool
    {
        $stmt = $pdo->prepare($this->query);
        return $stmt->execute($this->params);
    }
}
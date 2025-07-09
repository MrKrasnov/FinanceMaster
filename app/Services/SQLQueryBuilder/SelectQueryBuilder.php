<?php

namespace App\Services\SQLQueryBuilder;

use App\Services\SQLQueryBuilder\QueryBuilder;
use PDO;

final class SelectQueryBuilder extends QueryBuilder
{
    public function select(?array $columns): SelectQueryBuilder {
        if(isset($columns)) {
            $this->query = 'SELECT ' . implode(', ', $columns);
        } else {
            $this->query = 'SELECT *';
        }

        return $this;
    }

    public function from(string $table): SelectQueryBuilder {
        $this->query .= " FROM $table";
        return $this;
    }

    public function where(array $data, $operator = "=") : SelectQueryBuilder
    {
        $clauses = [];
        foreach ($data as $column => $value) {
            $paramName = $this->generateParamName();
            $clauses[] = "$column $operator $paramName";
            $this->params[$paramName] = $value;
        }
        $whereClause = implode(' AND ', $clauses);

        $this->query .= " WHERE $whereClause";

        return $this;
    }

    public function execute(PDO $pdo): array
    {
        $stmt = $pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetchAll();
    }
}
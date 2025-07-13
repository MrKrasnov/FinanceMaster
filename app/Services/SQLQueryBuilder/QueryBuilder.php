<?php

namespace App\Services\SQLQueryBuilder;

abstract class QueryBuilder
{
    protected string $query = '';
    protected array $params = [];
    protected int $paramCounter = 0;

    protected function generateParamName(): string {
        return ':param_' . $this->paramCounter++;
    }
}
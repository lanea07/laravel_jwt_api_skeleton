<?php

namespace App\Framework\Services;

use App\Framework\ValueObjects\TempTableColumn;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TempTableService
{

    protected string $tableName;
    protected Builder $builder;

    public function create(string $tableName, string|array $schema): static
    {
        $this->tableName = $tableName;

        $sql = $this->buildCreateTableSql($tableName, $schema);

        DB::statement($sql);
        $this->builder = DB::table($this->tableName);

        return $this;
    }

    private function buildCreateTableSql(string $tableName, string|array $schema): string
    {
        if (is_array($schema)) {
            return "CREATE TEMPORARY TABLE {$tableName} (" . $this->buildSchemaFromArray($schema) . ")";
        }

        $trimmed = strtolower(trim($schema));

        if (str_starts_with($trimmed, 'select')) {
            return "CREATE TEMPORARY TABLE {$tableName} AS {$schema}";
        }

        return "CREATE TEMPORARY TABLE {$tableName} ({$schema})";
    }

    protected function buildSchemaFromArray(array $schema): string
    {
        return collect($schema)->map(function (TempTableColumn $column) {
            return trim("{$column->name} {$column->type} {$column->options}");
        })->implode(', ');
    }

    public function truncate(): static
    {
        DB::statement("TRUNCATE TABLE {$this->tableName}");
        return $this;
    }

    public function drop(): static
    {
        DB::statement("DROP TEMPORARY TABLE IF EXISTS {$this->tableName}");
        return $this;
    }

    public function __call(string $method, array $arguments): mixed
    {
        $result = $this->builder->$method(...$arguments);

        // For methods that should remain chainable, return $this
        $chainableMethods = [
            'insert',
            'update',
            'delete',
            'where',
            'whereIn',
            'whereNotIn',
            'whereNull',
            'whereNotNull',
            'whereBetween',
            'whereNotBetween',
            'orderBy',
            'groupBy',
            'having',
            'limit',
            'offset',
            'skip',
            'take',
            'select',
            'addSelect',
            'distinct',
            'from',
            'join',
            'leftJoin',
            'rightJoin',
            'crossJoin',
            'innerJoin'
        ];

        if (in_array($method, $chainableMethods) || $result === $this->builder) {
            return $this;
        }

        return $result;
    }
}

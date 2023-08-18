<?php

namespace DevelopersNL\Model;

class PostgresRepository
{
    use CaseConverterTrait;

    public function __construct(
        protected \PDO $connection,
        protected readonly string $tableName,
        protected readonly string $idField = 'id'
    )
    {
    }

    public function store(object $obj): object
    {
        return $obj->{$this->idField} ? $this->update($obj) : $this->insert($obj);
    }

    protected function insert(object $obj): object
    {
        $values = get_object_vars($obj);
        unset($values[$this->idField]);

        $stmt = $this->connection->prepare(sprintf(
            'INSERT INTO %s (%s) VALUES (%s) RETURNING %s',
            $this->tableName,
            implode(', ', array_map(fn($prop) => $this->camelToSnake($prop), array_keys($values))),
            ltrim(str_repeat(', ?', count($values)), ', '),
            $this->idField
        ));

        $stmt->execute(array_values($values));
        $obj->{$this->idField} = $stmt->fetchColumn();

        return $obj;
    }

    protected function update(object $obj): object
    {
        $values = get_object_vars($obj);
        unset($values[$this->idField]);

        $stmt = $this->connection->prepare(sprintf(
            'UPDATE %s SET %s WHERE %s = ?',
            $this->tableName,
            implode(', ', array_map(fn($prop) => $this->camelToSnake($prop) . " = ?", array_keys($values))),
            $this->idField
        ));

        $params = array_values($values);
        $params[] = $obj->{$this->idField};

        $stmt->execute($params);

        return $obj;
    }
}

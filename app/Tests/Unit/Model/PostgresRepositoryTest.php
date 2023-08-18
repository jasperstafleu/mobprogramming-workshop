<?php

namespace DevelopersNL\Tests\Unit\Model;

use DevelopersNL\Model\PostgresRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\once;

/**
 * @covers \DevelopersNL\Model\PostgresRepository
 */
class PostgresRepositoryTest extends TestCase
{
    protected PostgresRepository $repository;
    protected \PDO|MockObject $connection;
    protected \PDOStatement|MockObject $statement;
    protected string $tableName;
    protected string $idField;

    public function setUp(): void
    {
        $this->connection = $this->createMock(\PDO::class);
        $this->tableName = 'tn' . mt_rand();
        $this->idField = 'idf' . mt_rand();
        $this->statement = $this->createMock(\PDOStatement::class);

        $this->repository = new PostgresRepository($this->connection, $this->tableName, $this->idField);
    }

    public function testStoreWithoutIdInsertsRecord()
    {
        $id = mt_rand();
        $obj = (object) ['var1' => mt_rand(), 'var2' => mt_rand()];

        // For compleness sake, I should assert whether the correct values
        // are bound, but I'll leave that for some junior to figure out ;)

        $this->connection
            ->expects(self::once())
            ->method('prepare')
            ->with(self::callback(function(string $sqlString) {
                self::assertStringStartsWith('INSERT ', $sqlString);

                return true;
            }))
            ->willReturn($this->statement)
        ;

        $this->statement
            ->expects(self::once())
            ->method('execute')
            ->willReturn(true)
        ;

        $this->statement
            ->expects(self::once())
            ->method('fetchColumn')
            ->willReturn($id)
        ;

        $result = $this->repository->store($obj);

        $this->assertEquals($id, $result->{$this->idField});
    }

    public function testStoreWithIdUpdatesRecord()
    {
        $id = mt_rand();
        $obj = (object) [$this->idField => $id, 'var1' => mt_rand(), 'var2' => mt_rand()];

        $this->connection
            ->expects(self::once())
            ->method('prepare')
            ->with(self::callback(function(string $sqlString) {
                self::assertStringStartsWith('UPDATE ', $sqlString);

                return true;
            }))
            ->willReturn($this->statement)
        ;

        $this->statement
            ->expects(self::once())
            ->method('execute')
            ->with(self::callback(function(array $params) use ($id) {
                self::assertEquals($id, end($params));

                return true;
            }))
            ->willReturn(true)
        ;

        $this->repository->store($obj);
    }
}

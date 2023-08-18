<?php

namespace DevelopersNL\Tests\Unit\Model;

use DevelopersNL\Model\CaseConverterTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevelopersNL\Model\CaseConverterTrait
 */
class CaseConverterTraitTest extends TestCase
{
    protected $caseConverter;

    public function setUp(): void
    {
        $this->caseConverter = new class() {
           use CaseConverterTrait {
               camelToSnake as public;
               snakeToCamel as public;
           }
        };
    }

    public static function caseStringsProvider(): array
    {
        return [
            'triv' => ['triv', 'triv'],
            'basic' => ['triv_triv', 'trivTriv'],
            'multiple' => ['triv_triv_multi', 'trivTrivMulti'],
            'numbersTriv' => ['triv1', 'triv1'],
            'numberBasic' => ['triv1_triv2', 'triv1Triv2'],
            'numberMultiple' => ['triv_triv10_multi', 'trivTriv10Multi'],
        ];
    }

    /** @dataProvider caseStringsProvider */
    public function testCamelToSnake(string $snake, string $camel): void
    {
        $this->assertEquals($snake, $this->caseConverter->camelToSnake($camel));
    }

    /** @dataProvider caseStringsProvider */
    public function testSnakeToCamel(string $snake, string $camel): void
    {
        $this->assertEquals($camel, $this->caseConverter->snakeToCamel($snake));
    }
}

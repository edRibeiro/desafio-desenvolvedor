<?php

namespace Tests\Unit;

use App\Helpers\SearchHelper;
use PHPUnit\Framework\TestCase;

class SearchHelperTest extends TestCase
{
    public function testToArrayWithValidQuery()
    {
        // String de teste
        $query = "name:john,age:30,city:paris";

        // Resultado esperado
        $expected = [
            ['name' => 'john'],
            ['age' => '30'],
            ['city' => 'paris'],
        ];

        // Chamada ao método estático
        $result = SearchHelper::toArray($query);

        // Verificar se o resultado corresponde ao esperado
        $this->assertEquals($expected, $result);
    }

    public function testToArrayWithEmptyQuery()
    {
        // String de teste vazia
        $query = "";

        // Resultado esperado
        $expected = [];

        // Chamada ao método estático
        $result = SearchHelper::toArray($query);

        // Verificar se o resultado corresponde ao esperado
        $this->assertEquals($expected, $result);
    }

    public function testToArrayWithMalformedQuery()
    {
        // String de teste malformada
        $query = "name-john,age:30,city;paris";

        // Esperado: exceção ou comportamento específico
        $this->expectException(\Exception::class);

        // Chamada ao método estático
        SearchHelper::toArray($query);
    }
}

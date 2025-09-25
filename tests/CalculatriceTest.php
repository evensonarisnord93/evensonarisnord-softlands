<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Evensonarisnord\Softlands\Calculatrice; // Importez la classe à tester

class CalculatriceTest extends TestCase
{
    /** @test */ // PHPUnit reconnaît les méthodes commençant par 'test' ou l'annotation '@test'
    public function additionner_deux_nombres_positifs()
    {
        $calc = new Calculatrice();

        // Affirme que le résultat (actual) est égal à la valeur attendue (expected)
        $this->assertSame(5, $calc->additionner(2, 3));
    }

    /** @test */
    public function additionner_avec_un_nombre_negatif()
    {
        $calc = new Calculatrice();
        
        // Affirme que 10 + (-4) est égal à 6
        $this->assertSame(6, $calc->additionner(10, -4));
    }
}
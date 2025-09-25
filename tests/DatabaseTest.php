<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Evensonarisnord\Softlands\Database; // Importez la classe à tester

class DatabaseTest extends TestCase
{
    // Réinitialise la connexion Singleton après chaque test
    protected function tearDown(): void
    {
        // Une astuce pour 'réinitialiser' la connexion statique pour le test suivant
        $reflection = new \ReflectionClass(Database::class);
        $instanceProperty = $reflection->getProperty('instance');
        $instanceProperty->setAccessible(true);
        $instanceProperty->setValue(null, null);
    }
    
    /** @test */
    public function la_classe_est_un_singleton()
    {
        // On ne devrait pas pouvoir instancier la classe directement (constructeur privé)
        $this->expectException(\Error::class); 
        new Database();
    }

    /** @test */
    public function peut_definir_les_parametres_de_connexion()
    {
        $config = ['host' => '127.0.0.1', 'db_name' => 'test_db'];
        Database::setConfig($config);

        // Puisque nous n'avons pas de vraie DB, nous allons tester si elle essaie de se connecter.
        // Elle lancera une exception si la connexion ÉCHOUE, mais pas si les paramètres sont définis.
        
        try {
            Database::getConnection();
            $this->fail("La connexion aurait dû échouer avec les paramètres de test non valides, ou réussi avec des paramètres valides.");
        } catch (\Exception $e) {
            // C'est le comportement attendu si la connexion échoue avec des paramètres non valides.
            $this->assertStringContainsString('Erreur de connexion', $e->getMessage());
        }
    }
}
<?php

namespace Evensonarisnord\Softlands;

use \PDO;
use \PDOException;

/**
 * Gère une connexion Singleton à la base de données via PDO.
 * Empêche l'instanciation multiple pour garantir une seule ressource de connexion.
 * @author Evenson Arisnord
 */
class Database
{
    /** @var PDO | null La connexion PDO unique */
    private static ?PDO $instance = null;

    /** @var array Les paramètres de connexion par défaut */
    private static array $config = [
        'host' => 'localhost',
        'db_name' => 'mydb',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ];

    /**
     * Le constructeur est privé pour empêcher l'instanciation externe (Singleton).
     */
    private function __construct() {}

    /**
     * Empêche le clonage de la connexion.
     */
    private function __clone() {}
    
    /**
     * Met à jour les paramètres de connexion.
     * Doit être appelé avant get_connection() pour la première connexion.
     */
    public static function setConfig(array $newConfig): void
    {
        self::$config = array_merge(self::$config, $newConfig);
    }

    /**
     * Récupère l'instance PDO de la base de données.
     * Crée la connexion si elle n'existe pas encore.
     * * @return PDO L'objet de connexion PDO.
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $config = self::$config;
            $dsn = "mysql:host={$config['host']};dbname={$config['db_name']};charset={$config['charset']}";
            
            try {
                self::$instance = new PDO($dsn, $config['user'], $config['password'], [
                    // Options recommandées pour PDO
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // En environnement de production, vous ne devriez pas afficher l'erreur brute.
                // Loggez l'erreur à la place.
                throw new \Exception("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
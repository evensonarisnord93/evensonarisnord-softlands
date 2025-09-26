# 🚀 Evensonarisnord/Softlands (ex: Developpement de logiciels sous mesure)

Un package PHP simple et léger fournissant un ensemble de modules reutilisables dans vos applications.

[](https://www.google.com/search?q=https://packagist.org/packages/Evensonarisnord/Softlands)
[](https://www.google.com/search?q=https://github.com/evensonarisnord93/evensonarisnord-softlands/)
[](https://www.google.com/search?q=LICENSE)

-----

## 📦 Installation

Ce package est destiné à être installé via Composer.

```bash
composer require Evensonarisnord/Softlands
```

-----

## ⚙️ Configuration de la Connexion

Avant d'utiliser la connexion, vous devez définir les paramètres de la base de données. Cette configuration doit être appelée **une seule fois** au démarrage de votre application (par exemple, dans votre fichier `index.php` ou votre conteneur de dépendances).

Attention : Les paramètres sont stockés statiquement (Singleton) et ne devraient pas être modifiés après la première connexion.

| Paramètre | Description | Défaut |
| :--- | :--- | :--- |
| `host` | L'adresse du serveur de base de données. | `localhost` |
| `db_name` | Le nom de la base de données à utiliser. | `mydb` |
| `user` | Le nom d'utilisateur pour la connexion. | `root` |
| `password` | Le mot de passe de l'utilisateur. | `''` (vide) |

```php
// Fichier de démarrage de l'application (index.php, bootstrap, etc.)

use Evensonarisnord\Softlands\Database;

Database::setConfig([
    'host'      => '127.0.0.1',
    'db_name'   => 'ecommerce_app',
    'user'      => 'api_user',
    'password'  => 'votre_mot_de_passe_securise',
    'charset'   => 'utf8mb4' // Optionnel
]);
```

-----

## 💡 Utilisation

La classe `Database` est un Singleton. Elle assure qu'une seule instance de connexion PDO est créée et partagée dans toute votre application.

Utilisez la méthode statique `getConnection()` pour récupérer l'objet PDO.

```php
<?php

// Assurez-vous d'inclure l'autoload de Composer
require 'vendor/autoload.php';

use MonEntreprise\MaPhplib\Database;

// --- 1. Configuration (Doit être appelée au début) ---
Database::setConfig([
    'host' => '127.0.0.1', 
    'db_name' => 'test_db', 
    'user' => 'root', 
    'password' => ''
]);

// --- 2. Récupération et Utilisation ---
try {
    // Récupère l'unique instance PDO. La connexion est établie ici.
    $pdo = Database::getConnection(); 
    
    // Exemple de requête préparée
    $id = 5;
    $stmt = $pdo->prepare("SELECT nom, prix FROM produits WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Produit trouvé : " . $produit['nom'];

} catch (\Exception $e) {
    // Gérer les erreurs (connexion, requête, etc.)
    echo "Une erreur critique est survenue: " . $e->getMessage();
}
```

[![PHP Composer](https://github.com/evensonarisnord93/evensonarisnord-softlands/actions/workflows/php.yml/badge.svg)](https://github.com/evensonarisnord93/evensonarisnord-softlands/actions/workflows/php.yml)
-----

## 🤝 Contribution

Les contributions sont les bienvenues \! Veuillez vous référer à notre fichier [CONTRIBUTING.md](https://www.google.com/search?q=CONTRIBUTING.md) (si vous en créez un) pour les directives de développement.

1.  Fork (cloner) le dépôt.
2.  Créez une branche de fonctionnalité (`git checkout -b feature/nouvelle-fonction`).
3.  Ajoutez vos tests.
4.  Commettez vos changements (`git commit -am 'feat: ajout de nouvelle fonction'`).
5.  Poussez vers la branche (`git push origin feature/nouvelle-fonction`).
6.  Ouvrez une Pull Request sur GitHub.

-----

## 📜 Licence

Ce package est distribué sous la licence **MIT**. Voir le fichier [LICENSE](https://www.google.com/search?q=LICENSE) pour plus de détails.

-----

Ce `README.md` fournit toutes les informations dont un développeur a besoin pour commencer rapidement, en mettant l'accent sur la clarté et les bonnes pratiques (Singleton, gestion des exceptions). N'oubliez pas de mettre ce contenu dans un fichier appelé **`README.md`** à la racine de votre projet.

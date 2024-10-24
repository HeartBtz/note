<?php

/**
 * 
 * CREATE DATABASE your_database CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
 *
 *-- Créer un utilisateur dédié
 *CREATE USER 'your_username'@'localhost' IDENTIFIED BY 'your_password';
 *
 *-- Accorder les droits nécessaires à l'utilisateur sur la base de données
 *GRANT ALL PRIVILEGES ON your_database.* TO 'your_username'@'localhost';
 *
 *-- Appliquer les changements
 *FLUSH PRIVILEGES;
 * 
 * 
 * 
 * __________________________pdo.php_____________________________________________________
 *
 * créer un fichier pdo.php et y mettre vos bonnes infos 
 * 
 * function getPDOConnection() {
 *   $host = 'your_host';
 *   $db = 'your_database';
 *   $user = 'your_username';
 *   $pass = 'your_password';
 *   $charset = 'utf8mb4';
*
*    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
*    $options = [
*        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
*        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
*        PDO::ATTR_EMULATE_PREPARES   => false,
*    ];
*
*    try {
*        return new PDO($dsn, $user, $pass, $options);
*    } catch (PDOException $e) {
*        throw new PDOException($e->getMessage(), (int)$e->getCode());
*    }
*}
* 
*____________________________fin pdo.php ______________________________________________________
* 
*/
require_once 'pdo.php';

/**
 * Execute a SQL query with parameters.
 *
 * @param string $sql
 * @param array $params
 * @return array
 */
function executeQuery($sql, $params = []) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

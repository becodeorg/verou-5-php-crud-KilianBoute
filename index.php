<?php

// Require the correct variable type to be used (no auto-converting)
declare(strict_types=1);

// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Load you classes
require_once 'config.php';
require_once 'classes/DatabaseManager.php';
require_once 'classes/CardRepository.php';

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

// This example is about a Pokémon card collection
// Update the naming if you'd like to work with another collection
$cardRepository = new CardRepository($databaseManager);
$cards = $cardRepository->get();

// Get the current action to execute
// If nothing is specified, it will remain empty (home should be loaded)
$action = $_GET['action'] ?? null;

// Load the relevant action
// This system will help you to only execute the code you want, instead of all of it (or complex if statements)
$page = $_SERVER['REQUEST_URI'];
$BASE_PATH = '/becode/3.The-Mountain/07.CRUD/';
switch ($page) {
    case $BASE_PATH:
        overview($cards);
        break;
    case $BASE_PATH . 'create':
        create($databaseManager);
        break;
    default:
        break;
}

function overview($cards)
{
    // Load your view
    // Tip: you can load this dynamically and based on a variable, if you want to load another view
    require 'overview.php';
}

function create($databaseManager)
{
    // TODO: provide the create logic
    $name = htmlspecialchars($_POST['card_name']);
    $primaryType = htmlspecialchars($_POST['$card_primary_type']);
    $secondaryType = htmlspecialchars($_POST['$card_secondary_type'] ?? null);

    $query = "INSERT INTO cards (name, primary_type, secondary_type) VALUES (:name, :primaryType, :secondaryType)";
    $statement = $databaseManager->connection->prepare($query);
    $statement->bindValue(":name", $name, PDO::PARAM_STR);
    $statement->bindValue(":primaryType", $primaryType, PDO::PARAM_STR);
    $statement->bindValue(":secondaryType", $secondaryType, PDO::PARAM_STR);

    try {
        $statement->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    header("Location: /becode/3.The-Mountain/07.CRUD");
}

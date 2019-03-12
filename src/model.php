<?php

/* Database connection */

require __DIR__ . '/../config/database.php';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("set names utf8");

} catch (PDOException $e) {

    die($e->getMessage());
}

/**
 * Create feedback
 *
 * @param $db
 * @param string $name
 * @param string $email
 * @param string $text
 * @return bool
 */
function create($db, string $name, string $email, string $text): bool
{

    $sql = "INSERT feedback "
        . "SET name=:name, "
        . "email=:email, "
        . "text=:text ";

    $stmt = $db->prepare($sql);

    //Bind our variables.
    $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
    $stmt->bindParam(':text', $text, \PDO::PARAM_STR);

    //Execute the statement and insert the new feedback.
    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

}

/**
 * Read feedback
 *
 * @param $db
 * @return array
 */
function read($db)
{
    $sql = "SELECT name, email, text, published_at "
        . "FROM feedback "
        . "ORDER BY published_at DESC ";

    $query = $db->query($sql);

    $result = [];

    if ($query) {

        $result = $query->fetchAll();
    }

    return $result;
}

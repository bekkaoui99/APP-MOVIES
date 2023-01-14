<?php

session_start();
require('../db/db.php');


$sql_r = 'DELETE FROM reservations WHERE id = :id';
$delete_r = $connection->prepare($sql_r);

$delete_r->bindValue(':id', $_GET['id']);

$delete_r->execute();


if ($delete_r->rowCount() > 0) {
    header('location:paney.php?valid=data is deleted');
} else {
    header('location:paney.php?erreur=data is not deleted');
}

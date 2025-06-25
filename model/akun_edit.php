<?php
require_once 'DB_Connection.php';

function getUserById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM account WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateUser($id, $name, $email, $password = null) {
    global $conn;
    if ($password) {
        $stmt = $conn->prepare("UPDATE account SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE account SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }
    return $stmt->execute();
}
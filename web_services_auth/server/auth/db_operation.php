<?php
require_once('db_connect.php'); 

function getUsername($username){
    global $conn;
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query preparation: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $result->close();
            $stmt->close();
            return $row;
        } else {
            $result->close();
            $stmt->close();
            return null;
        }
    } else {
        die("Error executing SQL query: " . $stmt->error);
    }
}

function createUsr($username, $password, $user_level) {
    global $conn;
    try {
        $sql = "INSERT INTO users (username, password, user_level) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        // Bind parameters
        $stmt->bind_param('sss', $username, $password, $user_level);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
}

function machingUsr($username) {
    global $conn;
    $sql = "SELECT username,password,user_level FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query preparation: " . $conn->error);
    }

    $stmt->bind_param("s", $username);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $result->close();
            $stmt->close();
            return $row;
        } else {
            $result->close();
            $stmt->close();
            return null;
        }
    } else {
        die("Error executing SQL query: " . $stmt->error);
    }
}

?>

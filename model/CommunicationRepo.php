<?php
require_once __DIR__ . '/../model/db_connect.php';


function findOneWayMessageByID($id)
{
    $conn = db_conn();
    $selectQuery = 'SELECT one_way_message FROM `communication` WHERE `id` = ?';

    try {
        $stmt = $conn->prepare($selectQuery);

        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $message = $result->fetch_assoc();

        if (!$message) {
            throw new Exception("No message found with ID: " . $id);
        }

        $stmt->close();
        return $message['one_way_message']; // Return the message string directly
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    } finally {
        $conn->close();
    }
}

function updateMessage($data, $id)
{
    $conn = db_conn();

    // Construct the SQL query
    $updateQuery = "UPDATE `communication` SET 
                    one_way_message = ?
                    WHERE id = ?";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($updateQuery);

        // Check if the prepare statement was successful
        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param('si', $data, $id);

        // Execute the query
        $stmt->execute();

        // Return true if the update is successful
        return true;
    } catch (Exception $e) {
        // Handle the exception, you might want to log it or return false
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();
    }
}



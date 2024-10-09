<?php
session_start();

function displayMessage($message) {
    echo "<h2>Status: $message</h2>";
    echo "<a href='message.php'>Back to Leave Management</a>";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'approve' || $action === 'disapprove') {
        $leaveRequest = $_SESSION['leaveRequest'] ?? null;

        if ($leaveRequest) {
           
            $statusMessage = $action === 'approve' ? "Leave request approved." : "Leave request disapproved.";
            
            
            unset($_SESSION['leaveRequest']);
            
            
            displayMessage($statusMessage);
        } else {
            header("Location: message.php");
            exit();
        }
    } else {
        header("Location: message.php");
        exit();
    }
}


if (isset($_SESSION['message'])) {
    displayMessage($_SESSION['message']);
    unset($_SESSION['message']); 
} else {
    echo "<h2>Welcome to Leave Management</h2>";
    
}
?>

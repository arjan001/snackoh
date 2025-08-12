<?php
// Include database connection and notifications helper
include './config/config.php';
include './includes/notifications.php';

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notification_id = intval($_POST['notification_id'] ?? 0);
    
    if ($notification_id > 0) {
        // Mark notification as read
        $result = markNotificationAsRead($notification_id);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Notification marked as read']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to mark notification as read']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid notification ID']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 
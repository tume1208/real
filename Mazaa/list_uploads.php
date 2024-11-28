<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Receipts</title>
</head>
<body>
    <h1>Uploaded Receipts</h1>
    <div id="uploads">
        <?php
        include 'C:\xampp\secure\connect.php';

        $uploadDir = 'uploads/';
        $files = scandir($uploadDir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                // Debugging: Print the file name
                error_log("File: " . $file);

                // Fetch the user ID from the payments table
                $stmt = $conn->prepare("SELECT user_id FROM payments WHERE receipt_path = ?");
                $stmt->bind_param("s", $file);
                $stmt->execute();
                $stmt->bind_result($userId);
                $stmt->fetch();
                $stmt->close();

                // Debugging: Print user ID
                error_log("User ID: " . $userId);

                // Check if user ID is fetched
                if ($userId) {
                    // Fetch the email from the users table
                    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
                    $stmt->bind_param("i", $userId); // Use integer type for user ID
                    $stmt->execute();
                    $stmt->bind_result($email);
                    $stmt->fetch();
                    $stmt->close();

                    // Debugging: Print email
                    error_log("Email: " . $email);

                    echo '<div>';
                    echo '<img src="' . $uploadDir . $file . '" alt="Receipt" style="max-width: 200px; max-height: 200px;">';
                    echo '<p>User ID: ' . $userId . '</p>';
                    echo '<p>Email: ' . $email . '</p>';
                    echo '<p>' . $file . '</p>';
                    echo '</div>';
                } else {
                    echo '<div>';
                    echo '<img src="' . $uploadDir . $file . '" alt="Receipt" style="max-width: 200px; max-height: 200px;">';
                    echo '<p>User ID: Not found</p>';
                    echo '<p>Email: Not found</p>';
                    echo '<p>' . $file . '</p>';
                    echo '</div>';
                }
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

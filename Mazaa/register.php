<?php
include 'C:\xampp\secure\connect.php';

// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['signUp'])){
    $firstName = htmlspecialchars($_POST['fName']);
    $lastName = htmlspecialchars($_POST['lName']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if($result->num_rows > 0){
        echo "Өөр Email хаяг ашиглана уу.";
    } else {
        $insertQuery = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
        $insertQuery->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);

        if($insertQuery->execute()){
            header("Location: index.php");
        } else {
            error_log("Error: " . $conn->error);
            echo "An error occurred. Please try again later.";
        }
    }
}

if(isset($_POST['signIn'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['password'])){
            session_regenerate_id(true); // Regenerate session ID to prevent session fixation
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            $_SESSION['email'] = $row['email'];

            // Clear local storage
            echo "<script>
                localStorage.clear();
            </script>";

            // Fetch cart data
            $stmt = $conn->prepare("SELECT cart_data FROM user_cart WHERE user_id = ?");
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $cart_row = $result->fetch_assoc();
                echo "<script>
                    localStorage.setItem('data_" . $row['id'] . "', '" . $cart_row['cart_data'] . "');
                    localStorage.setItem('userId', " . json_encode($row['id']) . ");
                    window.location.href = 'homepage.php';
                </script>";
            } else {
                echo "<script>
                    localStorage.setItem('userId', " . json_encode($row['id']) . ");
                    window.location.href = 'homepage.php';
                </script>";
            }
            exit();
        } else {
            echo "Email эсвэл Password буруу.";
        }
    } else {
        echo "Email эсвэл Password буруу.";
    }
}
?>


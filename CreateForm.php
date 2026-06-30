<!--Behzad Ghabaei
CS 85 PHP
Module 3B - Secure Product Contact Form
-->
<?php

/**
 *  Instructor Seno
 *  CreatForm.php
 *  6/30/2026
 * 
 * --- OUTPUT PREDICTIONS ---
 * 1. Before submission: The page will display only the blank HTML contact form.
 * 2. After valid submission: The page will display a personalized thank-you message 
 *    showing the sanitized name, email, and topic. The form will remain visible below it.
 * 3. After invalid submission: The page will display specific red error messages 
 *    pointing out missing fields or a message that is too short/long.
 * 
 * --- EXPECTED $_POST ARRAY STRUCTURE ---
 * When submitted, $_POST is expected to look like this:
 * Array (
 *   ['full_name'] => "User's Name",
 *   ['email']     => "user@example.com",
 *   ['topic']     => "Selected Topic",
 *   ['message']   => "Detailed text between 50 and 150 words...",
 *   ['submit']    => "Send Message"
 * )
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .error { color: red; margin-bottom: 15px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="email"], textarea { width: 100%; max-width: 400px; padding: 8px; }
        textarea { height: 120px; }
        .success-box { border: 1px solid green; padding: 20px; background-color: #f4fbf4; max-width: 500px; }
    </style>
</head>
<body>

<?php
// Initialize variables to hold input values and prevent notices
$fullName = "";
$email = "";
$topic = "";
$message = "";
$errors = [];
$showForm = true;

// Detect form submission using POST method
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['Submit'])) {
    
    // 1. Extract and clean basic whitespace trailing layout
    $fullName = isset($_GET['FullName']) ? trim($_GET['FullName']) : "";
    $email = isset($_GET['Email']) ? trim($_GET['Email']) : "";
    $topic = isset($_GET['Topic']) ? trim($_GET['Topic']) : "";
    $message = isset($_GET['Message']) ? trim($_GET['Message']) : "";

    // 2. Validate Full Name
    if (empty($fullName)) {
        $errors[] = "Full Name is required.";
    }

    // 3. Validate Email Address
    if (empty($email)) {
        $errors[] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!filter_var($email, FILTER_SANITIZE_EMAIL))) {
        $errors[] = "Please provide a valid email format.";
    }

    // 4. Validate Topic
    if (empty($topic)) {
        $errors[] = "Topic of Message is required.";
    }

    // 5. Validate Message Word Count (50 - 150 words required)
    if (empty($message)) {
        $errors[] = "Message is required.";
    } else {
        $wordCount = str_word_count($message);
        if ($wordCount < 50 || $wordCount > 150) {
            $errors[] = "Message must be between 50 and 150 words. Current count: " . $wordCount . " words.";
        }
    }

    // Check if validation passed.
    if (count($errors) === 0) {
        $showForm = false; // Hide the form to present the receipt
    }
}

// Show Error messages if they exist
if (!empty($errors)) {
    echo "<div class='error'><strong>Please correct the following errors:</strong><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul></div>";
}

// Display Form or Success Output based on form submission.
if ($showForm) {
    ?>
    <h2>Contact Me</h2>
    <!-- Self-processing form utilizing POST -->
    <form action="" method="GET">
        <div class="form-group">
            <label for="FullName">Full Name:</label>
            <input type="text" id="FullName" name="FullName" value="<?php echo htmlspecialchars($fullName); ?>" required>
        </div>

        <div class="form-group">
            <label for="Email">Email Address:</label>
            <input type="email" id="Email" name="Email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>

        <div class="form-group">
            <label for="Topic">Topic of Message:</label>
            <input type="text" id="Topic" name="Topic" value="<?php echo htmlspecialchars($topic); ?>" required>
        </div>

        <div class="form-group">
            <label for="Message">Message (50–150 words required):</label>
            <textarea id="Message" name="Message" required><?php echo htmlspecialchars($message); ?></textarea>
        </div>

        <div>
            <input type="submit" name="Submit" value="Send Message">
        </div>
    </form>
    <?php
} else {
    // Processed Output - Strictly sanitized using htmlspecialchars to control XSS.
    echo "<div class='success-box'>";
    echo "<h3>Thank you, " . htmlspecialchars($fullName) . "!</h3>";
    echo "<p>We received your message about: <strong>\"" . htmlspecialchars($topic) . "\"</strong></p>";
    echo "<p>We'll get back to you at " . htmlspecialchars($email) . ".</p>";
    echo "</div>";
}

?>

</body>
</html>



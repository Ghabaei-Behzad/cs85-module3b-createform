

<!--
 *  Behzad Ghabaei
 *  CS 85
 *  Module: 3B - Secure Product Contact Form
 *  Instructor Seno
 *  CreateForm.php
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
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3B - Secure Contact Form</title>
    <style>
      
    </style>
</head>
<body>
<?php 
$name="";
$email="";
$topic="";

?>
    <h2>Contact Us</h2>

  
    <form action="" method="GET">
        
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="<?php echo $name; ?>" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

        <label for="topic">Topic of Message:</label>
        <input type="text" id="topic" name="topic" value="<?php echo $topic; ?>" required placeholder="e.g., Labrador training tips">

        <label for="message">Message (50 to 150 words):</label>
        <textarea id="message" name="message" required placeholder="Write your message here..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>

        <input type="submit" name="submit" value="Send Message">
    </form>

</body>
</html>

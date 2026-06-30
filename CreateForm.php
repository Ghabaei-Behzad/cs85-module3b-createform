<!--Behzad Ghabaei
CS 85 PHP
Module 3B - Secure Product Contact Form
-->

<!DOCTYPE html>
<html>
    <head>
<style>

     body { font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 0 10px; }
          label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], input[type="email"], textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
   
        input[type="submit"] { margin-top: 15px; padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #0056b3; }
        p{
            background-color:greenyellow;
        }
#full_name{
    text-align: center;

}
#email{
 text-align: center;
}
#subject{
 text-align: center;
}
#message{
 text-align: center;
}
</style>
</head>
</html>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
  echo "<h3>Contact Form Results</h3>";
  echo "<p>Name: " . htmlspecialchars($_GET['full_name']) . "</p>";
  echo "<p>Email: " . htmlspecialchars($_GET['email']) . "</p>";
  echo "<p>Subject: " . htmlspecialchars($_GET['subject']) . "</p>";
   echo "<p>Message: " . htmlspecialchars($_GET['message']) . "</p>";
}
    

?>

<form action="" method="GET">
  <label for="full_name">Full Name:</label>
  <input type="text" id="full_name" name="full_name" required><br>
  
  <label for="email">Email Address:</label>
  <input type="email" id="email" name="email" required><br>
  
  <label for="subject">Subject:</label>
  <input type="text" id="subject" name="subject" required><br>
  
  <label for="message">Message:</label>
 <input type="text" id="message" name="message" required><br>
 
  <input type="submit" value="Submit Survey">
</form>
</body>
</html>
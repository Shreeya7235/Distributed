<?php
$pageTitle = "Welcome to My Simple PHP Website";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1><?php echo $pageTitle; ?></h1>
    <p>This is a sample PHP website without database connectivity. You can extend it with your own content!</p>

    <h2>Contact Us</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        echo "<p class='success'><strong>Thank you, $name!</strong> Your message has been received.</p>";
        echo "<p class='success'>We will reply to <em>$email</em> as soon as possible.</p>";
    }
    ?>

    <form method="post" action="" onsubmit="return validateForm()">
        <input type="text" name="name" id="name" placeholder="Your Name" required>
        <input type="email" name="email" id="email" placeholder="Your Email" required>
        <textarea name="message" id="message" rows="4" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>

<?php
// Check if the 'send message' button was clicked
if (isset($_POST['annsubmit'])) {

    // 1. EDIT THIS: Enter the email address where you want to receive the data
    $toEmail = "lloydenergyukk@gmail.com"; 
    
    // 2. Capture the data from your specific HTML fields
    // We use htmlspecialchars() to prevent security issues
    $fullName = htmlspecialchars($_POST['ufxd-fname']);
    $fromEmail = htmlspecialchars($_POST['ufxd-email']); // User's email
    $phone = htmlspecialchars($_POST['ufxd-phone']);
    $postalCode = htmlspecialchars($_POST['ufxd-postal']);
    $message = htmlspecialchars($_POST['ufxd-message']);

    // 3. Create the Email Subject
    $subject = "New Inquiry BBC (Contact) from Website: " . $fullName;

    // 4. Create the Email Body (The layout of the email you receive)
    $emailBody = "You have received a new message from your website contact(BBC) form.\n\n";
    $emailBody .= "----------------------------------\n";
    $emailBody .= "Name: " . $fullName . "\n";
    $emailBody .= "Email: " . $fromEmail . "\n";
    $emailBody .= "Mobile: " . $phone . "\n";
    $emailBody .= "Postal Code: " . $postalCode . "\n";
    $emailBody .= "----------------------------------\n";
    $emailBody .= "Message:\n" . $message . "\n";

    // 5. Email Headers (Crucial for not going to Spam)
    // 'From' should ideally be an email on your own domain (e.g., noreply@yourwebsite.com)
    $headers = "From: noreply@lloydenergy.co.uk\r\n";
    $headers .= "Reply-To: " . $fromEmail . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 6. Send the Email
    if (mail($toEmail, $subject, $emailBody, $headers)) {
        // Success Message
        echo "<script> location.href='thank-you.html';</script>";
        // Optional: Redirect back to your home page after 3 seconds
        // header("refresh:3;url=index.html"); 
    } else {
        // Error Message
        echo "<h3>Sorry, there was a problem sending your message. Please try again.</h3>";
    }

} else {
    // If someone tries to open process.php directly without submitting the form
    echo "Access Denied.";
}
?>
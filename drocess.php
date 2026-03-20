<?php
// Check if the 'Request a free Quote' button was clicked
if (isset($_POST['onsubmit'])) {

    // 1. EDIT THIS: Enter the email address where you want to receive the data
    $toEmail = "lloydenergyukk@gmail.com"; 
    
    // 2. Capture the data from your specific HTML fields
    $fullName = htmlspecialchars($_POST['ufxd-fname']);
    $fromEmail = htmlspecialchars($_POST['ufxd-email']);
    $phone = htmlspecialchars($_POST['ufxd-phone']);
    $postalCode = htmlspecialchars($_POST['ufxd-postal']);
    $businessName = htmlspecialchars($_POST['ufxd-business']); // New Field
    $meterNumber = htmlspecialchars($_POST['ufxd-meter']);     // New Field

    // 3. Create the Email Subject
    $subject = "New  BBC Quote Request: " . $businessName;

    // 4. Create the Email Body
    $emailBody = "You have received a new quote request.\n\n";
    $emailBody .= "----------------------------------\n";
    $emailBody .= "Name: " . $fullName . "\n";
    $emailBody .= "Email: " . $fromEmail . "\n";
    $emailBody .= "Phone: " . $phone . "\n";
    $emailBody .= "Postal Code: " . $postalCode . "\n";
    $emailBody .= "Business Name: " . $businessName . "\n";
    $emailBody .= "Meter Number: " . $meterNumber . "\n";
    $emailBody .= "----------------------------------\n";

    // 5. Email Headers
    // Ideally, change 'noreply@yourwebsite.com' to a real email on your domain
    $headers = "From: noreply@lloydenergy.co.uk\r\n";
    $headers .= "Reply-To: " . $fromEmail . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 6. Send the Email
    if (mail($toEmail, $subject, $emailBody, $headers)) {
        echo "<h3>Success! Your quote request has been sent.</h3>";
    } else {
        echo "<h3>Sorry, there was a problem sending your request.</h3>";
    }

} else {
    echo "Access Denied.";
}
?>
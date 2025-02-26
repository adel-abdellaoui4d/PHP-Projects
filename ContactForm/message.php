<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$website = $_POST['website'];
$message = $_POST['message'];

if(!empty($email) && !empty($message)){ // if email and message field is not empty
     if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // if user entered email is valid
          $receiver = "adelabdellaoui2002@gmail.com";
          $subject = "From: $name <$email>"; // subject of the email 
          $body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage: $message\n\nRegards,\n$name";
          
          // Correcting the sender format and adding headers
          $headers = "From: $email\r\n";
          $headers .= "Reply-To: $email\r\n";
          $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // ensure proper encoding
          
          // Sending the email
          if(mail($receiver, $subject, $body, $headers)){
            echo "Your message has been sent!";
          } else {
            echo "Sorry, failed to send your message!";
          }
     } else {
        echo "Enter a valid email address!";
     }
}else {
    echo "Email and message fields are required!";
}
?>

<?php

use \google\appengine\api\mail\Message;
# Looks for current Google account session

$to      = 'nobody@example.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);


// try
// {
//   $message = new Message();
//   //$message->setSender("from@google.com");
//   $message->addTo("qzeng2490@yahoo.com");
//   $message->setSubject("New Photo Gallery Comment");
//   //$created = datetime_to_text($this->created);
//   $message->setTextBody("A new comment has been received in the Photo Gallery.");
//   //$message->addAttachment('image.jpg', $image_data, $image_content_id);
//   $message->send();
// } catch (InvalidArgumentException $e) {
//   echo "erro in sending email";
// }
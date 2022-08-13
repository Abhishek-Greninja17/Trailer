<?php
$username1 = $_POST['username1'];
$username1 = $_POST['username1'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$movie = $_POST['movie'];
$seat = $_POST['seat'];
$showtime = $_POST['showtime'];
$payment = $_POST['payment'];
$card = $_POST['card'];
$amount = $_POST['amount'];
if (!empty($username1) || !empty($username2) || !empty($address) || !empty($phone) || !empty($email) || !empty($movie) || !empty($seat) || !empty($showtime) || !empty($payment)|| !empty($card)|| !empty($amount)) { $host = "localhost";
    $host= "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "new";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From bookticket Where email = ? Limit 1";
     $INSERT = "INSERT Into user (username1, username2, address, phone, email, movie, seat, showtime, payment, card, amount) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssissssssi", $username1, $username2, $address, $phone, $email, $movie, $seat, $showtime, $payment, $card, $amount);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
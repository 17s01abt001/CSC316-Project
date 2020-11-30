<?php
$db = mysqli_connect("localhost", "root", "", "project1");

if (isset($_POST['contact_us'])) {
    $fullnames = $_POST['fullnames'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($fullnames) || empty($email) || empty($message)) {
        echo "<script>alert('All fields required')</script>";
        echo "<script>window.location = 'contact.html'</script>";

    } else {
        $sql = "INSERT INTO contact(fullnames, email, message) VALUES ('$fullnames','$email','$message')";
        mysqli_query($db, $sql);
        echo "<script>alert('Your Message has been received we will contact you shortly.')</script>";
        echo "<script>window.location = 'contact.html'</script>";
    }
}
?>
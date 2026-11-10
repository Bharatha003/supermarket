<?php

include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$email = $_POST["e"];
$vcode = uniqid();

$rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
$num = $rs->num_rows;

if ($num > 0) {
    
    Database::iud("UPDATE `user` SET `v_code` = '" . $vcode . "' WHERE `email` = '" . $email . "'");
    
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'supermarket.1989.22@gmail.com';                     //SMTP username
        $mail->Password = 'vcvr ncwr kmxc cmqj';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('supermarket.1989.22@gmail.com', 'Supermarket');
        $mail->addAddress($email);     //Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset your Account Password';
        $mail->Body = '<table style="width: 100%; font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 40px; margin: 20px 0;">
                                            <tr>
                                                <td align="center" style="padding-bottom: 20px;">
                                                    <a href="http://localhost/supermarket/signIn.php" style="font-size: 35px; font-weight: bolder; color: #198754; text-decoration: none;">Supermarket</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <h2 style="font-size: 25px; line-height: 1.5; font-weight: 600; color: #000000;">Reset Password</h2>
                                                    <p style="margin-bottom: 24px; color: #666;">You can change your password by clicking on the button below</p>
                                                    <div style="margin: 20px 0;">
                                                        <a href="http://localhost/supermarket/resetPassword.php?vcode=' . $vcode . '" style="text-decoration: none; display: inline-block; background-color: #DC3545; color: #ffffff; padding: 12px 24px; border-radius: 5px; font-size: 16px;">
                                                            <span>Reset Password</span>
                                                        </a>
                                                    </div>
                                                    <p style="color: #198754; font-style: italic;">If you did not request a password reset, please ignore this email...</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="padding-top: 20px;">
                                                    <p style="color: #000000; font-size: 14px;">© 2025 supermarket.lk</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>';
        $mail->send();
        echo 'Success';
    } catch (Exception $e) {
        echo "Message could not be sent! Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "User not found! Please check your email again...";
}

?>

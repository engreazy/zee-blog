<?php
/**
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 12/31/2017
 * Time: 11:17 PM
 */
namespace Controllers;
class EmailSender
{

    /**
     * @param $recipient
     * @param $subject
     * @param $message
     * @param $from
     * @return bool
     */
    public function send($recipient, $subject, $message, $from)
    {
        $header = "From: " . $from;
        $header .= "\nMIME-Version: 1.0\n";
        $header .= "Content-Type: text/html; charset=\"utf-8\"\n";
        return mb_send_mail($recipient, $subject, $message, $header);
    }
}
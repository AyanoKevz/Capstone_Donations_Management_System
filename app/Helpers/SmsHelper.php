<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class SmsHelper
{
  public static function sendSmsNotification($phoneNumber, $message)
  {
    $url = 'http://192.168.1.3:8082'; // Traccar SMS endpoint
    $authToken = 'b3224bb5-4eb1-401e-8a41-2371a52aca1d'; // Your API Token

    $postData = json_encode([
      'to'      => $phoneNumber,
      'message' => $message,
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'Authorization: ' . $authToken,
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    Log::info("SMS Sent to $phoneNumber. Response: $response, HTTP Code: $httpCode");

    return $httpCode == 200 ? json_decode($response, true) : false;
  }
}

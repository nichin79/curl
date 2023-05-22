<?php
namespace Nichin79\Curl;

class Curl
{
  public static function exec(array $payload)
  {
    if (!isset($payload['url']) || empty($payload['url'])) {
      throw new \Exception('Bad Requst - Missing URL');
    }
    if (!isset($payload['method']) || empty($payload['method'])) {
      $payload['method'] = 'GET';
    }

    // Curl Init 
    $ch = curl_init();

    // Curl Options
    curl_setopt($ch, CURLOPT_URL, htmlspecialchars($payload['url']));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if (isset($payload['method'])) {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $payload['method']);
    }

    if (isset($payload['data'])) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payload['data']);
    }

    if (isset($payload['headers'])) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $payload['headers']);
    }

    if (isset($payload['user'])) {
      if (isset($payload['token'])) {
        curl_setopt($ch, CURLOPT_USERPWD, $payload['user'] . '/token:' . $payload['token']);
      } elseif (isset($payload['password'])) {
        curl_setopt($ch, CURLOPT_USERPWD, $payload['user'] . ':' . $payload['password']);
      }
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Curl Execute
    $server_output = curl_exec($ch);

    if ($server_output == '') {
      $server_output = '""';
    }
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $response = json_decode('{ "httpcode":' . $httpcode . ',"response":"" }');

    if (!$response->response = json_decode($server_output)) {
      $response->response = $server_output;
    }

    curl_close($ch);
    return $response;
  }
}
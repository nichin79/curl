<?php
namespace Nichin79\Curl;

class Curl
{
  public $curl;
  public $response;
  private array $constants;

  public function __construct(array $data = [])
  {
    $this->constants = $this->getCurlConstants();

    $this->curl = curl_init();

    if (isset($data['method']) || !empty($data['method'])) {
      curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $data['method']);
    }

    if (isset($data['url']) && !empty($data['url'])) {
      curl_setopt($this->curl, CURLOPT_URL, htmlspecialchars($data['url']));
    }

    if (isset($data['headers'])) {
      curl_setopt($this->curl, CURLOPT_HTTPHEADER, $data['headers']);
    }

    if (isset($data['data'])) {
      curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data['data']);
    }

    if (isset($data['options'])) {
      foreach ($data['options'] as $key => $value) {
        curl_setopt($this->curl, $this->getCurlopt('curlopt_' . $key), $value);
      }
    }

    $keys = ['method', 'url', 'headers', 'data', 'options'];
    if (!$this->checkDataKeys($keys, $data) && !empty($data)) {
      foreach ($data as $key => $value) {
        curl_setopt($this->curl, $this->getCurlopt($key), $value);
      }
    }
  }


  private function getCurlConstants()
  {
    $constants = get_defined_constants(true);
    return $constants['curl'];
  }


  private function getCurlOpt($option)
  {
    foreach ($this->constants as $key => $value) {
      if (strtoupper($key) === strtoupper($option)) {
        return $value;
      }
    }
    throw new \Exception("CURLOPT: " . strtoupper($option) . " NOT FOUND");
  }


  private function checkDataKeys($keys, $data)
  {
    foreach ($keys as $key) {
      if (isset($data[$key])) {
        return true;
      }
    }
    return false;
  }

  public function exec()
  {
    $this->response = curl_exec($this->curl);
    curl_close($this->curl);
  }


  public function info()
  {
    return curl_getinfo($this->curl);
  }


  public function httpcode()
  {
    return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
  }


  public function response()
  {
    try {
      $response = json_decode($this->response, $associative = true, $depth = 512, JSON_THROW_ON_ERROR);
    } catch (\Exception $e) {
      $response = $this->response;
    }
    return $response;
  }

  public function jsonPrint($pretty_print = 0)
  {
    try {
      if ($pretty_print === 0) {
        $this->response = json_encode(json_decode($this->response, $associative = true, $depth = 512, JSON_THROW_ON_ERROR), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      }

      if ($pretty_print === 1) {
        $this->response = json_encode(json_decode($this->response, $associative = true, $depth = 512, JSON_THROW_ON_ERROR), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      }
    } catch (\Exception $e) {
      $this->response = "Error when converting to Json: $e";
    }

    echo $this->response;
    return $this->response;
  }

  public function jsonFile($file, $pretty_print = 1)
  {
    $this->jsonPrint($pretty_print);
    file_put_contents($file, $this->response);
    return $this->response;
  }
}
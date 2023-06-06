# curl

Contains two classes:

- Curl
- BasicCurl

BasicCurl extends Curl and will automatically use the curlopt's ssl_verifypeer and returntransfer. In addition it will automatically execute the curl

`use Nichin79\Curl\BasicCurl;`
OR
`use Nichin79\Curl\Curl;`

```
$data = [
  'url' => 'https://reqbin.com/echo',
  'method' => 'GET', // Method will automatically be set to GET if not specified
  'headers' => [],
  'options' => [
  'SSL_VERIFYPEER' => false
  ]
];

$curl = new Curl($data);

// execute the initiated curl and return the response
$curl->exec();

echo "\r\n";
echo "http status code: " . $curl->getHttpCode();
```

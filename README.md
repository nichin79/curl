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
// Method will automatically be set to GET if not specified
'method' => 'GET',
'headers' => [],
'options' => [
'SSL_VERIFYPEER' => false
]
];

$curl = new Curl($data);
$curl->execute();

echo json_encode($curl->getResponse(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
echo "\r\n";
echo "http status code: " . $curl->getHttpCode();
```

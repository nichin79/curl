# curl

**Example**
require_once **DIR** . '/../vendor/autoload.php';
use Nichin79\Curl\Curl;

$payload = [
'method' => 'GET',
'url' => 'https://www.google.com',
'headers' => ["Content-Type: application/json"],
'user' => 'test@test.com',
'password' => '',
'token' => '',
'data' => '{"key":"value"}',
];

$curlResponse = Curl::exec($payload);

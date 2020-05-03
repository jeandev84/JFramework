<?php

/*
function getParsedBody($json = false)
{
    if($_SERVER['REQUEST_METHOD'] === 'GET')
    {
        return $json === true ? json_encode($_GET) : $_GET;
    }

    $content = file_get_contents('php://input');
    $parses = explode('&', $content);
    $data = [];

    foreach ($parses as $parse)
    {
        list($key, $value) = explode('=', $parse);
        $data[$key] = $value;
    }

    $data['password'] = ! empty($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : '';
    return ($json === true ? json_encode($data) : $data);
}

echo 'Body as array';
dump(getParsedBody());

echo 'Body as json';
dump(getParsedBody(true));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost:8080');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$data = curl_exec($ch);
curl_close($ch);

dump($data);
*/


?>
<form action="/" method="GET">
    <div>
        <input type="text" name="username" placeholder="Jean">
    </div>
    <div>
        <input type="email" name="email" placeholder="jeanyao@ymail.com">
    </div>
    <div>
        <input type="password" name="password" placeholder="xxx-xx-x">
    </div>
<!--    <input type="hidden" name="_method" value="PUT">-->
    <button type="submit">Send</button>
</form>
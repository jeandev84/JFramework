<?php
/*
$requestMethod = $_SERVER['REQUEST_METHOD'];
$method = isset($_POST['_method']) ? $_POST['_method'] : null;

if($method === 'PUT')
{
$_SERVER['REQUEST_METHOD'] = $method;
parse_str(file_get_contents('php://input'), $_PUT);
'Put arguments: ';
unset($_PUT['_method']);
dump($_PUT);
}

dump($_SERVER['REQUEST_METHOD']);

if ('PUT' === $method) {
parse_str(file_get_contents('php://input'), $_PUT);
dump($_PUT); //$_PUT contains put fields
}

$_SERVER['REQUEST_METHOD']==="PUT" ? parse_str(file_get_contents('php://input', false , null, -1 , $_SERVER['CONTENT_LENGTH'] ), $_PUT): $_PUT=array();

function createRequestMethod($method)
{
if($_SERVER['REQUEST_METHOD'] === $method)
{
// pase body
$_SERVER['REQUEST_METHOD'] = parse_str(file_get_contents('php://input', false , null, -1 , $_SERVER['CONTENT_LENGTH'] ), $_PUT);
}else{
$_SERVER['REQUEST_METHOD'] = $_PUT = [];
}
}

echo '<form action="/" method="POST">
    <div>
        <input type="text" name="username">
    </div>
    <div>
        <input type="password" name="password">
    </div>
    <input type="hidden" name="_method" value="PUT">
    <button type="submit">Send</button>
</form>';
<?php declare(strict_types=1);

$filter = ['.', '..', '.htaccess', 'index.php', 'thumbs.db', 'thumbs'];

$param = isset($_GET['param'])? trim(htmlspecialchars($_GET['param']), '/') : null;

if ($param === null) {
    http_response_code(400);
    exit("bad request");
}

foreach (scandir('.') as $f) {
    if (in_array($f, $filter))
        continue;
    if ($f === $param) {
        header('Content-Type: application/json');
        exit(json_encode(array_values(array_diff(scandir("./$f"), $filter))));
    }
}

http_response_code(404);
exit("not found");

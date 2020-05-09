http://shpargalkablog.ru/2017/02/sitemap-php-mysql.html#robotstxt
================================================
Как создать sitemap.xml на PHP и MySQL

Для базы данных table, содержащей такие столбцы:


+----------------+--------------------------------+-----------------------------+----------------------------+
| id             | url                            | update                      | meta                       |
| smallint(5)    | varchar(255)                   | timestamp                   | set('noindex', 'feed', '') |
| UNSIGNED       |                                | CURRENT_TIMESTAMP           |                            |
| AUTO_INCREMENT |                                | ON UPDATE CURRENT_TIMESTAMP |                            |
+----------------+--------------------------------+-----------------------------+----------------------------+
| 1              | 2017/02/sitemap-php-mysql.html | 2017-02-14 09:07:30         |                            |
+----------------+--------------------------------+-----------------------------+----------------------------+
| 2              | 2017/02/example.html           | 2017-01-26 12:00:00         | noindex                    |
+----------------+--------------------------------+-----------------------------+----------------------------+

Файл db.php

<?php
if (defined('dbOn')) {
    $mysqli = new mysqli('localhost', 'my_user', 'my_password', 'my_db'); // подключение к серверу MySQL: тут указывается пароль к базе данных
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
} else {
    exit();
}

Файл sitemap.php

<?php

if (isset($_GET['p']) && in_array($_GET['p'], array('0','1'))): sitemapN($_GET['p']); // in_array($_GET['p'], array('0','1')) убирает невостребованные страницы site.ru/sitemap.xml?p=2, site.ru/sitemap.xml?p=3 и т.д.
elseif ($_SERVER['QUERY_STRING'] == ''): sitemap();
else: sitemap404();
endif;

function sitemap() { // файл индекса Sitemap

    // подключить файл с паролем от базы данных
    define('dbOn', '');
    require_once 'абсолютный_адрес/db.php';

    if (!$mysqli->set_charset("utf8")) {
        printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);
        exit();
    } else {
        if ($result = $mysqli->query("SELECT FLOOR(id/1000) FROM table WHERE meta NOT LIKE '%noindex%' ORDER BY id DESC LIMIT 1;")) { // 1000 — это максимальное количество адресов страниц сайта, хранящихся в одном Sitemap, которое можно изменить на другое число, но не более 50000; условие WHERE meta NOT LIKE '%noindex%' не заносит адрес страницы в Sitemap, если в столбце meta есть значение noindex
            $row = $result->fetch_row();
            $row = intval($row[0]);
            header("Content-Type: application/xml;");
            echo '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            for ($i=0; $i<=$row; $i++) {
                echo '<sitemap><loc>http://site.ru/sitemap.xml?p='.$i.'</loc></sitemap>';  // http://site.ru/ — это домен рассматриваемого сайта, например, http://shpargalkablog.ru/
            }
            echo '</sitemapindex>';
        } 
    }
    $mysqli->close();
    exit();
}


function sitemapN($i) { // файлы Sitemap
    define('dbOn', '');
    require_once 'абсолютный_адрес/db.php';
    if (!$mysqli->set_charset("utf8")) {
        printf("Ошибка при загрузке набора символов utf8: %s\n", $mysqli->error);
        exit();
    } else {
        if ($result = $mysqli->query("SELECT url, update FROM table WHERE id>=". $i*1000 ." AND id<". ($i+1)*1000 ." AND meta NOT LIKE '%noindex%' LIMIT 1000;")) {
            header("Content-Type: application/xml;");
            echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            while ($row = $result->fetch_assoc()) {
                echo '
        <url>
          <loc>http://site.ru/'. $row['url'] .'</loc>
          <lastmod>'. date('c', strtotime($row['update'])) .'</lastmod>
          // теги priority и changefreq не являются обязательными и есть большие сомнения относительно того, что они как-то учитываются поисковыми системами
        </url>';
            }
            echo '
</urlset>';
        }
    }
    $mysqli->close();
    exit();
}


function sitemap404() { // 404 ошибка
    http_response_code(404);
    include_once 'http://site.ru/404.php'; // подключить файл со своим оформлением 404 ошибки
    exit();
}

Файл .htaccess

RewriteEngine On # если запись отсутствует
RewriteRule ^sitemap.xml$ /sitemap.php

Файл robots.txt

User-agent: *
Allow: / # запись для примера, разрешает сканировать все страницы
Sitemap: http://site.ru/sitemap.xml

Как добавить файл sitemap.xml в Яндекс и Google

Сообщить поисковым системам о созданном файле с картой сайта можно двумя способами.

    Добавить директиву sitemap с его адресом в файл robots.txt (см. выше)
    Добавить его адрес в соответствующее поле в Вебмастере
        Яндекс,
        Google (справка): нажать кнопку «ДОБАВЛЕНИЕ/ПРОВЕРКА ФАЙЛА SITEMAP» — в всплывающем окне ввести «sitemap.xml» — нажать кнопку «Отправить». 

Рекомендуемые сервисы:

    Telderi — покупка или продажа сайтов
    XML Stock — покупка и продажа лимитов Яндекс.XML
    ВоркЗилла — удалённая работа для всех
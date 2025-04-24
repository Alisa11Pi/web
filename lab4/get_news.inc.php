<?php
$items = $news->getNews();
if (!$items) {
    $errMsg = "Произошла ошибка при выводе новостной ленты";
} else {
    echo "<p>Всего новостей: " . count($items) . "</p>";
    
    foreach ($items as $item) {
        $dt = date("d-m-Y H:i:s", $item['datetime']);
        echo "<div>
                <h3>{$item['title']}</h3>
                <p><em>{$item['category']} | {$dt}</em></p>
                <p>{$item['description']}</p>
                <p>Источник: {$item['source']}</p>
                <p><a href='news.php?delete={$item['id']}'>Удалить</a></p>
              </div><hr>";
    }
}
?>
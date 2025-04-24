<?php
if (empty($_POST['title']) || empty($_POST['category']) || 
    empty($_POST['description']) || empty($_POST['source'])) {
    $errMsg = "Заполните все поля формы!";
} else {
    $result = $news->saveNews(
        $_POST['title'],
        $_POST['category'],
        $_POST['description'],
        $_POST['source']
    );
    
    if ($result) {
        header("Location: news.php");
        exit;
    } else {
        $errMsg = "Произошла ошибка при добавлении новости";
    }
}
?>
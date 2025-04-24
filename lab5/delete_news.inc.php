<?php
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id > 0) {
        if (!$news->deleteNews($id)) {
            $errMsg = "Произошла ошибка при удалении новости";
        } else {
            header("Location: news.php");
            exit;
        }
    }
}
?>
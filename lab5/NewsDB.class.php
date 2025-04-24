<?php
require_once 'INewsDB.class.php';

class NewsDB implements INewsDB, IteratorAggregate
{
    const DB_NAME = 'news.db';
    private $_db;
    private $items = [];

    public function __construct() {
        $is_db_exists = file_exists(self::DB_NAME);
        $this->_db = new SQLite3(self::DB_NAME);
        
        if (!$is_db_exists) {
            $this->initializeDatabase();
        }
        
        $this->getCategories();
    }

    private function initializeDatabase() {
        $sql = "CREATE TABLE msgs(
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT,
            category INTEGER,
            description TEXT,
            source TEXT,
            datetime INTEGER
        )";
        $this->_db->exec($sql);
        
        $sql = "CREATE TABLE category(
            id INTEGER PRIMARY KEY,
            name TEXT
        )";
        $this->_db->exec($sql);
        
        $sql = "INSERT INTO category(id, name)
                VALUES (1, 'Политика'), 
                       (2, 'Культура'), 
                       (3, 'Спорт')";
        $this->_db->exec($sql);
    }

    private function getCategories() {
        $result = $this->_db->query("SELECT id, name FROM category");
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->items[$row['id']] = $row['name'];
        }
    }

    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this->items);
    }

    public function __destruct()
    {
        $this->_db->close();
    }

    protected function getDB()
    {
        return $this->_db;
    }

    public function saveNews($title, $category, $description, $source)
    {
        $dt = time();
        $sql = "INSERT INTO msgs(title, category, description, source, datetime)
                VALUES('" . $this->_db->escapeString($title) . "', 
                       " . (int)$category . ", 
                      '" . $this->_db->escapeString($description) . "', 
                      '" . $this->_db->escapeString($source) . "', 
                       $dt)";
        return $this->_db->exec($sql);
    }

    public function getNews()
    {
        $sql = "SELECT msgs.id as id, title, category.name as category, 
                description, source, datetime
                FROM msgs, category
                WHERE category.id = msgs.category
                ORDER BY msgs.id DESC";
        $result = $this->_db->query($sql);
        
        if (!$result) return false;
        
        $news = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $news[] = $row;
        }
        return $news;
    }

    public function deleteNews($id)
    {
        $sql = "DELETE FROM msgs WHERE id = " . (int)$id;
        return $this->_db->exec($sql);
    }
}
?>
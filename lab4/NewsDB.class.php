<?php
require_once 'INewsDB.class.php';

class NewsDB implements INewsDB {
    const DB_NAME = 'news.db';
    private $_db;

    public function __construct() {
        $is_db_exists = file_exists(self::DB_NAME);
        $this->_db = new SQLite3(self::DB_NAME);
        
        if (!$is_db_exists) {
            $sql = "CREATE TABLE msgs(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                category INTEGER,
                description TEXT,
                source TEXT,
                datetime INTEGER
            )";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
            
            $sql = "CREATE TABLE category(
                id INTEGER PRIMARY KEY,
                name TEXT
            )";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
            
            $sql = "INSERT INTO category(id, name)
                    SELECT 1 as id, 'Политика' as name
                    UNION SELECT 2 as id, 'Культура' as name
                    UNION SELECT 3 as id, 'Спорт' as name";
            $this->_db->exec($sql) or die($this->_db->lastErrorMsg());
        }
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
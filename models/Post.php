<?php

namespace models;

class Post
{
    //DB stuff
    private $conn;//representing the connection
    private $table = 'posts';

    //POST Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    //Constructor with DB
    //When we instantiate a new post
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get posts
    public function read()
    {
        //Create query
        $query = 'SELECT 
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM
            ' . $this->table . ' p
            LEFT JOIN
                categories c ON p.category_id = c.id
            ORDER BY
                p.created_at DESC
        ';
        
        //Prepare statement
        $stmt = $this->conn->prepare($query);//comes from PDO
        
        //Execute the query
        $stmt->execute();
        
        return $stmt;//data
    }
}
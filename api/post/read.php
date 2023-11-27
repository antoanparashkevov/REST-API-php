<?php

use config\Database as Database;
use models\Post as Post;

//will interact with the model

//Headers
header('Access-Control-Allow-Origin: *');//completely public
header('Content-Type: application/json');//the mimetype is application/json

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB and connect to them
$database = new Database();

$db = $database->connect();

//Instantiate blog post object
$post = new Post($db);

//Blog post query
$result = $post->read();

//Get row count
$num = $result->rowCount();

if($num > 0) {
    //Post array
    $posts_arr = [];
    $posts_arr['data'] = [];
    
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $post_item = [
            "id" => $id,
            "title" => $title,
            "body" => html_entity_decode($body),
            "author" => $author,
            "category_id" => $category_id,
            "category_name" => $category_name
        ];
        
        //push each individual item to the posts_arr['data'] array
    
        array_push($posts_arr['data'], $post_item);
    }
    
    //turn to JSON since for now it is a PHP array
    
    echo json_encode($posts_arr);
    
    
} else {
    //No posts
    
    echo json_encode(
        [
            'message' => 'No Posts Found!'
        ]
    );
}


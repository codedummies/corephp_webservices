<?php

header('Access-Control-Allow-Origin: *');
header('Contrnt-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Post.php');

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$post->title = isset($_POST['title']) ? $_POST['title'] : '';
$post->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
$post->body = isset($_POST['body']) ? $_POST['body'] : '';
$post->author = isset($_POST['author']) ? $_POST['author'] : '';
$post->created_at = isset($_POST['created_at']) ? $_POST['created_at'] : '';

if($post->create()){
    echo json_encode(array('message'=>'Post created'));
}else{
    echo json_encode(array('message'=>'Post not created'));
}



?>
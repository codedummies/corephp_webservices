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

$post->post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';

if($post->delete()){
    echo json_encode(array('message'=>'Post deleted'));
}else{
    echo json_encode(array('message'=>'Post not deleted'));
}



?>
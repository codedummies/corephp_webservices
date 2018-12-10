<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Post.php');

//initiate db
$database = new Database();
$db = $database->connect();

//initiate post 
$post = new Post($db);
$result = $post->read();

if($result->rowCount() > 0){

    $post_data = array();
    $post_data['data'] = array();

    while($row = $result->fetch()){
        extract($row);
        
        $post_item = array(
            'id'=>$id,
            'category_id'=>$category_id,
            'category_name'=>$category_name,
            'title'=>$title,
            'body'=>$body,
            'author'=>$author,
            'created_at'=>$created_at,
        );

        array_push($post_data['data'],$post_item);
    }

    echo json_encode($post_data);

}else{
    echo json_encode(array('message'=>'No post found'));
}



?>
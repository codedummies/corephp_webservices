<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Post.php');

$database = new Database();
$db = $database->connect();

$post = new Post($db);

if(isset($_GET['id'])){
    
    $result = $post->read_single($_GET['id']);
    if($result->rowCount() > 0){
        if($row = $result->fetch(PDO::FETCH_ASSOC)){
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
            echo json_encode($post_item);
        }
    }else{
        echo json_encode(array('message'=>'No post found'));
    }

}else{
   echo json_encode(array('message'=>'Wrong data resource'));
}





?>
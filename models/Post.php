<?php

class Post {

    private $conn;
    private $table = "posts";

    public $id;
    public $category_id;
    public $title;
    public $body;
    public $author;
    public $created_at;
    public $post_id;


    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "select c.id as category_id,c.name as category_name,p.id,p.title,p.body,p.author,p.created_at from $this->table p 
        inner join categories c on (c.id = p.category_id)
        order by created_at desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single($id){
        $query="select c.id as category_id,c.name as category_name,p.id,p.title,p.body,p.author,p.created_at from $this->table p 
        inner join categories c on (c.id = p.category_id)
        where p.id= :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt;
    }

    public function create(){
        if($this->title!="" && $this->category_id!="" && $this->body!="" && $this->author!="" && $this->created_at!=""){
            $query="insert into $this->table set title= :title,category_id= :category_id,body= :body,author= :author,created_at= :created_at";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute(['title'=>$this->title,'category_id'=>$this->category_id,'body'=>$this->body,'author'=>$this->author,'created_at'=>$this->created_at])){
                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function update(){
        if($this->post_id!="" && $this->title!="" && $this->category_id!="" && $this->body!="" && $this->author!="" && $this->created_at!=""){
            $query="update $this->table set title= :title,category_id= :category_id,body= :body,author= :author,created_at= :created_at where id= :post_id";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute(['post_id'=>$this->post_id,'title'=>$this->title,'category_id'=>$this->category_id,'body'=>$this->body,'author'=>$this->author,'created_at'=>$this->created_at])){
                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function delete(){
        if($this->post_id!=""){
            $query="delete from $this->table where id= :post_id";
            $stmt = $this->conn->prepare($query);
            if($stmt->execute(['post_id'=>$this->post_id])){
                if($stmt->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
                
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


}

?>
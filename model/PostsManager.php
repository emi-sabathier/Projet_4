<?php

namespace Blog\model;

require_once 'Manager.php'; 

class PostsManager extends Manager 
{

    public function getListPosts() {

        $db = $this->dbconnect(); 
        $q = $db->query('SELECT posts.id, posts.title, posts.author_id, posts.content, users.user_name, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%i\') AS post_date_fr FROM posts INNER JOIN users ON posts.author_id = users.id ORDER BY post_date DESC');
        $posts = $q->fetchAll();
        
        return $posts;
    }

    public function getPost($postId) {

        $db = $this->dbConnect();
        $q = $db->prepare('SELECT posts.id, posts.title, posts.author_id, users.user_name, posts.content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh%i\') AS post_date_fr FROM posts INNER JOIN users ON posts.author_id = users.id WHERE posts.id = ?');
        $q->execute(array($postId));
        $post = $q->fetch(); 

        return $post;
    }

    public function deletePostAdmin($postId) {

        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM posts WHERE id = ?');
        $q->execute(array($postId));
        $deletedPost = $q->fetch(); 

        return $deletedPost;
    }
}




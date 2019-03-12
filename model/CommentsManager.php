<?php

namespace Blog\model;

require_once 'Manager.php'; 

class CommentsManager extends Manager {

    public function addComment($postId, $author, $comment) {
        $db = $this->dbconnect();
        $q = $db->prepare('INSERT INTO comments(post_id, author, content, comment_date) VALUES(?, ?, ?, NOW())');
        $q->execute(array($postId, $author, $comment));
        $comment = $q->fetch();

        return $comment;
    }
    public function getListComments($postId) {
        $db = $this->dbconnect();
        $q = $db->prepare('SELECT id, author, content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $q->execute(array($postId));
        $comments = $q->fetchAll();

        return $comments;
    }

}
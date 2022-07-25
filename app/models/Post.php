<?php

class Post{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }
    //Get all posts
    public function getPosts(){
        $this->db->query('SELECT *,
                            posts.id AS postId,
                            users.id AS usersId,
                            users.profile_path_img as userProfileImage,
                            posts.created_at as postCreated,
                            users.created_at as userCreated
                            FROM posts 
                            INNER JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC
                            '
        );
        $results = $this->db->resultSet();
        return $results;
    }
    public function getPostForRangueLimited($initLimit, $endLimit ){
        $this->db->query('SELECT *,
                            posts.id AS postId,
                            users.id AS usersId,
                            users.profile_path_img as userProfileImage,
                            posts.created_at as postCreated,
                            users.created_at as userCreated
                            FROM posts 
                            INNER JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC LIMIT :init, :end
                            '
        );
        $this->db->bind(':init', $initLimit);
        $this->db->bind(':end', $endLimit);
        $results = $this->db->resultSet();
        return $results;
    }
    //Insert post for id user
    public function addPost( $data ){
        $this->db->query(
            /*Init post and score posts*/
            'BEGIN;
                INSERT INTO posts(user_id, title, body) VALUES( :user_id, :title, :body );
                INSERT INTO score_post( posts_id, users_id ) VALUES( LAST_INSERT_ID(), :user_id  );
            COMMIT;'
            );
        //bind values
        //$this->db->bind(':post_id', 'LAST_INSERT_ID()');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        if ($this->db->execute() == true) {
            return true;
        } else {
            return false;
        }
    }
    //Update post
    public function updatePost( $data ){
        $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        //bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        //Execute
        if ($this->db->execute() == true) {
            return true;
        } else {
            return false;
        }
    }

    //Get post detail for id
    public function getPostById( $id ){
        $this->db->query(
            'SELECT POST.id, POST.user_id, 
                    POST.created_at, POST.title, 
                    POST.body, 
                    SUM(SCORE_POST.like) AS likes, 
                    SUM(SCORE_POST.dislike) AS dislikes 
                    FROM posts AS POST
                INNER JOIN score_post AS SCORE_POST
                ON SCORE_POST.posts_id = POST.id
                WHERE POST.id = :id'
        );
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        
        return $row;
    }

    //Delete post by id
    public function deletePost( $id ){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        //bind values
        $this->db->bind(':id', $id);
        //Execute
        if ($this->db->execute() == true) {
            return true;
        } else {
            return false;
        }
    }
    //Count all posts
    public function countAllPost(){
        $this->db->query('SELECT COUNT(*) AS num_posts FROM posts');
        $this->db->execute();
        return $this->db->rowCountAlter();
    }
    //Count post by id +delete+
    public function countPostsById( $id ){
        $this->db->query( 'SELECT COUNT(*) AS num_posts FROM posts WHERE user_id = :id ' );
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function getScorePostByUserId( $postId, $userId  ){
        $this->db->query('SELECT * FROM score_post WHERE posts_id = :postId && users_id = :userId' );
        $this->db->bind( ':userId', $userId );
        $this->db->bind( ':postId', $postId );
        $row = $this->db->single();
        return $row;
    }
    //Like post
    public function likePost( $id, $user ){
        try{
            //Check Status like and dislike
            $this->db->query('SELECT score_post.like, score_post.dislike FROM score_post WHERE score_post.posts_id = :id && score_post.users_id = :user ');
            //Bind values
            $this->db->bind(':id', $id);
            $this->db->bind(':user', $user);
            $result = $this->db->single();
            
            if ($this->db->execute() == true) {

                if( $result->like == null ){
                    $this->db->query('INSERT INTO score_post( score_post.like, posts_id, users_id) VALUES( :like, :id, :user)' );
                    //Bind values
                    $this->db->bind(':id', $id);
                    $this->db->bind(':user', $user);
                    $this->db->bind(':like', 1);

                }else if( $result->like == 1 ){
                    $this->db->query('UPDATE score_post AS SCORE SET SCORE.like = NOT SCORE.like WHERE (SCORE.posts_id = :id && SCORE.users_id = :user )' );
                }
                else if( $result->like == 0 ){
                    $this->db->query( 'UPDATE score_post AS SCORE SET SCORE.like = NOT SCORE.like WHERE (SCORE.posts_id = :id && SCORE.users_id = :user )' );
                }
                //Dislike is active
                if ($result->dislike == 1) {
                    $this->db->query(
                        'UPDATE score_post AS SCORE
                            SET SCORE.like = 1,
                                SCORE.dislike = 0
                        WHERE (SCORE.posts_id = :id && SCORE.users_id = :user) '
                    );
                }
                //Bind values
                $this->db->bind(':id', $id);
                $this->db->bind(':user', $user);
                if ($this->db->execute() == true){
                    return true;
                }
            }else{
                return false;
            }
        }catch(PDOException $e){
            echo $e;
        }
    }
    //Dislike Post
    public function dislikePost($id, $user){
        try {
            //Check Status like and dislike
            $this->db->query('SELECT score_post.like, score_post.dislike FROM score_post WHERE score_post.posts_id = :id && score_post.users_id = :user ');
            //Bind values
            $this->db->bind(':id', $id);
            $this->db->bind(':user', $user);
            $result = $this->db->single();

            if ($this->db->execute() == true) {

                if ($result->dislike == null) {
                    $this->db->query('INSERT INTO score_post( score_post.like, posts_id, users_id) VALUES( :dislike, :id, :user)');
                    //Bind values
                    $this->db->bind(':id', $id);
                    $this->db->bind(':user', $user);
                    $this->db->bind(':dislike', 1);
                } else if ($result->dislike == 1) {
                    $this->db->query('UPDATE score_post AS SCORE SET SCORE.dislike = NOT SCORE.dislike WHERE (SCORE.posts_id = :id && SCORE.users_id = :user )');
                } else if ($result->dislike == 0) {
                    $this->db->query('UPDATE score_post AS SCORE SET SCORE.dislike = NOT SCORE.dislike WHERE (SCORE.posts_id = :id && SCORE.users_id = :user )');
                }
                //Dislike is active
                if ($result->like == 1) {
                    $this->db->query(
                        'UPDATE score_post AS SCORE
                            SET SCORE.dislike = 1,
                                SCORE.like = 0
                        WHERE (SCORE.posts_id = :id && SCORE.users_id = :user) '
                    );
                }
                //Bind values
                $this->db->bind(':id', $id);
                $this->db->bind(':user', $user);
                if ($this->db->execute() == true) {
                    return true;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

}
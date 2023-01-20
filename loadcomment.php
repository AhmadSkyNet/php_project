<?php
include "db.php" ; 

if ($_POST['getData']==='getcomment') {
    $start = $_POST['start'];
    $limit = $_POST['limit'];
    $id = $_POST['id'];
    $query = "SELECT * FROM comments WHERE comment_post_id = $id  ORDER BY comment_id DESC LIMIT $start, $limit";
    $result = $conn->prepare($query);    
    $result->execute();   

    //$count = $result->rowCount();
    //if($count>0){
        $response = "";
        while($row = $result->fetch()){
            $comment_id      = $row['comment_id'];
            $comment_user    = $row['comment_user'];
            $comment_date    = $row['comment_date'];
            $comment_email   = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_post_id = $row['comment_post_id'];   

            $response .= "<div class='border border-success p-3 mb-2 border-opacity-50'>
            <div class='body' id='mainComment'>
            <h6><i class='bi bi-person-circle'></i> $comment_user</h6>
            <p><i class='bi bi-chat-right-text-fill'></i> $comment_content</p>
            <small><i class='bi bi-clock-history'></i> $comment_date</small>
            <div class= 'reply'> <a href='javascript:void(0)' onclick ='reply(this)'>REPLY </a> </div>
            </div>
            </div>
            <form method='post'>
            <div class= 'row replyRow'>
            <textarea name='replyComment' class='form-control m-2' id='replyComment' cols='10' rows='4'></textarea>
            <button  class='btn btn-light ms-2' style='float:right' onclick=$('isReply').hide();'>Close</button>
            <button type='submit' value='' name='submit' class='btn btn-dark ms-2' onclick='isReply=true;'>Add Reply</button>
          </form>";
        } 
        echo $response ;
     
    //}
}
else { 
    echo 'reachedMax' ;
    }

?>
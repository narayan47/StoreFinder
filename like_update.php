<?php
session_start();
include("connection.php");

if (!isset($_SESSION["id"])) {
    echo "login";
     $conn->close();
    exit();
}

$user_id = $_SESSION["id"];
if (isset($_POST["feedback_id"])) {
    $comment_id = (int)$_POST["feedback_id"];
    
    // Check if user already liked/disliked this comment
    $check = $conn->prepare("SELECT * FROM tm_like_dislike WHERE user_id=? AND comment_id=?");
    $check->bind_param("ii", $user_id, $comment_id);
    $check->execute();
    $result = $check->get_result();
    if ($result->num_rows == 0) {
        // Insert like
        $like = 1;
        $dislike = 0;
        $insert = $conn->prepare("INSERT INTO tm_like_dislike(user_id, comment_id, likes, dislike) VALUES (?, ?, ?, ?)");
        $insert->bind_param("iiii", $user_id, $comment_id, $like, $dislike);
        $insert->execute();
        $col="bi-hand-thumbs-up-fill text-danger";
    } else {
        // Update existing row (toggle)
         while( $row = $result->fetch_assoc() ) {
            $likes = $row["likes"];
        if($likes== 1) {
              $update = $conn->prepare("UPDATE tm_like_dislike SET likes=0, dislike=0 WHERE user_id=? AND comment_id=?");
        $update->bind_param("ii", $user_id, $comment_id);
        $update->execute();
        $col="bi-hand-thumbs-up";
        }else{
        $update = $conn->prepare("UPDATE tm_like_dislike SET likes=1, dislike=0 WHERE user_id=? AND comment_id=?");
        $update->bind_param("ii", $user_id, $comment_id);
        $update->execute();
        $col="bi-hand-thumbs-up-fill text-danger";
        }
    }
    }
    
    // Get updated total
    $sum = $conn->prepare("SELECT SUM(likes) AS total_like, SUM(dislike) AS total_dislike FROM tm_like_dislike WHERE comment_id=?");
    $sum->bind_param("i", $comment_id);
    $sum->execute();
    $res = $sum->get_result()->fetch_assoc();
    $like_count = $res['total_like'] ?? 0;
    $dislike_count = $res['total_dislike'] ?? 0;

    echo "<button style='border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;' class='like' data-feedback_like_id='$comment_id'><i class='bi $col mx-3'>$like_count</i></button> 
    <button style='border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;' class='dislike' data-feedback_dislike_id='$comment_id'><i class='bi bi-hand-thumbs-down'>$dislike_count</i></button>
    <button style='border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;' class='creply text-dark mx-2'>Reply</button>";
     $conn->close();
    exit();

}

// Dislike action
if (isset($_POST["feedback_dislike_id"])) {
    $comment_id = (int)$_POST["feedback_dislike_id"];

    // Check if user already liked/disliked this comment
    $check = $conn->prepare("SELECT * FROM tm_like_dislike WHERE user_id=? AND comment_id=?");
    $check->bind_param("ii", $user_id, $comment_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        // Insert dislike
        $like = 0;
        $dislike = 1;
        $insert = $conn->prepare("INSERT INTO tm_like_dislike(user_id, comment_id, likes, dislike) VALUES (?, ?, ?, ?)");
        $insert->bind_param("iiii", $user_id, $comment_id, $like, $dislike);
        $insert->execute();
         $col="bi-hand-thumbs-down-fill text-danger";
    } else {
        // Update existing row (toggle)
          while( $row = $result->fetch_assoc() ) {
            $dislike = $row["dislike"];
        if($dislike== 1) {
             $update = $conn->prepare("UPDATE tm_like_dislike SET likes=0, dislike=0 WHERE user_id=? AND comment_id=?");
        $update->bind_param("ii", $user_id, $comment_id);
        $update->execute();
             $col="bi-hand-thumbs-down";
        }else{
            $update = $conn->prepare("UPDATE tm_like_dislike SET likes=0, dislike=1 WHERE user_id=? AND comment_id=?");
        $update->bind_param("ii", $user_id, $comment_id);
        $update->execute();
             $col="bi-hand-thumbs-down-fill text-danger";
        }
    }
        
    }

    // Get updated total
    $sum = $conn->prepare("SELECT SUM(likes) AS total_like, SUM(dislike) AS total_dislike FROM tm_like_dislike WHERE comment_id=?");
    $sum->bind_param("i", $comment_id);
    $sum->execute();
    $res = $sum->get_result()->fetch_assoc();
    $like_count = $res['total_like'] ?? 0;
    $dislike_count = $res['total_dislike'] ?? 0;

    echo "<button style='border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;' class='like' data-feedback_like_id='$comment_id'><i class='bi bi-hand-thumbs-up mx-3'>$like_count</i></button> 
    <button style='border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;' class='dislike' data-feedback_dislike_id='$comment_id'><i class='bi $col '>$dislike_count</i></button>
    <button style='border: none;
    background: none;
    padding: 0;
    margin: 0;
    cursor: pointer;' class='creply text-dark mx-2'>Reply</button>";
     $conn->close();
    exit();
}
?>

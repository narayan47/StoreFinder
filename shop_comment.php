<?php
session_start();
include("connection.php");

function displayReplies($conn, $parent_id, $guser_id = 0, $isGuest = false) {
    $sql = "SELECT rc_id, user_id, feedback_id, comment_text,rfd_datetime FROM reply_comment WHERE feedback_id = $parent_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<button style='border: none; background: none; padding: 0; margin: 0; cursor: pointer;' class='reply_num text-primary ms-3'><i class='bi bi-chevron-down rn'></i>{$result->num_rows} Reply</button>";
        echo "<div class='reply_ans'>";
        while ($row = $result->fetch_assoc()) {
            $rc_id = $row['rc_id'];
            $u_id = $row['user_id'];
            $msg = $row['comment_text'];
            $datetime= $row['rfd_datetime'];

            // User info
            $user_sql = "SELECT user_fullname, profile_img FROM tm_user WHERE user_id = $u_id";
            $user_result = $conn->query($user_sql);
            $user = $user_result->fetch_assoc();
            $name = $user['user_fullname'];
            $img = $user['profile_img'];

            // Like/Dislike info
            $like_sql = "SELECT SUM(likes) AS likes, SUM(dislike) AS dislike FROM tm_like_dislike WHERE comment_id = $rc_id";
            $like_result = $conn->query($like_sql)->fetch_assoc();
            $likes = (int)$like_result['likes'];
            $dislikes = (int)$like_result['dislike'];

            $user_like = $user_dislike = 0;
            if (!$isGuest) {
                $user_react_sql = "SELECT likes, dislike FROM tm_like_dislike WHERE user_id = $guser_id AND comment_id = $rc_id";
                $user_react = $conn->query($user_react_sql)->fetch_assoc();
                $user_like = isset($user_react['likes']) ? (int)$user_react['likes'] : 0;
                $user_dislike = isset($user_react['dislike']) ? (int)$user_react['dislike'] : 0;
            }

            $like_icon = $user_like ? "bi-hand-thumbs-up-fill text-danger" : "bi-hand-thumbs-up";
            $dislike_icon = $user_dislike ? "bi-hand-thumbs-down-fill text-danger" : "bi-hand-thumbs-down";

            $dropdown = "<div class='dropdown'>
                <button class='btn p-0 m-0 border-0' type='button' data-bs-toggle='dropdown'><i class='bi bi-three-dots-vertical'></i></button>
                <ul class='dropdown-menu dropdown-menu-end'>";

            if (!$isGuest && $guser_id == $u_id) {
                $dropdown .= "<li><a class='dropdown-item rpedit' data-comment-id='$rc_id'>Edit</a></li>
                              <li><a class='dropdown-item rpdelete' data-comment-id='$rc_id'>Delete</a></li>
                              </ul></div>";
            } else {
                $dropdown= "";
            }

            echo "
            <div class='comment d-flex align-items-start mb-3'>
             <a href='user_profile.php?u_id=$u_id' style='text-decoration:none;' class='d-flex align-items-center gap-2 text-dark'>   
            <div class='flex-shrink-0'>
                    <img src='uploads/profile/$img' alt='User Image' class='rounded-circle' width='50' height='50'>
                </div>
                <div class='flex-grow-1 ms-3'>
                    <h6 class='fw-bold mb-1'>$name</h6>
                    </a>
                    <p>$datetime</p>
                    <div class='d-flex justify-content-between'>
                        <p class='mb-0 flex-grow-1'>$msg</p>
                        <div>$dropdown</div>
                    </div>
                    <span class='liked'>
                        <button class='like' data-feedback_like_id='$rc_id' style='background:none;border:none'><i class='bi $like_icon '>$likes</i></button>
                        <button class='dislike' data-feedback_dislike_id='$rc_id' style='background:none;border:none'><i class='bi $dislike_icon'>$dislikes</i></button>";
                        if ($isGuest) {
            echo "<button class='text-dark' style='border:none;background:none'><a href='registration.php' style='text-decoration:none;color:black'>Reply</a></button>";
        } else {
            echo "<button class='ccreply text-dark' style='border:none;background:none'>Reply</button>";
        }
                  echo"</span>
                    <div class='sreply_div' data-feedback_id='$rc_id'>
                        <input type='text' class='rp_msg form-control w-75 my-3'>
                        <span class='rms'>
                            <button class='cancels btn text-dark rounded-3'>Cancel</button>
                            <button class='submits btn rounded-3 '>Submit</button>
                        </span>
                    </div>
                    <div class='reply_divss' data-feedback-id='$rc_id'>
                        <input type='text' class='msg form-control w-75 my-3'>
                        <span class='rms'>
                            <button class='cancels btn text-dark rounded-3'>Cancel</button>
                            <button class='saves btn rounded-3 '>Save</button>
                        </span> 
                    </div>";

            echo "</div></div>";
              displayReplies($conn, $rc_id, $guser_id, $isGuest);
        }
        echo "</div>";
       
    }
}

$shop_id = $_SESSION["shop_id"];
$data = "SELECT user_id, feedback_id, feedback_msg,fd_datetime FROM tm_feedback WHERE shop_id = $shop_id ORDER BY feedback_id DESC";
$result = $conn->query($data);

$isGuest = !isset($_SESSION["id"]);
$guser_id = $isGuest ? 0 : (int)$_SESSION["id"];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row["user_id"];
        $msg = $row["feedback_msg"];
        $f_id = $row["feedback_id"];
         $datetime= $row['fd_datetime'];

        $user_sql = "SELECT user_fullname, profile_img FROM tm_user WHERE user_id = $user_id";
        $user_result = $conn->query($user_sql);
        $user_row = $user_result->fetch_assoc();
        $user_name = $user_row["user_fullname"];
        $img = $user_row["profile_img"];

        $count_sql = "SELECT SUM(likes) AS likes, SUM(dislike) AS dislike FROM tm_like_dislike WHERE comment_id = $f_id";
        $ld_row = $conn->query($count_sql)->fetch_assoc();
        $likes = (int)$ld_row["likes"];
        $dislikes = (int)$ld_row["dislike"];

        $ld_like = $ld_dislike = 0;
        if (!$isGuest) {
            $ld_sql = "SELECT likes, dislike FROM tm_like_dislike WHERE user_id = $guser_id AND comment_id = $f_id";
           $ld_result = $conn->query($ld_sql);

    if ($ld_result && $ld_result->num_rows > 0) {
        $ld = $ld_result->fetch_assoc();
        $ld_like = (int)$ld["likes"];
        $ld_dislike = (int)$ld["dislike"];
    }
}

        $like_icon = $ld_like ? "bi-hand-thumbs-up-fill text-danger" : "bi-hand-thumbs-up";
        $dislike_icon = $ld_dislike ? "bi-hand-thumbs-down-fill text-danger" : "bi-hand-thumbs-down";

        $dropdown = "<div class='dropdown'>
          <button class='btn p-0 m-0 border-0' type='button' data-bs-toggle='dropdown'><i class='bi bi-three-dots-vertical'></i></button>
          <ul class='dropdown-menu dropdown-menu-end'>";
        if (!$isGuest && $user_id == $guser_id) {
            $dropdown .= "<li><a class='dropdown-item edit' data-comment-id='$f_id'>Edit</a></li>
                          <li><a class='dropdown-item delete' data-comment-id='$f_id'>Delete</a></li></ul></div>";
        } else {
            $dropdown = "";
        }

        echo "<div class='comment d-flex align-items-start'>
         <a href='user_profile.php?u_id=$user_id' style='text-decoration:none;' class='d-flex align-items-center gap-2 text-dark'>
            <div class='flex-shrink-0'>
                <img src='uploads/profile/$img' alt='User Image' class='rounded-circle' width='50' height='50'>
            </div>
            <div class='flex-grow-1 ms-3'>
                <div class='ed'>
                    <h6 class='mb-1 fs-5 fw-bold'>$user_name</h6>
                    </a>
                    <p>$datetime</p>
                    <div class='d-flex justify-content-between'>
                        <p class='mb-0 flex-grow-1'>$msg</p>
                        <div>$dropdown</div>
                    </div>
                    <span class='liked'>
                        <button class='like' data-feedback_like_id='$f_id' style='border:none;background:none'><i class='bi $like_icon'>$likes</i></button>
                        <button class='dislike' data-feedback_dislike_id='$f_id' style='border:none;background:none'><i class='bi $dislike_icon'>$dislikes</i></button>";

        if ($isGuest) {
            echo "<button class='text-dark' style='border:none;background:none'><a href='registration.php' style='text-decoration:none;color:black'>Reply</a></button>";
        } else {
            echo "<button class='creply text-dark' style='border:none;background:none'>Reply</button>";
        }

        echo "</span>
                    <br>
                    <div class='reply_div' data-feedback_id=$f_id>
                        <input type='text' class='rp_msg form-control w-75 my-3'>
                        <span class='rms'>
                            <button class='cancel btn text-dark rounded-3'>Cancel</button>
                            <button class='submit btn rounded-3 '>Submit</button>
                        </span>
                    </div>
                </div>
                <br>
                <div class='reply_divs' data-feedback-id=$f_id>
                    <input type='text' class='msg form-control w-75 my-3'>
                    <span class='rms'>
                        <button class='cancels btn text-dark rounded-3'>Cancel</button>
                        <button class='save btn rounded-3 '>Save</button>
                    </span>
                </div>";
 echo "</div></div>";
        displayReplies($conn, $f_id, $guser_id, $isGuest);

       
    }
} else {
    echo "No feedback found.";
}


 $conn->close();
?>

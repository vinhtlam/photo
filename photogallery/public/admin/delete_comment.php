<?php
require_once('../../includes/initialize.php');

if(!$session->is_logged_in()) {	redirect_to("login.php"); }
// if(isset($session->message)){
if(isset($_GET['id'])) {
	$comment_id = $_GET['id'];	
} else { redirect_to("list_photos.php"); }

$comment = Comment::find_by_id($comment_id);
$photo_id = $comment->photograph_id;

if($comment && $comment->delete()) {
	$session->message("The comment id {$comment->id} was deleted.");
	redirect_to("photo_comments.php?id={$comment->photograph_id}") ;
} else {
	$session->message("Failed to delete commnent id {$comment->id}.");
	redirect_to("photo_comments.php?id={$comment->photograph_id}") ;
}
?>

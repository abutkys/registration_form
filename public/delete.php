<?php
/**
 * Created by PhpStorm.
 * User: andriusbutkys
 * Date: 20/09/2018
 * Time: 22:50
 */

require_once('../private/initialize.php');

if (!isset($_GET['id'])) {
	redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];
$user = find_user_by_id($id);

if(is_post_request()) {
	
	$result = delete_user($id);
	redirect_to(url_for('/index.php'));
} else {
	find_user_by_id($id);
}
?>
<?php $page_title = "Delete"; ?>
<?php include(SHARED_PATH . '/header.php');?>


<div id="content">
	
	<div class="subject delete">
		<h1 class="item">Delete User</h1>
		<p class="item">Are you sure you want to delete this user?</p>
		<p class="item">User: <?php echo h($user['firstname']) .' '. ($user['lastname']) ; ?></p>
		<form action="<?php echo url_for('/delete.php?id=' . h(u($user['id']))); ?>" method="post">
	<div id="operations">
		<input type="submit" name="commit" value="Delete" />
	</div>
</form>
</div>

</div>


<?php require(SHARED_PATH .  '/footer.php');?>

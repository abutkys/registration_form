<?php require_once("../private/initialize.php");
$page_title = "Edit";

if (!isset($_GET['id'])) {
	redirect_to(url_for('/index.php'));
}
$id = $_GET['id'];
$user = find_user_by_id($id);


//<!--POST REQUEST-->

if(is_post_request()){
	$user = [];
	$user['id'] = $id;
	$user['firstname'] = $_POST['firstname'] ?? '';
	$user['lastname'] = $_POST['lastname'] ?? '';
	$user['email'] = $_POST['email'] ?? '';
	$user['phone1'] = $_POST['phone1'] ?? '';
	$user['phone2'] = $_POST['phone2'] ?? '';
	$user['comment'] = $_POST['comment'] ?? '';
	
	$result = edit_user($user);
	if ($result === true) {
		redirect_to(url_for('/index.php'));
	}else
	{
		$errors=$result;
	}
	
}else
{
	$user = find_user_by_id($id);
}


?>

<?php include(SHARED_PATH . '/header.php');?>

<div id = "content">
	<div class = "pages_listing">
		<h1>Edit user's information</h1>
		
		<?php echo display_errors($errors); ?>
		
		<form action="<?php echo url_for('edit.php?id=' .h(u($id))); ?>" method="post">
			<fieldset>
				<legend>Personal information:</legend>
				First name:<br>
				<input type="text" name="firstname" value="<?php echo $user['firstname']; ?>">
				<br><br>
				Last name:<br>
				<input type="text" name="lastname" value="<?php echo $user['lastname'] ?>">
				<br><br>
				Email:<br>
				<input type="text" name="email" value="<?php echo $user['email'] ?>">
				<br><br>Phone1<br>
				<input type="text" name="phone1" value="<?php echo $user['phone1'] ?>">
				<br><br>Phone2<br>
				<input type="text" name="phone2" value="<?php echo $user['phone2'] ?>">
				<br><br>
				<textarea name="comment" rows="10" cols="30"><?php echo $user['comment'] ?></textarea>
				<br><br>
				<input type="submit" value="Submit">
			</fieldset>
		</form>
	
	</div>
</div>
<br><br>
<?php require(SHARED_PATH .  '/footer.php');?>

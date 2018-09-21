<?php require_once("../private/initialize.php");
$page_title = "Registration";
?>

<!--POST REQUEST-->

<?php

	if(is_post_request()){
		$user = [];
		$user['firstname'] = $_POST['firstname'] ?? '';
		$user['lastname'] = $_POST['lastname'] ?? '';
		$user['email'] = $_POST['email'] ?? '';
		$user['phone1'] = $_POST['phone1'] ?? '';
		$user['phone2'] = $_POST['phone2'] ?? '';
		$user['comment'] = $_POST['comment'] ?? '';
		
		$result = insert_user($user);
		if($result === TRUE)
		{
			redirect_to('index.php');
		}else
		{
			$errors = $result;
		}
	}
?>
<?php include(SHARED_PATH . '/header.php');?>

<div id = "content">
	<div class = "pages_listing">
		<h1>User registration form</h1>
		<?php echo display_errors($errors); ?>
		<form action="<?php echo url_for('form.php')?>" method="post">
			<fieldset>
				<legend class="item">Personal information:</legend>
			First name:<br>
			<input type="text" name="firstname">
			<br><br>
			Last name:<br>
			<input type="text" name="lastname">
			<br><br>
			Email:<br>
			<input type="text" name="email">
			<br><br>Phone1<br>
			<input type="text" name="phone1">
			<br><br>Phone2<br>
			<input type="text" name="phone2">
			<br><br>
				<textarea name="comment" rows="10" cols="30"></textarea>
				<br><br>
			<input type="submit" value="Submit">
				</fieldset>
		</form>
	</div>
</div>
<br><br>
<?php require(SHARED_PATH .  '/footer.php');?>

<?php require_once("../private/initialize.php");
$page_title = "Index";

$user_set = user_index();

?>


<?php include(SHARED_PATH . '/header.php');?>


<div id = "content">
	<div class = "pages_listing">
	
<div class = "actions">
	<a class="actions" href ="form.php">Create new user</a>
</div>

<table class="list">
	<tr>
		<th>ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Phone number1</th>
		<th>Phone number2</th>
		<th>Comment</th>
		<th>&nbsp;</th>
		<th>&nbsp;</th>
	</tr>
		<?php while($user = mysqli_fetch_assoc($user_set)) : ?>
	<tr>
			<td><?php echo $user['id'] ;?></td>
			<td><?php echo $user['firstname'] ;?></td>
			<td><?php echo $user['lastname'] ;?></td>
			<td><?php echo $user['email'] ;?></td>
			<td><?php echo $user['phone1'] ;?></td>
			<td><?php echo $user['phone2'] ;?></td>
			<td><?php echo $user['comment'] ;?></td>
			<td><a href="<?php echo url_for('edit.php?id='. h(u($user['id']))) ;?>">Edit</a></td>
			<td><a href="<?php echo url_for('delete.php?id='. h(u($user['id']))) ;?>">Delete</a></td>
	</tr>
		<?php endwhile; ?>
</table>

</div>
</div>

<?php require(SHARED_PATH .  '/footer.php');?>

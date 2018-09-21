<?php
/**
 * Created by PhpStorm.
 * User: andriusbutkys
 * Date: 20/09/2018
 * Time: 15:11
 */
function find_user_by_id($id)
{
	global $db;
	
	$sql = "SELECT * FROM users ";
	$sql .= "WHERE id= '" .db_escape($db, $id). "' ";
	$result = mysqli_query($db, $sql);
	confirm_result($result);
	
	$user = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $user;
}

function user_index()
{
	global $db;
	
	$sql = "SELECT * FROM users ";
	$sql .="ORDER BY id ASC";
	$result = mysqli_query($db, $sql);
	return $result;
}

function insert_user($user)
{
	global $db;
	
	$errors = validate_user($user);
	if(!empty($errors))
	{
		return $errors;

	}
	
	$sql = "INSERT INTO users ";
	$sql .="(firstname, lastname, email, phone1, phone2, comment)";
	$sql .= "VALUES(";
	$sql .=" '" . db_escape($db, $user['firstname']) . "', ";
	$sql .=" '" . db_escape($db, $user['lastname']) . "', ";
	$sql .=" '" . db_escape($db, $user['email']) . "', ";
	$sql .=" '" . db_escape($db, $user['phone1']) . "', ";
	$sql .=" '" . db_escape($db, $user['phone2']) . "', ";
	$sql .=" '" . db_escape($db, $user['comment']) . "' ";
	$sql .= ")";
	
	$result = mysqli_query($db, $sql);
	confirm_result($result);
	if ($result) {
		return TRUE;
	} else {
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function edit_user($user)
{
	global $db;
	$errors = validate_user($user);
	if(!empty($errors))
	{
		return $errors;
	}
	
	$sql = "UPDATE users SET ";
	$sql .= "firstname='" . db_escape($db,$user['firstname']) . "', ";
	$sql .= "lastname='" . db_escape($db,$user['lastname']) . "', ";
	$sql .= "email='" . db_escape($db,$user['email']) . "', ";
	$sql .= "phone1='" . db_escape($db,$user['phone1']) . "', ";
	$sql .= "phone2='" . db_escape($db,$user['phone2']) . "', ";
	$sql .= "comment='" . db_escape($db,$user['comment']) . "' ";
	$sql .= "WHERE id='" . db_escape($db,$user['id']) . "' " ;
	$sql .= "LIMIT 1";
	
	$result = mysqli_query($db, $sql);
	confirm_result($result);
	
	if ($result) {
		return TRUE;
	} else {
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function delete_user($id)
{
	global $db;
	
	$sql = "DELETE FROM users ";
	$sql .= "WHERE id = '" .db_escape($db,$id) . "'";
	$sql .= "LIMIT 1";
	$result = mysqli_query($db, $sql);
	confirm_result($result);
	if ($result) {
		return TRUE;
	} else {
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}

function validate_user($user) {
	$errors =[];

//	FIRSTNAME
	if (is_blank($user['firstname'])) {
		$errors['firstname'] = "First name cannot be blank.";
	} elseif (!has_length($user['firstname'], ['min' => 2, 'max' => 20])) {
		$errors['firstname'] = "First Name must be between 2 and 20 characters.";
	}
//	LASTNAME
	if (is_blank($user['lastname'])) {
		$errors['lastname'] = "Last name cannot be blank.";
	} elseif (!has_length($user['lastname'], ['min' => 2, 'max' => 20])) {
		$errors['lastname'] = "Last Name must be between 2 and 20 characters.";
	}
//	EMAIL
	if (is_blank($user['email'])) {
		$errors['email'] = "Email cannot be blank.";
	}elseif (!has_valid_email_format($user['email'])){
		$errors['email'] = "Wrong email address. E.g. someone@somewhere.fr";
	}
//	PHONE1
	if (is_blank($user['phone1'])) {
		$errors['phone1'] = "Phone1 cannot be blank.";
	}elseif (!has_valid_phone_number($user['phone1'])){
		$errors['phone1'] = "Phone1 does not match e.g. 8666... or +3306...";
	}elseif (!has_length($user['phone1'], ['min' => 4, 'max' => 15])) {
		$errors['phone1'] = "Phone1 must be between 4 and 15 numbers";
	}
//	PHONE2
	if (is_blank($user['phone2'])) {
		$errors['phone2'] = "Phone2 cannot be blank.";
	}elseif (!has_valid_phone_number($user['phone2'])){
		$errors['phone2'] = "Phone2 does not match e.g. 8666... or +3306...";
	}elseif (!has_length($user['phone2'], ['min' => 4, 'max' => 15])) {
		$errors['phone2'] = "Phone2 must be between 4 and 15 numbers";
	}
//	COMMENT
	
	if (has_length_greater_than($user['comment'],100))
	{
		$errors['comment'] = "Your comment must have less than 100 chaaracters.";
	};

	return $errors;
}


<?php

	function logIn($username, $password, $ip) {
		require_once('connect.php');

		$maxTime = 30;//Minutes

		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
		$user_set = mysqli_query($link, $loginstring);
		//echo mysqli_num_rows($user_set);
		if(mysqli_num_rows($user_set)){
			$founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);

			//Verify if is first login of the user and time is valid
			$firstLogin = $founduser['user_first'];
			$dateCreate = new Date($founduser['user_date']);
			//Compare from now
			$dateNow = new Date();
			//Difference in minutes
			$interval = $dateCreate->diff($dateNow);
			$minutesDiff = $interval->format('%i');//%i minutes format

			if($minutesDiff>$maxTime && $firstLogin == 1){
				$message = "Too much time your account is blocked";
				return $message;
			}else{
				$id = $founduser['user_id'];
				$_SESSION['user_id'] = $id;
				$_SESSION['user_name']= $founduser['user_fname'];

				if(mysqli_query($link, $loginstring)){
					$update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
					$updatequery = mysqli_query($link, $update);
				}

				//Verify if this is the first login of the user, if it is, you will send the user to the edit_account

				if($firstLogin == 1){
					//we need to update the first time field to 0
					$update = "UPDATE tbl_user SET user_first=0 WHERE user_id={$id}";
					redirect_to("admin_edituser.php");
				}else{
					//if this is not the first login, it will redirct the user to the admin section
					redirect_to("admin_index.php");
				}

			}


		}else{
			$message = "Learn how to type you dumba&*.";
			return $message;
		}

		mysqli_close($link);
	}
?>

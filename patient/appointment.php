<?php
require "./config.php";
function guidv4($data = null)
{
	// Generate 16 bytes (128 bits) of random data or use the data passed into the function.
	$data = $data ?? random_bytes(16);
	assert(strlen($data) == 16);

	// Set version to 0100
	$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
	// Set bits 6-7 to 10
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

	// Output the 32 character UUID.
	return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}
if (isset($_POST['submit'])) {
	if (empty($_POST['dname'])) {
		$errors = "You must fill in the doctor's name";
	} else {
		//Checking if the task should be kept or not
		$atime = $_POST['ApptTime'];
		$adate = $_POST['ApptDate'];
		$AID = guidv4();
		$patname = $_SESSION['username'];
		$docname = $_POST['dname'];
		$sql = "INSERT INTO appoint (date, time, pname, dname, aid) 
					VALUES ( '$adate', '$atime', '$patname', '$docname', '$AID');";
		mysqli_query($conn, $sql);
		header('location: appointment.php');
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="../css/st1.css">
</head>

<body>
	<div class="nav1">
		<a href="#" class="logo">myhealthcompass</a>
		<ul>
			<li><a href="./home.php">home</a></li>
			<li><a href="./profile.php">profile</a></li>
			<li><a href="../logout.php">Logout</a></li>
		</ul>
	</div>
	<div class="content" style="display:grid;place-items:center;margin:7rem;border-radius:0.5rem;width:60vw;">
		<table class="tt table-hover" cellspacing="0" style="border-radius:0.5rem;">
			<tr>
				<td colspan="4" style="font-size:1.1rem;color:white;font-weight:700;background:#8a2ce2;padding:1rem;margin-left:1.5rem;border-radius:0.5rem;text-align:center;" class="appst">Appointment Schedule</td>
			</tr>
			<tr style="margin-top:0px;">
				<th width="15%" style="font-size:1.1rem;text-align:center; color:black;">Appointment ID</th>
				<th width="15%" style="font-size:1.1rem;text-align:center; color:black;">Appointment Date</th>
				<th width="15%" style="font-size:1.1rem;text-align:center; color:black;">Appointment Time</th>
				<th width="15%" style="font-size:1.1rem;text-align:center; color:black;">Doctor Name</th>
			</tr>
			<?php
			$q1 = "SELECT * FROM appoint where date=CURRENT_DATE AND time>CURRENT_TIME; ";
			$r = mysqli_query($conn, $q1);
			while ($row = mysqli_fetch_array($r)) {
				$aid = $row['aid'];
				$docname = $row['dname'];
				$patname = $row['pname'];
				$ad = $row['date'];
				$apt = $row['time'];
				$dt = date("d-M-Y", strtotime($ad));
				$tt  = date("h:i A", strtotime($apt));
			?>
				<tr>
					<td style="font-size:1.1rem;text-align:center;"><?php echo $aid; ?></td>
					<td style="font-size:1.1rem;text-align:center;"><?php echo $dt; ?></td>
					<td style="font-size:1.1rem;text-align:center;"><?php echo $tt; ?></td>
					<td style="font-size:1.1rem;text-align:center;"><?php echo $docname ?></td>
				</tr>
			<?php
			}
			?>
			</tr>
		</table>
		<table class="table1" style="width:80vw;border-radius:0.5rem;">
			<thead>
				<tr>
					<th scope='col' style="padding:0 3rem;">Doctor Name</th>
					<th scope='col' style="padding:0 3rem;">Date</th>
					<th scope='col' style="padding:0 1rem;">Time</th>
					<th style="padding:0 3rem;" scope='col'>Action</th>
				</tr>
			</thead>
			<form method="post" action="appointment.php" class="input_form">
				<?php if (isset($errors)) { ?>
					<p><?php echo $errors; ?></p>
				<?php   }     ?>
				<tr>
					<td><input type="text" name="dname" class="appt_input" required placeholder="enter doctor name"></td>
					<td><input id="datestart" type="date" name="ApptDate" value="<?php echo date('Y-m-d') ?>"></td>
					<td><input id="timestart" type="time" name="ApptTime" required placeholder="enter restart time"></td>
					<td><button type="submit" name="submit" id="add_btn" value="submit" style="background:#8a2ce2;padding:0 2rem;margin-left:1rem;border-radius:0.5rem;font-size:1.1rem;margin-right:0;color:white;">Schedule</button></td>
				</tr>
			</form>
		</table>
	</div>
	<script type="text/javascript">
		window.addEventListener("scroll", function() {
			var nav = document.querySelector(".nav1");
			nav.classList.toggle("sticky", window.scrollY > 0);
		})
	</script>
</body>

</html>
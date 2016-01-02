<?php
//instantiate a new class. We will store data here later to be encoded for a json response
$data = new stdClass();

//Initially, set coins won to 'pay to play' to indicate that no spin has yet occurred
$coins_won = "Pay to play :)";

/* This variable "$rand_win" is intended to simulate a number of coins for an
 * authentically generated, CLIENT-SIDE win which still needs to be sent to the server.
 * Obviously, php is server-side and so this is happening server-side in this example,
 * but we will still load it into a POST variable to be sent along with all the client-side
 * variables.
 */
$rand_win = rand(10, 20);


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	/* The request method is post --> assume a spin has occured
	 * The goal is to simulate a client-side action happening with the submit, but for
	 * simplicity, we do all of this server side here...
	 *
	 * simulate the client-side recognition of this by setting $coins_won = $rand_win
	 * ($coins_won gets echoed to the page after submit)
	 */
	$coins_won = $rand_win;
	
	/* Next, the spin data needs to get sent to the server, so we just mimic this by
	 * merging an element into the post array which is equal to the $rand_win value
	 */
	$_POST['coins_won'] = $rand_win;
	
	/* Now we simulate validating the player_id and password data against what is stored in the
	 * players table with some basic conditions -- the blowfish-hashed password and salt value
	 * are stored in the database together by using the method in the function "hash_plus_salt()"
	 * found in the inc/functions.php controller code
	 */
	if(isset($_POST['player_id']) && isset($_POST['password'])) {
		$pid = $_POST['player_id'];
		$pwd = $_POST['password'];
		if($pid > 0 && $pid < 4) {
			$message = check_hash_plus_salt($pid, $pwd);
		} else {
			$message = "Invalid Player ID";
		}
	} else {
		$message = "Please fill all fields";
	}
	if($message == "Success!") {
		/* After successfully validating the more static data elements,
		 * we validate the rest...
		 */
		if(isset($_POST['coins_bet']) && isset($_POST['coins_won'])){
			$b = $_POST['coins_bet'];
			$w = $_POST['coins_won'];
			$info = retrieve_data("Players", "*", "WHERE player_id = ".$pid);
			$player_id     = $info[0]['player_id'];
			$name          = $info[0]['name'];
			$total_credits = $info[0]['credits'];
			$total_spins   = $info[0]['lifetime_spins'];
			$total_won     = $info[0]['lifetime_won'];
			$total_bet     = $info[0]['lifetime_bet'];
			if($b > 0 && $b <= $total_credits) {
				if($w == $coins_won) {
					/* Last check is successful (the value ready to be saved to the DB is
					 * the correct number of coins actually won)
					 *
					 * Now we are ready to update values for the DB record and write to the table
					 */
					$message = "You won ".$w." coins";
					$total_spins += 1;
					$total_credits += ($w - $b);
					$total_won += $w;
					$total_bet += $b;
					add_spin($player_id, $total_credits, $total_spins, $total_won, $total_bet);
					
					/* Finally, put the required info in the data class so that it is 
					 * ready to be encoded in a json response...
					 */
					$data->player_id = $player_id;
					$data->player_name = $name;
					$data->credits = $total_credits;
					$data->lifetime_spins = $total_spins;
					$data->lifetime_avg_return = $total_won / $total_bet;
				} else {
					$message = "You can't submit a number of coins you didn't win :)";
				}
			} else {
				$message = "You have ".$total_credits." credits available, please wager a valid number of credits";
			}
		} else {
			$message = "Please fill all fields";
		}
	}
}
echo '<br><br>';
echo $message;
?>
<br><hr>

<form method="post">
<input type="text" name="player_id"> <-- Player_ID (must be valid: 1, 2 or 3)<br>
<input type="password" name="password"> <-- Password (must match hashed+salted password for Player_ID -- enter "password1", "password2" or "password3" respectively)<br>
<input type="number" name="coins_bet" min="0"> <-- Coins bet (must be greater than 0 and less than Total Credits)<br>
<input type="text" value="<?php echo $coins_won; ?>" readonly> <-- Coins won (This is an output field only)<br>
<input type="submit" name="submit" value="Enter Spin Results">
</form><br>
<div id="stats"></div>

<script type="text/javascript">
//json encode data and user javascript to write to the page
var stats = document.getElementById("stats");
var htmlstring = "<ul>"
var obj = <?php echo json_encode($data); ?>;
for(var elem in obj) { htmlstring += "<li>" + elem + ": " + obj[elem] + "</li>"; }
htmlstring += "</ul>";
stats.innerHTML = htmlstring;
</script>
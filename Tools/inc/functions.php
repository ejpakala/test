<?php
function hash_plus_salt($input) {
	$salt = "";
	$saltChars = array_merge(range('A','Z'), range('a','z'), range(0,9));
	for($i = 0; $i < 22; $i++){ $salt .= $saltChars[array_rand($saltChars)]; }
	return crypt($input, sprintf('$2y$%02d$', 5) . $salt);
}
function check_hash_plus_salt($ID, $inputPass) {
	$_hashpass = retrieve_data("Players", "hashpass_plus_salt", "WHERE player_id = ".$ID);
	$hashpass = $_hashpass[0]["hashpass_plus_salt"];

	if(crypt($inputPass, $hashpass) == $hashpass) {
		return "Success!";
	} else {
		return "PlayerID or Password Incorrect";
	}
}
function add_life($birth, $death) {
	/* 
	 * This function simply creates a new record in the population table
	 *
	 *
	 */
    require(ROOT_PATH . "inc/tools_db_connect.php");
    try {
        $results = $db->prepare('INSERT INTO population (birth_year, death_year) VALUES (:var1, :var2)');
        $results->bindParam(':var1',$birth);
        $results->bindParam(':var2',$death);
        $results->execute();
    } catch (Exception $e) {
        echo "Data could not be written to the tools database (table: population | function: add_life).";
        exit;
    }
}
function add_spin($player_id, $credits, $lifetime_spins, $lifetime_won, $lifetime_bet) {
	/* 
	 * 
	 *
	 *
	 */
    require(ROOT_PATH . "inc/tools_db_connect.php");
    try {
        $results = $db->prepare('UPDATE Players SET credits=:var1, lifetime_spins=:var2, lifetime_won=:var3, lifetime_bet=:var4 WHERE player_id = '.$player_id);
        $results->bindParam(':var1',$credits);
        $results->bindParam(':var2',$lifetime_spins);
        $results->bindParam(':var3',$lifetime_won);
        $results->bindParam(':var4',$lifetime_bet);
        $results->execute();
    } catch (Exception $e) {
        echo "Data could not be written to the tools database (table: Players | function: add_spin).";
        exit;
    }
}
function retrieve_data($table, $fields, $where) {
    require(ROOT_PATH . "inc/tools_db_connect.php");
    $query_string = "SELECT ".$fields." FROM ".$table;
    if(isset($where) && $where != "") { $query_string = $query_string." ".$where; }
    try {
        $results = $db->query($query_string);
    } catch (Exception $e) {
        echo "Data could not be retrieved from the database. (".$fields." FROM ".$table.")";
        exit;
    }
    $set = $results->fetchAll(PDO::FETCH_ASSOC);
    return $set;
}
?>
<br><hr>
<?php
/* the controller code "functions.php" is already included in index.php
 * functions will be referenced here
 *
 */

if($_SERVER['REQUEST_METHOD'] == "POST") {
	/* If the request method is post, then the "Add another person" button has been
	 * clicked and the following block of code will add another randome lifespan to
	 * the 'population' table in the 'tools' database
	 */
	$y1 = rand(1900, 2000);
	$y2 = rand(1900, 2000);
	$birth = min($y1, $y2);
	$death = max($y1, $y2);
	add_life($birth, $death);
}

//Query the entire population from the database and store in array
$population = retrieve_data('population', '*');

/* In the following block of code we will loop through the years 1900-2000,
 * retrieve and count everyone for which the year in questions falls on or between
 * their birth year and death year. (For simplicity assume everyone is born Jan 1 and
 * everyone dies Dec 31)
 * We simply find the max count of people alive each year and store that along with 
 * the years where that count occurred.
 */
$years = array();
$max = 0;
for($i=1900; $i<=2000; $i++) {
	$alive = retrieve_data('population', '*', 'WHERE birth_year <= '.$i.' AND death_year >= '.$i);
	$count_alive = count($alive);
	if($count_alive >= $max) {
		if($count_alive > $max){ $years = array(); }
		$years[] = $i;
		$max = $count_alive;
	}
}
echo "<h4>The maximum number of people alive is: ".$max.", which occurs the following year(s):</h4>";
?>
<ul>
<?php
foreach($years as $year){
	echo "<li>".$year."</li>";
}
?>
</ul>

<h3>Total population table:</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Birth</th> 
    <th>Death</th>
  </tr>
<?php
foreach($population as $life) {
	echo '<tr><td>'.$life["ID"].'</td><td>'.$life["birth_year"].'</td><td>'.$life["death_year"].'</td></tr>';
}
?>
</table>
<form method="post">
<input type="submit" name="submit" value="Add another person">
</form>
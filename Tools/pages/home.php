<h2>Outline of the projects addressed here:</h2>
<h3>Problem 1 description:</h3>
<p>Given a list of people with their birth and end years (all between 1900 and 2000), find the year with the most number of people alive.</p>
<hr>

<h3>Problem 2: Implement a basic spin results end point</h3>
<p>
Description: Slot Machine Spin Results is our server end point that updates all player data and features when a spin is completed on the client. We do hundreds of millions of these requests per day, and we would like to see you make a very basic MySQL driven version.
This can be just a normal PHP file that gets called, or you can implement more modern routing if you would like
</p>
<h4>Data Storage</h4>
<p>Create a MySQL database that contains a player table with the following fields:</p>
<ul>
	<li>Player ID</li>
	<li>Name</li>
	<li>Credits<span style="color:red"> <-- please note I am assuming that by "Credits" you are referring to the total number of coins in the player's account</span></li>
	<li>Lifetime Spins</li>
	<li>Salt Value<span style="color:red"> <-- please note I am storing the salt value with the hashed password for now since this is the method with which I am familiar</span></li>
</ul>
<h4>Code</h4>
<p>Your code should validate the following request data: hash, coins won, coins bet, player ID ---
Update the player data in MySQL if the data is valid</p>
<p>Generate a JSON response with the following data:</p>
<ul>
	<li>Player ID</li>
	<li>Name</li>
	<li>Credits</li>
	<li>Lifetime Spins</li>
	<li>Lifetime Average Return</li>
</ul>


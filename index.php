<?php
if (array_key_exists('actor', $_GET))
    include 'actor.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Monkey Divers :: BACON</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="assets/css/bacon.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bacon.js"></script>
</head>


<body>

<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#">Monkey Divers</a>

			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="active"><a href="#">Lovin' Bacon</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>


<div class="container">


	<div class="column span5">

		<form class="span5 form-horizontal well">

			<div class="control-group">
				<div class="input-append">
					<label class="control-label" for="inputActorButton">Actor</label>

					<div class="controls">
						<input type="text" id="inputActorButton" name="actor" placeholder="Bill Murray">
						<button type="submit" class="btn" type="button"><i class="icon-user"></i> Go!</button>
					</div>
				</div>
			</div>

			<div class="control-group">
				<div class="input-append">
					<label class="control-label" for="inputDateButton">Date</label>

					<div class="controls">
						<input type="date" id="inputDateButton" name="date" placeholder="21/09/1950">
						<button class="btn" type="button"><i class="icon-list"></i> Go!</button>
					</div>
				</div>
			</div>

			<div class="control-group">
				<div class="input-append">
					<label class="control-label" for="inputFilmButton">Film</label>

					<div class="controls">
						<input type="text" id="inputFilmButton" placeholder="Groundhog Day">
						<button class="btn" type="button"><i class="icon-film"></i> Go!</button>
					</div>
				</div>
			</div>

		</form>

		<hr class="span5">

		<div class="row span5 well">
			<div class="span5 outpust">
				<h2>Output</h2>
                <ul>
                <?php
                    if (isset($data)) {
                        foreach ($data as $d) {
                            echo "<li>{$d}</li>";
                        }
                    }
                ?>
                </ul>
			</div>
		</div>

	</div>


<div class="column span1"></div>



	<div class="column span4">

		<div class="span4 well">
			<div class="span3">
				<h2>Actor / Actress</h2>

				<p>Enter an artist name, and we'll work out which film they were in and had the most shared birthdays
					with
					other cast members.</p>
			</div>
		</div>

		<div class="span4 well">
			<div class="span3">
				<h2>Date</h2>

				<p>Enter a date, and we'll return you the film that has the most birthdays on that date (as well as a
					list
					of those actors)</p>
			</div>
		</div>

		<div class="span4 well">
			<div class="span3">
				<h2>Film</h2>

				<p>Enter a film, and we'll return you the day that the most cast birthdays fall on (as well as a list of
					those actors)</p>

			</div>
		</div>

	</div>


	<footer>
		<!--<hr>-->
		<dl class="dl-horizontal span12">
			<dt>&copy; Monkey Divers</dt>
			<dd>#monkeydivers</dd>
		</dl>
	</footer>

</div>


</body>
</html>





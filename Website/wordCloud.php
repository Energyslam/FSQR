<!DOCTYPE html>
<!--this page is not used for the live version, but useful for testing purposes-->
<html lang="en">
<head>
	<meta charset=UTF-8>
	<title>$.wordCloud() tests</title>
	<style type="text/css">
	canvas {
	position: fixed; top: 2em; right: 0;
	font-family: monospace;
	white-space: nowrap;
	}
	.support {
		color: #080;
	}
	.not_support {
		color: #800;
	}
	</style>
</head>
<body>
<h2>Support</h2>
<p id="wordCloudSupported">$.wordCloudSupported</p>
<h2>$.wordCloud(); MySQL Support</h2>
<ul>
	<li><label>Database Host <input type="text" id="host" value="" /></label></li>
	<li><label>Database Username<input type="text" id="user" value="" /></label></li>
	<li><label>Database Password <input type="text" id="pass" value="" /></label></li>
	<li><label>Database Name <input type="text" id="dbname" value="" /></label></li>
	<li><label>Select Fields <input type="text" id="select" value="" /></label></li>
	<li><label>Table Name <input type="text" id="table" value="" /></label></li>
	<li><label>Where Clause <input type="text" id="where" value="" /></label></li>
	<li><label>Max Words <input type="text" id="maxWords" value="0" /></label></li>
	<li><label>Excluded Words <input type="text" id="excludedWords" value="" /></label></li>
	<li><label>Biggest Word <input type="text" id="biggestWord" value="100" /></label></li>
</ul>
<input type="button" id="test" value="Test" />

<canvas id="result" width="580" height="400"></canvas>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="wordcloud/jquery.wordcloud.js"></script>
<script type="text/javascript">
jQuery(function ($) {

	var $r = $('#result');

	$('#wordCloudSupported').addClass(($.wordCloudSupported?'':'not_') + 'support');

	$('#test').bind(
		'click',
		function () {
			try {
				$r.wordCloud({
					database: {
						dbHost: $('#host').val(),
						dbUser: $('#user').val(),
						dbPass: $('#pass').val(),
						dbName: $('#dbname').val(),
						selectFields: $('#select').val(),
						tableName: $('#table').val(),
						where: $('#where').val(),
						maxWords: $('#maxWords').val(),
						excludedWords: $('#excludedWords').val()
					},
					wordCountUrl: '../freq/wordcounter.php',
					biggestWord: $('#biggestWord').val()
				});
			} catch (e) { alert(e); }
		}
	);


});

</script>
</body>
</html>

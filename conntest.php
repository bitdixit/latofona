<html>
<body>
<form method="POST">
<textarea name="info"></textarea>
<br>
<input type="submit" value="go">
</body>
</html>

<?

$lines = explode("\n", $_POST["info"]);

foreach($lines as $line) {
	echo "<br>a line: ".$line;
}

?>
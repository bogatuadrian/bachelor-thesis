<?php
session_start();
?>

<?php
$answer = "";
$address = '127.0.0.1';
$port    = 16969;
if (isset($_GET["question"])) {

  /* Establish connection */
	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($sock == FALSE) {
		echo "error creating socket";
		exit("error");
	}
	$result = socket_connect($sock, $address, $port);
	if ($result == FALSE) {
		echo "error connecting";
		exit("error");
	}

  /* Send the question to the conversational agent */
	$question = $_GET["question"] . "\n";

	$err = socket_write($sock, $question, strlen($question));

  /* Wait for the answer */
	$answer = socket_read($sock, 12000);
	echo "$answer";

	socket_close($sock);
}?>

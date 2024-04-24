<?php
	$mysqli= new mysqli("localhost", "root", "", "Examen 1",3308);
	if(mysqli_connect_errno()){
		echo "Este sitio esta presentando problemas";
	}
	$mysqli->set_charset("utf8");
	?>
    
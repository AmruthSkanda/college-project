<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			$output = "<div id=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {

			$errors = "<div id=\"message\">";
			$errors .= $_SESSION["errors"];
			$errors .= "</div>";
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

spl_autoload_register(function($class){
	if (file_exists('class/'.$class.'.php')) {
		require 'class/'.$class.'.php'; 
	}
});

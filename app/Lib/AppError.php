<?php
class AppError {
	public static function handleError($code, $description, $file = null,
			$line = null, $context = null) {
		echo '$code';
		echo $description;
	}
}
?>
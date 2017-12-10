<?php

class Helpers {
    public static function getMinutes($datetime) {
		return (strtotime(date("Y-m-d H:i:s")) - strtotime($datetime));
	}
}
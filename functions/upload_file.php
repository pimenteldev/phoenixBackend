<?php

function uploadImage($tipo, $imagen, $photo, $location)
{
	if (strstr($tipo, "image")) {
		if (strstr($tipo, "jpeg"))
			$extension = ".jpg";
		else if (strstr($tipo, "jpg"))
			$extension = ".jpg";
		else if (strstr($tipo, "gif"))
			$extension = ".gif";
		else if (strstr($tipo, "png"))
			$extension = ".png";

		$destino = "images/" . $location . "/" . $photo . $extension;

		move_uploaded_file($imagen, $destino);

		// $nombre_img = "images/".$location."/".$photo;
		// $imagen="images/".$location."/".$photo.$extension;
		return $destino;
	} else {
		return false;
	}
}

function removeImage($pathImg, $location)
{
	$pattern = $location . "/";
	$path = explode($pattern, $pathImg);
	$image = "images/" . $location . "/" . $path[1];
	if (file_exists($image)) {
		unlink("images/" . $location . "/" . $path[1]);
	}
}

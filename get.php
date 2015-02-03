<?php
/* php.ini has limit of 50mb here we check for 48MB or smaller also perform some file types allowd */
#if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "application/x-gzip") || ($_FILES["file"]["type"] == "application/x-tar") || ($_FILES["file"]["type"] == "video/avi") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "text/plain") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "application/vnd.ms-excel") || ($_FILES["file"]["type"] == "application/octet-stream") || ($_FILES["file"]["type"] == "application/x-zip-compressed") || ($_FILES["file"]["type"] == "application/zip")) && ($_FILES["file"]["size"] < 50331648)) {
if ($_FILES["file"]["size"] < 50331648) {
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	} else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

		if (file_exists("uploadedfiles/" . $_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " already exists. ";
		} else {
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"uploadedfiles/" . $_FILES["file"]["name"]);
			echo "Stored in: " . "fileshare/uploadedfiles/" . $_FILES["file"]["name"];
			$link="http://".$_SERVER['SERVER_NAME']."/fileshare/uploadedfiles/".$_FILES['file']['name'];

			echo '<br/>Download link: <a href="'.$link.'">'.$link.'</a>';
			if ($_FILES["file"]["type"] == "video/avi") {
				$playlink="http://".$_SERVER['SERVER_NAME']."/fileshare/video.php?vidname=".$_FILES['file']['name'];
				echo '<br/>Playable Link: <a href="'.$playlink.'">'.$playlink.'</a>';
				
			} 
			echo '<br/><br/><br/>Upload another <a href="upload.php">File</a>';
		}
	}
} else {
	echo '<pre>Invalid file ';
	echo 'Here is some more debugging info:'; print_r($_FILES); 
	var_dump($_FILES);
	echo '</pre>';
}
/*
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead // of $_FILES.

$uploaddir = '/var/www/uploads';//<----This is all I changed $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n"; } else {
    echo "Possible file upload attack!\n"; }

echo 'Here is some more debugging info:'; print_r($_FILES);

echo $_REQUEST['data']."\n";
print "</pre>";
*/
?>


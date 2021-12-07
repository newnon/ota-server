<?php


function isJsonCall(\Slim\Slim $app)
{
	return strstr($app->request()->headers('Accept'), 'json') !== false || strstr($app->request()->headers('Content-Type'), 'json') !== false;
}

function toUrl($path = '')
{
	return currentUrl() . '/' . ltrim($path, '/');
}

function toUrlWithCredential($path = '')
{
	return currentUrlWithCredential() . '/' . ltrim($path, '/');
}

function currentUrl()
{
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	$path = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $path;
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $path;
	}

	return $pageURL;
}

function currentUrlWithCredential()
{
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	$path = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["PHP_AUTH_USER"]. ":" . $_SERVER["PHP_AUTH_PW"] . "@" . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $path;
	} else {
		$pageURL .= $_SERVER["PHP_AUTH_USER"]. ":" . $_SERVER["PHP_AUTH_PW"] . "@" . $_SERVER["SERVER_NAME"] . $path;
	}

	return $pageURL;
}

/**
 * @param $path String
 * @return String
 */
function strip_datas_dir($path)
{
	return str_replace(DIR_DATAS, '', $path);
}

function is_file_to_skip($file)
{
	return $file == '.' || $file == '..' || $file == '_empty' || $file == '.svn' || $file == '.DS_Store';
}
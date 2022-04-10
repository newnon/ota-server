<?php


class PlateformeWebGL extends Plateforme
{

	function __construct($apps = null)
	{
		parent::__construct($apps, 'webgl', 'WebGL');
	}


	/**
	 * @param $app \Slim\Slim
	 * @param $File File
	 */
	public function startSpecificDownloadForResource(\Slim\Slim $app, File $File)
	{
		$app->redirect($File->getDownloadUrl());
	}
}
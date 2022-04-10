<?php


class File extends Resource
{

	function __construct($path)
	{
		parent::_construct($path);
	}

	public function getUrl()
	{
		$plateform = $this->getPlateforme();
		if(strcasecmp($plateform->id, "android") === 0)
		{
			return $this->getDownloadUrl();
		}

		return toUrl("dl/" . $this->getPath());
	}

	public function startDownload(\Slim\Slim $app)
	{
		$Plateforme = $this->getPlateforme();
		$Plateforme->startSpecificDownloadForResource($app, $this);
	}

	/**
	 * @return Plateforme
	 */
	private function getPlateforme()
	{
		$path = $this->getPath();
		$plateformDirectory = current(explode("/", $path));
		return Plateforme::findById($plateformDirectory);
	}

	public function getFullPath()
	{
		return $this->path;
	}

	public function getDownloadUrl()
	{
		return toUrl('datas/'.$this->getPath());
	}

		public function getDownloadUrlWithCredential()
	{
		return toUrlWithCredential('datas/'.$this->getPath());
	}

	public function isFolder()
	{
		return false;
	}

	public function getCreated(): string
    {
        $ctime = filemtime($this->getFullPath());
        if (!$ctime) {
            throw new \Exception(sprintf("invalid mtime for file: %s", $this->getFullPath()));
        }

        return \DateTimeImmutable::createFromMutable(
            (new \DateTime())
            ->setTimestamp($ctime)
            ->setTimezone(new \DateTimeZone("Europe/Moscow"))
        )->format("d.m.Y");
    }

    public function getSize(): string
    {
        $filesize = filesize($this->getFullPath()); // bytes

        return round($filesize / 1024 / 1024, 2);
    }
}
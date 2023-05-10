<?php
class DisqueDur extends Composant
{
	protected bool $ssd = false;
	protected int $capaciteDisque;

	public function __construct(array $data = [])
	{
		parent::__construct($data);
		
		if (!empty($data['capaciteDisque'])) {
			$this->setCapacite($data['capaciteDisque']);
		}
		if (!empty($data['ssd'])) {
			$this->setSsd($data['ssd']);
		}

	}

	public function getSsd(): bool
	{
		return $this->ssd;
	}
	public function setSsd(bool $ssd): self
	{
		$this->ssd = $ssd;
		return $this;
	}

	public function getCapacite(): int
	{
		return $this->capaciteDisque;
	}
	public function setCapacite(int $capacite): self
	{
		$this->capaciteDisque = $capacite;
		return $this;
	}

	public function getMore(): string
	{
		return 'Capacite : '.$this->getCapacite().'GO, SSD : '.($this->getSsd() ? 'oui':'non');;
	}
}
?>
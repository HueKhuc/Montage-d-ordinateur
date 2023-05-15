<?php
class DisqueDur extends Composant
{
	protected bool $estSsd = false;
	protected int $capaciteDisque;

	public function __construct(array $data = [])
	{
		parent::__construct($data);
		
		if (!empty($data['capaciteDisque'])) {
			$this->setCapacite($data['capaciteDisque']);
		}
		if (!empty($data['estSsd'])) {
			$this->setestSsd($data['estSsd']);
		}

	}

	public function getEstSsd(): bool
	{
		return $this->estSsd;
	}
	public function setEstSsd(bool $estSsd): self
	{
		$this->estSsd = $estSsd;
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
		return 'Capacite : '.$this->getCapacite().'GO, SSD : '.($this->getEstSsd() ? 'oui':'non');
	}
}
?>
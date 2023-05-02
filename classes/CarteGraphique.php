<?php
class CarteGraphique extends Composant {
	protected string $chipset;
	protected float $memoire;

	public function getChipset(): string
	{
		return $this->chipset;
	}

	public function setChipset(string $chipset): self
	{
		$this->chipset = $chipset;
		return $this;
	}

	public function getMemoire(): float
	{
		return $this->memoire;
	}

	public function setMemoire(float $memoire): self
	{
		$this->memoire = $memoire;
		return $this;
	}
}
?>
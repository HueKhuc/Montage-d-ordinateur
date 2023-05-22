<?php
namespace Model;
class CarteGraphique extends Composant {
	protected string $chipset;
	protected float $memoire;

	public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (!empty($data['chipset'])) {
            $this->setChipset($data['chipset']);
        } 
		if (!empty($data['memoire'])) {
            $this->setMemoire($data['memoire']);
        } 
    }

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

	public function getMore(): string
	{
		return 'Chipset : '.$this->getChipset().', Memoire : '.$this->getMemoire();
		
	}
}
?>
<?php
namespace Model;
class Processeur extends Composant {

	protected float $frequence;
	protected int $nbCoeurs;
	protected string $chipsetCompatible;

	public function __construct(array $data = [])
	{
		parent::__construct($data);
		
		if (!empty($data['frequence'])) {
			$this->setFrequence($data['frequence']);
		}
		if (!empty($data['nbCoeurs'])) {
			$this->setNbCoeurs($data['nbCoeurs']);
		}
		if (!empty($data['chipsetCompatible'])) {
			$this->setChipsetCompatible($data['chipsetCompatible']);
		}
	}

	public function getFrequence(): float {
		return $this->frequence;
	}
	public function setFrequence(float $frequence): self {
		$this->frequence = $frequence;
		return $this;
	}

	public function getNbCoeurs(): int {
		return $this->nbCoeurs;
	}
	public function setNbCoeurs(int $nbCoeurs): self {
		$this->nbCoeurs = $nbCoeurs;
		return $this;
	}

	public function getChipsetCompatible(): string {
		return $this->chipsetCompatible;
	}
	public function setChipsetCompatible(string $chipsetCompatible): self {
		$this->chipsetCompatible = $chipsetCompatible;
		return $this;
	}

	public function getMore(): string
	{
		return 'Frequence : '.$this->getFrequence().'Htz, Nombre de coeurs :'.$this->getNbCoeurs(). ', Chipset :'.$this->getChipsetCompatible();
	}
}
?>
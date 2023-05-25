<?php
namespace Model;
class Ecran extends Composant {
	protected float $taille;

	public function __construct(array $data = [])
	{
		parent::__construct($data);
		
		if (!empty($data['taille'])) {
			$this->setTaille($data['taille']);
		}

	}

	public function getTaille(): float {
		return $this->taille;
	}
	public function setTaille(float $taille): self {
		$this->taille = $taille;
		return $this;
	}

	public function getMore(): string
	{
		return 'Taille : '.$this->getTaille(). 'pouce';
	}
}
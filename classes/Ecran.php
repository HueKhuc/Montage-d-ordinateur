<?php
class Ecran extends Composant {
  protected float $taille;

	public function getTaille(): float {
		return $this->taille;
	}
	public function setTaille(float $taille): self {
		$this->taille = $taille;
		return $this;
	}
}
?>
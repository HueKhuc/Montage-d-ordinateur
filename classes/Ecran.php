<?php
class Ecran extends Composant {

  protected string $taille;

	public function getTaille(): string {
		return $this->taille;
	}
	public function setTaille(string $taille): self {
		$this->taille = $taille;
		return $this;
	}
}

?>
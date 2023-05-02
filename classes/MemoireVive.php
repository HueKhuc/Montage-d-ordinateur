<?php

class MemoireVive extends Composant {

  protected string $capacite;
  protected int $nbBarrettes;
  protected string $type;

	public function getCapacite(): string {
		return $this->capacite;
	}
	public function setCapacite(string $capacite): self {
		$this->capacite = $capacite;
		return $this;
	}

	public function getNbBarrettes(): int {
		return $this->nbBarrettes;
	}
	public function setNbBarrettes(int $nbBarrettes): self {
		$this->nbBarrettes = $nbBarrettes;
		return $this;
	}

	public function getType(): string {
		return $this->type;
	}
	public function setType(string $type): self {
		$this->type = $type;
		return $this;
	}
}

?>
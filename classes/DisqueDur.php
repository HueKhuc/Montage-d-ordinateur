<?php
class DisqueDur extends Composant {

  protected bool $ssd;
  protected int $capacite;

	public function getSsd(): bool {
		return $this->ssd;
	}
	public function setSsd(bool $ssd): self {
		$this->ssd = $ssd;
		return $this;
	}

	public function getCapacite(): int {
		return $this->capacite;
	}
	public function setCapacite(int $capacite): self {
		$this->capacite = $capacite;
		return $this;
	}
}

?>
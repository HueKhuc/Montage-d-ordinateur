<?php
class Modele {

  protected int $id;
  protected string $nom;
  protected int $quantite;
  protected bool $portable;
  protected string $dateAjout;
  
	public function getId(): int {
		return $this->id;
	}
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}

	public function getNom(): string {
		return $this->nom;
	}
	public function setNom(string $nom): self {
		$this->nom = $nom;
		return $this;
	}

	public function getQuantite(): int {
		return $this->quantite;
	}
	public function setQuantite(int $quantite): self {
		$this->quantite = $quantite;
		return $this;
	}

	public function getPortable(): bool {
		return $this->portable;
	}
	public function setPortable(bool $portable): self {
		$this->portable = $portable;
		return $this;
	}

	public function getDateAjout(): string {
		return $this->dateAjout;
	}
	public function setDateAjout(string $dateAjout): self {
		$this->dateAjout = $dateAjout;
		return $this;
	}
}

?>
<?php
class GestionStock {
    protected int $id;
    protected string $dte;
    protected string $nom;
    protected int $quantite;
    protected bool $entree;

	public function getId(): int {
		return $this->id;
	}
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}

	public function getDte(): string {
		return $this->dte;
	}
	public function setDte(string $dte): self {
		$this->dte = $dte;
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

	public function getEntree(): bool {
		return $this->entree;
	}
	public function setEntree(bool $entree): self {
		$this->entree = $entree;
		return $this;
	}
}
?>
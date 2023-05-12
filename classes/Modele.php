<?php
class Modele {
  protected int $Id_Modele;
  protected string $nom;
  protected int $quantite;
  protected bool $portable;
  protected string $dateAjout;
  protected int $Id_Utilisateur;
	protected float $prixModele = 0.0;
  
	public function getId(): int {
		return $this->Id_Modele;
	}
	public function setId(int $id): self {
		$this->Id_Modele = $id;
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

	public function getIdUtilisateur(): int {
		return $this->Id_Utilisateur;
	}
	public function setIdUtilisateur(int $Id_Utilisateur): self {
		$this->Id_Utilisateur = $Id_Utilisateur;
		return $this;
	}

	public function getPrixModele(): float {
		return $this->prixModele;
	}
	public function setPrixModele(float $prixModele): self {
		$this->prixModele = $prixModele;
		return $this;
	}
}
?>
<?php
namespace Model;
class Modele
{ 
	protected int $idModele;
	protected string $nom;
	protected int $quantite;
	protected bool $estPortable;
	protected string $dateAjoutModele;
	protected int $idUtilisateur; 
	protected float $prixModele = 0.0;
	protected bool $archivageModele = false;
	protected string $description;

	public function getIdModele(): int
	{
		return $this->idModele;
	}
	public function setIdModele(int $idModele): self
	{
		$this->idModele = $idModele;
		return $this;
	}

	public function getNom(): string
	{
		return $this->nom;
	}
	public function setNom(string $nom): self
	{
		$this->nom = $nom;
		return $this;
	}

	public function getQuantite(): int
	{
		return $this->quantite;
	}
	public function setQuantite(int $quantite): self
	{
		$this->quantite = $quantite;
		return $this;
	}

	public function getEstPortable(): bool
	{
		return $this->estPortable;
	}
	public function setPortable(bool $estPortable): self
	{
		$this->estPortable = $estPortable;
		return $this;
	}

	public function getDateAjoutModele(): string
	{
		return $this->dateAjoutModele;
	}
	public function setDateAjout(string $dateAjoutModele): self
	{
		$this->dateAjoutModele = $dateAjoutModele;
		return $this;
	}

	public function getIdUtilisateur(): int
	{
		return $this->idUtilisateur;
	}
	public function setIdUtilisateur(int $idUtilisateur): self
	{
		$this->idUtilisateur = $idUtilisateur;
		return $this;
	}

	public function getPrixModele(): float
	{
		return $this->prixModele;
	}
	public function setPrixModele(float $prixModele): self
	{
		$this->prixModele = $prixModele;
		return $this;
	}

	public function getArchivageModele(): bool {
		return $this->archivageModele;
	}
	public function setArchivageModele(bool $archivageModele): self {
		$this->archivageModele = $archivageModele;
		return $this;
	}

	public function getDescription(): string {
		return $this->description;
	}
	public function setDescription(string $description): self {
		$this->description = $description;
		return $this;
	}
}
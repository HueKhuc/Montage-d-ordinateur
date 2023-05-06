<?php
class Composant
{
	const CATEGORIES = [
		'alimentation' => 'Alimentation',
		'carte_mere' => 'Carte Mere',
		'disque_dur' => 'Disque dur',
		'memoire_vive' => 'Memoire vive',
		'carte_graphique' => 'Carte Graphique',
		'clavier' => 'Clavier',
		'ecran' => 'Ecran',
		'souris' => 'Souris',
		'processeur' => 'Processeur',
	];
	protected int $Id_Composant;
	protected string $nom;
	protected string $marque;
	protected string $categorie;
	protected float $prix;
	protected int $quantite;
	protected string $datAjout;
	protected bool $isLaptop = false;
	protected bool $archivage = false;

	public function getId(): int
	{
		return $this->Id_Composant;
	}
	public function setId(int $id): self
	{
		$this->Id_Composant = $id;
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

	public function getMarque(): string
	{
		return $this->marque;
	}
	public function setMarque(string $marque): self
	{
		$this->marque = $marque;
		return $this;
	}

	public function getCategorie(): string
	{
		return $this->categorie;
	}
	public function setCategorie(string $categorie): self
	{
		$this->categorie = $categorie;
		return $this;
	}

	public function getPrix(): float
	{
		return $this->prix;
	}
	public function setPrix(float $prix): self
	{
		$this->prix = $prix;
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

	public function getDatAjout(): string
	{
		return $this->datAjout;
	}
	public function setDatAjout(string $dateAjout): self
	{
		$this->datAjout = $dateAjout;
		return $this;
	}

	public function getIsLaptop(): bool
	{
		return $this->isLaptop;
	}
	public function setIsLaptop(bool $isLaptop): self
	{
		$this->isLaptop = $isLaptop;
		return $this;
	}

	public function getArchivage(): bool
	{
		return $this->archivage;
	}
	public function setArchivage(bool $archivage): self
	{
		$this->archivage = $archivage;
		return $this;
	}
}
?>
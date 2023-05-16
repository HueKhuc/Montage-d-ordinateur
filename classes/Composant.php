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
	const LIMITS = [
		'alimentation' => 1,
		'carte_mere' => 1,
		'disque_dur' => 4,
		'memoire_vive' => 4,
		'carte_graphique' => 2,
		'clavier' => 1,
		'ecran' => 3,
		'souris' => 1,
		'processeur' => 1,
	];
	protected int $idComposant = 0;
	protected string $nom = '';
	protected string $marque;
	protected string $categorie;
	protected float $prix = 0.0;
	protected int $quantite = 0;
	protected int $quantiteModele = 0;
	protected string $dateAjoutComposant;
	protected bool $estPortable = false;
	protected bool $archivage = false; 

	public function __construct(array $data = [])
	{
		if (!empty($data['idComposant'])) {
			$this->setIdComposant($data['idComposant']);
		}
		if (!empty($data['nom'])) {
			$this->setNom($data['nom']);
		}
		if (!empty($data['marque'])) {
			$this->setMarque($data['marque']);
		}
		if (!empty($data['categorie'])) {
			$this->setCategorie($data['categorie']);
		}
		if (!empty($data['prix'])) {
			$this->setPrix($data['prix']);
		}
		if (!empty($data['quantite'])) {
			$this->setQuantite($data['quantite']);
		}
		if (!empty($data['quantiteModele'])) {
			$this->setQuantiteModele($data['quantiteModele']);
		}
		if (!empty($data['dateAjoutComposant'])) {
			$this->setDateAjout($data['dateAjoutComposant']);
		}
		if (!empty($data['estPortable'])) {
			$this->setEstPortable($data['estPortable']);
		}
		if (!empty($data['archivage'])) {
			$this->setArchivage($data['archivage']);
		}
	}

	public function getIdComposant(): int
	{
		return $this->idComposant;
	}
	public function setIdComposant(int $idComposant): self
	{
		$this->idComposant = $idComposant;
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

	public function getDateAjout(): string
	{
		return $this->dateAjoutComposant;
	}
	public function setDateAjout(string $dateAjoutComposant): self
	{
		$this->dateAjoutComposant = $dateAjoutComposant;
		return $this;
	}

	public function getEstPortable(): bool
	{
		return $this->estPortable;
	}
	public function setEstPortable(bool $estPortable): self
	{
		$this->estPortable = $estPortable;
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

	public function getQuantiteModele(): int
	{
		return $this->quantiteModele;
	}
	public function setQuantiteModele(int $quantiteModele): self
	{
		$this->quantiteModele = $quantiteModele;
		return $this;
	}

	public function getMore(): string
	{
		return '';
	}
}
?>
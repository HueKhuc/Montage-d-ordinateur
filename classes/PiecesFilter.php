<?php
class PiecesFilter 
{
	protected string $quantite = '';
	protected string $marque = '';
	protected float $prixmin = 0;
	protected float $prixmax = 0;
	protected string $categorie = '';
  protected bool $isLaptop;
  protected array $composants = [];

	public function __construct(array $postdata, array $composants) {
		$this->composants = $composants;
		if (!empty($postdata['quantite'])) {
			$this->setMarque(trim($postdata['quantite']));
		}
    if (!empty($postdata['marque'])) {
			$this->setMarque(trim($postdata['marque']));
		}
    if (!empty($postdata['prixmin'])) {
			$this->setMarque(trim($postdata['prixmin']));
		}
    if (!empty($postdata['prixmax'])) {
			$this->setMarque(trim($postdata['prixmax']));
		}
    if (!empty($postdata['categorie'])) {
			$this->setMarque(trim($postdata['categorie']));
		}
    if (!empty($postdata['islaptop'])) {
			$this->setMarque(trim($postdata['islaptop']));
		}
	}

	public function getQuantite(): string {
		return $this->quantite;
	}
	public function setQuantite(string $quantite): self {
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($quantite): bool {
			return $quantite == $composant->getMarque();
		});
		$this->quantite = $quantite;
		return $this;
	}
  
  public function getMarque(): string {
		return $this->marque;
	}
	public function setMarque(string $marque): self {
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($marque): bool {
			return $marque == $composant->getMarque();
		});
		$this->marque = $marque;
		return $this;
	}

  public function getPrixmin(): float {
		return $this->prixmin;
	}
	public function setPrixmin(float $prixmin): self {
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($prixmin) {
			return $composant->getPrix() >= $prixmin;
		});
		$this->prixmin = $prixmin;
		return $this;
	}

  public function getPrixmax(): float {
		return $this->prixmin;
	}
	public function setPrixmax(float $prixmax): self {
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($prixmax) {
			return $composant->getPrix() <= $prixmax;
		});
		$this->prixmax = $prixmax;
		return $this;
	}

  public function getCategorie(): string {
		return $this->categorie;
	}
	public function setCategorie(string $categorie): self {
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($categorie): bool {
			return $categorie == $composant->getCategorie();
		});
		$this->categorie = $categorie;
		return $this;
	}

  public function getIsLaptop(): bool {
		return $this->isLaptop;
	}
	public function setIsLaptop(bool $isLaptop): self {
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($isLaptop): bool {
			return $isLaptop == $composant->getIsLaptop();
		});
		$this->isLaptop = $isLaptop;
		return $this;
	}
}
?>
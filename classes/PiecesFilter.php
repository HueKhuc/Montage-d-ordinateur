<?php
class PiecesFilter
{
	protected int $quantite = 1;
	protected string $marque = '';
	protected float $prixmin = 0;
	protected float $prixmax = 0;
	protected string $categorie = '';
	protected bool $isLaptop = false;
	protected array $composants = [];
	protected int $Id_Composant = 0;

	public function __construct(array $postdata, array $composants)
	{
		$this->composants = $composants;
		if (!empty($postdata) && !isset($postdata['quantite'])) {
			$this->setQuantite(0);
		} else {
			$this->setQuantite(1);
		}
		if (!empty($postdata['marque'])) {
			$this->setMarque(trim($postdata['marque']));
		}
		if (!empty($postdata['prixmin'])) {
			$this->setPrixmin(trim($postdata['prixmin']));
		}
		if (!empty($postdata['prixmax'])) {
			$this->setPrixmax(trim($postdata['prixmax']));
		}
		if (!empty($postdata['categorie'])) {
			$this->setCategorie(trim($postdata['categorie']));
		}
		if (!empty($postdata['islaptop'])) {
			$this->setIsLaptop($postdata['islaptop']);
		}
		if (!empty($postdata['id'])) {
			$this->setId($postdata['id']);
		}
	}

	public function getQuantite(): int
	{
		return $this->quantite;
	}
	public function setQuantite(int $quantite): self
	{
		if ($quantite > 0) {
			$this->composants = array_filter($this->composants, function (Composant $composant): bool {
				return $composant->getQuantite() > 0;
			});
		}
		$this->quantite = $quantite;
		return $this;
	}

	public function getMarque(): string
	{
		return $this->marque;
	}
	public function setMarque(string $marque): self
	{
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($marque): bool {
			return $marque == $composant->getMarque();
		});
		$this->marque = $marque;
		return $this;
	}

	public function getPrixmin(): float
	{
		return $this->prixmin;
	}
	public function setPrixmin(float $prixmin): self
	{
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($prixmin) {
			return $composant->getPrix() >= $prixmin;
		});
		$this->prixmin = $prixmin;
		return $this;
	}

	public function getPrixmax(): float
	{
		return $this->prixmax;
	}
	public function setPrixmax(float $prixmax): self
	{
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($prixmax) {
			return $composant->getPrix() <= $prixmax;
		});
		$this->prixmax = $prixmax;
		return $this;
	}

	public function getCategorie(): string
	{
		return $this->categorie;
	}
	public function setCategorie(string $categorie): self
	{
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($categorie): bool {
			return $categorie == $composant->getCategorie();
		});
		$this->categorie = $categorie;
		return $this;
	}

	public function getIsLaptop(): bool
	{
		return $this->isLaptop;
	}
	public function setIsLaptop(bool $isLaptop): self
	{
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($isLaptop): bool {
			return $isLaptop == $composant->getIsLaptop();
		});
		$this->isLaptop = $isLaptop;
		return $this;
	}

	public function getComposants(): array
	{
		return $this->composants;
	}

	public function getId(): int
	{
		return $this->Id_Composant;
	}

	public function setId(int $Id_Composant): self
	{
		$this->composants = array_filter($this->composants, function (Composant $composant) use ($Id_Composant): bool {
			return $Id_Composant == $composant->getId();
		});
		$this->Id_Composant = $Id_Composant;
		return $this;
	}

}
?>
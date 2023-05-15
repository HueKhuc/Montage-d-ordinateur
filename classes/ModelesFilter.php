<?php
class ModelesFilter
{
	protected bool $nonLus = false;
	protected float $prixmin = 0;
	protected float $prixmax = 0;
	protected bool $estPortable = false;
	protected array $modeles = [];

	public function __construct(array $postdata, array $modeles)
	{
		$this->modeles = $modeles;

		if (!empty($postdata['prixmin'])) {
			$this->setPrixmin(trim($postdata['prixmin']));
		}
		if (!empty($postdata['prixmax'])) {
			$this->setPrixmax(trim($postdata['prixmax']));
		}
		if (!empty($postdata['nonLus'])) {
			$this->setNonLus($postdata['nonLus']);
		}
		if (!empty($postdata['estPortable'])) {
			$this->setEstPortable($postdata['estPortable']);
		}
	}

	public function getNonLus(): bool
	{
		return $this->nonLus;
	}
	public function setNonLus(bool $nonLus): self
	{
		$this->nonLus = $nonLus;
		return $this;
	}

	public function getPrixmin(): float
	{
		return $this->prixmin;
	}
	public function setPrixmin(float $prixmin): self
	{
		$this->modeles = array_filter($this->modeles, function (Modele $modele) use ($prixmin) {
			return $modele->getPrixModele() >= $prixmin;
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
		$this->modeles = array_filter($this->modeles, function (Modele $modele) use ($prixmax) {
			return $modele->getPrixModele() <= $prixmax;
		});
		$this->prixmax = $prixmax;
		return $this;
	}

	public function getEstPortable(): bool
	{
		return $this->estPortable;
	}
	public function setEstPortable(bool $estPortable): self
	{
		$this->modeles = array_filter($this->modeles, function (Modele $modele) use ($estPortable): bool {
			return $estPortable == $modele->getEstPortable();
		});
		$this->estPortable = $estPortable;
		return $this;
	}

	public function getModeles(): array
	{
		return $this->modeles;
	}
	public function setModeles(array $modeles): self
	{
		$this->modeles = $modeles;
		return $this;
	}
}
?>
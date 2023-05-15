<?php
class Stock
{
	protected int $idStock;
	protected string $dateEntree;
	protected string $nom;
	protected int $quantite;
	protected bool $entree;

	public function getIdStock(): int
	{
		return $this->idStock;
	}
	public function setIdStock(int $idStock): self
	{
		$this->idStock = $idStock;
		return $this;
	}

	public function getDateEntree(): string
	{
		return $this->dateEntree;
	}
	public function setDateEntree(string $dateEntree): self
	{
		$this->dateEntree = $dateEntree;
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

	public function getEntree(): bool
	{
		return $this->entree;
	}
	public function setEntree(bool $entree): self
	{
		$this->entree = $entree;
		return $this;
	}
}
?>
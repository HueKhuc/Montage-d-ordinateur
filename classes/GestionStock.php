<?php
class GestionStock
{
    protected int $id;
    protected string $dte;
    protected string $nom;
    protected int $quantite;
    protected bool $entree;


	/**
	 * @return int
	 */
	public function getIdGestionStock(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDte(): string {
		return $this->dte;
	}

	/**
	 * @param string $dte 
	 * @return self
	 */
	public function setDte(string $dte): self {
		$this->dte = $dte;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getNom(): string {
		return $this->nom;
	}

	/**
	 * @param string $nom 
	 * @return self
	 */
	public function setNom(string $nom): self {
		$this->nom = $nom;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getQuantite(): int {
		return $this->quantite;
	}

	/**
	 * @param int $quantite 
	 * @return self
	 */
	public function setQuantite(int $quantite): self {
		$this->quantite = $quantite;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getEntree(): bool {
		return $this->entree;
	}

	/**
	 * @param bool $entree 
	 * @return self
	 */
	public function setEntree(bool $entree): self {
		$this->entree = $entree;
		return $this;
	}
}
?>
<?php
class Clavier extends Composant
{
	protected bool $sansFil;
	protected bool $paveNumerique;
	protected string $typeTouche;
	public function getTypeTouche(): string
	{
		return $this->typeTouche;
	}
	public function setTypeTouche(string $typeTouche): self
	{
		$this->typeTouche = $typeTouche;
		return $this;
	}
	public function getPaveNumerique(): bool
	{
		return $this->paveNumerique;
	}

	public function setPaveNumerique(bool $paveNumerique): self
	{
		$this->paveNumerique = $paveNumerique;
		return $this;
	}

	public function getSansFil(): bool
	{
		return $this->sansFil;
	}

	public function setSansFil(bool $sansFil): self
	{
		$this->sansFil = $sansFil;
		return $this;
	}
}
?>
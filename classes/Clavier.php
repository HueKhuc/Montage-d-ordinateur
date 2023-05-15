<?php
class Clavier extends Composant
{
	protected bool $clavierSansFil = false;
	protected bool $paveNumerique = false;
	protected string $typeTouche;

	public function __construct(array $data = [])
	{
		parent::__construct($data);
		if (!empty($data['clavierSansFil'])) {
			$this->setSansFil($data['clavierSansFil']);
		}
		if (!empty($data['paveNumerique'])) {
			$this->setPaveNumerique($data['paveNumerique']);
		}
		if (!empty($data['typeTouche'])) {
			$this->setTypeTouche($data['typeTouche']);
		}
	}
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
		return $this->clavierSansFil;
	}

	public function setSansFil(bool $sansFil): self
	{
		$this->clavierSansFil = $sansFil;
		return $this;
	}

	public function getMore(): string
	{
		return 'Type touche : ' . $this->getTypeTouche() . ', Sans Fil : ' . ($this->getSansFil() ? 'oui' : 'non') . ', Pave Num : ' . ($this->getPaveNumerique() ? 'oui' : 'non');
	}
}
?>
<?php
class Souris extends Composant {
    protected bool $sansFilSouris = false;
    protected int $nbTouche;

    public function __construct(array $data = [])
	{
		parent::__construct($data);
		
		if (!empty($data['nbTouche'])) {
			$this->setNbTouche($data['nbTouche']);
		}
		if (!empty($data['sansFilSouris'])) {
			$this->setSansFil($data['sansFilSouris']);
		}

	}

    public function getSansFil(): bool
    {
        return $this->sansFilSouris;
    }
    public function setSansFil(bool $sansFil): self
    {
        $this->sansFilSouris = $sansFil;
        return $this;
    }

    public function getNbTouche(): int
    {
        return $this->nbTouche;
    }
    public function setNbTouche(int $nbTouche): self
    {
        $this->nbTouche = $nbTouche;
        return $this;
    }

    public function getMore(): string
	{
		return 'Nb de touche : '.$this->getNbTouche().', Sans Fil : '.($this->getSansFil() ? 'oui':'non');
	}
}
?>
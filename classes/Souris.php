<?php
class Souris extends Composant {
    protected bool $sansFil;
    protected int $nbTouche;

    public function getSansFil(): bool
    {
        return $this->sansFil;
    }
    public function setSansFil(bool $sansFil): self
    {
        $this->sansFil = $sansFil;
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
}
?>
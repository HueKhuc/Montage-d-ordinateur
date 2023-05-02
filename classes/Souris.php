<?php
class Souris extends Composant
{
    protected bool $sansFil;
    protected int $nbTouche;

    /**
     * @return bool
     */
    public function getSansFil(): bool
    {
        return $this->sansFil;
    }

    /**
     * @param bool $sansFil 
     * @return self
     */
    public function setSansFil(bool $sansFil): self
    {
        $this->sansFil = $sansFil;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbTouche(): int
    {
        return $this->nbTouche;
    }

    /**
     * @param int $nbTouche 
     * @return self
     */
    public function setNbTouche(int $nbTouche): self
    {
        $this->nbTouche = $nbTouche;
        return $this;
    }
}
?>
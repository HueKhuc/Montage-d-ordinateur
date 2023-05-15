<?php
class Souris extends Composant
{
    protected bool $sourisSansFil = false;
    protected int $nbTouches;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (!empty($data['nbTouches'])) {
            $this->setnbTouches($data['nbTouches']);
        }
        if (!empty($data['sourisSansFil'])) {
            $this->setSansFil($data['sourisSansFil']);
        }

    }

    public function getSansFil(): bool
    {
        return $this->sourisSansFil;
    }
    public function setSansFil(bool $sourisSansFil): self
    {
        $this->sourisSansFil = $sourisSansFil;
        return $this;
    }

    public function getnbTouches(): int
    {
        return $this->nbTouches;
    }
    public function setnbTouches(int $nbTouches): self
    {
        $this->nbTouches = $nbTouches;
        return $this;
    }

    public function getMore(): string
    {
        return 'Nb de touche : ' . $this->getnbTouches() . ', Sans Fil : ' . ($this->getSansFil() ? 'oui' : 'non');
    }
}
?>
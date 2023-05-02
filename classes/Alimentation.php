<?php
class Alimentation extends Composant {
    protected float $puissance;

    public function getPuissance(): float
    {
        return $this->puissance;
    }

    public function setPuissance(float $puissance): self
    {
        $this->puissance = $puissance;
        return $this;
    }
}
?>
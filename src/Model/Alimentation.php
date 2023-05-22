<?php
namespace Model;
class Alimentation extends Composant {
    protected float $puissance;

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (!empty($data['puissance'])) {
            $this->setPuissance($data['puissance']);
        }
    }

    public function getPuissance(): float
    {
        return $this->puissance;
    }

    public function setPuissance(float $puissance): self
    {
        $this->puissance = $puissance;
        return $this;
    }
	public function getMore(): string
	{
		return 'Puissance : '.$this->getPuissance().'W';
	}
}
?>
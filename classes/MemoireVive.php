<?php
class MemoireVive extends Composant {
	protected string $capaciteMemoireVive;
	protected int $nbBarrettes;
	protected string $type;

	public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (!empty($data['capaciteMemoireVive'])) {
            $this->setCapaciteMemoireVive($data['capaciteMemoireVive']);
        }
		if (!empty($data['nbBarrettes'])) {
            $this->setNbBarrettes($data['nbBarrettes']);
        }
		if (!empty($data['type'])) {
            $this->setType($data['type']);
        }
    }

	public function getCapaciteMemoireVive(): string {
		return $this->capaciteMemoireVive;
	}
	public function setCapaciteMemoireVive(string $capaciteMemoireVive): self {
		$this->capaciteMemoireVive = $capaciteMemoireVive;
		return $this;
	}

	public function getNbBarrettes(): int {
		return $this->nbBarrettes;
	}
	public function setNbBarrettes(int $nbBarrettes): self {
		$this->nbBarrettes = $nbBarrettes;
		return $this;
	}

	public function getType(): string {
		return $this->type;
	}
	public function setType(string $type): self {
		$this->type = $type;
		return $this;
	}

	public function getMore(): string
	{
		return 'Capacite : '.$this->getCapaciteMemoireVive().', NbBarrette : '.$this->getNbBarrettes().', Type : '.$this->getType();
		
	}
}
?>
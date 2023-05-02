<?php
class Commentaire {
	protected int $id;
    protected string $texte;
    protected string $dateMess;

	public function getTexte(): string {
		return $this->texte;
	}
	public function setTexte(string $texte): self {
		$this->texte = $texte;
		return $this;
	}

	public function getDateMess(): string {
		return $this->dateMess;
	}
	public function setDateMess(string $dateMess): self {
		$this->dateMess = $dateMess;
		return $this;
	}

	public function getId(): int {
		return $this->id;
	}
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
}
?>
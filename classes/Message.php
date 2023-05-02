<?php
class Commentaire
{
	protected int $id;
    protected string $texte;
    protected string $dateMess;

	/**
	 * @return string
	 */
	public function getTexte(): string {
		return $this->texte;
	}
	
	/**
	 * @param string $texte 
	 * @return self
	 */
	public function setTexte(string $texte): self {
		$this->texte = $texte;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDateMess(): string {
		return $this->dateMess;
	}
	
	/**
	 * @param string $dateMess 
	 * @return self
	 */
	public function setDateMess(string $dateMess): self {
		$this->dateMess = $dateMess;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id 
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
}
?>
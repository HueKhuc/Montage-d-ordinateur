<?php
class Message {
	protected int $id;
    protected string $texte;
    protected string $dateMess;

	protected bool $lu;

	protected ?string $userName = null;

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

	/**
	 * @return 
	 */
	public function getLu(): bool {
		return $this->lu;
	}
	
	/**
	 * @param  $lu 
	 * @return self
	 */
	public function setLu(bool $lu): self {
		$this->lu = $lu;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getUserName(): ?string {
		return $this->userName;
	}
	
	/**
	 * @param  $userName 
	 * @return self
	 */
	public function setUserName(?string $userName): self {
		$this->userName = $userName;
		return $this;
	}
}
?>
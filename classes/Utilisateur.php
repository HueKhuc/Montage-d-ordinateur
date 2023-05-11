<?php 

class Utilisateur 

{
    protected int $Id_Utilisateur;

    protected string $password;

    protected string $nom;

	/**
	 * @return 
	 */
	public function getId_Utilisateur(): int {
		return $this->Id_Utilisateur;
	}
	
	/**
	 * @param  $Id_Utilisateur 
	 * @return self
	 */
	public function setId_Utilisateur(int $Id_Utilisateur): self {
		$this->Id_Utilisateur = $Id_Utilisateur;
		return $this;
	}


    

	/**
	 * @return 
	 */
	public function getPassword(): string {
		return $this->password;
	}
	
	/**
	 * @param  $password 
	 * @return self
	 */
	public function setPassword(string $password): self {
		$this->password = $password;
		return $this;
	}

    

	/**
	 * @return 
	 */
	public function getNom(): string {
		return $this->nom;
	}
	
	/**
	 * @param  $nom 
	 * @return self
	 */
	public function setNom(string $nom): self {
		$this->nom = $nom;
		return $this;
	}
}
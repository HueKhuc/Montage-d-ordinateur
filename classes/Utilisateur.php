<?php
class Utilisateur
{
	protected int $idUtilisateur;

	protected string $motDePasse;

	protected string $nom;

	public function getIdUtilisateur(): int
	{
		return $this->idUtilisateur;
	}
	public function setIdUtilisateur(int $idUtilisateur): self
	{
		$this->idUtilisateur = $idUtilisateur;
		return $this;
	}

	public function getmotDePasse(): string
	{
		return $this->motDePasse;
	}
	public function setmotDePasse(string $motDePasse): self
	{
		$this->motDePasse = $motDePasse;
		return $this;
	}

	public function getNom(): string
	{
		return $this->nom;
	}
	public function setNom(string $nom): self
	{
		$this->nom = $nom;
		return $this;
	}
}
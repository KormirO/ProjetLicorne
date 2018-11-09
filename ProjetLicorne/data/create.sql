CREATE TABLE produit (
	reference INTEGER PRIMARY KEY,
	intitule TEXT,
  informations TEXT,
	categorie INTEGER,
	prix REAL,
	image TEXT,
	FOREIGN KEY(categorie) REFERENCES categorie(numero)
);


CREATE TABLE categorie (
	numero INTEGER PRIMARY KEY,
	nom TEXT,
	parent INTEGER,
	FOREIGN KEY(parent) REFERENCES categorie(numero)
);

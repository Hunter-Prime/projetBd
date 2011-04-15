create table Utilisateurs
	(identifiant int NOT NULL AUTO_INCREMENT,
	pseudo varchar(15) NOT NULL,
	motdepasse varchar(15) NOT NULL,
	admin varchar(3) NOT NULL,
	primary key (identifiant)
	);
	
create table Clients
	(identifiant int NOT NULL,
	nom varchar(30) NOT NULL,
	prenom varchar(30) NOT NULL,
	adresse varchar(30) NOT NULL,
	ville varchar(20) NOT NULL,
	codepostal int NOT NULL,
	mail varchar(30) NOT NULL,
	primary key (identifiant),
	CONSTRAINT Clients_identifiant FOREIGN KEY (identifiant) REFERENCES Utilisateurs(identifiant)
	);
	
create table Produits 
	(reference int NOT NULL,
	nomproduit varchar(30) NOT NULL,
	prix int NOT NULL,
	qterestante int NOT NULL,
	datededispo date NOT NULL,
	primary key (reference)
	);
	
create table Commandes
	(identifiant int NOT NULL,
	reference int NOT NULL,
	datecommande date NOT NULL,
	datelivraison date NOT NULL,
	primary key (identifiant,reference),
	CONSTRAINT Comm_identifiant FOREIGN KEY (identifiant) REFERENCES Clients(identifiant),
	CONSTRAINT Comm_reference FOREIGN KEY (reference) REFERENCES Produits(reference)
	);
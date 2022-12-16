
DROP TABLE CB;
DROP TABLE Clients;
DROP TABLE Commenter;
DROP TABLE Contenir;
DROP TABLE Produits;
DROP TABLE Commandes;
DROP TABLE Constituer;

CREATE TABLE Clients (
    idClient DECIMAL(5),
    Nom VARCHAR(32),
    Prenom VARCHAR(32),
    Telephone DECIMAL(10),
    Mail VARCHAR(32),
    NumRue DECIMAL(5),
    NomRue VARCHAR(32),
    CdPost VARCHAR(10),
    Ville VARCHAR(32),
    Username VARCHAR(32),
    Password VARCHAR(64),
    isAdmin CHAR(1),
    CONSTRAINT pk_clients_idclients PRIMARY KEY idClient,
    CONSTRAINT ck_isAdmin CHECK (isAdmin IN ('O', 'N'))    
);

CREATE TABLE CB (
    idCB DECIMAL(5),
    NumCB DECIMAL(16),
    Nom VARCHAR(32),
    Prenom VARCHAR(32),
    idClient DECIMAL(5),
    CONSTRAINT pk_cb_idcb PRIMARY KEY idCB,
    CONSTRAINT fk_cb_clients FOREIGN KEY (idClient) REFERENCES Clients(idClient) 
);

CREATE TABLE Produits (
    RefProduit VARCHAR(10),
    Prix DECIMAL(12,2),
    Description VARCHAR(256),
    Dimension VARCHAR(10),
    Poids VARCHAR(10),
    Vitesse VARCHAR(10),
    Coloris VARCHAR(10),
    isAccessoire CHAR(1),
    CONSTRAINT pk_produits_refproduit PRIMARY KEY RefProduit,
    CONSTRAINT ck_produits_isaccessoire CHECK (isAccessoire IN ('O', 'N'))
);

CREATE TABLE Commenter (
    idAvis DECIMAL(5),
    Texte VARCHAR(256),
    Note DECIMAL(5),
    Date DATE,
    idClient DECIMAL(5),
    RefProduit VARCHAR(10),
    CONSTRAINT pk_commenter_idavis PRIMARY KEY idAvis,
    CONSTRAINT ck_commenter_note CHECK (Note <= 10 AND Note >= 0),
    CONSTRAINT fk_commenter_clients FOREIGN KEY (idClient) REFERENCES Clients(idClient),
    CONSTRAINT fk_commenter_produits FOREIGN KEY (RefProduit) REFERENCES Produits(RefProduit)
);

CREATE TABLE Contenir (
    idClient DECIMAL(5),
    RefProduit VARCHAR(10),
    Quantite DECIMAL(5),
    CONSTRAINT pk_contenir_idclient_refproduit PRIMARY KEY (idClient, RefProduit),
    CONSTRAINT fk_contenir_clients FOREIGN KEY (idClient) REFERENCES Clients(idClient),
    CONSTRAINT fk_contenir_produits FOREIGN KEY (RefProduit) REFERENCES Produits(RefProduit)
);

CREATE TABLE Commandes (
    RefCommande VARCHAR(10),
    NumRue DECIMAL(5),
    NomRue VARCHAR(32),
    CdPost VARCHAR(10),
    Ville VARCHAR(32),
    idClient DECIMAL(5),
    CONSTRAINT pk_commandes_refcommande PRIMARY KEY RefCommande,
    CONSTRAINT fk_commandes_clients FOREIGN KEY (idClient) REFERENCES Clients(idClient)
);

CREATE TABLE Constituer (
    RefCommande VARCHAR(10),
    RefProduit VARCHAR(10),
    Quantite DECIMAL(5),
    CONSTRAINT pk_constituer_refcommande_refproduit PRIMARY KEY (RefCommande, RefProduit),
    CONSTRAINT fk_constituer_produits FOREIGN KEY (RefProduit) REFERENCES Produits(RefProduit),
    CONSTRAINT fk_contenir_commandes FOREIGN KEY (RefCommande) REFERENCES Commandes(RefCommande)
);
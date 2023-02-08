CREATE DATABASE takalo;
USE TAKALO;

CREATE TABLE utilisateur(
    idutilisateur INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    numero VARCHAR(255),
    email VARCHAR(255),
    motdepasse VARCHAR(255),
    estadmin INTEGER DEFAULT 0
);

CREATE TABLE categorie(
    idcategorie INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255)
);

CREATE TABLE objet(
    idobjet INTEGER PRIMARY KEY AUTO_INCREMENT,
    idcategorie INTEGER,
    idutilisateur INTEGER,
    designation VARCHAR(255),
    prixestimatif FLOAT,
    FOREIGN KEY (idcategorie) REFERENCES categorie (idcategorie),
    FOREIGN KEY (idutilisateur) REFERENCES utilisateur (idutilisateur)
);

CREATE TABLE photo(
    idphoto INTEGER PRIMARY KEY AUTO_INCREMENT,
    idobjet INTEGER,
    nomphoto VARCHAR(255),
    FOREIGN KEY (idobjet) REFERENCES utilisateur (idobjet)
);



CREATE TABLE echange(
    idechange INTEGER PRIMARY KEY AUTO_INCREMENT,
    iddemande INTEGER,
    idreceveur INTEGER,
    idobjet INTEGER,
    idobjet2 INTEGER,
    dateechange DATE,
    dateacceptation DATE,
    etat INTEGER DEFAULT 0,
    FOREIGN KEY (iddemande) REFERENCES utilisateur (idutilisateur),
    FOREIGN KEY (idreceveur) REFERENCES utilisateur (idutilisateur),
    FOREIGN KEY (idobjet) REFERENCES objet (idobjet)
);

INSERT INTO utilisateur (nom,prenom,numero,email,motdepasse,estadmin) VALUES ('RASOLOFOMANANA','Kanty','0348764436','kanty@gmail.com','1234',10);
INSERT INTO utilisateur (nom,prenom,numero,email,motdepasse) VALUES ('RABEARISOA','Sedera','0343914184','sedera@gmail.com','1234');
INSERT INTO utilisateur (nom,prenom,numero,email,motdepasse) VALUES ('RAKOTO','Fabien','0342367546','fabien@gmail.com','1234');
INSERT INTO utilisateur (nom,prenom,numero,email,motdepasse) VALUES ('RANDRIARIMALALA','Anthony','0346186543','tony@gmail.com','1111');

INSERT INTO categorie (nom) VALUES ('electronique');
INSERT INTO categorie (nom) VALUES ('textile');
INSERT INTO categorie (nom) VALUES ('menager');

INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (1,2,'Kiraro',30000);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (2,3,'poele',25000);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (3,3,'aspirateur',21750);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (1,3,'radio',15000);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (2,3,'sotro-be',1500);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (3,2,'cocombre',30000);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (1,2,'Bicyclette',30000);
INSERT INTO objet (idcategorie,idutilisateur,designation,prixestimatif) VALUES (2,3,'verre',175000);

INSERT into photo (idobjet,nomphoto) values (1,'kiraro.png');
INSERT into photo (idobjet,nomphoto) values (2,'poele.png');
INSERT into photo (idobjet,nomphoto) values (3,'aspirateur.png');
INSERT into photo (idobjet,nomphoto) values (4,'radio.png');
INSERT into photo (idobjet,nomphoto) values (5,'sotro.png');
INSERT into photo (idobjet,nomphoto) values (6,'cocombre.png');
INSERT into photo (idobjet,nomphoto) values (7,'bicyclette.png');
INSERT into photo (idobjet,nomphoto) values (8,'verre.png');

CREATE VIEW v_objet AS
SELECT utilisateur.idutilisateur,utilisateur.prenom,categorie.nom,objet.idobjet,objet.designation,objet.prixestimatif,photo.nomphoto FROM objet
JOIN utilisateur ON objet.idutilisateur=utilisateur.idutilisateur
JOIN categorie ON objet.idcategorie=categorie.idcategorie
JOIN photo ON objet.idobjet=photo.idobjet;

CREATE VIEW V_Demande AS
    SELECT e.idechange , e.idreceveur,e.iddemande as idutilisateur, e.etat, e.dateechange, u.nom, u.prenom, e.idobjet, o.designation, o.prixestimatif, p.nomphoto 
        FROM echange e
            JOIN objet o
                ON o.idobjet = e.idobjet
            JOIN utilisateur u
                ON u.idUtilisateur = e.iddemande
            JOIN photo p
                ON p.idobjet = e.idobjet;

CREATE VIEW V_Demande2 AS
    SELECT e.idobjet2, o1.designation designation2 ,e.idechange , e.idreceveur,e.iddemande as idutilisateur, e.etat, e.dateechange, u.nom, u.prenom, e.idobjet, o.designation, o.prixestimatif, p.nomphoto 
        FROM echange e
            JOIN objet o
                ON o.idobjet = e.idobjet
            JOIN objet o1
                ON o1.idObjet = e.idobjet2
            JOIN utilisateur u
                ON u.idUtilisateur = e.iddemande
            JOIN photo p
                ON p.idobjet = e.idobjet;

CREATE TABLE HISTORIQUE(
    idHistorique int PRIMARY KEY AUTO_INCREMENT,
    idObjet int,
    idUtilisateur int,
    dateAppartenance date
);
 CREATE VIEW HistoriqueByUser AS
            SELECT h.idobjet, o.designation , h.idutilisateur, u.nom, u.prenom, h.dateAppartenance 
                FROM HISTORIQUE h
                    JOIN utilisateur u
                        ON h.idutilisateur = u.idutilisateur
                    JOIN objet o
                        ON o.idobjet = h.idobjet
;

 create view v_objet_objet as 
 select objet.*,photo.idphoto,photo.nomphoto from objet 
 join photo on objet.idobjet=photo.idobjet;

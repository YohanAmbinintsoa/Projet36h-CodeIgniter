CREATE DATABASE takalo;
use takalo;

CREATE TABLE user(
    idUser int primary key auto_increment,
    nom varchar(50),
    mail varchar(50),
    pass varchar(50),
    isAdmin int
);

INSERT INTO user values(NULL,'admin','admin@gmail.com','admin',1);

CREATE TABLE categorie(
    idCat int primary key auto_increment,
    nom varchar(50)
);

insert into categorie values(NULL,'Vetement');
insert into categorie values  (NULL,'Livre');
 insert into categorie values(NULL,'CD');
insert into categorie values(NULL,'Vehicule');
insert into categorie values(NULL,'Montre');
insert into categorie values(NULL,'Informatique');
                           

CREATE TABLE entana(
    idEntana int primary key auto_increment,
    nom varchar(50),
    description text,
    prix float,
    idUser int,
    foreign key (idUser) references user(idUser)
);

CREATE TABLE EntanaCategorie(
    idEntanaCategorie int primary key auto_increment,
    idCat int,
    idEntana int,
    foreign key (idCat) references categorie(idCat),
    foreign key (idEntana) references entana(idEntana)
);

CREATE TABLE sary(
    idSary int primary key auto_increment,
    path varchar(50),
    idEntana int,
    foreign key (idEntana) references entana(idEntana)
);

CREATE TABLE echange(
    idEchange int primary key auto_increment,
    idEntana1 int,
    idEntana2 int,
    etat int,
    dateAcceptation TIMESTAMP,
    foreign key (idEntana1) references entana(idEntana),
    foreign key (idEntana2) references entana(idEntana)
);

create table historique(
    idHistorique int primary key auto_increment,
    idEntana int,
    idUser int,
    dateAcceptation TIMESTAMP,
    foreign key (idEntana) references entana(idEntana),
    foreign key (idUser) references user(idUser)
);


select idEchange,idEntana1,e1.nom as nom1,e1.idUser,u1.nom,idEntana2,e2.nom as nom2,u2.nom,u2.idUser,dateAcceptation,etat from echange 
inner join entana e1 on echange.idEntana1=e1.idEntana inner join entana e2 on echange.idEntana2=e2.idEntana
left outer join user u1 on e1.idUser=u1.idUser left OUTER JOIN user u2 on e2.idUser=u2.idUser where e2.idUser=2;

select idEchange,e1.nom as nom1,e1.idUser,u1.nom,e2.nom as nom2,u2.nom,u2.idUser from echange 
inner join entana e1 on echange.idEntana1=e1.idEntana inner join entana e2 on echange.idEntana2=e2.idEntana
inner JOIN user u1 on e1.idUser=u1.idUser inner JOIN user u2 on e2.idUser=u2.idUser;
drop database if exists progetto2;
create database progetto2;
use progetto2;

CREATE TABLE Medico (
CF char(10) PRIMARY KEY,
cognome varchar(50),
nome varchar(50),
eta integer, 
genere char(1),
chirurgo boolean,
codice_reparto varchar(20),
foto varchar(20),
index idx_codicerep(codice_reparto)
) engine='innoDB';

CREATE TABLE Reparto(
codice varchar(20) PRIMARY KEY,
nome varchar(30),
n_medici integer,
n_postiletto integer,
CF_medico_direttore char(10),
index idx_cfmedicodirett(CF_medico_direttore)
) engine='innoDB';



insert into Medico values (‘JDKAKDMF10’, ‘Orso’, ‘Beatrice’, 31, ‘F’, true,’1’, ‘F1.JPG’);
insert into Medico values (‘JDKAKDMF20’, ‘Lupo’, ‘Antonio’, 36, ‘M’, true,’1’, ‘M1.JPG’);
insert into Medico values (‘JDKAKDMF30’, ‘Leone’, ‘Federico’, 67, ‘M’, false, ’2’, ‘M2.JPG’);
insert into Medico values (‘JDKAKDMF40’, ‘Tigre’, ‘Greta’, 36, ‘F’, false,’2’, ‘F2.JPG’);
insert into Medico values (‘JDKAKDMF50’, ‘Vespa’, ‘Giorgia’, 46, ‘F’, true,’3’,  ‘F3.JPG’);
insert into Medico values (‘JDKAKDMF60’, ‘Pappagallo’, ‘Diego’, 59, ‘M’, true,’3’, ‘M3.JPG’);
insert into Medico values (‘JDKAKDMF70’, ‘Gallo’, ‘Emma’, 47, ‘F’, true,’4’, ‘F4.JPG’);
insert into Medico values (‘JDKAKDMF80’, ‘Cavallo’, ‘Pietro’, 30, ‘M’, true,’4’, ‘M4.JPG’);
insert into Medico values (‘JDKAKDMF90’, ‘Geco’, ‘Ginevra’, 56, ‘F’, false,’5’, ‘F5.JPG’);
insert into Medico values (‘JDKAKDMF11’, ‘Riccio’, ‘Cristian’, 53, ‘M’, false,’5’, ‘M5.JPG’);

insert into Medico values (‘PCXOKFLE10’, ‘Bronzo’, ‘Carla’, 41, ‘F’, true, ’6’, ‘F6.JPG’);
insert into Medico values (‘PCXOKFLE20’, ‘Oro’, ‘Mario’, 62, ‘M’, false,’6’, ‘M6.JPG’);
insert into Medico values (‘PCXOKFLE30’, ‘Argento’, ‘Gianluca’, 29, ‘M’, true,’7’, ‘M7.JPG’);
insert into Medico values (‘PCXOKFLE40’, ‘Platino’, ‘Chiara’, 36, ‘F’, false,’7’, ‘F7.JPG’);
insert into Medico values (‘PCXOKFLE50’, ‘Rame’, ‘Francesca’, 53, ‘F’, true,’8’, ‘F8.JPG’);
insert into Medico values (‘PCXOKFLE60’, ‘Diamante’, ‘Giovanni’, 35, ‘M’, false,’8’, ‘M8.JPG’);

insert into Reparto values (‘1’, ‘Cardiologia’, 2, 4, ‘JDKAKDMF10’);
insert into Reparto values (‘2’, ‘Geriatria’, 2, 60, ‘JDKAKDMF30’);
insert into Reparto values (‘3’, ‘Nefrologia’, 2, 60, ‘JDKAKDMF50’);
insert into Reparto values (‘4’, ‘Ortopedia’, 2, 100, ‘JDKAKDMF70’);
insert into Reparto values (‘5’, ‘Pediatria’, 2, 60, ‘JDKAKDMF90’);

insert into Reparto values (‘6’, ‘Neurologia’, 2, 4, ‘PCXOKFLE20’);
insert into Reparto values (‘7’, ‘Radiologia’, 2, 4, ‘PCXOKFLE40’);
insert into Reparto values (‘8’, ‘Virologia’, 2, 4, ‘PCXOKFLE60’);

ALTER TABLE Medico add FOREIGN KEY(codice_reparto) REFERENCES Reparto(codice);
ALTER TABLE Reparto add FOREIGN KEY(CF_medico_direttore) REFERENCES Medico(CF);
CREATE TABLE account (
    id integer primary key auto_increment,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null, 
    password varchar(255) not null,
    telephone varchar(20) not null,
    checkbox_email boolean not null
) Engine = InnoDB;
CREATE TABLE messaggi (
    id integer primary key auto_increment,
    name varchar(255) not null,
    surname varchar(255) not null, 
    email varchar(255) not null,
    mex varchar(510) not null,
    tempo datetime not null
) Engine = InnoDB;
CREATE TABLE contenuti (
    titolo varchar(255) primary key,
    immagine varchar(255) not null, 
    descrizione tinytext not null
) Engine = InnoDB;

insert into contenuti values (‘Cardiologia’, ‘cardiologia.jpg’, ‘Unità operativa articolata in più settori di ricovero, dotata di numerose apparecchiature elettroniche ed elevati livelli di specializzazione professionale.’);
insert into contenuti values (‘Geriatria’, ‘geriatria.jpg’, ‘L\'alta competenza medica assicura interventi personalizzati sulle cause del declino funzionale dell\'anziano.’);
insert into contenuti values (‘Nefrologia’, ‘nefrologia.jpg’, ‘Unità operativa complessa che si occupa della diagnosi e terapia delle malattie renali acute e croniche’);
insert into contenuti values (‘Neurologia’, ‘neurologia.jpg’, ‘Unità operativa complessa dedicata alla diagnosi e cura delle malattie neurologiche acute, subacute e croniche del sistema nervoso centrale e periferico.’);
insert into contenuti values (‘Ortopedia’, ‘ortopedia.jpg’, ‘Diagnosi e trattamento delle patologie traumatiche attraverso l\'impiego di metodiche terapeutiche avanzate e di tecnologie di ultimissima generazione.’);
insert into contenuti values (‘Pediatria’, ‘pediatria.jpg’, ‘Il reparto garantisce assistenza sanitaria ospedaliera H24 ai bambini di età compresa tra il 28° giorno di vita e il compimento dei 14 anni.’);
insert into contenuti values (‘Radiologia’, ‘radiologia.png’, ‘Alta qualità delle prestazioni erogate sia per la parte diagnostica che per quella terapeutica, avvalendosi di strumentazione completa e all\’avanguardia.’);
insert into contenuti values (‘Virologia’, ‘virologia.jpg’, ‘Laboratorio di elevata attività diagnostica, con stanze di livello di protezione 3 per lavorare in sicurezza con patogeni ad alta infettività.’);

CREATE TABLE PREFERITI(
id_utente integer,
id_reparto varchar(20),
INDEX IDX_UTENTE(id_utente),
INDEX IDX_VEICOLO(id_reparto),
FOREIGN KEY(id_utente) REFERENCES account(id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(id_reparto)REFERENCES reparto(codice) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY (id_utente, id_reparto)
)Engine='InnoDB';

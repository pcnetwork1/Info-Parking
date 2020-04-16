Drop database if exists infoparking;
create database infoparking;
use infoparking;

CREATE TABLE `markers` (
  `sifra` int(4) primary key auto_increment NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `type` varchar(20) NOT NULL,
  `lat` float(10,6) DEFAULT NULL,
  Operater int not null,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;



create table operater(
sifra       int not null primary key auto_increment,
email       varchar(50) not null,
lozinka     char(60) not null,
ime         varchar(50) not null,
prezime     varchar(50) not null,
uloga       varchar(20) not null,
aktivan     boolean not null default true,
sessionid   varchar(100)
);

create table korisnik(
sifra       int not null primary key auto_increment,
email       varchar(50) not null,
lozinka     char(60) not null,
ime         varchar(50) not null,
prezime     varchar(50) not null,
Osobni_podatci int not null,
Markers int not null,
aktivan     boolean not null default true,
sessionid   varchar(100)
);

create table Osobni_podatci(
sifra           int not null primary key auto_increment,
registracija    varchar(20) not null,
Model_auta      varchar(50) not null,
Vrsta           varchar(50) not null
);

alter table markers add foreign key (Operater) references Operater(sifra);
alter table Korisnik add foreign key (Osobni_podatci) references Osobni_podatci(sifra);
alter table Korisnik add foreign key (markers) references markers(sifra);

//INSERT INTO `markers` (`sifra`, `name`, `address`, `type`, `lat`, `Operater`, `lng`) VALUES
(1, 'College of Engineering Pune', 'Wellesley Road, Shivajinagar, Pune, Maharashtra 411005', 'college', 45.5587,1, 18.6758);

insert into operater values 
(null,'edunova@edunova.hr',
'$2y$10$AzFzPK10Gi3nYBfpVKGYPeiyeQ8JOQOkfGJJ1jKJnQ.2hacJ2iwBi',
'Edunova','Operater','oper',true,null);
insert into operater values 
(null,'admin@edunova.hr',
'$2y$10$AzFzPK10Gi3nYBfpVKGYPeiyeQ8JOQOkfGJJ1jKJnQ.2hacJ2iwBi',
'Edunova','Administrator','admin',true,null);







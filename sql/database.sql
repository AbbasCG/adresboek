-- Tabel bedrijven
CREATE TABLE bedrijven (
    id int auto_increment primary key,
    naam varchar(255) not null,
    adres varchar(255),
    woonplaats varchar(100)
);

-- tabel contactpersonen
CREATE TABLE contacten (
    id int auto_increment primary key,
    bedrijf_id int references bedrijven(id),
    voornaam varchar(255) not null,
    tussenvoegsel varchar(255),
    achternaam varchar(255) not null,
    email varchar(255) unique not null,
    telefoon varchar(20),
    foreign key (bedrijf_id) references bedrijven(id) ON DELETE CASCADE
);
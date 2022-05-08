USE db_mood_in_music;

DROP TABLE music;
DROP TABLE musical_genre;
DROP TABLE user;
DROP TABLE dates;


SHOW tables;
-- DROP TABLE music; Si base de données déjà créée -> pour modification de la table music
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_mood_in_music` DEFAULT CHARACTER SET utf8 ;
USE `db_mood_in_music` ;

-- -----------------------------------------------------
-- Table `musical_genre_id`.`musical_genre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mood_in_music`.`musical_genre` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `genre_name` VARCHAR(45) NOT NULL,
  `image` BLOB,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `dates`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dates` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`start_date` DATETIME NOT NULL,
`end_date` DATETIME)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `musical_genre_id`.`music`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mood_in_music`.`music` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL,
  `author` VARCHAR(80) NOT NULL,
  `source` TEXT NOT NULL,
  `musical_genre_id` INT NULL,
  `number_vote` INT NULL,
  `old_number_vote` INT NULL,
  `music_image` BLOB,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_musical_genre_id`
    FOREIGN KEY (musical_genre_id)
    REFERENCES `db_mood_in_music`.`musical_genre` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `musical_genre_id`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mood_in_music`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pseudo` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO musical_genre (genre_name) VALUES
('pop'),('cinematic'),('electro'),
('world'),('chillout'),('ambient');

INSERT INTO music (title,author,source, musical_genre_id,number_vote,old_number_vote,music_image) VALUES
('Running','Apsley',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/307027394&color=%23ff5500&auto_play=false
&hide_related=true&show_comments=false&show_user=false&show_reposts=false&show_teaser=false&visual=false",1,0,0,
"https://i1.sndcdn.com/avatars-000273720715-amrs5o-t200x200.jpg"),
('Paris La Nuit','A Virtual Friend',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/101988889&color=%23ff5500&auto_play=false
&hide_related=true&show_comments=false&show_user=false&show_reposts=false&show_teaser=false&visual=false",1,0,0,
"https://i1.sndcdn.com/avatars-000215983290-8qeri7-t200x200.jpg"),
('Waiting For Nothing','The Fisherman',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/185495869&color=%23ff5500&auto_play=false
&hide_related=true&show_comments=false&show_user=false&show_reposts=false&show_teaser=false&visual=false",1,0,0,
"https://i1.sndcdn.com/avatars-12ZtajHyrXldyKG6-ksgPAA-t200x200.jpg"),
('Feel Sorry','A Virtual Friend',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/549886593&color=%23ff5500&auto_play=false
&hide_related=true&show_comments=false&show_user=false&show_reposts=false&show_teaser=false&visual=false",1,0,0,
"https://i1.sndcdn.com/avatars-000215983290-8qeri7-t200x200.jpg"),
('Daybreak feat Henk','Jens East',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/184041689&color=%23ff5500&auto_play=false
&hide_related=true&show_comments=false&show_user=false&show_reposts=false&show_teaser=false&visual=false",1,0,0,
"https://i1.sndcdn.com/avatars-44l49j2fXFXizBFI-IaAJ2Q-t200x200.jpg");

INSERT INTO music (title,author,source, musical_genre_id,number_vote,old_number_vote,music_image) VALUES
('The Epic Hero','Keys Of Moon',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/394326033&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",2,0,0,
"https://i1.sndcdn.com/avatars-wtAziJ8wNdu7QXOg-NFeS6g-t200x200.jpg"),
('Gaia','Nova Noma',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/205456569&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",2,0,0,
"https://i1.sndcdn.com/avatars-000331554991-z960n4-t200x200.jpg"),
('Beyond The Warriors','Guifrog',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/23434963&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",2,0,0,
"https://i1.sndcdn.com/avatars-000291280229-b69nmn-t200x200.jpg"),
('The Return','Alexander Nakarada',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/308669192&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",2,0,0,
"https://i1.sndcdn.com/avatars-000734625328-18orum-t200x200.jpg"),
('Winters-call','Mattias Westlund',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/233954398&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",2,0,0,
"https://i1.sndcdn.com/avatars-000178001044-4nwxke-t200x200.jpg");


INSERT INTO music (title,author,source, musical_genre_id,number_vote,old_number_vote,music_image) VALUES
('Essaouira','Amine Maxwell',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1062290803&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",3,0,0,
"https://i1.sndcdn.com/avatars-q0BqoN8W5JDuSSJZ-BxWCXw-t200x200.jpg"),
('Hiking','Scandinavianz',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1018958728&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",3,0,0,
"https://i1.sndcdn.com/avatars-EqTyDAp99m7zyElJ-xtG92Q-t200x200.jpg"),
('Desire','Markvard',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/646593702&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",3,0,0,
"https://i1.sndcdn.com/avatars-0FLB42zSgVAzpyhW-mTytew-t200x200.jpg"),
('Star Swimming','Props',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1196175913&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",3,0,0,
"https://i1.sndcdn.com/avatars-CyYkzOFfGyWzMOQi-8wUb8w-t200x200.jpg"),
('Laser Pointer','Wontolla',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/205554396&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",3,0,0,
"https://i1.sndcdn.com/avatars-iDe3sqjzZyqag9sL-a2fpzQ-t200x200.jpg");

INSERT INTO music (title,author,source, musical_genre_id,number_vote,old_number_vote,music_image) VALUES
('Flame and Go','CyberSDF',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/257129209&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",4,0,0,
"https://i1.sndcdn.com/avatars-000103005058-isftr7-t200x200.jpg"),
('Sakuya2','Peritune',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/239947267&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",4,0,0,
"https://i1.sndcdn.com/avatars-000233343998-4ty8y0-t200x200.jpg"),
('Intenciòn','Sapajou',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/899729788&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",4,0,0,
"https://i1.sndcdn.com/avatars-hLAT84sIjyfxbXkQ-lWq4EQ-t200x200.jpg"),
('Opening Para','Songo 21',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/309315552&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",4,0,0,
"https://i1.sndcdn.com/avatars-000297973272-2tukvt-t200x200.jpg"),
('Guazù','Shika Shika',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/307605364&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",4,0,0,
"https://i1.sndcdn.com/avatars-uPmRNq6q6D4BeMOq-PiHIIg-t200x200.jpg");

INSERT INTO music (title,author,source, musical_genre_id,number_vote,old_number_vote,music_image) VALUES
('Takayama','Niwel',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/726161599&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",5,0,0,
"https://i1.sndcdn.com/avatars-OOUXxO5OVwbzDvBH-kxKA9A-t200x200.jpg"),
('Naya','HaTom',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/660919205&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",5,0,0,
"https://i1.sndcdn.com/avatars-uOKfqPVfCMtWY1IL-aFvUbw-t200x200.jpg"),
('Flourish','Purrple Cat',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/772063282&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",5,0,0,
"https://i1.sndcdn.com/avatars-hXCegvaYMoJX7AUW-1EjExg-t200x200.jpg"),
('Light','Idyllic',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/456939843&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",5,0,0,
"https://i1.sndcdn.com/avatars-000689628332-sf5c4d-t200x200.jpg"),
('Memories','Atch',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/776397571&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",5,0,0,
"https://i1.sndcdn.com/avatars-NHui16hl8f7mfEVC-cjxyiA-t200x200.jpg");

INSERT INTO music (title,author,source, musical_genre_id,number_vote,old_number_vote,music_image) VALUES
('Overlove','John Tasoulas',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/1004355163&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",6,0,0,
"https://i1.sndcdn.com/avatars-oq7QHyOgMba0bSzh-zp5FhQ-t200x200.jpg"),
('Tai Chi','Valtteri Kujala',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/110602862&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",6,0,0,
"https://i1.sndcdn.com/avatars-000435856005-lcxovw-t200x200.jpg"),
('Wild Birth','Under The Gaïac',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/789639880&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",6,0,0,
"https://i1.sndcdn.com/avatars-CFZTK2T1pb9I8Pv4-pdmEMA-t200x200.jpg"),
('Titan','Scott Buckley',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/457526781&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",6,0,0,
"https://i1.sndcdn.com/avatars-000326739998-mqhaca-t200x200.jpg"),
('To The Great Beyond','Stellardrone',
"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/162416525&color=%23ff5500&auto_play=false
&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true",6,0,0,
"https://i1.sndcdn.com/avatars-000207804388-ealubt-t200x200.jpg");


INSERT INTO user (pseudo, password) VALUES
('user_test', 'pwd_test'),
('user_test2', 'pwd_test2'),
('Justine', 'password')
;

SELECT music.id, music.title, music.author,music.source, music.musical_genre_id, genre.genre_name 
FROM music INNER JOIN musical_genre as genre
ON music.musical_genre_id = genre.id;

SELECT music.id, music.title, music.author, music.source, music.music_image,genre.genre_name 
        FROM music
        INNER JOIN musical_genre AS genre ON music.musical_genre_id=genre.id
        WHERE music.id = 3
        ORDER BY music.title ASC;
        
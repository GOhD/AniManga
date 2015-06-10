Drop Table Comment_Write_Contain;
Drop Table Subtopic_Create_Subtopic_Have;
Drop Table Voice;
Drop Table Favored;
Drop Table c_In_a;
Drop Table Manga;
Drop Table Voice_Actor;
Drop Table Created_Forum_Forum;
Drop Table Member;
Drop Table my_Character;
Drop Table Anime;
Drop Table Admin;
Drop Table Animated_Series;
Drop Table Users;

CREATE TABLE Animated_Series
(
Title char(100),
primary key (Title)
);

CREATE TABLE Anime
(
Title   char(100),
Genre  char(255),
Rating  int ,
Description  text,
Season  int,
a_Status  char(100),
Start_date  date,
Studio  char(100),
num_of_episodes  int,
Primary key (Title, Season),
Foreign key (Title) REFERENCES Animated_Series(Title)
)ENGINE=InnoDB;

CREATE TABLE Manga
(Title   char(100),
Genre  char(200),
Rating   int ,
Description  text,
Author   char (100),
Volume  int,
Published_date date,
Primary key (Title, Author),
Foreign key (Title) REFERENCES Animated_Series(Title)
)ENGINE=InnoDB;

CREATE TABLE Voice_Actor 
( Vname  char (100),
Birthday  date,
Gender  char(10),
Bio  text,
Primary key (Birthday, Vname))ENGINE=InnoDB;

CREATE TABLE my_Character 
(Cname    char(100),
 Description   text,
 Rating   int,
Primary key (Cname))ENGINE=InnoDB;

CREATE TABLE Users
(
Email char(100),
Primary key (Email)
);

CREATE TABLE Admin
(
Email char (100),
r_Name char (100),
Admin_name  char (100), 
a_Password  char (20),
Primary key (Email),
Foreign key (Email) REFERENCES Users(Email)
)ENGINE=InnoDB;

CREATE TABLE Member
(
Email char (100),
r_Name char (100),
Username  char (100), 
Password  char (20),
Primary key (Email),
Foreign key (Email) REFERENCES Users(Email)
)ENGINE=InnoDB;

#Tables for Relationship
CREATE TABLE Created_Forum_Forum
( 
fid int not null, 
Email char(100),
fName char (100),
Date_created date,
Primary key (fid),
Foreign key (Email) REFERENCES Admin(Email)
)ENGINE=InnoDB;

CREATE TABLE Favored
(Title char (100),
 Email char (100),
Primary key (Title, Email),
Foreign key (Email) REFERENCES Users(Email),
Foreign key (Title) REFERENCES Animated_Series(Title)
)ENGINE=InnoDB;


CREATE TABLE c_In_a
(Cname char(100),
Title char(100),
Primary key (Cname, Title),
Foreign key (Cname) REFERENCES my_Character(Cname),
Foreign key (Title) REFERENCES Animated_Series(Title)
)ENGINE=InnoDB;

CREATE TABLE Voice
(Title char(100),
 Season int,
Birthday date, 
Vname char(100),
Cname char(100),
Primary key (Title,Season,Birthday,Vname,Cname),
Foreign key (Title,Season) REFERENCES Anime(Title,Season),
Foreign key (Birthday,Vname) REFERENCES Voice_Actor(Birthday,Vname),
Foreign key (Cname) REFERENCES my_Character(Cname)
)ENGINE=InnoDB;

CREATE TABLE Subtopic_Create_Subtopic_Have
(
fid int not null,
Date_created date,
Title char(100),
Email char(100),
Primary key (Title, fid),
Foreign key (fid) REFERENCES created_forum_forum(fid) on delete cascade on update cascade,
Foreign key (Email) REFERENCES Users(Email)
) ENGINE=InnoDB;


CREATE TABLE Comment_Write_Contain
( 
fid int, 
Title char (100),
Msg text,
Date_written date,
Email char (100),
<<<<<<< HEAD
Primary key (Forum_ID, Title, Msg, Date_written),
Foreign key (Title, Forum_ID) REFERENCES Subtopic_Create_Subtopic_Have(Title, Forum_ID) on delete cascade on update cascade,
Foreign key (Email) REFERENCES Admin(Email), 
Foreign key (Email) REFERENCES Member(Email)
);


=======
Primary key (fid, Title, Date_written),
Foreign key (Title, fid) REFERENCES Subtopic_Create_Subtopic_Have(Title, fid) on delete cascade on update cascade,
Foreign key (Email) REFERENCES Users(Email)
)ENGINE=InnoDB;

insert into Animated_Series values
('Pokemon'),('Code_Geass'),('Shokugeki no Souma'), ('Naruto'), ('Shingeki no Kyojin'), ('Jyu oh sei'), ('Meitantei Conan'), ('Tokyo Ghoul'), ('Girls of the Wilds'), ('Bleach'), ('Noblesse'), ('Emma');

insert into Users values
('frank_rui@hotmail.com'), ('weininghu1012@gmail.com'), ('liangjiaxing57@gmail.com'), ('shehryartariq82@hotmail.com'),
('john_smith@gmail.com'), ('eiser@gmail.com'), ('fx7384@gmail.com'), ('jb@hotmail.com'), ('bj@hotmail.com'),
('gm@hotmail.com'), ('joe@hotmail.com');

insert into Anime values
('Pokemon', 'Animation, Adventure, Comedy, Family, Fantasy', 5,
'Pokémon is a media franchise owned by The Pokémon Company, and created by Satoshi Tajiri in 1995. It is 
centered on fictional creatures called "Pokémon", which humans capture and train to fight each other for 
sport.', 18, 'Currently Airing', '2014-11-06', 'OML, Inc.', 20),
('Code_Geass', 'Alternate History, Mecha, Drama, Sci-Fi, Super Power', 5,
'On August 10th of the year 2010 the Holy Empire of Britannia began a campaign of conquest, its sights set on 
Japan. Operations were completed in one month thanks to Britannias deployment of new mobile humanoid armor 
vehicles dubbed Knightmare Frames. Japans rights and identity were stripped away, the once proud nation now 
referred to as Area 11. Its citizens, Elevens, are forced to scratch out a living while the Britannian 
aristocracy lives comfortably within their settlements. Pockets of resistance appear throughout Area 11, 
working towards independence for Japan.Lelouch, an exiled Imperial Prince of Britannia posing as a student, 
finds himself in the heart of the ongoing conflict for the island nation. Through a chance meeting with a 
mysterious girl named C.C., Lelouch gains his Geass, the power of the king. Now endowed with absolute 
dominance over any person, Lelouch may finally realize his goal of bringing down Britannia from within!', 1,
'Finished Airing', '2006-10-06', 'Sunrise', 25),
('Shokugeki no Souma', 'Comedy, Ecchi, School, Shounen', 4, 
'Yukihira Soumas dream is to become a full-time chef in his fathers restaurant and surpass his fathers 
culinary skill. But just as Yukihira graduates from middle schools his father, Yukihira Jouichirou, closes 
down the restaurant to cook in Europe. Although downtrodden, Soumas fighting spirit is rekindled by a 
challenge from Jouichirou which is to survive in an elite culinary school where only 10% of the students 
graduate. Can Souma survive?', 1, 'Currently Airing', '2015-04-04', 'J.C.Staff', 24),
('Naruto', 'Animation,Action,Adventure,Comedy,Fantasy,Thriller', 5,
'Naruto is a Japanese manga series written and illustrated by Masashi Kishimoto. It tells the story of Naruto 
Uzumaki, an adolescent ninja who constantly searches for recognition and dreams to become the Hokage, the 
ninja in his village who is acknowledged as the leader and the strongest of all. The series is based on a 
one-shot manga by Kishimoto that was published in the August 1997 issue of Akamaru Jump.', 1, 'Finished Airing',
'2002-03-10', 'Studio Pierrot', 220),
('Shingeki no Kyojin', 'Action, Horror, Drama, Fantasy, Tragedy, Psychological, Mature', 5,
'Several hundred years ago, humans were nearly exterminated by titans. Titans are typically several stories 
tall, seem to have no intelligence, devour human beings and, worst of all, seem to do it for the pleasure 
rather than as a food source. A small percentage of humanity survived by walling themselves in a city 
protected by extremely high walls, even taller than the biggest of giants. Flash forward to the present and 
the city has not seen a giant in over 100 years. Teenage boy Eren and his foster sister Mikasa witness 
something horrific as one of the city walls is damaged by a 60 meter giant causing a breach in the wall. As 
the smaller giants flood the city, the two kids watch in horror as Erens mother is eaten alive.Unable to save 
her , Eren vows that he will wipe out every single giant and take revenge for all of mankind.', 1, 'Finished Airing',
'2014-04-06', 'Wit Studio', 25),
('Jyu oh sei', 'Science Fiction, Romance, Tragedy', 4,
'Jyu-Oh-Sei is a Japanese manga series written and illustrated by Natsumi Itsuki. An 11-episode anime 
adaptation was animated by Bones and premiered April 13, 2006 in Japan as part of Fuji TVs Noitamina 
programming block.', 1, 'Finished Airing', '2006-04-13', 'Bones', 11),
('Meitantei Conan', 'Animation,Comedy,Crime,Drama,Mystery,Romance,Thriller', 5,
'Shinichi Kudo is a high-school student who, by using observation and deduction, is good at solving mysteries. 
While investigating one, he is caught by the criminals that he was watching and forced to take an 
experimental drug. Leaving him for dead, the criminals disappear. Instead of killing him, however, the drug 
turns Shinichi into a little kid.', 16, 'Finished Airing', '2007-02-26', 'TMS Entertainment, Ltd', 25),
('Code_Geass', 'Alternate History, Mecha, Drama, Sci-Fi, Super Power', 5, 
'On August 10th of the year 2010 the Holy Empire of Britannia began a campaign of conquest, its sights set on 
Japan. Operations were completed in one month thanks to Britannias deployment of new mobile humanoid armor 
vehicles dubbed Knightmare Frames. Japans rights and identity were stripped away, the once proud nation now 
referred to as Area 11. Its citizens, Elevens, are forced to scratch out a living while the Britannian 
aristocracy lives comfortably within their settlements. Pockets of resistance appear throughout Area 11, 
working towards independence for Japan.Lelouch, an exiled Imperial Prince of Britannia posing as a student, 
finds himself in the heart of the ongoing conflict for the island nation. Through a chance meeting with a 
mysterious girl named C.C., Lelouch gains his Geass, the power of the king. Now endowed with absolute 
dominance over any person, Lelouch may finally realize his goal of bringing down Britannia from within!', 2,
'Finished Airing', '2008-04-06', 'Sunrise', 25);

insert into Manga values
('Tokyo Ghoul', 'Action, Drama, Horror, Fantasy, Psychological, Tragedy, Supernatural', 5,
'Strange murders are happening in Tokyo. Due to liquid evidence at the scene, the police conclude the attacks 
are the results of "eater" type ghouls. College buddies Kaneki and Hide come up with the idea that ghouls are 
imitating humans so thats why they have not ever seen one. Little did they know that their theory may very 
well become reality.', 'Ishida Sui', 14, '2012-02-04'),
('Girls of the Wilds', 'Action, Comedy, Drama, Harem, Martial Arts, Romance', 2,
'Wilds High has a 42-year history as a fighting specialized, girls only, private high school meant solely for 
the elite. It is also the place that Wilds-League is held: the most popular event in the country and the only 
place in the world where teenage girls have brutal fights with their lives on the line.', 'Hun', 1, '2011-11-08'),
('Naruto', 'Animation, Action, Adventure, Comedy, Fantasy, Thriller', 5, 
'Naruto is a Japanese manga series written and illustrated by Masashi Kishimoto. It tells the story of Naruto 
Uzumaki, an adolescent ninja who constantly searches for recognition and dreams to become the Hokage, the 
ninja in his village who is acknowledged as the leader and the strongest of all. The series is based on a 
one-shot manga by Kishimoto that was published in the August 1997 issue of Akamaru Jump.', 'Masashi Kishimoto',
72, '2007-10-19'),
('Bleach', 'Action, Comedy, Drama, Mystery, School Life', 4,
'Ichigo Kurosaki has always been able to see ghosts, but this ability does not change his life nearly as much 
as his close encounter with Rukia Kuchiki, a Soul Reaper and member of the mysterious Soul Society. While 
fighting a Hollow, an evil spirit that preys on humans who display psychic energy, Rukia attempts to lend 
Ichigo some of her powers so that he can save his family; but much to her surprise, Ichigo absorbs every last 
drop of her energy. Now a full-fledged Soul Reaper himself, Ichigo quickly learns that the world he inhabits 
is one full of dangerous spirits, and along with Rukia--who is slowly regaining her powers--its Ichigos job 
to protect the innocent from Hollows and help the spirits themselves find peace.', 'Kubo Tite', 68, '2007-10-14'),
('Noblesse', 'Action, Comedy, Drama, Mystery, School Life', 5,
'He awakens. For 820 years he has slumbered with no knowledge of mankinds advancements and scientific 
achievments. The land which he once knew has become an unfamiliar place with new technologies, attitudes, 
and lifestyles. Cadis Etrama Di Raizel, Rai, while seeking to familiarize himself with this era, somehow 
locates a loyal servant of his, Frankenstein, who is currently the principal of a South Korean high school. 
Rai decides that this high school would be the perfect place to help him learn about the new world. He 
enrolls, and suddenly becomes the friend of Shinwoo, an immature teenager who is also a master martial 
artist. But this new world is no safer than the old, and the dignified, bewildered, technologically 
illiterate Rai finds himself caught up in adventures both hilarious and dangerous.', 'Son Jae-ho',
4, '2010-02-28'),
('Shokugeki no Souma', 'Comedy, Ecchi, School, Shounen', 4,
'Yukihira Soumas dream is to become a full-time chef in his fathers restaurant and surpass his 
fathers culinary skill. But just as Yukihira graduates from middle schools his father, Yukihira 
Jouichirou, closes down the restaurant to cook in Europe. Although downtrodden, Soumas fighting spirit 
is rekindled by a challenge from Jouichirou which is to survive in an elite culinary school where only 
10% of the students graduate. Can Souma survive?', 'Tsukada Yuuto', 14, '2012-11-30'),
('Emma', 'Drama, Historical, Romance', 4,
'In Victorian-era England, a young girl is rescued from a life of destitution and raised to become a 
proper British maid. Emma meets William, the eldest son of a wealthy family, and immediately falls in 
love with him. William shares her feelings, but the strict rules of their society prevent their 
relationship from ever coming out in the open. Traditional class distinctions and rich, historical 
details provide the backdrop for this appealing romance.', 'Kaoru Mori', 10, '2007-10-16');

insert into Voice_Actor values
('Ikue Ohtani', '1965-08-18', 'Female', 
'Ikue Ohtani was born on August 18, 1965 in Tokyo, Japan. She is an actress, known for Pokémon (1998), 
Poketto Monsutâ (1997) and Gekijô-ban poketto monsutâ - Myûtsû no gyakushû (1998).'),
('Veronica Taylor', '1978-04-09', 'Female', 
'Veronica Taylor was born on April 9, 1978 in New York City, New York, USA. She is an actress, known 
for Pokémon (1998), Gekijô-ban poketto monsutâ - Myûtsû no gyakushû (1998) and Teenage Mutant Ninja 
Turtles (2003). She is married to Dan Chruscinski.'),
('Kazuhiko Inoue', '1954-03-26', 'Male',
'Kazuhiko Inoue was born on March 26, 1954 in Yokohama, Japan. He is an actor, known for Naruto: 
Shippûden (2007), Naruto (2002) and Hyakujû-ô Goraion (1981).'),
('Junko Takeuchi', '1972-04-05', 'Female', 
'Junko Takeuchi was born on April 5, 1972 in Saitama, Japan. She is an actress, known for Naruto: 
Shippûden (2007), Naruto (2002) and Naruto SD: Rock Lee no Seishun Full-Power Ninden (2012).'),
('Minami Takayama', '1964-05-05', 'Female',
'Minami Takayama was born on May 5, 1964 in Tokyo, Japan as Arai Izumi. She is an actress and 
composer, known for Meitantei Conan (1996), Majo no takkyûbin (1989) and Ranma ½: Nettô-hen (1989). 
She was previously married to Gôshô Aoyama.'),
('Jun Fukuyama', '1978-11-26', 'Male',
'Jun Fukuyama (born November 26, 1978) is a Japanese voice actor and singer. He was previously 
represented by Aoni Production and Production Baobab, and is now represented by Axl-One. He is from 
Fukuyama, Hiroshima but grew up in Takatsuki, Osaka. He was on the cover of October 2008, issue 28 
of the Japanese magazine Voice Newtype. He is a Japanese voice actor who won the 1st Seiyu Awards 
for best voice actor for his role as Lelouch Lamperouge at Code_Geass. He is sometimes confused 
with another fellow Japanese voice actor by the name of Jun Fukushima, as their names are only 
different by one Kanji letter in their name spellings.');

insert into my_Character values
('Pikachu', 'Pikachu, easily the most famous and recognizable of all the Pokemon, is the companion and 
best friend of the hero of the TV show, Ash Ketchum. Pikachu is stubborn, yet kind hearted and very 
powerful (much more powerful than the average Pikachu). It is loyal to Ash no matter what, and Ash 
feels the same for Pikachu, as each have laid their lives on the line for the other many times 
throughout the series and the movies.', 5),
('Ash Ketchum', 'Ash Ketchum is the hero of the Pokemon television series and movies. He is 10 years 
old (though the show has been on the air over 10 years now), and his best friend is his first 
Pokemon, Pikachu. He hopes to become a Pokemon master by travelling all throughout the world, 
through the Kanto, Johto, Hoenn, and Sinnoh regions and defeating the other trainers. He is a 
talented trainer, however he sometimes does not think things through, resulting in losses. He 
relies on the help of his friends from time to time, whether that be Misty, the Cerulean City Gym 
leader, Brock, the Pewter City Gym Leader, Tracy, a Pokemon sketch artist, May and Max, a young 
brother and sister combination, or Dawn, a young trainer from Sinnoh. He also is a constant foil 
in the plans of Team Rocket, stopping them in almost every episode of the TV show and in most of 
the movies as well. The typical Rockets that he faces of with are the inept Jessie and James, who 
are followed around by the Rocket mascot, Meowth, and James baby Pokemon Mime Jr. His archnemeses 
include Gary and Paul, both of whom try to constantly dampen his spirits. Ash is a good kid who is 
always fighting for the greater good, and always wishes for the happiness of Pokemon over his own. 
He has released several of his Pokemon, particularly Charizard, Butterfree, and Pidgeot, so they 
could be happier. He was even prepared to let Pikachu go, but Pikachu decided to stay with Ash in 
the end, solidifying their friendship.', 4),
('Lelouch vi Britannia', 'Lelouch vi Britannia is the protagonist and antihero of Code_Geass: 
Lelouch of the Rebellion and Code_Geass: Lelouch of the Rebellion R2, 17 years old (18 at R2). After 
he was exiled he used the alias, Lelouch Lamperouge He is the Eleventh Prince of the Holy Britannian 
Empire and the son of the 98th Emperor of Britannia, Charles zi Britannia. He is the leader of the 
Black Knights which makes him the real identity of Zero. He is voiced by Jun Fukuyama, while his 
child self is voiced by Sayaka Ohara. His English dub voice is provided by Johnny Yong Bosch with 
Michelle Ruff doing Lelouchs child voice.', 5),
('Naruto Uzumaki', 'Naruto Uzumaki is a shinobi of Konohagakure. He became the jinchūriki of the 
Nine-Tails on the day of his birth, a fate that caused him to be ostracised and neglected by most 
of Konoha throughout his childhood. After joining Team Kakashi, Naruto worked hard to gain the 
villages respect and acknowledgement with the eventual dream of becoming Hokage. In the following 
years, he became a capable ninja regarded as a hero, both by the villagers and the shinobi world at 
large. He soon proved to be the main factor in winning the Fourth Shinobi World War, leading him to 
achieve his dream and become the Seventh Hokage', 3),
('Shinichi Kudo', 'A high school detective, he is forced to ingest the lethal poison APTX 4869 after 
his encounter with Gin and Vodka. Due to a rare side effect, the poison shrinks him into a child and 
he adopts the pseudonym Conan Edogawa to hide from those who poisoned him. He moves in with his 
childhood friend Rachel Moore and her father Richard Moore as he awaits the day he can take down 
Gin and the syndicate he belongs to, the Black Organization.', 1),
('Kakashi Hatake', 'Kakashi Hatake is a shinobi of Konohagakures Hatake clan. After receiving a 
Sharingan from his team-mate, Obito Uchiha, Kakashi gained recognition as Copy Ninja Kakashi and 
Kakashi of the Sharingan His prodigious talent, skill, and Sharingan prowess have made him one of 
the villages most capable ninja, and as such, both highly renowned and feared throughout the ninja 
world. Later appointed the leader of Team 7, Kakashi used his years of experience to train his 
students as skilled shinobi in their own rights. In the aftermath of the Fourth Shinobi World War, 
Kakashi takes up office as the Sixth Hokage.', 2);

insert into Admin values
('fx7384@gmail.com', 'Francis Xavier', 'EternalBlaze', 'jpopftw'),
('jb@hotmail.com', 'John Bennings', 'anime4lyfe', 'iheartanime34'),
('bj@hotmail.com', 'Bob Jones', 'otakugrandmaster', 'yayanime'),
('gm@hotmail.com', 'Gordon Ma', 'noname', '8739023'),
('joe@hotmail.com', 'Joe Mckay', 'whyamihere', 'nolife7643');

insert into Member values
('frank_rui@hotmail.com', 'Frank Rui', 'animefreak', 'iloveanime275'),
('weininghu1012@gmail.com', 'Weining Hu', 'jigglypuff', 'animeforever'),
('eiser@gmail.com', 'Yozu Liang', 'pichubear', 'ahaha5478'),
('liangjiaxing57@gmail.com', 'Jiaxing Liang', 'pikapika', 'whatever'),
('shehryartariq82@hotmail.com', 'Shehryar Awan', 'GOhDi55mDream', 'whatarewedoing'),
('john_smith@gmail.com', 'John Smith', 'animeislove', 'animeislife');

insert into Created_Forum_Forum values
(1, 'fx7384@gmail.com', 'General Discussion', '2015-06-03'),
(2, 'jb@hotmail.com', 'Suggestions', '2015-06-03'),
(3, 'bj@hotmail.com', 'Anime Discussion', '2015-06-04'),
(4, 'gm@hotmail.com', 'Manga Discussion', '2015-06-05'),
(5, 'joe@hotmail.com', 'Bug Reports', '2015-06-08');

insert into Favored values
('Code_Geass', 'frank_rui@hotmail.com'),
('Pokemon', 'weininghu1012@gmail.com'),
('Emma', 'eiser@gmail.com'),
('Tokyo Ghoul', 'frank_rui@hotmail.com'),
('Jyu oh sei', 'eiser@gmail.com'),
('Pokemon', 'frank_rui@hotmail.com');

insert into c_In_a values
('Pikachu', 'Pokemon'),
('Naruto Uzumaki', 'Naruto'),
('Ash Ketchum', 'Pokemon'),
('Lelouch vi Britannia', 'Code_Geass'),
('Kakashi Hatake', 'Naruto'),
('Shinichi Kudo', 'Meitantei Conan');

insert into Voice values
('Pokemon', 18, '1965-08-18', 'Ikue Ohtani', 'Pikachu'),
('Pokemon', 18, '1978-04-09', 'Veronica Taylor', 'Ash Ketchum'),
('Naruto', 1, '1954-03-26', 'Kazuhiko Inoue', 'Kakashi Hatake'),
('Naruto', 1, '1972-04-05', 'Junko Takeuchi', 'Naruto Uzumaki'),
('Meitantei Conan', 16, '1964-05-05', 'Minami Takayama', 'Shinichi Kudo'),
('Code_Geass', 1, '1978-11-26', 'Jun Fukuyama', 'Lelouch vi Britannia');

insert into Subtopic_Create_Subtopic_Have values
(1, '2015-06-07', 'What is it about anime that attracts you?', 'frank_rui@hotmail.com'),
(2, '2015-06-07', 'Add a feature to keep track of our favourite animes!', 'weininghu1012@gmail.com'),
(3, '2015-06-08', 'Who is your favourite anime character?', 'eiser@gmail.com'),
(4, '2015-06-10', 'Which manga should I read if I like action and fantasy?', 'jb@hotmail.com'),
(5, '2015-06-12', 'The site is not displaying correctly on Firefox.', 'joe@hotmail.com');

insert into comment_write_contain values
(1, 'What is it about anime that attracts you?', 
'I like how anime is not just for kids. It also deals with some very mature content!',
'2015-06-04',
'frank_rui@hotmail.com'),
(2, 'Add a feature to keep track of our favourite animes!', 
'It would be great to have a feature where we can track our favourite animes. Add it please!',
'2015-06-08', 'weininghu1012@gmail.com'),
(3, 'Who is your favourite anime character?',
'My favourite anime character is Lelouch from Code_Geass. He is so good at strategizing!',
'2015-06-09',
'eiser@gmail.com'),
(4, 'Which manga should I read if I like action and fantasy?',
'As the title says, do you guys have any suggestions for the action and fantasy genre?',
'2015-06-10',
'jb@hotmail.com'),
(5, 'The site is not displaying correctly on Firefox.',
'Hello admins, the site is not displaying correctly for me in Firefox. The format seems to be all over the place.',
'2015-06-12',
'joe@hotmail.com');

#SHOW ENGINE INNODB STATUS;


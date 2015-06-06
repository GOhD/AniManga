CREATE TABLE Anime
(
Title   char(100),
Genre  varchar(2000),
Rating  int ,
Description  char(100),
Season  int,
a_Status  char(100),
Start_date  char(100),
Studio  char(100),
num_of_episodes  int,
Primary key (Title, Season)
);

CREATE TABLE Manga
(Title   char(100),
Genre  char(200),
Rating   int ,
Description  char(100),
Author   char (100),
Volume  int,
Published_date char(100),
Primary key (Title, Author)
);

CREATE TABLE Voice_Actor 
( Vname  char (100),
Birthday  char(100),
Gender  char(6),
Bio  char(10000),
Primary key (Name, Birthday));

CREATE TABLE my_Character 
(Cname    char(100),
 Description   char(10000),
 Rating   int,
Primary key (Cname));

CREATE TABLE Admin
(Email char (100),
r_Name char (100),
Admin_name  char (100), 
a_Password  char (20),
Primary key (Email));

CREATE TABLE Member
(Email char (100),
Name char (100),
Username  char (100), 
Password  char (20),
Primary key (Email));

#Tables for Relationship
CREATE TABLE Created_Forum_Forum
( 
Forum_ID   int, 
Email  char(100),
Name   char (100),
Date_created   char (100),
Primary key (Forum_ID),
Foreign key (Email) REFERENCES Admin(Email)
);

CREATE TABLE Subtopic_Create_Subtopic_Have
( 
Forum_ID   int, 
Date_created  char (100),
Title  char (100),
Email char (100),
Primary key (Forum_ID, Title),
Foreign key (Forum_ID) REFERENCES Create_Forum_Forum(Forum_ID))


CREATE TABLE Comment_Write_Contain
( 
Forum ID   int, 
Title  char (100),
Msg  char (100),
Date  char (100),
Email char (100),
Primary key (Forum ID, Title, Msg, Date),
Foreign key (Forum ID, Title) REFERENCES Subtopic_Create_Subtopic_Have (Forum ID, title),
Foreign key (Email) REFERENCES Admin(Email), Member(Email)
)

CREATE TABLE Voice
(Title char(100),
 Season int,
Birthday  char(100), 
Vname  char(100),
Cname char(100),
Primary key (Title,Season,Birthday,Vname,Cname)),
Foreign key (Title,Season) REFERENCES Anime(Title,Season),
Foreign key (Birthday, Vname) REFERENCES VoiceActor(Birthday,Vname), 
Foreign key (Cname) REFERENCES character(Cname));


CREATE TABLE Favored
(Title char (100),
 Email char (100),
Primary key (Title, Email),
Foreign key (Email) REFERENCES Admin(Email),Member(Email),
Foreign key (Title) REFERENCES Anime(Title), Manga(Title));

CREATE TABLE c_In_a
(Cname  char(100),
Title  char(100),
Primary key (Cname, Title),
Foreign key (Cname) REFERENCES my_Character(Cname),
Foreign key (Title) REFERENCES Anime(Title), Manga(Title));




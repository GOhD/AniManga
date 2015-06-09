
CREATE TABLE Voice
(Title char(100),
 Season int,
Birthday char(100), 
Vname char(100),
Cname char(100),
Primary key (Title,Season,Birthday,Vname,Cname),
Foreign key (Title,Season) REFERENCES Anime(Title,Season),
Foreign key (Birthday, Vname) REFERENCES Voice_Actor(Birthday,Vname), 
Foreign key (Cname) REFERENCES my_Character(Cname)
);

CREATE TABLE Subtopic_Create_Subtopic_Have
(
Forum_ID int,
Date_created char (100),
Title char(100),
Email char(100),
Primary key (Title),
Foreign key (Forum_ID) REFERENCES Create_Forum_Forum(Forum_ID));




CREATE TABLE Comment_Write_Contain
( 
Forum_ID int, 
Title char (100),
Msg varchar (10000),
Date_written char (100),
Email char (100),
Primary key (Forum_ID, Title, Msg, Date_written),
Foreign key (Forum_ID, Title) REFERENCES Subtopic_Create_Subtopic_Have (Forum_ID, title),
Foreign key (Email) REFERENCES Admin(Email), 
Foreign key (Email) REFERENCES Member(Email)
);






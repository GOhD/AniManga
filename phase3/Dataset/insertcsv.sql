LOAD DATA INFILE '/Users/weininghu/Documents/study/ubc2015S/Animanga/phase3/Dataset/new_anime.csv' 
INTO TABLE Anime 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n';
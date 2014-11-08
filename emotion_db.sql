CREATE DATABASE emotion_db DEFAULT CHARACTER SET utf8;
GRANT ALL ON emotion_db.* TO aroma_user@localhost IDENTIFIED BY 'aroma123';

CREATE DATABASE test_emotion_db DEFAULT CHARACTER SET utf8;
GRANT ALL ON test_emotion_db.* TO aroma_user@localhost IDENTIFIED BY 'aroma123';

CREATE TABLE emotions(
	id INT AUTO_INCREMENT,
	user_id INT,
	record_date DATETIME,
	my_emotion VARCHAR(255),
	my_emotion_val INT,
	analyzed_emotion VARCHAR(255),
	analyzed_emotion_val INT,
	face_emotyion VARCHAR(255),
	face_emotyion_val INT,
	memo TEXT,
	img1 VARCHAR(255),
    img_file MEDIUMBLOB,
	created DATETIME,
	modified DATETIME,
	PRIMARY KEY  (id)
) engine = InnoDB;


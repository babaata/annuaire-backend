

CREATE TABLE accounts (
	user_id integer PRIMARY KEY,
	username VARCHAR ( 50 )  NOT NULL,
	password VARCHAR ( 50 ) NOT NULL,
	email VARCHAR ( 255 )  NOT NULL
) ;

INSERT INTO accounts (user_id,username, password, email) VALUES (1, 'bendia','libb', 'linsan.saliou@gmail.com'),(2,'bendia','libb', 'linsan.saliou@gmail.com');



CREATE TABLE places (
  id integer PRIMARY KEY,
  name VARCHAR(255),
  visited integer ,
  lat decimal ( 50 ) ,
  lng decimal ( 255 )  
) ;

INSERT INTO places (id, name, visited, lat, lng) VALUES (1,'Berlin',1,52.52,13.405),(2,'Budapest',1,47.4979,19.0402),(3,'Cincinnati',0,39.1031,-84.512),(4,'Denver',0,39.7392,-104.99);

														USER TABLE

CREATE DATABASE lele;
USE lele ;
CREATE TABLE register_form(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
email varchar(255) NOT NULL UNIQUE ,
first_password varchar(255) NOT NULL ,
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE INNODB charset = utf8;

CREATE TABLE personal_information(
personal_id int(11) NOT NULL PRIMARY KEY,
first_name char(255) NOT NULL,
last_name char(255) NOT NULL,
phone int(11) NOT NULL UNIQUE ,
FOREIGN KEY (personal_id) REFERENCES register_form (id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE INNODB charset = utf8;

CREATE TABLE mobile_info(
mobile_id int(11) NOT NULL ,
imei bigint NOT NULL UNIQUE,
phone_primary_number int(11) NOT NULL UNIQUE ,
mobile_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP PRIMARY KEY,

check_m char(255) NOT NULL ,
the_checker char(255) NOT NULL,

FOREIGN KEY (mobile_id) REFERENCES register_form (id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE INNODB charset = utf8;

CREATE TABLE mobile_image(
image_id int(11) NOT NULL ,
image longblob NOT NULL ,
image_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP PRIMARY KEY,
FOREIGN KEY (image_id) REFERENCES register_form (id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE INNODB charset = utf8;


//////////////////////////////////////////////////////////////////////////////////////////////////
										ADMIN TABLE

CREATE DATABASE admins;
USE admins ;
CREATE TABLE admin_form(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
name char(255) NOT NULL ,
email varchar(255) NOT NULL UNIQUE ,
password varchar(255) NOT NULL ,
degree int(11) NOT NULL,
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE INNODB charset = utf8;

//////////////////////////////////////////////////////////////////////


USE admins ;
CREATE TABLE old_new_data(
id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
old_data  varchar(255) NOT NULL ,
new_data  varchar(255) NOT NULL ,
maker     varchar(255) NOT NULL ,
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE INNODB charset = utf8;

///////////////////////////////////////////////////////////////////////

USE lele ;
CREATE TABLE stolen_phones(
stolen_id int(11) NOT NULL ,
stolen_imei bigint NOT NULL UNIQUE,
stolen_time date NOT NULL UNIQUE,
FOREIGN KEY (stolen_id) REFERENCES register_form (id) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE INNODB charset = utf8;






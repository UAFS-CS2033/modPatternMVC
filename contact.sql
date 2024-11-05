drop database if exists cs2033;
drop user if exists 'cs2033user'@'localhost';
create database cs2033;
use cs2033;

create user 'cs2033user'@'localhost' identified by 'cs2033pass';
grant all on cs2033.* to 'cs2033user'@'localhost';

create table contacts(
   contactID int AUTO_INCREMENT,
   username varchar(50),
   email varchar(120),
   address1 varchar(120),
   passwd varchar(50),
   primary key(contactID)
)engine=innodb;

insert into contacts(username,email,address1,passwd) values('Jim Smith','jim.smith@gmail.com','1107 Addison','pass123');
insert into contacts(username,email,address1,passwd) values('Mary Jones','mjones@gmail.com','2314 Park','pass123');
insert into contacts(username,email,address1,passwd) values('Rick Wilson','rick.wilson@gmail.com','1122 56th','pass123');
insert into contacts(username,email,address1,passwd) values('Kim Johnson','kjohnson@gmail.com','456 Oak','pass123');
insert into contacts(username,email,address1,passwd) values('Brian Williams','bwilliams@gmail.com','123 Main','pass123');

drop database taller;
create database taller;
use taller;
create table user(
  id_user int auto_increment not null,
  first_name varchar(20),
  last_name varchar (20),
  email varchar (50),
  password varchar (500),
  primary key (id_user)
);
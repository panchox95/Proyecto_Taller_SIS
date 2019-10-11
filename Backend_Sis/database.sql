drop database taller;
create database taller;
use taller;
create table user(
  id_user int auto_increment not null,
  first_name varchar(20),
  last_name varchar (20),
  email varchar (50),
  password varchar (500),
  profile_image varchar (500),
  primary key (id_user)
);

create table perfil(
  id_perfil int auto_increment not null,
  id_user int ,
  telefono int,
  direccion varchar (500),
  foto varchar (200),
  tarjeta int,
  zipcode int,
  primary key (id_perfil),
  foreign key (id_user) references user(id_user)

);

create table producto(
  id_producto int auto_increment not null,
  nombre varchar(20),
  marca varchar (20),
  cantidad int,
  precio double,
  descripcion varchar (500),
  estado varchar(100),
  primary key (id_producto)
);

create table servicio(
  id_servicio int auto_increment not null,
  nombre varchar(20),
  precio double,
  descripcion varchar (500),
  estado varchar(100),
  primary key (id_servicio)
);

create table productoservicio(
  id_produserv int auto_increment not null,
  id_servicio int ,
  id_producto int,
  primary key (id_produserv),
  foreign key (id_servicio) references servicio(id_servicio),
  foreign key (id_producto) references producto(id_producto)
);

/*drop database taller;
create database taller;
use taller;
create table user(
	id_user int auto_increment,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    password varchar(255),
    intento int,
    ultimo_intento int,
    rol varchar(255),
    primary key(id_user)
);
create table perfil(
	id_perfil int auto_increment,
    id_user int ,
    telefono int,
    direccion varchar(255),
    foto varchar(255),
    tarjeta int,
    zipcode int,
    foreign key(id_user) references user (id_user),
    primary key(id_perfil)
);
create table producto(
	id_producto int auto_increment,
    nombre varchar(255),
    marca varchar(255),
    cantidad int,
    precio int,
    descripcion varchar(255),
    estado varchar(255),
    primary key(id_producto)
);
create table comentarioproducto(
	id_comentario int auto_increment,
    id_producto int,
    id_user int,
    comentario varchar(255),
    calificacion int,
    foreign key(id_producto) references producto (id_producto),
	foreign key(id_user) references user (id_user),
    primary key(id_comentario)
);

create table ofertaproducto(
	id_oferta int auto_increment,
    id_producto int,
    descripcion varchar(255),
    descuento double,
    estado varchar(255),
    foreign key(id_producto) references producto (id_producto),
    primary key(id_oferta)
);
create table servicio(
	id_servicio int auto_increment,
    nombre varchar(255),
    precio int,
    descripcion varchar(255),
    estado varchar(255),
    primary key(id_servicio)
);
create table ofertaservicio(
	id_oferta int auto_increment,
    id_servicio int,
    descripcion varchar(255),
    descuento double,
    estado varchar(255),
    foreign key(id_servicio) references servicio (id_servicio),
    primary key(id_oferta)
);
create table comentarioservicio(
	id_comentario int auto_increment,
    id_servicio int,
    id_user int,
    comentario varchar(255),
    calificacion int,
    foreign key(id_servicio) references servicio (id_servicio),
	foreign key(id_user) references user (id_user),
    primary key(id_comentario)
);
create table categoria(
	id_categoria int auto_increment,
    nombre varchar(255),
    primary key(id_categoria)
);
create table categoriaproducto(
	id_categoria int,
    id_producto int,
	foreign key(id_categoria) references categoria (id_categoria),
    foreign key(id_producto) references producto (id_producto),
    primary key(id_categoria,id_producto)
);
create table categoriaservicio(
    id_categoria int,
    id_servicio int,
    foreign key(id_categoria) references categoria (id_categoria),
    foreign key(id_servicio) references servicio (id_servicio),
    primary key(id_categoria,id_servicio)
);

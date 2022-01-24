create database actividad1;

use actividad1;

create table productos(
	id int primary key auto_increment not null,
	nombre varchar(255),
	tipo varchar(255),
	cantidad int,
	cantidad_min int,
	precio double,
	estado varchar(1)
);

create table ventas(
	id int primary key auto_increment not null,
	fecha date,
	total double,
	cantidad int,
	producto int
);

create table compras(
	id int primary key auto_increment not null,
	fecha date,
	total double,
	cantidad int,
	producto int,
	proveedor int
);

create table proveedores(
	id int primary key auto_increment not null,
	nombre varchar(150),
	estado varchar(1)
);

alter table ventas
	add constraint fk_producto foreign key (producto) references productos (id);
	
alter table compras
	add constraint fk_producto2 foreign key (producto) references productos (id);
	
alter table compras
	add constraint fk_proveedores foreign key (proveedor) references proveedores (id);

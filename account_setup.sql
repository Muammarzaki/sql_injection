create database sql_inject;

use sql_inject;

create table account(
id int primary key auto_increment,
username varchar(255)unique ,
password varchar(255),
role enum('ADMIN','USER')
)

drop table account ;

desc account;

-- Inserting 7 users with Indonesian names
INSERT INTO account (username, password, role) VALUES
('agus', 'password1', 'USER'),
('budi', 'password2', 'USER'),
('citra', 'password3', 'USER'),
('dewi', 'password4', 'USER'),
('eko', 'password5', 'USER'),
('fitri', 'password6', 'USER'),
('gita', 'password7', 'USER');

-- Inserting 3 admins with Indonesian names
INSERT INTO account (username, password, role) VALUES
('admin1', 'adminpass1', 'ADMIN'),
('admin2', 'adminpass2', 'ADMIN'),('admin', 'admin', 'ADMIN'),
('admin3', 'adminpass3', 'ADMIN');


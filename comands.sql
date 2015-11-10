create database nowall_bbs;

use nowall_bbs;

grant all on nowall_bbs.* to testuser@localhost identified by '9999';

create table users(
  id int primary key auto_increment,
  name varchar (255),
  email varchar(255),
  count varchar(255),
  created_at datetime);

create table posts(
  id int primary key auto_increment,
  name varchar(255),
  message text,
  created_at datetime,
  updated_at datetime);
create database if not exists rps_db;
use rps_db;

create table if not exists player
(
    pk_id    int primary key auto_increment,
    username varchar(255) not null
);

create table if not exists symbol
(
    pk_id        int primary key auto_increment,
    symbol_name  varchar(255) not null,
    fk_game_id   int          not null,
    fk_player_id int          not null
);

create table if not exists games
(
    pk_id          int primary key auto_increment,
    date_played    datetime not null
);

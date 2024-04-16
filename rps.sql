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

insert into player (username) values ('Raven');
insert into player (username) values ('Lisa');
insert into player (username) values ('Roman');
insert into player (username) values ('Severin');

insert into games (date_played) values (sysdate());
insert into games (date_played) values (sysdate());
insert into games (date_played) values (sysdate());
insert into games (date_played) values (sysdate());
insert into games (date_played) values (sysdate());
insert into games (date_played) values (sysdate());

insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('rock', 1, 1);
insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('scissors', 1, 2);

insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('paper', 2, 3);
insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('rock', 2, 4);

insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('scissors', 3, 1);
insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('rock', 3, 3);

insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('rock', 4, 2);
insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('scissors', 4, 4);

insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('paper', 5, 1);
insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('rock', 5, 4);

insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('scissors', 6, 2);
insert into symbol (symbol_name, fk_game_id, fk_player_id) values ('rock', 6, 3);

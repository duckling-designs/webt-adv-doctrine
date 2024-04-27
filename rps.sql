drop database if exists rps_db;
create database if not exists rps_db;
use rps_db;

create table if not exists player
(
    pk_id    int primary key auto_increment,
    username varchar(255) not null
);

create table if not exists symbols
(
    pk_id   int primary key auto_increment,
    symbol  varchar(255) not null
);

create table if not exists rounds
(
    pk_id       int primary key auto_increment,
    date_played datetime not null default current_timestamp,
    fk_player_1 int not null,
    fk_player_2 int not null,
    fk_player_1_symbol int not null,
    fk_player_2_symbol int not null,
    constraint fk_rounds_player_1 foreign key (fk_player_1) references player (pk_id),
    constraint fk_rounds_player_2 foreign key (fk_player_2) references player (pk_id),
    constraint fk_rounds_player_1_symbol foreign key (fk_player_1_symbol) references symbols (pk_id),
    constraint fk_rounds_player_2_symbol foreign key (fk_player_2_symbol) references symbols (pk_id)
);

insert into symbols (symbol) values ('rock');
insert into symbols (symbol) values ('paper');
insert into symbols (symbol) values ('scissors');

insert into player (username) values ('Raven');
insert into player (username) values ('Lisa');
insert into player (username) values ('Sophie');
insert into player (username) values ('Roman');
insert into player (username) values ('Severin');

insert into rounds (date_played, fk_player_1, fk_player_2, fk_player_1_symbol, fk_player_2_symbol) values ('2024-04-16 10:00:00', 1, 2, 1, 2);
insert into rounds (date_played, fk_player_1, fk_player_2, fk_player_1_symbol, fk_player_2_symbol) values ('2024-04-16 11:00:00', 3, 4, 3, 2);
insert into rounds (date_played, fk_player_1, fk_player_2, fk_player_1_symbol, fk_player_2_symbol) values ('2024-04-16 12:00:00', 5, 1, 1, 3);
insert into rounds (date_played, fk_player_1, fk_player_2, fk_player_1_symbol, fk_player_2_symbol) values ('2024-04-16 13:00:00', 2, 3, 2, 3);
insert into rounds (date_played, fk_player_1, fk_player_2, fk_player_1_symbol, fk_player_2_symbol) values ('2024-04-16 14:00:00', 4, 5, 1, 1);

select rounds.pk_id as 'Round ID', p.username as 'Player 1', s.symbol as 'Player 1 Symbol', p2.username as 'Player 2', s2.symbol as 'Player 2 Symbol', rounds.date_played as 'Date Played'
from rounds
join player p on p.pk_id = rounds.fk_player_1
join symbols s on rounds.fk_player_1_symbol = s.pk_id
join player p2 on p2.pk_id = rounds.fk_player_2
join symbols s2 on rounds.fk_player_2_symbol = s2.pk_id
order by rounds.pk_id;

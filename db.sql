create table tasks (
    id integer primary key AUTO_INCREMENT,
    title text not null,
    done boolean default 0
);
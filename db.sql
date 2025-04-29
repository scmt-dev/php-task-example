create table tasks (
    id integer primary key AUTO_INCREMENT,
    title text not null,
    done boolean default 0
);

create table products (
    id integer primary key AUTO_INCREMENT,
    name varchar(100) not null,
    price decimal(10,2),
    description text
);
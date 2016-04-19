create table if not exists rebuilds (
  id int auto_increment,
  email varchar(100) not null,
  ticket_num int not null,
  service varchar(100) not null,
  build_type varchar(100) not null,
  os varchar(100) not null,
  reason varchar(100) not null,
  computer varchar(100) not null,
  notes varchar(5000),
  primary key(id)
);

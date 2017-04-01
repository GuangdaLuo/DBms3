CREATE TABLE User(
    user_id         int             NOT NULL,
    user_name       varchar(100)    NOT NULL,
    manager_id      varchar(50)     default 0,
    email           varchar(100)    NOT NULL,
    password        varchar(100)    NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE TABLE Portfolio(
    id                  int     NOT NULL,
    value               float   default 0,
    client_id           int     NOT NULL,
    manager_id          int,
    cash_amout          float,
    performance_fee     float,  
    management_fee      float,
    PRIMARY KEY (id),
    foreign key (client_id)     references  User(user_id)   on delete cascade,
    foreign key (manager_id)    references  User(user_id)   on delete set null
);

CREATE TABLE Asset(
    asset_id        int             NOT NULL,
    asset_name      varchar(100)    NOT NULL,
    price           float           NOT NULL,
    type            varchar(20)     NOT NULL,
    PRIMARY KEY (asset_id)
);

CREATE TABLE Stock(
    stock_id        int     NOT NULL,
    PRIMARY KEY (stock_id),
    foreign key(stock_id) references Asset(asset_id)
);

CREATE TABLE Bond(
    bond_id         int     NOT NULL,
    maturity        date    NOT NULL,
    PRIMARY KEY (bond_id),
    foreign key (bond_id) references Asset(asset_id) on delete cascade
);

CREATE TABLE Transaction(
    id              int     NOT NULL,
    trans_time      int     NOT NULL,
    units           int     default 1,
    portfolio_id    int     NOT NULL,
    unit_price      float,
    asset_id        int     NOT NULL,
    PRIMARY KEY (id),
    foreign key (portfolio_id) references Portfolio(id)   on delete no action,
    foreign key (asset_id) references Asset(asset_id)     on delete no action
    
);

CREATE TABLE Percentage(
    asset_id        int             NOT NULL,
    asset_name      varchar(200)    NOT NULL,
    percentage      float           default 0,
    units           int             default 1,
    unit_price      float           NOT NULL,
    portfolio_id    int             NOT NULL,
    PRIMARY KEY (asset_id, portfolio_id),
    foreign key (asset_id) references Asset(asset_id)       on delete cascade,
    foreign key (portfolio_id) references Portfolio(id)     on delete cascade
);


USE 'balance_service';

CREATE TABLE BALANCES
(
    ID       INT AUTO_INCREMENT
        PRIMARY KEY,
    USER_ID  INT        NOT NULL,
    BALANCE  INT        NOT NULL,
    CURRENCY VARCHAR(3) NOT NULL
);

CREATE TABLE TRANSACTIONS
(
    ID          INT AUTO_INCREMENT
        PRIMARY KEY,
    USER_ID     INT          NOT NULL,
    BALANCE     INT          NOT NULL,
    DESCRIPTION VARCHAR(255) NULL,
    CURRENCY    VARCHAR(3)   NOT NULL,
    TYPE        VARCHAR(255) NOT NULL,
    DATE        DATETIME     NOT NULL
);
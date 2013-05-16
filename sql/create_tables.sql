SET SQLBLANKLINES ON
/*
    INITIATING



WORKFLOW FOR DATABASE GENERATION

- Do create_tables.sql
- Do create_views.sql
- Do create_procedures.sql
- Do create_roles.sql
- Run the init.php from the source code! IMPORTANT! DO WITH FOLLOWING URL:
    init.php?dba=1
- Do the create_data.sql (init.php need to have runned before this for 
    constraint-purposes)


*/




/*
    CREATING TABLES
*/

/*----------------------------------Users-------------------------------------*/

CREATE TABLE ibankUser(
    
    login_id number(11) PRIMARY KEY NOT NULL,
    full_name varchar2(50) NOT NULL,
    address_id number(11) NOT NULL,
    pword varchar2(200) NOT NULL,
    priv number(1) DEFAULT 1 NOT NULL,
    contact_number VARCHAR2(10)
);

/*For auto_increment*/
CREATE SEQUENCE login_id_seq START WITH 13371337 INCREMENT BY 1;

CREATE OR REPLACE trigger login_id_trig
BEFORE INSERT ON ibankUser
FOR EACH ROW
BEGIN
    SELECT login_id_seq.nextval INTO :new.login_id FROM dual;
END;
/

/*-------------------------------Address--------------------------------------*/

CREATE TABLE ibankAddress(

    address_id number(11) PRIMARY KEY NOT NULL,
    street_address varchar2(200) NOT NULL,
    county varchar2(50) NOT NULL,
    suburb_id number(11) NOT NULL
);

/*For auto_increment*/
CREATE SEQUENCE address_id_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE trigger address_id_trig
BEFORE INSERT ON ibankAddress
FOR EACH ROW
BEGIN
    SELECT address_id_seq.nextval INTO :new.address_id FROM dual;
END;
/



/*----------------------------------Suburb------------------------------------*/

CREATE TABLE ibankSuburb(
    suburb_id number(11)PRIMARY KEY NOT NULL, 
    postcode varchar2(4) NOT NULL, 
    suburb_name varchar2(50)
);

/*For auto_increment*/
CREATE SEQUENCE suburb_id_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE trigger suburb_id_trig
BEFORE INSERT ON ibankSuburb
FOR EACH ROW
BEGIN
    SELECT suburb_id_seq.nextval INTO :new.suburb_id FROM dual;
END;
/

/*---------------------------------Account------------------------------------*/

CREATE TABLE ibankAccount(
    account_number number(8) PRIMARY KEY NOT NULL,
    staff_user_id number(11) NOT NULL,
    login_user_id number(11) NOT NULL,
    login_user_id2 number(11),
    balance number(*,4) DEFAULT 0.0,
    date_opened date DEFAULT SYSDATE,
    type_of_account number(11) DEFAULT 1 NOT NULL,
    interest_sum number(*,4) DEFAULT 0.0 NOT NULL
); 

/*For auto_increment*/
CREATE SEQUENCE account_number_seq START WITH 13371337 INCREMENT BY 7331;

CREATE OR REPLACE trigger account_number_trig
BEFORE INSERT ON ibankAccount
FOR EACH ROW
BEGIN
    SELECT account_number_seq.nextval INTO :new.account_number FROM dual;
END;
/

/*------------------------------AccountType-----------------------------------*/

CREATE TABLE ibankAccountType (
    type_id number(11) PRIMARY KEY NOT NULL,
    name varchar2(50) NOT NULL,
    interest_rate number(6,4) DEFAULT 0 NOT NULL
);

/*For auto_increment*/
CREATE SEQUENCE type_id_seq START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE trigger type_id_trig
BEFORE INSERT ON ibankAccountType
FOR EACH ROW
BEGIN
    SELECT type_id_seq.nextval INTO :new.type_id FROM dual;
END;
/

/*----------------------------Transaction-------------------------------------*/

CREATE TABLE ibankTransaction (
    transaction_id number(11) PRIMARY KEY NOT NULL,
    from_account number(8) NOT NULL,
    to_account number(8) NOT NULL,
    memo varchar2(18),
    amount number(*,2) NOT NULL,
    date_of_transaction date DEFAULT SYSDATE
);

/*For auto_increment*/
CREATE SEQUENCE transaction_id_seq START WITH 100001 INCREMENT BY 1;

CREATE OR REPLACE trigger transaction_id_trig
BEFORE INSERT ON ibankTransaction
FOR EACH ROW
BEGIN
    SELECT transaction_id_seq.nextval INTO :new.transaction_id FROM dual;
END;
/

/*
    ALTERING TABLES, foreign keys and such
*/

/*--------------------------------ALTERS--------------------------------------*/
ALTER TABLE ibankUser
add CONSTRAINT fk_address
    FOREIGN KEY (address_id)
    REFERENCES ibankAddress(address_id);

ALTER TABLE ibankAddress
add CONSTRAINT fk_suburb
    FOREIGN KEY (suburb_id)
    REFERENCES ibankSuburb(suburb_id);


ALTER TABLE ibankAccount
add CONSTRAINT fk_login_staff
    FOREIGN KEY (staff_user_id)
    REFERENCES ibankUser(login_id);

ALTER TABLE ibankAccount
add CONSTRAINT fk_login_user
    FOREIGN KEY (login_user_id)
    REFERENCES ibankUser(login_id);

ALTER TABLE ibankAccount
add CONSTRAINT fk_login_user2
    FOREIGN KEY (login_user_id2)
    REFERENCES ibankUser(login_id);

ALTER TABLE ibankAccount
add CONSTRAINT fk_account_type
    FOREIGN KEY (type_of_account)
    REFERENCES ibankAccountType(type_id);

ALTER TABLE ibankTransaction
add CONSTRAINT fk_transaction_from
    FOREIGN KEY (from_account)
    REFERENCES ibankAccount(account_number);

ALTER TABLE ibankTransaction
add CONSTRAINT fk_transaction_to
    FOREIGN KEY (to_account)
    REFERENCES ibankAccount(account_number);

COMMIT;

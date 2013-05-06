/*
    structure.sql
*/
DROP TABLE user;
CREATE TABLE user(
    
    login_id number(11) PRIMARY KEY,
    full_name varchar2(50),
    address_id number(11),
    password varchar2(200),
    priv number(1),
    contact_number number(10)
);

DROP TABLE address;
CREATE TABLE address(

    address_id number(11) PRIMARY KEY,
    street_address varchar2(200),
    suburb varchar2(50),
    post_code_id number(11)
);

DROP TABLE postcode;
CREATE TABLE postcode(

    post_code_id number(11) PRIMARY KEY,
    postal_code number(4)
);

DROP TABLE account;
CREATE TABLE account(
    account_number number(8) PRIMARY KEY,
    staff_user_id number(11),
    login_user_id number(11),
    login_user_id2 number(11),
    balance number(*,4),
    date_opened date,
    type_of_account number(11),
    interest_sum number(*,4)
); 

DROP TABLE accountType;
CREATE TABLE accountType (
    type_id number(11) PRIMARY KEY,
    name varchar2(50),
    interest_rate number(2,4)
);

DROP TABLE transaction;
CREATE TABLE transaction (
    transaction_id number(11) PRIMARY KEY,
    from_account number(8),
    to_account number(8),
    memo varchar2(18),
    amount number(*,2),
    date_of_transaction date
)



ALTER TABLE user
add CONSTRAINT fk_address
    FOREIGN KEY (address_id)
    REFERENCES address(address_id);

ALTER TABLE address
add CONSTRAINT fk_postcode
    FOREIGN KEY (post_code_id)
    REFERENCES postcode(post_code_id);

ALTER TABLE account
add CONSTRAINT fk_login
    FOREIGN KEY (staff_user_id, login_user_id,login_user_id2)
    REFERENCES user(login_id, login_id, login_id);

ALTER TABLE account
add CONSTRAINT fk_account_type
    FOREIGN KEY (type_of_account)
    REFERENCES accountType(type_id);

ALTER TABLE transaction
add CONSTRAINT fk_transaction
    FOREIGN KEY (from_account, to_account)
    REFERENCES account(account_number, account_number);




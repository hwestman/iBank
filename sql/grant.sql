SET SQLBLANKLINES ON
drop table users;
CREATE TABLE users(
    
    login_id number(11) PRIMARY KEY,
    full_name varchar2(50),
    address_id number(11),
    pword varchar2(200),
    priv number(1),
    contact_number number(10)
);
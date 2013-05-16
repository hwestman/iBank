/* roles */
SET SQLBLANKLINES ON


/*
this below displays priveleges on logged on user
SELECT * FROM USER_SYS_PRIVS;

need to kick out a user?
select sid,username,serial# from v$session
alter system kill session '<sid>,<serial#>'


THE IBANKDBA USER(below) NEEDS TO BE CREATED BEFORE RUNNING STRUCTURE.SQL, WHICH
AGAIN NEEDS TO BE EXECUTED BEFORE THIS SCRIPT

CREATE USER ibank_dba IDENTIFIED BY billybob;
grant dba to ibank_dba;
Alter user ibank_dba default tablespace DBS_SPACE;
Alter user ibank_dba temporary tablespace TEMP;
Alter user ibank_dba quota 10M on DBS_SPACE;

*/

CREATE USER ibank_manager IDENTIFIED BY billybob;
Grant connect to ibank_manager;
Grant create sequence to ibank_manager;
Alter user ibank_manager default tablespace DBS_SPACE;
Alter user ibank_manager temporary tablespace TEMP;
Alter user ibank_manager quota 10M on DBS_SPACE;

CREATE USER ibank_teller IDENTIFIED BY billybob;
Grant connect to ibank_teller;
Grant create sequence to ibank_teller;
Alter user ibank_teller default tablespace DBS_SPACE;
Alter user ibank_teller temporary tablespace TEMP;
Alter user ibank_teller quota 10M on DBS_SPACE;

CREATE USER ibank_customer IDENTIFIED BY billybob;
Grant connect to ibank_customer;
Grant create sequence to ibank_customer;
Alter user ibank_customer default tablespace DBS_SPACE;
Alter user ibank_customer temporary tablespace TEMP;
Alter user ibank_customer quota 10M on DBS_SPACE;


create role ibank_customer_role;
create role ibank_teller_role;
create role ibank_manager_role;


/*
Customer specific privileges
*/
GRANT SELECT ON ibankUser TO ibank_customer_role;
GRANT SELECT ON ibankAddress TO ibank_customer_role;

GRANT SELECT ON ibankAccount TO ibank_customer_role;
GRANT SELECT ON ibankAccountType TO ibank_customer_role;
GRANT SELECT ON ibankTransaction TO ibank_customer_role;
GRANT SELECT ON ibankSuburb TO ibank_customer_role;
GRANT SELECT ON user_info_view TO ibank_customer_role;
GRANT EXECUTE ON transferFunds TO ibank_customer_role;
GRANT EXECUTE ON updateInterestRate TO ibank_customer_role;
GRANT EXECUTE ON bankDeposit TO ibank_customer_role;
GRANT EXECUTE ON updateUser TO ibank_customer_role;

GRANT ALTER ON ibankUser TO ibank_customer_role;
GRANT ALTER ON ibankAddress TO ibank_customer_role;
GRANT ALTER ON ibankSuburb TO ibank_customer_role;
GRANT ALTER ON ibankAccount TO ibank_customer_role;
/*
Cascading privileges to teller
*/
GRANT ibank_customer_role TO ibank_teller_role;

/*
Spesific tller privileges
*/
GRANT INSERT ON ibankUser TO ibank_teller_role;
GRANT INSERT ON ibankAddress TO ibank_teller_role;
GRANT INSERT ON ibankSuburb TO ibank_teller_role;
GRANT SELECT ON customer_info_view TO ibank_customer_role;
GRANT SELECT ON transaction_data_view TO ibank_customer_role;

/*
cascading privileges to manager
*/
GRANT ibank_teller_role TO ibank_manager_role;

/*
Specific manager priveleges
*/
GRANT ALTER ON ibankAccountType TO ibank_manager_role;
GRANT INSERT ON ibankUser TO ibank_manager_role;
GRANT INSERT ON ibankAddress TO ibank_manager_role;
GRANT INSERT ON ibankSuburb TO ibank_manager_role;

   
GRANT ibank_customer_role to ibank_customer;
GRANT ibank_teller_role to ibank_teller;
GRANT ibank_manager_role to ibank_manager;

COMMIT;


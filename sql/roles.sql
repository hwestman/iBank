/* roles */
SET SQLBLANKLINES ON


/*
this below displays priveleges on logged on user
SELECT * FROM USER_SYS_PRIVS;

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


GRANT SELECT 
    ON ibankUsers,ibankAddress,ibankPostcode,ibankAccount,ibankAccountType,ibankTransaction 
    TO ibank_customer,ibank_teller,ibank_manager;

GRANT ALTER
    ON ibankUsers,ibankAddress,ibankPostcode,ibankAccount
    TO ibank_customer,ibank_teller,ibank_manager;

GRANT ALTER
    ON ibankAccountType
    TO ibank_manager;

GRANT INSERT
    ON ibankUsers,ibankAddress,ibankPostcode
    TO ibank_teller,ibank_manager;

   

COMMIT;


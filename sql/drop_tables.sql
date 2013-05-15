
/* sqlplus s2873575@dwarf @drop_tables.sql */
SET SQLBLANKLINES ON


DROP SEQUENCE transaction_id_seq;
DROP TRIGGER transaction_id_trig;
DROP TABLE ibankTransaction;

DROP SEQUENCE account_number_seq;
DROP TRIGGER account_number_trig;
DROP TABLE ibankAccount;

DROP SEQUENCE type_id_seq;
DROP TRIGGER type_id_trig;
DROP TABLE ibankAccountType;

DROP SEQUENCE login_id_seq;
DROP TRIGGER login_id_trig;
DROP TABLE ibankUser;

DROP SEQUENCE address_id_seq;
DROP TRIGGER address_id_trig;
DROP TABLE ibankAddress;


DROP SEQUENCE suburb_id_seq;
DROP TRIGGER suburb_id_trig;
DROP TABLE ibankSuburb;









/*
    VIEWS
*/
DROP VIEW user_info_view;
DROP VIEW account_info_view;






COMMIT;

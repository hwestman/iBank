SET SQLBLANKLINES ON
/*
DROP USER ibank_dba CASCADE;
*/
DROP USER ibank_manager CASCADE;
DROP USER ibank_teller CASCADE;
DROP USER ibank_customer CASCADE;

DROP ROLE ibank_manager_role;
DROP ROLE ibank_teller_role;
DROP ROLE ibank_customer_role;


COMMIT;
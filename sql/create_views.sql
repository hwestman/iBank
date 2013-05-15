/*
    views.sql
rlwrap -c sqlplus ibank_dba/billybob@dwarf @views.sql
*/
SET SQLBLANKLINES ON
CREATE OR REPLACE VIEW user_info_view AS
    SELECT U.login_id,U.full_name,U.contact_number,A.street_address,S.postcode
    FROM ibankUser U
    LEFT JOIN ibankAddress A ON U.address_id = A.address_id
    LEFT JOIN ibankSuburb S ON A.suburb_id = S.suburb_id;

CREATE OR REPLACE VIEW account_info_view AS
    
    SELECT U.login_id,A.account_number,A.balance,A.interest_sum,A.type_of_account
    FROM ibankAccount A
    LEFT JOIN ibankUser U on U.login_id = A.login_user_id
    
    WITH READ ONLY;

CREATE OR REPLACE VIEW customer_info_view AS
    
    SELECT U.login_id,U.full_name,U.contact_number,U.street_address,U.postcode,A.account_number,A.balance,A.interest_sum,A.type_of_account
    FROM account_info_view A
    LEFT JOIN user_info_view U on U.login_id = A.login_id
    
    WITH READ ONLY;




COMMIT;


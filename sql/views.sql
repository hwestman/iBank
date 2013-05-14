/*
    views.sql
rlwrap -c sqlplus ibank_dba/billybob@dwarf @views.sql
*/
SET SQLBLANKLINES ON
CREATE OR REPLACE VIEW user_info_view AS
    SELECT U.login_id,U.full_name,U.contact_number,A.street_address,S.postcode
    FROM ibankUsers U
    LEFT JOIN ibankAddress A ON U.address_id = A.address_id
    LEFT JOIN ibankSuburb S ON A.suburb_id = S.suburb_id;

CREATE OR REPLACE VIEW account_info_view AS
    
    SELECT 
    SELECT U.login_id,U.full_name,U.contact_number,A.street_address,S.postcode
    FROM ibankUsers U
    LEFT JOIN ibankAddress A ON U.address_id = A.address_id
    LEFT JOIN ibankSuburb S ON A.suburb_id = S.suburb_id;



COMMIT;


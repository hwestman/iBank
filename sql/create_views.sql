/*
    views.sql
rlwrap -c sqlplus ibank_dba/billybob@dwarf @views.sql
*/
SET SQLBLANKLINES ON
CREATE OR REPLACE VIEW user_info_view AS
    SELECT U.login_id,U.full_name,U.contact_number,A.street_address,S.postcode,S.suburb_name
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
/*
    getting data concerning a transaction, the from-user and to-user
*/
CREATE OR REPLACE VIEW transaction_data_view AS
    SELECT  T.transaction_id, T.from_account,T.to_account, T.amount,T.memo,T.date_of_transaction,
            AFROM.login_user_id AS login_user_id_from,UFROM.full_name AS full_name_from,
            ATO.login_user_id AS login_user_id_to,UTO.full_name AS full_name_to
    FROM ibank_dba.ibankTransaction T 
    LEFT JOIN ibankAccount AFROM on T.from_account = AFROM.account_number 
    LEFT JOIN ibankUser UFROM on AFROM.login_user_id = UFROM.login_id 
    LEFT JOIN ibankAccount ATO on T.to_account = ATO.account_number
    LEFT JOIN ibankUser UTO on ATO.login_user_id = UTO.login_id;




COMMIT;


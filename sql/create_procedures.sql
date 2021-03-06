/*
    procedures.sql
    
    sqlplus ibank_dba/billybob@dwarf @drop_tables.sql
    sqlplus ibank_dba/billybob@dwarf @structure.sql
    sqlplus ibank_dba/billybob@dwarf @sampleData.sql
    sqlplus ibank_dba/billybob@dwarf @create_procedures.sql
    
    EXEC createAccount(1,4,'',2);
    
    select * from SYS.USER_ERRORS;
    
    SELECT createAccount(1,4,'',2) FROM DUAL;
    
    DECLARE
    BEGIN
    END
    	
    	//// CREATE USER PROCUEDRE ////
    	VARIABLE loginUserID NUMBER;
		EXEC createUser('5','35 Serafina Drive','Queensland', 'Lance N. Solomon', 'shanaye', 4, '0421008826', :loginUserID);
		PRINT loginUserID;
		/
    
		//// CREATING ACCOUNT FUNCTION ////
    	variable accountNumber NUMBER;
    	EXEC createAccount(1,4,4, :accountNumber);
    	PRINT accountNumber;
    	/
    	
    	//// TRANSFER FUNDS PROCEDURE ////
    	variable receiptNumber NUMBER;
    	EXEC transferFunds(18283004,18280330,'HELLO',300.25, :receiptNumber);
    	PRINT receiptNumber;
    	/
    	
    	//// BANK DEPOSIT PROCEDURE ////
    	variable receiptNumber NUMBER;
    	EXEC bankDeposit(13371337,18284341,'Back',100, :receiptNumber);
    	PRINT receiptNumber;
    	/
    	
    	//// ACCUMULATE INTEREST PROCEDURE ////
    	VARIABLE interestSum NUMBER;
    	EXEC accumulateInterest(:interestSum);
    	/
    	
    	//// PAYOUT INTEREST PROCEDURE ////
    	VARIABLE interestSum NUMBER;
    	EXEC payoutInterest(:interestSum);
    	/
    	
*/

SET SQLBLANKLINES ON
/*////////////////////////////////////////////// PROCEDURES ////////////////////////////////////////////////////////////////////////*/

/*///////////////////////////// CREATING A USER PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE createUser (
	suburbID IN VARCHAR2,
	streetAddress IN VARCHAR2,
	county IN VARCHAR2,
	fullName IN VARCHAR2,  
	pword IN VARCHAR2, 
	priv IN NUMBER, 
	contactNumber IN VARCHAR2,
	loginID OUT NUMBER
)
AS
addressID NUMBER;
BEGIN	
	INSERT INTO ibankAddress
		VALUES ('', streetAddress, county, suburbID)
		RETURNING address_id INTO addressID;
	
	INSERT INTO ibankUser
		VALUES ('', fullName, addressID, pword, priv, contactNumber)
		RETURNING login_id INTO loginID;
	COMMIT;
	RETURN;
END;
/

/*///////////////////////////// CREATING AN ACCOUNT PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE createAccount (
	staffID IN NUMBER,
	loginID IN NUMBER,
	accountType IN NUMBER,
	accountNumber OUT NUMBER
)
AS
BEGIN	
	INSERT INTO ibankAccount
		(account_number, staff_user_id, login_user_id, type_of_account)
		VALUES ('', staffID, loginID, accountType)
		RETURNING account_number INTO accountNumber;
	COMMIT;
	RETURN;
END;
/

/*///////////////////////////// TRANSFER FUNDS PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE transferFunds (
	accountFrom IN NUMBER,
	accountTo IN NUMBER,
	message IN VARCHAR2,
	money IN NUMBER,	
	receiptNumber OUT NUMBER
)
AS
fromAmount NUMBER;
BEGIN	
	SELECT balance INTO fromAmount FROM ibankAccount WHERE accountFrom = account_number;

	fromAmount := fromAmount - money;
	
	IF fromAmount < 0 THEN
		RETURN;
	ELSE
		INSERT INTO ibankTransaction
			(transaction_id, from_account, to_account, memo, amount)
			VALUES ('', accountFrom, accountTo, message, money)
			RETURNING transaction_id INTO receiptNumber;
		
		UPDATE ibankAccount
			SET balance = balance - money WHERE accountFrom = ibankAccount.account_number;
		
		UPDATE ibankAccount
			SET balance = balance + money WHERE accountTo = ibankAccount.account_number;
		
		IF receiptNumber > 0 THEN
			COMMIT;
			RETURN;
		ELSE
			ROLLBACK;
		END IF;
	END IF;
END;
/

/*///////////////////////////// BANK DEPOSIT PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE bankDeposit (
	accountFrom IN NUMBER,
	accountTo IN NUMBER,
	message IN VARCHAR2,
	money IN NUMBER,	
	receiptNumber OUT NUMBER
)
AS
fromAmount NUMBER;
BEGIN	
	INSERT INTO ibankTransaction
		(transaction_id, from_account, to_account, memo, amount)
		VALUES ('', accountFrom, accountTo, message, money)
		RETURNING transaction_id INTO receiptNumber;
	
	UPDATE ibankAccount
		SET balance = balance + money WHERE accountTo = ibankAccount.account_number;
	
	IF receiptNumber > 0 THEN
		COMMIT;
		RETURN;
	ELSE
		ROLLBACK;
	END IF;
END;
/

/*///////////////////////////// ACCUMULATE INTEREST PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE accumulateInterest(
	interestSum OUT NUMBER
)
AS
accountNumber NUMBER;
interestRate NUMBER (20,18);
accountType NUMBER;
bankBalance NUMBER;
tmp NUMBER;
interestBalance NUMBER;

cursor account_tmp IS SELECT account_number FROM ibankAccount;

BEGIN
	OPEN account_tmp;
	LOOP
		FETCH account_tmp INTO accountNumber;
		EXIT WHEN account_tmp%NOTFOUND;
			
			SELECT 	balance INTO bankBalance
					FROM ibankAccount
					WHERE accountNumber = account_number;
			SELECT 	type_of_account INTO accountType
					FROM ibankAccount
					WHERE accountNumber = account_number;	
			SELECT 	interest_sum INTO interestBalance 
					FROM ibankAccount
					WHERE accountNumber = account_number;	
			SELECT 	interest_rate INTO interestRate
					FROM ibankAccountType
					WHERE accountType = type_id;
			
			interestRate := interestRate/365;
			interestRate := interestRate/100;
			tmp := interestBalance + bankBalance;
			tmp := tmp*interestRate;
			interestBalance := tmp + interestBalance;
			
			UPDATE ibankAccount
				SET interest_sum = interestBalance WHERE accountNumber = account_number;
			COMMIT;
	END LOOP;
	RETURN;
END;
/

/*///////////////////////////// ACCUMULATE INTEREST PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE payoutInterest(
	interestSum OUT NUMBER
)
AS
accountNumber NUMBER;
bankBalance NUMBER;
interestBalance NUMBER;

cursor account_tmp IS SELECT account_number FROM ibankAccount;

BEGIN
	OPEN account_tmp;
	LOOP
		FETCH account_tmp INTO accountNumber;
		EXIT WHEN account_tmp%NOTFOUND;
			
			SELECT 	balance INTO bankBalance
					FROM ibankAccount
					WHERE accountNumber = account_number;	
			SELECT 	interest_sum INTO interestBalance 
					FROM ibankAccount
					WHERE accountNumber = account_number;	
					
			bankBalance := interestBalance + bankBalance;
			
			UPDATE ibankAccount
				SET balance = bankBalance, interest_sum = 0 WHERE accountNumber = account_number;
				
			INSERT INTO ibankTransaction
				(transaction_id, from_account, to_account, memo, amount)
				VALUES ('', 13371337, accountNumber, 'Interest', interestBalance);
			COMMIT;
	END LOOP;
	RETURN;
END;
/

/*///////////////////////////// UPDATE INTEREST RATE PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE updateInterestRate (
	savings IN NUMBER,
	credit IN NUMBER,
	cheque IN NUMBER,
	loan IN NUMBER
)
AS
interestRate NUMBER;
BEGIN	
		UPDATE ibankAccountType
			SET interest_rate = savings
			WHERE type_id = 1;
		UPDATE ibankAccountType
			SET interest_rate = credit
			WHERE type_id = 2;
		UPDATE ibankAccountType
			SET interest_rate = cheque
			WHERE type_id = 3;
		UPDATE ibankAccountType
			SET interest_rate = loan
			WHERE type_id = 4;
		COMMIT;
		RETURN;
END;
/
/*
    EXEC updateUser(7,'carlton_2','3696',95935336,'newPassword','new StreetAddress');

        variable address_id NUMBER;
    	EXEC :address_id := ibank_dba.updateUser(13371337,'John McClain','1337',911,'billybob','kake');
    	PRINT address_id;


*/

/*///////////////////////////// UPDATE USER PROCEDURE /////////////////////////////*/
CREATE OR REPLACE PROCEDURE updateUser(
	login_id_ IN NUMBER,
    full_name_ IN VARCHAR2,
	suburb_id_ IN NUMBER,
	county_ IN VARCHAR2,
    contact_number_ IN NUMBER,
    pword_ IN VARCHAR2,
	street_address_ IN VARCHAR2)
AS
    address_id_ NUMBER;
BEGIN	
    
    SELECT address_id INTO address_id_
                FROM ibankUser
                WHERE login_id = login_id_;

    UPDATE ibankAddress 
        SET suburb_id = suburb_id_,
            street_address = street_address_,
            county = county_
        WHERE address_id = address_id_;
        
    UPDATE ibankUser
        SET full_name = full_name_,
            contact_number = contact_number_,
            pword = pword_
        WHERE login_id = login_id_;
            
        
        COMMIT;
        RETURN;
        
    --COMMIT;
END;
/
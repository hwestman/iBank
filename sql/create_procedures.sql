/*
    procedures.sql
    
    sqlplus ibank_dba/billybob@dwarf @drop_tables.sql
    sqlplus ibank_dba/billybob@dwarf @structure.sql
    sqlplus ibank_dba/billybob@dwarf @sampleData.sql
    sqlplus ibank_dba/billybob@dwarf @create_procedures.sql
    
    EXEC createAccount(1,4,'',2);
    
    SELECT createAccount(1,4,'',2) FROM DUAL;
    
    DECLARE
    BEGIN
    END
    	
    	//// CREATE USER PROCUEDRE ////
    	VARIABLE loginUserID NUMBER;
		EXEC createUser('5','35 Serafina Drive','Queensland', 'Lance N. Solomon', 'shanaye', 4, '0421008826', :loginUserID);
		PRINT loginUserID;
		/
    
		//// CREATING ACCOUNT PROCEDURE ////
    	variable accountNumber NUMBER;
    	EXEC :accountNumber := createAccount(1,4,'',4);
    	PRINT accountNumber;
    	/
    	
    	variable receiptNumber NUMBER;
    	EXEC transferFunds(18283004,18280330,'Enjoy',300.25, :receiptNumber);
    	PRINT receiptNumber;
    	/
*/

SET SQLBLANKLINES ON

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

/*///////////////////////////// CREATING AN ACCOUNT FUNCTION /////////////////////////////*/
CREATE OR REPLACE FUNCTION createAccount (
	staffID IN NUMBER,
	loginID IN NUMBER,
	loginID2 IN NUMBER,
	accountType IN NUMBER
)
RETURN NUMBER
IS
accountNumber NUMBER;
BEGIN	
		INSERT INTO ibankAccount
			(account_number, staff_user_id, login_user_id, login_user_id2, type_of_account)
			VALUES ('', staffID, loginID, loginID2, accountType)
			RETURNING account_number INTO accountNumber;
			COMMIT;
			RETURN accountNumber;
END;
/

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
    
    
    
    	variable accountNumber NUMBER;
    	EXEC :accountNumber := createAccount(1,4,'',4);
    	PRINT accountNumber;
    	/
    	
    	variable receiptNumber NUMBER;
    	EXEC :receiptNumber := transferFunds(18283004,18280330,'Enjoy',15000);
    	PRINT receiptNumber;
    	/
*/

SET SQLBLANKLINES ON

EXEC createUser('5','35 Serafina Drive','Queensland', 'Lance N. Solomon', 'shanaye', 4, '0421008826');

CREATE OR REPLACE PROCEDURE createUser (
	suburbID IN VARCHAR2,
	streetAddress IN VARCHAR2,
	county IN VARCHAR2,
	fullName IN VARCHAR2,  
	pword IN VARCHAR2, 
	priv IN INTEGER, 
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
END;
/
select * from SYS.USER_ERRORS;




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


CREATE OR REPLACE PROCEDURE transferFunds (
	accountFrom IN NUMBER,
	accountTo IN NUMBER,
	message IN VARCHAR2,
	money IN NUMBER,
	receiptNumber OUT NUMBER
)
RETURN NUMBER
AS
fromAmount NUMBER;
BEGIN	
		SELECT balance FROM ibankAccount WHERE accountFrom = account_number;
		RETURNING balance INTO fromAmount;

		fromAmount := fromAmount - money;
		
		IF fromAmount < 0 THEN
			RETURN 0;
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
				RETURN receiptNumber;
			ELSE
				ROLLBACK;
				RETURN 0;
			END IF;
		END IF;
END;
/

select * from SYS.USER_ERRORS;

/* TEXT BOOK EXAMPLE

CREATE PROCEDURE remove_emp (employee_id NUMBER) AS
tot_emps NUMBER;
BEGIN
   DELETE FROM employees
   WHERE employees.employee_id = remove_emp.employee_id;
tot_emps := tot_emps - 1;
END;
/


CREATE PROCEDURE Addlnventory (
	IN book_isbn CHAR(lO),
	IN addedQty INTEGER)

UPDATE Books
	SET qty_in_stock = qtyjn_stock + addedQty
	WHERE bookjsbn = isbn
	
END TEXT BOOK EXAMPLE */
/*
    procedures.sql
    
    sqlplus ibank_dba/billybob@dwarf @drop_tables.sql
    sqlplus ibank_dba/billybob@dwarf @structure.sql
    sqlplus ibank_dba/billybob@dwarf @sampleData.sql
    sqlplus ibank_dba/billybob@dwarf @procedures.sql
    
    EXEC createAccount(1,4,'',2);
    
    SELECT createAccount(1,4,'',2) FROM DUAL;
    
    	variable accountNumber NUMBER;
    	EXEC :accountNumber := createAccount(1,4,'',4);
    	PRINT accountNumber;
    	/
*/

SET SQLBLANKLINES ON

CREATE OR REPLACE PROCEDURE createUser (
	suburbID IN VARCHAR2,
	streetAddress IN VARCHAR2,
	county IN VARCHAR2,
	fullName IN VARCHAR2,  
	pword IN VARCHAR2, 
	priv IN INTEGER, 
	contactNumber IN VARCHAR2
)
AS
addressID NUMBER;
BEGIN	
	INSERT INTO ibankAddress
		VALUES ('', streetAddress, county, suburbID)
		RETURNING address_id INTO addressID;
	
	INSERT INTO ibankUser
		VALUES ('', fullName, addressID, pword, priv, contactNumber);
END;
/

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
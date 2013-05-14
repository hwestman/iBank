/*
    procedures.sql
    
    sqlplus ibank_dba/billybob@dwarf @drop_tables.sql
    sqlplus ibank_dba/billybob@dwarf @structure.sql
    sqlplus ibank_dba/billybob@dwarf @sampleData.sql
    sqlplus ibank_dba/billybob@dwarf @procedures.sql
    
    EXEC createUser('Hallvard Westman','17','phoebe','4', '0466894751');
*/

SET SQLBLANKLINES ON

CREATE OR REPLACE PROCEDURE createUser (
	streetAddress IN VARCHAR2,
	county IN VARCHAR2,
	suburbID IN VARCHAR2,
	fullName IN VARCHAR2,  
	pword IN VARCHAR2, 
	priv IN INTEGER, 
	contactNumber IN VARCHAR2
)
IS
BEGIN
	DECLARE addressID INTEGER;
	INSERT INTO ibankAddress
		VALUES ('', streetAddress, county, suburbID)
		RETURNING address_id INTO addressID;
	INSERT INTO ibankUsers
		VALUES ('', fullName, addressID, pword, priv, contactNumber);
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
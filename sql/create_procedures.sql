/*
    procedures.sql
    
    sqlplus ibank_dba/billybob@dwarf @drop_tables.sql
    sqlplus ibank_dba/billybob@dwarf @structure.sql
    sqlplus ibank_dba/billybob@dwarf @sampleData.sql
    sqlplus ibank_dba/billybob@dwarf @procedures.sql
    
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
/*
    procedures.sql
*/

CREATE PROCEDURE createUser (
IN fullname CHAR(5O),
IN addressID INTEGER,
IN pword CHAR(200),
IN priv CINTEGER,
IN contactNumber INTEGER)




/* TEXT BOOK EXAMPLE  */
CREATE PROCEDURE Addlnventory (
	IN book_isbn CHAR(lO),
	IN addedQty INTEGER)

UPDATE Books
	SET qty_in_stock = qtyjn_stock + addedQty
	WHERE bookjsbn = isbn
	
/* END TEXT BOOK EXAMPLE */
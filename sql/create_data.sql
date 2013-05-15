/*
rlwrap -c sqlplus ibank_dba/billybob@dwarf @views.sql
*/

SET SQLBLANKLINES ON

insert into ibankSuburb values('1',4217,'Surfers Paradise');
insert into ibankSuburb values('2',4218,'Broadbeach');
insert into ibankSuburb values('3',4219,'Wollongong');
insert into ibankSuburb values('4',2001,'Sydney');
insert into ibankSuburb values('5',4222,'Ashmore');
insert into ibankSuburb values('6',4220,'Labrador');
insert into ibankSuburb values('7',4223,'Benowa');
insert into ibankSuburb values('8',4224,'Nerang');
insert into ibankSuburb values('9',4225,'Robina');
insert into ibankSuburb values('10',4226,'Southport');

insert into ibankAddress values('1','28 walker way','Queensland',1);
insert into ibankAddress values('2','96 crawler bay','Tasmania',2);
insert into ibankAddress values('3','21 jump street','South Australia',3);
insert into ibankAddress values('4','42 wallabay way','New South Wales',4);
insert into ibankAddress values('5','9 bitchway','Queensland',5);
insert into ibankAddress values('6','475 sunshine curve','Queensland',6);
insert into ibankAddress values('7','35 flying eagle','Queensland',7);
insert into ibankAddress values('8','17 runaway way','Western Australia',8);
insert into ibankAddress values('9','19 wiggle street','Northern Territory',9);
insert into ibankAddress values('10','63 counting crows','Victoria',10);

insert into ibankUser values ('1','Billy ray cyrus',1,'billybob',2,9823982398);
insert into ibankUser values ('2','Mily cyrus',2,'billybob',1,9823982398);
insert into ibankUser values ('3','Johnny Depp',3,'billybob',3,9823982398);
insert into ibankUser values ('4','P. Sherman',4,'billybob',1,9823982398);
insert into ibankUser values ('5','Lance Armstrong',5,'billybob',1,9823982398);
insert into ibankUser values ('','Aroona',6,'billybob',1,9823982398);
insert into ibankUser values ('','Carlton Banks',7,'billybob',1,9823982398);
insert into ibankUser values ('','Nemo',8,'billybob',1,9823982398);
insert into ibankUser values ('','Jimminy Billy bob',9,'billybob',1,9823982398);
insert into ibankUser values ('','Gert',10,'billybob',1,9823982398);

insert into ibankAccountType values('','Savings',06.0000);
insert into ibankAccountType values('','Credits',15.4963);
insert into ibankAccountType values('','Cheque',00.0000);
insert into ibankAccountType values('','Loan',04.2500);


insert into ibankAccount (account_number,staff_user_id,login_user_id) values('',1,2);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,4);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,5);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,6);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,7);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,8);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,9);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',1,10);
COMMIT;

UPDATE ibankAccount SET balance = balance + '-250000' WHERE account_number = 18301722;
UPDATE ibankAccount SET balance = balance + 2500000 WHERE account_number = 18277656;
UPDATE ibankAccount SET balance = balance + 48 WHERE account_number = 18283004;
UPDATE ibankAccount SET balance = balance + '-1532' WHERE account_number = 18293700;
COMMIT;

UPDATE ibankAccount SET balance = balance + 450 WHERE account_number = 18273645;
UPDATE ibankAccount SET balance = balance + 123456 WHERE account_number = 18274982;
UPDATE ibankAccount SET balance = balance + 99871 WHERE account_number = 18276319;
UPDATE ibankAccount SET balance = balance + 12 WHERE account_number = 18277656;
UPDATE ibankAccount SET balance = balance + 96 WHERE account_number = 18278993;
UPDATE ibankAccount SET balance = balance + 9912 WHERE account_number = 18280330;
UPDATE ibankAccount SET balance = balance + 982 WHERE account_number = 18281667;
UPDATE ibankAccount SET balance = balance + 54321 WHERE account_number = 18283004;
UPDATE ibankAccount SET balance = balance + 25000 WHERE account_number = 18287015;
UPDATE ibankAccount SET balance = balance + 1234 WHERE account_number = 18288352;
UPDATE ibankAccount SET balance = balance + 6782 WHERE account_number = 18289689;
UPDATE ibankAccount SET balance = balance + '-12' WHERE account_number = 18291026;
UPDATE ibankAccount SET balance = balance + '-3214' WHERE account_number = 18292363;
UPDATE ibankAccount SET balance = balance + '-6001' WHERE account_number = 18293700;
UPDATE ibankAccount SET balance = balance + '-9876' WHERE account_number = 18295037;
UPDATE ibankAccount SET balance = balance + '-123456' WHERE account_number = 18296374;
UPDATE ibankAccount SET balance = balance + '-9812733' WHERE account_number = 18297711;
UPDATE ibankAccount SET balance = balance + '-1234' WHERE account_number = 18299048;
UPDATE ibankAccount SET balance = balance + '-8562' WHERE account_number = 18300385;
UPDATE ibankAccount SET balance = balance + '-2342' WHERE account_number = 18301722;



COMMIT;
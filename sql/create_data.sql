/*
rlwrap -c sqlplus ibank_dba/billybob@dwarf @views.sql
*/

SET SQLBLANKLINES ON


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
insert into ibankAddress values('11','1337 Yippee Ki-yay Way','Queensland',11);

insert into ibankUser values ('1','John McClain',11,'billybob',3,911);
insert into ibankUser values ('2','Mily cyrus',2,'billybob',2,9823982398);
insert into ibankUser values ('3','Johnny Depp',3,'billybob',1,9823982398);
insert into ibankUser values ('4','P. Sherman',4,'billybob',1,9823982398);
insert into ibankUser values ('5','Lance Armstrong',5,'billybob',1,9823982398);
insert into ibankUser values ('','Aroona',6,'billybob',1,9823982398);
insert into ibankUser values ('','Carlton Banks',7,'billybob',1,9823982398);
insert into ibankUser values ('','Nemo',8,'billybob',1,9823982398);
insert into ibankUser values ('','Jimminy Billy bob',9,'billybob',1,9823982398);
insert into ibankUser values ('','Gert',10,'billybob',1,9823982398);

insert into ibankAccountType values('','Savings',06.0000);
insert into ibankAccountType values('','Credit',15.4963);
insert into ibankAccountType values('','Cheque',00.0000);
insert into ibankAccountType values('','Loan',04.2500);


insert into ibankAccount (account_number,staff_user_id,login_user_id) values('',13371337,13371337);
insert into ibankAccount (account_number,staff_user_id,login_user_id) values('',13372674,13372674);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13374011);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13375348);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13376685);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13378022);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13379359);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13380696);
insert into ibankAccount (account_number,staff_user_id,login_user_id)values('',13372674,13382033);
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
UPDATE ibankAccount SET balance = balance + '-3214' WHERE account_number = 18285678;
UPDATE ibankAccount SET balance = balance + '-6001' WHERE account_number = 18293700;

COMMIT;

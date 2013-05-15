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

insert into ibankUsers values ('1','Billy ray cyrus',1,'billybob',2,9823982398);
insert into ibankUsers values ('2','Mily cyrus',2,'billybob',1,9823982398);
insert into ibankUsers values ('3','Johnny Depp',3,'billybob',3,9823982398);
insert into ibankUsers values ('4','P. Sherman',4,'billybob',1,9823982398);
insert into ibankUsers values ('5','Lance Armstrong',5,'billybob',1,9823982398);
insert into ibankUsers values ('','Aroona',6,'billybob',1,9823982398);
insert into ibankUsers values ('','Carlton Banks',7,'billybob',1,9823982398);
insert into ibankUsers values ('','Nemo',8,'billybob',1,9823982398);
insert into ibankUsers values ('','Jimminy Billy bob',9,'billybob',1,9823982398);
insert into ibankUsers values ('','Gert',10,'billybob',1,9823982398);

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

UPDATE ibankAccount SET balance = '-250000' WHERE account_number = 18301722;
UPDATE ibankAccount SET balance = 2500000 WHERE account_number = 18277656;
UPDATE ibankAccount SET balance = 48 WHERE account_number = 18283004;
UPDATE ibankAccount SET balance = '-1532' WHERE account_number = 18293700;


18273645		     1
18274982		     1
18276319		     1
18277656		     1
18278993		     1
18280330		     1
18281667		     1
18283004		     1
18287015		     2
18288352		     2
18289689		     2
18291026		     3
18292363		     3
18293700		     3
18295037		     4
18296374		     4
18297711		     4
18299048		     4
18300385		     4
18301722		     4



COMMIT;
SET SQLBLANKLINES ON

/*
select postcode from ibankSuburb where suburb_name = 'SURFERS PARADISE';
*/
CREATE INDEX suburb_name_index on ibankSuburb(suburb_name) global partition by
hash (suburb_name) partitions 4;

--b+

/*
select * from ibankTransaction where date_of_transaction BETWEEN '14/MAY/13' AND '16/MAY/13';
*/
create index transaction_date_index on ibankTransaction(date_of_transaction);


/*
select U.full_name,A.balance from ibankAccount A left join ibankUser U on A.login_user_id = U.login_id;
*/
CREATE INDEX user_login_index on ibankUser(login_id) global partition by
hash (login_id) partitions 4;

CREATE INDEX postcode_hash_index on ibankSuburb(postcode) global partition by
hash (postcode) partitions 4;
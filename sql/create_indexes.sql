SET SQLBLANKLINES ON

/*
select postcode from ibankSuburb where suburb_name = 'SURFERS PARADISE';
With the query above you can see the direct effect 

select transaction_data_view where ibankSuburb.suburb_name = 'SURFERS PARADISE';
this view joins the transactiontable to accounttable and accounttable to usertable
and the usertable to suburbtable, these joins are all indexed on primary keys, so 
to get the same performance we want when we set the where clause we need a hash-index 
on suburb_name.

*/
CREATE INDEX suburb_name_index on ibankSuburb(suburb_name) global partition by
hash (suburb_name) partitions 4;

/*
select * from ibankTransaction where date_of_transaction BETWEEN '14/MAY/13' AND '16/MAY/13';
This b+ index lets us do range searches on date so that we can display transactions
within different time-periods
*/
create index transaction_date_index on ibankTransaction(date_of_transaction);

/*
This is pretty much sorted on initial insert because of the file, but is nessecary
because of the "select suburbs where postcode = ?", When we select all suburbs on a specific postcode,
all the suburbs on the same postcode are going to be placed in buckets on that hash-index if we use
a hash index.
*/
CREATE INDEX postcode_hash_index on ibankSuburb(postcode) global partition by
hash (postcode) partitions 4;

COMMIT;
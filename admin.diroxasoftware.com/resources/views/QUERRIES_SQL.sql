QUERRIES SQL 

/* PRICE STOCK*/
CREATE VIEW stockPrice as 
SELECT SUM(Sell_Price) as TOTAL from products


/* STOCK COST */
CREATE VIEW stockCost as 
SELECT SUM(Cost_Price) as TOTAL from products

/* TOTAL QUANTITY IN STOCK */
CREATE VIEW stocktotalQuantity as 
SELECT SUM(quantity) as TOTAL from products


SELECT SUM(Sell_Price) as TOTAL_SELL, SUM(Cost_Price) as TOTAL_COST, SUM(Sell_Price - Cost_Price)  from products

CREATE VIEW user_report AS
SELECT first_name, last_name, COUNT(*) AS total_orders
FROM users
JOIN orders ON users.id = orders.user_id
GROUP BY users.id;
SELECT table_name, engine
FROM information_schema.tables
WHERE table_schema = 'your_database'
  AND engine IS NULL;

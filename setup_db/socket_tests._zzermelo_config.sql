-- socket and wrench data for the test reports
-- run this sql to add the needed data to the _zermelo_config database

-- wrench data
INSERT INTO wrench 
(`id`, `wrench_lookup_string`, `wrench_label`, `created_at`, `updated_at`) 
VALUES
(1, 'DURC_job_title_filter', 'DURC_job_title_filter', NULL, NULL),
(2, 'DURC_big_state_filter', 'DURC_big_state_filter', NULL, NULL),
(3, 'DURC_order_year_db_table', 'DURC_order_year_db_table', NULL, NULL);

INSERT INTO socket 
(`id`, `wrench_id`, `socket_value`, `socket_label`, `is_default_socket`, `socketsource_id`, `created_at`, `updated_at`) 
VALUES
(1, 1, 'jobTitle LIKE \'%engineer%\'', 'engineer', 1, 0, NULL, NULL),
(2, 1, 'jobTitle LIKE \'%doctor%\'', 'doctor', 0, 0, NULL, NULL),
(3, 2, 'stateProvince IN (\'TX\', \'CA\', \'FL\', \'NY\')', 'Large States (TX, FL, NY, CA)', 1, 0, NULL, NULL),
(4, 3, 'DURC_northwind_data.order_2019', '2019 data', 1, 0, NULL, NULL),
(5, 3, 'DURC_northwind_data.order_2018', '2018 data', 0, 0, NULL, NULL),
(6, 3, 'DURC_northwind_data.order_2017', '2017 data', 0, 0, NULL, NULL);

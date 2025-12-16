-- =====================================================
-- Test SQL for group_order feature in ZZermelo Graph Reports
-- =====================================================
-- Create test tables in the graph_reports database:
-- 1. test_group_order_success - correctly uses group_order (all nodes in same group have same group_order)
-- 2. test_group_order_inconsistent - breaks because same group has different group_order values
-- 3. test_group_order_null - breaks because group_order contains NULL values
--
-- These will be run through app/Reports/CSVReportGraph.php to verify the behavior.
-- Access via: /ZZermeloGraph/CSVReportGraph/{table_name}
-- =====================================================

-- First ensure the database exists
CREATE DATABASE IF NOT EXISTS graph_reports;
USE graph_reports;

-- =====================================================
-- TEST 1: SUCCESS CASE - Proper group_order usage
-- =====================================================
-- This table demonstrates correct usage of group_order:
-- - All nodes in "Hospitals" group have group_order = 1
-- - All nodes in "Doctors" group have group_order = 2  
-- - All nodes in "Patients" group have group_order = 3
-- Expected: Graph should render with groups ordered left-to-right: Hospitals -> Doctors -> Patients

DROP TABLE IF EXISTS test_group_order_success;

CREATE TABLE test_group_order_success (
    source_id VARCHAR(100) NOT NULL,
    source_name VARCHAR(255) NOT NULL,
    source_size INT NOT NULL DEFAULT 100,
    source_type VARCHAR(100) NOT NULL,
    source_group VARCHAR(100) NOT NULL,
    source_group_order INT NOT NULL,
    source_latitude DECIMAL(17,7) DEFAULT 0,
    source_longitude DECIMAL(17,7) DEFAULT 0,
    source_img VARCHAR(255) DEFAULT '',
    
    target_id VARCHAR(100) NOT NULL,
    target_name VARCHAR(255) NOT NULL,
    target_size INT NOT NULL DEFAULT 100,
    target_type VARCHAR(100) NOT NULL,
    target_group VARCHAR(100) NOT NULL,
    target_group_order INT NOT NULL,
    target_latitude DECIMAL(17,7) DEFAULT 0,
    target_longitude DECIMAL(17,7) DEFAULT 0,
    target_json_url VARCHAR(500) DEFAULT '',
    target_img VARCHAR(255) DEFAULT '',
    
    weight DECIMAL(15,5) NOT NULL DEFAULT 1,
    link_type VARCHAR(100) NOT NULL DEFAULT 'connected',
    query_num INT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert test data: Hospitals (leftmost) -> Doctors (middle) -> Patients (rightmost)
INSERT INTO test_group_order_success 
(source_id, source_name, source_type, source_group, source_group_order,
 target_id, target_name, target_type, target_group, target_group_order,
 weight, link_type, query_num) VALUES

-- Hospital to Doctor relationships (Hospitals = order 1, Doctors = order 2)
('hosp_001', 'General Hospital', 'Hospital', 'Hospitals', 1,
 'doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 10.0, 'employs', 1),

('hosp_001', 'General Hospital', 'Hospital', 'Hospitals', 1,
 'doc_002', 'Dr. Jones', 'Doctor', 'Doctors', 2,
 8.0, 'employs', 1),

('hosp_002', 'City Medical Center', 'Hospital', 'Hospitals', 1,
 'doc_003', 'Dr. Williams', 'Doctor', 'Doctors', 2,
 12.0, 'employs', 1),

('hosp_002', 'City Medical Center', 'Hospital', 'Hospitals', 1,
 'doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 5.0, 'employs', 1),

-- Doctor to Patient relationships (Doctors = order 2, Patients = order 3)
('doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 'pat_001', 'John Doe', 'Patient', 'Patients', 3,
 3.0, 'treats', 2),

('doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 'pat_002', 'Jane Doe', 'Patient', 'Patients', 3,
 4.0, 'treats', 2),

('doc_002', 'Dr. Jones', 'Doctor', 'Doctors', 2,
 'pat_003', 'Bob Wilson', 'Patient', 'Patients', 3,
 2.0, 'treats', 2),

('doc_003', 'Dr. Williams', 'Doctor', 'Doctors', 2,
 'pat_001', 'John Doe', 'Patient', 'Patients', 3,
 1.0, 'treats', 2),

('doc_003', 'Dr. Williams', 'Doctor', 'Doctors', 2,
 'pat_004', 'Alice Brown', 'Patient', 'Patients', 3,
 6.0, 'treats', 2);


-- =====================================================
-- TEST 2: FAILURE CASE - Inconsistent group_order values
-- =====================================================
-- This table should FAIL validation because:
-- The "Doctors" group has DIFFERENT group_order values (2 and 5)
-- Expected: Error message about inconsistent group_order values

DROP TABLE IF EXISTS test_group_order_inconsistent;

CREATE TABLE test_group_order_inconsistent (
    source_id VARCHAR(100) NOT NULL,
    source_name VARCHAR(255) NOT NULL,
    source_size INT NOT NULL DEFAULT 100,
    source_type VARCHAR(100) NOT NULL,
    source_group VARCHAR(100) NOT NULL,
    source_group_order INT NOT NULL,
    source_latitude DECIMAL(17,7) DEFAULT 0,
    source_longitude DECIMAL(17,7) DEFAULT 0,
    source_img VARCHAR(255) DEFAULT '',
    
    target_id VARCHAR(100) NOT NULL,
    target_name VARCHAR(255) NOT NULL,
    target_size INT NOT NULL DEFAULT 100,
    target_type VARCHAR(100) NOT NULL,
    target_group VARCHAR(100) NOT NULL,
    target_group_order INT NOT NULL,
    target_latitude DECIMAL(17,7) DEFAULT 0,
    target_longitude DECIMAL(17,7) DEFAULT 0,
    target_json_url VARCHAR(500) DEFAULT '',
    target_img VARCHAR(255) DEFAULT '',
    
    weight DECIMAL(15,5) NOT NULL DEFAULT 1,
    link_type VARCHAR(100) NOT NULL DEFAULT 'connected',
    query_num INT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert test data with INCONSISTENT group_order for "Doctors" group
INSERT INTO test_group_order_inconsistent 
(source_id, source_name, source_type, source_group, source_group_order,
 target_id, target_name, target_type, target_group, target_group_order,
 weight, link_type, query_num) VALUES

-- Hospital to Doctor: Doctors get group_order = 2
('hosp_001', 'General Hospital', 'Hospital', 'Hospitals', 1,
 'doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 10.0, 'employs', 1),

('hosp_001', 'General Hospital', 'Hospital', 'Hospitals', 1,
 'doc_002', 'Dr. Jones', 'Doctor', 'Doctors', 2,
 8.0, 'employs', 1),

-- Doctor to Patient: Same doctor now has DIFFERENT group_order = 5 (BUG!)
-- This should trigger the inconsistency error
('doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 5,
 'pat_001', 'John Doe', 'Patient', 'Patients', 3,
 3.0, 'treats', 2),

('doc_002', 'Dr. Jones', 'Doctor', 'Doctors', 5,
 'pat_002', 'Jane Doe', 'Patient', 'Patients', 3,
 4.0, 'treats', 2);


-- =====================================================
-- TEST 3: FAILURE CASE - NULL group_order values
-- =====================================================
-- This table should FAIL validation because:
-- Some rows have NULL values in source_group_order
-- Expected: Error message about NULL values in group_order

DROP TABLE IF EXISTS test_group_order_null;

CREATE TABLE test_group_order_null (
    source_id VARCHAR(100) NOT NULL,
    source_name VARCHAR(255) NOT NULL,
    source_size INT NOT NULL DEFAULT 100,
    source_type VARCHAR(100) NOT NULL,
    source_group VARCHAR(100) NOT NULL,
    source_group_order INT,  -- Allows NULL
    source_latitude DECIMAL(17,7) DEFAULT 0,
    source_longitude DECIMAL(17,7) DEFAULT 0,
    source_img VARCHAR(255) DEFAULT '',
    
    target_id VARCHAR(100) NOT NULL,
    target_name VARCHAR(255) NOT NULL,
    target_size INT NOT NULL DEFAULT 100,
    target_type VARCHAR(100) NOT NULL,
    target_group VARCHAR(100) NOT NULL,
    target_group_order INT NOT NULL,
    target_latitude DECIMAL(17,7) DEFAULT 0,
    target_longitude DECIMAL(17,7) DEFAULT 0,
    target_json_url VARCHAR(500) DEFAULT '',
    target_img VARCHAR(255) DEFAULT '',
    
    weight DECIMAL(15,5) NOT NULL DEFAULT 1,
    link_type VARCHAR(100) NOT NULL DEFAULT 'connected',
    query_num INT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert test data with NULL values in source_group_order
INSERT INTO test_group_order_null 
(source_id, source_name, source_type, source_group, source_group_order,
 target_id, target_name, target_type, target_group, target_group_order,
 weight, link_type, query_num) VALUES

-- First row has proper group_order
('hosp_001', 'General Hospital', 'Hospital', 'Hospitals', 1,
 'doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 10.0, 'employs', 1),

-- Second row has NULL source_group_order (BUG!)
('hosp_002', 'City Medical Center', 'Hospital', 'Hospitals', NULL,
 'doc_002', 'Dr. Jones', 'Doctor', 'Doctors', 2,
 8.0, 'employs', 1),

-- Third row is fine
('doc_001', 'Dr. Smith', 'Doctor', 'Doctors', 2,
 'pat_001', 'John Doe', 'Patient', 'Patients', 3,
 3.0, 'treats', 2);


-- =====================================================
-- TEST 4: SUCCESS CASE - No group_order columns (backwards compatibility)
-- =====================================================
-- This table has NO group_order columns at all
-- It should work with the default/arbitrary group ordering
-- Expected: Graph renders normally with default group ordering

DROP TABLE IF EXISTS test_group_order_none;

CREATE TABLE test_group_order_none (
    source_id VARCHAR(100) NOT NULL,
    source_name VARCHAR(255) NOT NULL,
    source_size INT NOT NULL DEFAULT 100,
    source_type VARCHAR(100) NOT NULL,
    source_group VARCHAR(100) NOT NULL,
    source_latitude DECIMAL(17,7) DEFAULT 0,
    source_longitude DECIMAL(17,7) DEFAULT 0,
    source_img VARCHAR(255) DEFAULT '',
    
    target_id VARCHAR(100) NOT NULL,
    target_name VARCHAR(255) NOT NULL,
    target_size INT NOT NULL DEFAULT 100,
    target_type VARCHAR(100) NOT NULL,
    target_group VARCHAR(100) NOT NULL,
    target_latitude DECIMAL(17,7) DEFAULT 0,
    target_longitude DECIMAL(17,7) DEFAULT 0,
    target_json_url VARCHAR(500) DEFAULT '',
    target_img VARCHAR(255) DEFAULT '',
    
    weight DECIMAL(15,5) NOT NULL DEFAULT 1,
    link_type VARCHAR(100) NOT NULL DEFAULT 'connected',
    query_num INT NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert test data without any group_order columns
INSERT INTO test_group_order_none 
(source_id, source_name, source_type, source_group,
 target_id, target_name, target_type, target_group,
 weight, link_type, query_num) VALUES

('hosp_001', 'General Hospital', 'Hospital', 'Hospitals',
 'doc_001', 'Dr. Smith', 'Doctor', 'Doctors',
 10.0, 'employs', 1),

('hosp_001', 'General Hospital', 'Hospital', 'Hospitals',
 'doc_002', 'Dr. Jones', 'Doctor', 'Doctors',
 8.0, 'employs', 1),

('doc_001', 'Dr. Smith', 'Doctor', 'Doctors',
 'pat_001', 'John Doe', 'Patient', 'Patients',
 3.0, 'treats', 2),

('doc_002', 'Dr. Jones', 'Doctor', 'Doctors',
 'pat_002', 'Jane Doe', 'Patient', 'Patients',
 4.0, 'treats', 2);


-- =====================================================
-- SUMMARY OF TEST CASES
-- =====================================================
-- 
-- Access via browser (after running this SQL):
--   /ZZermeloGraph/CSVReportGraph/test_group_order_success      -> Should work, groups ordered: Hospitals(1) -> Doctors(2) -> Patients(3)
--   /ZZermeloGraph/CSVReportGraph/test_group_order_inconsistent -> Should ERROR: "Doctors" group has conflicting group_order values: 2, 5
--   /ZZermeloGraph/CSVReportGraph/test_group_order_null         -> Should ERROR: source_group_order contains NULL values
--   /ZZermeloGraph/CSVReportGraph/test_group_order_none         -> Should work with default ordering (backwards compatibility)
--
-- =====================================================

SELECT 'Test tables created successfully!' AS result;
SELECT 'test_group_order_success' AS table_name, COUNT(*) AS row_count FROM test_group_order_success
UNION ALL
SELECT 'test_group_order_inconsistent', COUNT(*) FROM test_group_order_inconsistent
UNION ALL
SELECT 'test_group_order_null', COUNT(*) FROM test_group_order_null
UNION ALL
SELECT 'test_group_order_none', COUNT(*) FROM test_group_order_none;

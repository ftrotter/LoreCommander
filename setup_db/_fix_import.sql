-- Use this to quickly fix a CSV import into the graph reporting engine. Do a find and replace on REPLACEME to set the table name.

ALTER TABLE REPLACEME ADD PRIMARY KEY(`source_id`, `target_id`);
DELETE FROM REPLACEME WHERE source_name = 'source_name'; -- remove any header rows that may have been imported
ALTER TABLE REPLACEME CHANGE `source_size` `source_size` INT(11) NULL DEFAULT NULL;
ALTER TABLE REPLACEME CHANGE `source_group_order` `source_group_order` INT(11) NULL DEFAULT NULL;
ALTER TABLE REPLACEME CHANGE `target_size` `target_size` INT(11) NULL DEFAULT NULL;
ALTER TABLE REPLACEME CHANGE `target_group_order` `target_group_order` INT(11) NULL DEFAULT NULL;
ALTER TABLE REPLACEME CHANGE `weight` `weight` INT(11) NULL DEFAULT NULL;
ALTER TABLE REPLACEME CHANGE `query_num` `query_num` INT(11) NULL DEFAULT NULL;

ALTER TABLE REPLACEME CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


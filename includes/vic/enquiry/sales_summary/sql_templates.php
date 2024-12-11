<?php
/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- create table summary date list -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_create_table_summary_date_list = "
    CREATE TABLE `tblsummarydatelist` (
        `id` int(11) NOT NULL AUTO_INCREMENT, 
        `date` date DEFAULT NULL, 
        PRIMARY KEY (`id`), 
        UNIQUE(`date`), 
        KEY(`date`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
";

$sql_template_delete_table_summary_date_list = "
    DELETE FROM tblsummarydatelist 
    WHERE (`date` >= '[DATE_BEGIN]' AND `date` <= '[DATE_END]');
";

$sql_template_insert_table_summary_date_list = "
    INSERT INTO `tblsummarydatelist` 
    (`date`) 
    VALUES ('[THIS_FILL_DATE]');
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- create table summary daily sales quote -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_create_table_summary_daily_sales_quote = "
    CREATE TABLE `tblsummarydailysalesquote` (
        `id` int(11) NOT NULL AUTO_INCREMENT, 
        `quote_date` date DEFAULT NULL, 
        `consultant_id` varchar(45) DEFAULT NULL,
        `quote_id` varchar(45) DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`), 
        UNIQUE(`quote_date`, `consultant_id`, `quote_id`), 
        KEY(`quote_date`), 
        KEY(`consultant_id`), 
        KEY(`quote_id`), 
        KEY(`created_at`) 
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
";

$sql_template_delete_table_summary_daily_sales_quote = "
    DELETE FROM tblsummarydailysalesquote 
    WHERE (quote_date >= '[QUOTE_DATE_BEGIN]' AND quote_date <= '[QUOTE_DATE_END]');
";

$sql_template_insert_table_summary_daily_sales_quote = "
    INSERT INTO `tblsummarydailysalesquote` 
    (`quote_date`, `consultant_id`, `quote_id`) 
    SELECT 
        df3.quotedate AS 'quote_date', 
        df3.rep_id AS 'consultant_id', 
        df3.quoteid AS 'quote_id' 
    FROM ( 
        SELECT 
            df2.quoteid AS 'quote_id', 
            MIN(df2.quotedate) AS 'first_quote_date', 
            MIN(df2.cf_id) AS 'first_cf_id' 
        FROM (
            SELECT 
                df1.quoteid AS 'quote_id' 
            FROM ver_chronoforms_data_followup_vic df1 
            WHERE (df1.quotedate >= '[QUOTE_DATE_TIME_BEGIN]' AND df1.quotedate <= '[QUOTE_DATE_TIME_END]') 
            GROUP BY df1.quoteid 
        ) AS data_quote 
            LEFT JOIN ver_chronoforms_data_followup_vic df2 
                ON data_quote.quote_id = df2.quoteid 
        GROUP BY df2.quoteid 
    ) AS data_quote2 
        LEFT JOIN ver_chronoforms_data_followup_vic df3 
            ON data_quote2.first_cf_id = df3.cf_id 
    WHERE (df3.quotedate >= '[QUOTE_DATE_TIME_BEGIN]' AND df3.quotedate <= '[QUOTE_DATE_TIME_END]') 
    ORDER BY df3.quotedate, df3.rep_id, df3.cf_id 
    LIMIT 5000;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- create table summary daily sales general -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_create_table_summary_daily_sales_general = "
    CREATE TABLE `tblsummarydailysalesgeneral` (
        `id` int(11) NOT NULL AUTO_INCREMENT, 
        `summary_date` date DEFAULT NULL, 
        `summary_year` smallint DEFAULT NULL, 
        `summary_month` tinyint DEFAULT NULL, 
        `summary_day` tinyint DEFAULT NULL, 
        `consultant_id` varchar(45) DEFAULT NULL,
        `target_sales_amount` float DEFAULT NULL,
        `target_sales_contract` int DEFAULT NULL, 
        `sales_amount` float DEFAULT NULL,
        `num_enquiries` int DEFAULT NULL, 
        `num_quotes` int DEFAULT NULL, 
        `num_contracts` int DEFAULT NULL, 
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`), 
        UNIQUE(`summary_date`, `summary_year`, `summary_month`, `summary_day`, `consultant_id`), 
        KEY(`summary_date`), 
        KEY(`summary_year`), 
        KEY(`summary_month`), 
        KEY(`summary_day`), 
        KEY(`consultant_id`), 
        KEY(`target_sales_amount`), 
        KEY(`target_sales_contract`), 
        KEY(`sales_amount`), 
        KEY(`num_enquiries`), 
        KEY(`num_quotes`), 
        KEY(`num_contracts`), 
        KEY(`created_at`) 
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
";

$sql_template_delete_table_summary_daily_sales_general = "
    DELETE FROM tblsummarydailysalesgeneral 
    WHERE (summary_date >= '[SUMMARY_DATE_BEGIN]' AND summary_date <= '[SUMMARY_DATE_END]');
";

$sql_template_insert_table_summary_daily_sales_general_01 = "
    SET 
        @process_date_begin = DATE('[SUMMARY_DATE_BEGIN]'), 
        @process_date_end = DATE('[SUMMARY_DATE_END]'), 
        @summary_date = '', 
        @summary_year = '', 
        @summary_month = '', 
        @summary_day = '', 
        @target_date_time_begin = '', 
        @target_date_time_end = '', 
        @target_consultant_id = '', 
        @temp_target_sales_amount = '', 
        @temp_target_sales_contract = '', 
        @target_sales_amount = 0, 
        @target_sales_contract = 0;
";
$sql_template_insert_table_summary_daily_sales_general_02 = "
    INSERT INTO `tblsummarydailysalesgeneral` 
    (`summary_date`, `summary_year`, `summary_month`, `summary_day`, 
     `consultant_id`, `target_sales_amount`, `target_sales_contract`, 
     `sales_amount`, `num_enquiries`, `num_quotes`, `num_contracts`) 
    SELECT 
        t_output.summary_date, 
        t_output.summary_year, 
        t_output.summary_month, 
        t_output.summary_day, 
        t_output.consultant_id, 
        IF(t_output.target_sales_amount IS NOT NULL, t_output.target_sales_amount, 0) AS 'target_sales_amount', 
        IF(t_output.target_sales_contract IS NOT NULL, t_output.target_sales_contract, 0) AS 'target_sales_contract', 
        IF(t_output.sales_amount IS NOT NULL, t_output.sales_amount, 0) AS 'sales_amount', 
        t_output.num_enquiries, 
        t_output.num_quotes, 
        t_output.num_contracts 
    FROM ( 
        SELECT 
            @summary_date := tdl.date AS 'summary_date', 
            @summary_year := YEAR(tdl.date) AS 'summary_year', 
            @summary_month := MONTH(tdl.date)AS 'summary_month', 
            @summary_day := DAY(tdl.date)AS 'summary_day', 
            @target_date_time_begin := CONCAT(tdl.date, ' 00:00:00') AS 'target_date_time_begin', 
            @target_date_time_end := CONCAT(tdl.date, ' 23:59:59') AS 'target_date_time_end', 
            @target_consultant_id := vu.RepID AS 'consultant_id', 
            @target_sales_amount := (
                SELECT 
                    SUM(target_amount) 
                FROM ver_rep_sales_target 
                WHERE (target_date >= @target_date_time_begin AND target_date <= @target_date_time_end) 
                AND rep_id = @target_consultant_id 
            ) AS 'target_sales_amount', 
            @target_sales_contract := (
                SELECT 
                    SUM(target_contract) 
                FROM ver_rep_sales_target 
                WHERE (target_date >= @target_date_time_begin AND target_date <= @target_date_time_end) 
                AND rep_id = @target_consultant_id 
            ) AS 'target_sales_contract', 
            (
                SELECT 
                    SUM(total_cost) 
                FROM ver_chronoforms_data_contract_list_vic 
                WHERE (contractdate >= @target_date_time_begin AND contractdate <= @target_date_time_end) 
                AND rep_id = @target_consultant_id 
            ) AS 'sales_amount', 
            (
                SELECT 
                    COUNT(*) 
                FROM ver_chronoforms_data_clientpersonal_vic 
                WHERE (datelodged >= @target_date_time_begin AND datelodged <= @target_date_time_end) 
                AND repident = @target_consultant_id 
            ) AS 'num_enquiries',  
            (
                SELECT 
                    COUNT(*) 
                FROM tblsummarydailysalesquote 
                WHERE (quote_date >= @target_date_time_begin AND quote_date <= @target_date_time_end) 
                AND consultant_id = @target_consultant_id 
            ) AS 'num_quotes',  
            (
                SELECT 
                    COUNT(*) 
                FROM ver_chronoforms_data_contract_list_vic 
                WHERE (contractdate >= @target_date_time_begin AND contractdate <= @target_date_time_end) 
                AND rep_id = @target_consultant_id 
            ) AS 'num_contracts' 
        FROM tblsummarydatelist tdl 
            LEFT JOIN ver_users vu 
                ON tdl.date IS NOT NULL AND vu.RepID IS NOT NULL 
        WHERE (tdl.date >= @process_date_begin AND tdl.date <= @process_date_end) 
        AND vu.block=0 
    ) AS t_output 
    WHERE (
        (t_output.target_sales_amount IS NOT NULL AND t_output.target_sales_amount > 0) 
        OR 
        (t_output.target_sales_contract IS NOT NULL AND t_output.target_sales_contract > 0) 
        OR 
        (t_output.sales_amount IS NOT NULL AND t_output.sales_amount > 0) 
        OR 
        (t_output.num_enquiries IS NOT NULL AND t_output.num_enquiries > 0) 
        OR 
        (t_output.num_quotes IS NOT NULL AND t_output.num_quotes > 0) 
        OR 
        (t_output.num_contracts IS NOT NULL AND t_output.num_contracts > 0) 
    )
    ORDER BY t_output.summary_year, t_output.summary_month, t_output.summary_day, t_output.consultant_id 
    LIMIT 0, 5000;
";

$sql_template_get_all_user = "
    SELECT * FROM ver_users WHERE RepID IS NOT NULL AND block = 0;
";

$sql_template_get_sum_target_amount = "
    SELECT 
        SUM(target_amount) AS 'sum_target_amount' 
    FROM ver_rep_sales_target 
    WHERE (target_date >= '[DATE_BEGIN] 00:00:00' AND target_date <= '[DATE_END] 23:59:59') 
    AND rep_id = '[CONSULTANT_ID]';
";

$sql_template_get_sum_target_contract = "
    SELECT 
        SUM(target_contract) AS 'sum_target_contract' 
    FROM ver_rep_sales_target 
    WHERE (target_date >= '[DATE_BEGIN] 00:00:00' AND target_date <= '[DATE_END] 23:59:59') 
    AND rep_id = '[CONSULTANT_ID]';
";

$sql_template_get_sum_total_cost = "
    SELECT 
        SUM(total_cost) AS 'sum_total_cost' 
    FROM ver_chronoforms_data_contract_list_vic 
    WHERE (contractdate >= '[DATE_BEGIN] 00:00:00' AND contractdate <= '[DATE_END] 23:59:59') 
    AND rep_id = '[CONSULTANT_ID]' 
";

$sql_template_get_enquiry_total_record = "
    SELECT 
        COUNT(*) AS 'total_record' 
    FROM ver_chronoforms_data_clientpersonal_vic 
    WHERE (datelodged >= '[DATE_BEGIN] 00:00:00' AND datelodged <= '[DATE_END] 23:59:59') 
    AND repident = '[CONSULTANT_ID]' 
";

$sql_template_get_quote_total_record = "
    SELECT 
        COUNT(*) AS 'total_record' 
    FROM tblsummarydailysalesquote 
    WHERE (quote_date >= '[DATE_BEGIN] 00:00:00' AND quote_date <= '[DATE_END] 23:59:59') 
    AND consultant_id = '[CONSULTANT_ID]' 
";

$sql_template_get_contract_total_record = "
    SELECT 
        COUNT(*) AS 'total_record' 
    FROM ver_chronoforms_data_contract_list_vic 
    WHERE (contractdate >= '[DATE_BEGIN] 00:00:00' AND contractdate <= '[DATE_END] 23:59:59') 
    AND rep_id = '[CONSULTANT_ID]' 
";

$sql_template_insert_table_summary_daily_sales_general_21 = "
    INSERT INTO `tblsummarydailysalesgeneral` 
    (`summary_date`, `summary_year`, `summary_month`, `summary_day`, 
     `consultant_id`, `target_sales_amount`, `target_sales_contract`, 
     `sales_amount`, `num_enquiries`, `num_quotes`, `num_contracts`) 
    VALUES 
    ('[SUMMARY_DATE]', '[SUMMARY_YEAR]', '[SUMMARY_MONTH]', '[SUMMARY_DAY]', 
     '[CONSULTANT_ID]', '[TARGET_SALES_AMOUNT]', '[TARGET_SALES_CONTRACT]', 
     '[SALES_AMOUNT]', '[NUM_ENQUIRIES]', '[NUM_QUOTES]', '[NUM_CONTRACTS]');
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- get sales summary -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_get_sales_summary_01 = "
	SET 
	    @target_date_begin = '[TARGET_DATE_BEGIN]', 
	    @target_date_end = '[TARGET_DATE_END]', 
	    @current_target_sales_amount = 0, 
	    @current_sales_amount = 0, 
	    @current_sales_performance_monthly_diff = 0, 
	    @current_sales_performance_ytd_diff = 0, 
	    @current_total_enquiries = 0, 
	    @current_total_quotes = 0, 
	    @current_total_contracts = 0, 
	    @current_enquiry_to_quote = 0, 
	    @current_quote_to_contract = 0, 
	    @current_enquiry_to_contract = 0, 
	    @grand_total_target_sales_amount = 0, 
	    @grand_total_target_sales_contract = 0, 
	    @grand_total_sales_amount = 0, 
	    @grand_total_enquiries = 0, 
	    @grand_total_quotes = 0, 
	    @grand_total_contracts = 0, 
	    @grand_total_enquiry_to_quote = 0, 
	    @grand_total_quote_to_contract = 0, 
	    @grand_total_enquiry_to_contract = 0;
";
$sql_template_get_sales_summary_02 = "
	SELECT 
	    t_main.summary_date, 
	    t_main.summary_year, 
	    t_main.summary_month,
	    (@current_target_sales_amount := t_main.total_target_sales_amount) AS 'target_sales_amount', 
	    (@current_target_sales_contract := t_main.total_target_sales_contract) AS 'target_sales_contract', 
	    (@current_sales_amount := t_main.total_sales_amount) AS 'sales_amount', 
        IF(t_main.summary_date <= NOW(), @current_sales_performance_monthly_diff := @current_sales_amount - @current_target_sales_amount, 0) AS 'sales_performance_monthly_diff', 
        IF(t_main.summary_date <= NOW(), @current_sales_performance_ytd_diff := @current_sales_performance_ytd_diff + @current_sales_performance_monthly_diff, 0) AS 'sales_performance_ytd_diff', 
	    (@current_total_enquiries := t_main.total_enquiries) AS 'enquiries', 
	    (@current_total_quotes := t_main.total_quotes) AS 'quotes', 
	    (@current_total_contracts := t_main.total_contracts) AS 'contracts', 
	    IF((@current_total_quotes / @current_total_enquiries) * 100 IS NOT NULL, @current_enquiry_to_quote := (@current_total_quotes / @current_total_enquiries) * 100, '0') AS 'enquiry_to_quote', 
	    IF((@current_total_contracts / @current_total_quotes) * 100 IS NOT NULL, @current_quote_to_contract := (@current_total_contracts / @current_total_quotes) * 100, '0') AS 'quote_to_contract', 
	    IF((@current_total_contracts / @current_total_enquiries) * 100 IS NOT NULL, @current_enquiry_to_contract := (@current_total_contracts / @current_total_enquiries) * 100, '0') AS 'enquiry_to_contract', 
	    (@grand_total_target_sales_amount := @grand_total_target_sales_amount + @current_target_sales_amount) AS 'grand_total_target_sales_amount', 
	    (@grand_total_target_sales_contract := @grand_total_target_sales_contract + @current_target_sales_contract) AS 'grand_total_target_sales_contract', 
	    (@grand_total_sales_amount := @grand_total_sales_amount + @current_sales_amount) AS 'grand_total_sales_amount', 
	    (@grand_total_enquiries := @grand_total_enquiries + @current_total_enquiries) AS 'grand_total_enquiries', 
	    (@grand_total_quotes := @grand_total_quotes + @current_total_quotes) AS 'grand_total_quotes', 
	    (@grand_total_contracts := @grand_total_contracts + @current_total_contracts) AS 'grand_total_contracts', 
	    IF((@grand_total_quotes / @grand_total_enquiries) * 100 IS NOT NULL, @grand_total_enquiry_to_quote := (@grand_total_quotes / @grand_total_enquiries) * 100, '0') AS 'grand_total_enquiry_to_quote', 
	    IF((@grand_total_contracts / @grand_total_quotes) * 100 IS NOT NULL, @grand_total_quote_to_contract := (@grand_total_contracts / @grand_total_quotes) * 100, '0') AS 'grand_total_quote_to_contract', 
	    IF((@grand_total_contracts / @grand_total_enquiries) * 100 IS NOT NULL, @grand_total_enquiry_to_contract := (@grand_total_contracts / @grand_total_enquiries) * 100, '0') AS 'grand_total_enquiry_to_contract' 
	FROM ( 
	    SELECT 
	        summary_date, 
	        summary_year, 
	        summary_month, 
	        SUM(target_sales_amount) AS 'total_target_sales_amount', 
	        SUM(target_sales_contract) AS 'total_target_sales_contract', 
	        SUM(sales_amount) AS 'total_sales_amount', 
	        SUM(num_enquiries) AS 'total_enquiries', 
	        SUM(num_quotes) AS 'total_quotes', 
	        SUM(num_contracts) AS 'total_contracts' 
	    FROM `tblsummarydailysalesgeneral` 
	    WHERE (summary_date >= @target_date_begin AND summary_date <= @target_date_end) 
	    [ADDITIONAL_CONDITION] 
	    GROUP BY summary_year, summary_month 
	) AS t_main 
	ORDER BY t_main.summary_year, t_main.summary_month;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- flush summary daily sales info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_flush_table_summary_date_list = "
    DELETE FROM tblsummarydatelist;
";

$sql_template_flush_table_summary_daily_sales_quote = "
    DELETE FROM tblsummarydailysalesquote;
";

$sql_template_flush_table_summary_daily_sales_general = "
    DELETE FROM tblsummarydailysalesgeneral;
";


/*
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
----- restore summary daily sales info -----
----- ----- ----- ----- ----- ----- ----- ----- ----- -----
*/
$sql_template_restore_table_summary_date_list = "
    INSERT INTO tblsummarydatelist 
    SELECT * FROM tblsummarydatelist_temp;
";

$sql_template_restore_table_summary_daily_sales_quote = "
    INSERT INTO tblsummarydailysalesquote 
    SELECT * FROM tblsummarydailysalesquote_temp;
";

$sql_template_restore_table_summary_daily_sales_general = "
    INSERT INTO tblsummarydailysalesgeneral 
    SELECT * FROM tblsummarydailysalesgeneral_temp;
";
?>
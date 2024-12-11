select
    vim.company_name,
    vim.description,
    vim.inventoryid,
    vim.materialid,
    vim.raw_cost,
    vim.raw_description
from
    v_inventory_materials vim;

create view v_inventory_materials as
select `im`.`inventoryid`    AS `inventoryid`,
       `im`.`materialid`     AS `materialid`,
       `i`.`description`     AS `description`,
       `m`.`raw_description` AS `raw_description`,
       `m`.`raw_cost`        AS `raw_cost`,
       `s`.`company_name`    AS `company_name`
from (((`vergola_quotedb_sa_v1_as_live`.`ver_chronoforms_data_inventory_material_vic` `im` join `vergola_quotedb_sa_v1_as_live`.`ver_chronoforms_data_materials_vic` `m` on ((`m`.`cf_id` = `im`.`materialid`))) join `vergola_quotedb_sa_v1_as_live`.`ver_chronoforms_data_inventory_vic` `i` on ((`i`.`inventoryid` = convert(`im`.`inventoryid` using utf8))))
       join `vergola_quotedb_sa_v1_as_live`.`ver_chronoforms_data_supplier_vic` `s`
            on ((`s`.`supplierid` = convert(`m`.`supplierid` using utf8))));


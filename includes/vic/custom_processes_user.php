<?php
/* ===== ===== ===== ===== ===== ===== ===== ===== ===== ===== */
/* ===== begin custom configs user ===== */
/* ===== ===== ===== ===== ===== ===== ===== ===== ===== ===== */
/** @var TYPE_NAME $custom_configs_user */
$custom_configs_user = [
    'user_groups' => [
        '10' => 'System Admin', /* Victoria Admin */
        '29' => 'Accounts', /* Victoria Account User */
        '26' => 'Operation Manager', /* Victoria Operation Manager */
        '30' => 'Site Manager', /* Victoria Site Manager */
        '28' => 'Reception', /* Victoria Reception User */
        '27' => 'Sales Manager', /* Victoria Sales Manager */
        '9' => 'Sales Consultant', /* Victoria Users */
    ],
    'user_access_profiles' => [
        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Admin */
        /* ===== ===== ===== ===== ===== */
        '10' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab enquiry tracker' => ['send mail' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => true, 'save and close' => true]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => true, 'save' => true, 'save and close' => true, 'delete' => true, 'download pdf' => true, 'duplicate' => true, 'add vr items' => true]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab bill of materials' => ['show' => true],
                'tab purchase order' => ['show' => true],
                'tab po summary' => ['show' => true],
                'tab check list' => ['show' => true],
                'tab vergola standard' => ['edit' => true],
                'tab statutory approval' => ['edit' => true],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['update' => true, 'cancel contract' => true]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => true],
                'button purchase order' => ['show' => true],
                'button po summary' => ['show' => true],
                'button check list' => ['show' => true],
                'record action' => ['remove' => true, 'save' => true, 'process order' => true, 'cancel order' => true, 'add vr items' => true]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => true, 'save and process po' => true]
            ]
        ],
        /* end Victoria Admin */


        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Account User */
        /* ===== ===== ===== ===== ===== */
        '29' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => false, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => false, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => false, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => false],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => false, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['save' => false, 'delete' => false]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => false, 'view costing' => true, 'view contract' => true],
                'tab enquiry tracker' => ['send mail' => false],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['save' => false, 'delete' => false]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => false, 'save and close' => false]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => false, 'save' => false, 'save and close' => false, 'delete' => false, 'download pdf' => false, 'duplicate' => false, 'add vr items' => false]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab bill of materials' => ['show' => true],
                'tab purchase order' => ['show' => true],
                'tab po summary' => ['show' => true],
                'tab check list' => ['show' => true],
                'tab vergola standard' => ['edit' => true],
                'tab statutory approval' => ['edit' => true],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['update' => true, 'cancel contract' => true]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => true],
                'button purchase order' => ['show' => true],
                'button po summary' => ['show' => true],
                'button check list' => ['show' => true],
                'record action' => ['remove' => true, 'save' => true, 'process order' => true, 'cancel order' => true, 'add vr items' => true]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => true, 'save and process po' => true]
            ]
        ],
        /* end Victoria Account User */


        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Operation Manager */
        /* ===== ===== ===== ===== ===== */
        '26' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => false, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => false],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => false],
                'tab costing info' => ['add new costing' => false, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['save' => false, 'delete' => false]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => false, 'view costing' => true, 'view contract' => true],
                'tab enquiry tracker' => ['send mail' => false],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['save' => false, 'delete' => false]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => false, 'save and close' => false]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => false, 'save' => false, 'save and close' => false, 'delete' => false, 'download pdf' => false, 'duplicate' => false, 'add vr items' => false]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab bill of materials' => ['show' => true],
                'tab purchase order' => ['show' => true],
                'tab po summary' => ['show' => true],
                'tab check list' => ['show' => true],
                'tab vergola standard' => ['edit' => true],
                'tab statutory approval' => ['edit' => true],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['update' => true, 'cancel contract' => true]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => true],
                'button purchase order' => ['show' => true],
                'button po summary' => ['show' => true],
                'button check list' => ['show' => true],
                'record action' => ['remove' => true, 'save' => true, 'process order' => true, 'cancel order' => true, 'add vr items' => true]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => true, 'save and process po' => true]
            ]
        ],
        /* end Victoria Operation Manager */


        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Site Manager */
        /* ===== ===== ===== ===== ===== */
        '30' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => false],
                'tab costing info' => ['add new costing' => false, 'view costing' => false, 'view contract' => false],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => false
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => false],
                'tab costing info' => ['add new costing' => false, 'view costing' => false, 'view contract' => false],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => false
                ],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['save' => false, 'delete' => false]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => false, 'view costing' => false, 'view contract' => false],
                'tab enquiry tracker' => ['send mail' => false],
                'tab follow up' => [
                    'not interested' => false, 'costed' => false, 'quoted' => false, 'under consideration' => false, 
                    'future project' => false, 'won' => false, 'lost' => false, 
                    'project status' => false, 
                    'create contract' => false
                ],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['save' => false, 'delete' => false]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => false, 'save and close' => false]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => false, 'save' => false, 'save and close' => false, 'delete' => false, 'download pdf' => false, 'duplicate' => false, 'add vr items' => false]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => false],
                'tab bill of materials' => ['show' => true],
                'tab purchase order' => ['show' => true],
                'tab po summary' => ['show' => true],
                'tab check list' => ['show' => true],
                'tab vergola standard' => ['edit' => true],
                'tab statutory approval' => ['edit' => true],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['update' => true, 'cancel contract' => false]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => true],
                'button purchase order' => ['show' => true],
                'button po summary' => ['show' => true],
                'button check list' => ['show' => true],
                'record action' => ['remove' => false, 'save' => false, 'process order' => false, 'cancel order' => false, 'add vr items' => false]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => false, 'save and process po' => false]
            ]
        ],
        /* end Victoria Site Manager */


        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Reception User */
        /* ===== ===== ===== ===== ===== */
        '28' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab enquiry tracker' => ['send mail' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => true, 'save and close' => true]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => true, 'save' => true, 'save and close' => true, 'delete' => true, 'download pdf' => true, 'duplicate' => true, 'add vr items' => true]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab bill of materials' => ['show' => true],
                'tab purchase order' => ['show' => true],
                'tab po summary' => ['show' => true],
                'tab check list' => ['show' => true],
                'tab vergola standard' => ['edit' => true],
                'tab statutory approval' => ['edit' => false],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['update' => true, 'cancel contract' => false]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => true],
                'button purchase order' => ['show' => true],
                'button po summary' => ['show' => true],
                'button check list' => ['show' => true],
                'record action' => ['remove' => false, 'save' => false, 'process order' => false, 'cancel order' => false, 'add vr items' => false]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => false, 'save and process po' => false]
            ]
        ],
        /* end Victoria Reception User */


        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Sales Manager */
        /* ===== ===== ===== ===== ===== */
        '27' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab enquiry tracker' => ['send mail' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => true
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => true, 'save and close' => true]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => true, 'save' => true, 'save and close' => true, 'delete' => true, 'download pdf' => true, 'duplicate' => true, 'add vr items' => true]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => false],
                'tab bill of materials' => ['show' => true],
                'tab purchase order' => ['show' => true],
                'tab po summary' => ['show' => true],
                'tab check list' => ['show' => true],
                'tab vergola standard' => ['edit' => false],
                'tab statutory approval' => ['edit' => false],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['update' => true, 'cancel contract' => false]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => true],
                'button purchase order' => ['show' => true],
                'button po summary' => ['show' => true],
                'button check list' => ['show' => true],
                'record action' => ['remove' => false, 'save' => false, 'process order' => false, 'cancel order' => false, 'add vr items' => false]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => false, 'save and process po' => false]
            ]
        ],
        /* end Victoria Sales Manager */


        /* ===== ===== ===== ===== ===== */
        /* begin Victoria Users */
        /* ===== ===== ===== ===== ===== */
        '9' => [
            'client-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => false
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'builder-folder-vic' => [
                'tab client details' => ['edit' => true],
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => false
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'tender-folder-vic' => [
                'tab costing info' => ['add new costing' => true, 'view costing' => true, 'view contract' => true],
                'tab enquiry tracker' => ['send mail' => true],
                'tab follow up' => [
                    'not interested' => true, 'costed' => true, 'quoted' => true, 'under consideration' => true, 
                    'future project' => true, 'won' => true, 'lost' => true, 
                    'project status' => true, 
                    'create contract' => false
                ],
                'tab sales' => ['save' => true, 'delete' => true],
                'tab correspondence' => ['save' => true, 'delete' => true],
                'tab statutory' => ['save' => true, 'delete' => true],
                'tab photos' => ['save' => true, 'delete' => true],
                'tab drawings' => ['save' => true, 'delete' => true],
                'tab general' => ['save' => true, 'delete' => true],
                'record action' => ['save' => true, 'delete' => true]
            ],
            'add-quote-vic' => [
                'record action' => ['save' => true, 'save and close' => true]
            ],
            'add-quote-vic > quote_edit' => [
                'record action' => ['remove' => true, 'save' => true, 'save and close' => true, 'delete' => true, 'download pdf' => true, 'duplicate' => true, 'add vr items' => true]
            ],
            'contract-folder-vic' => [
                'tab client details' => ['edit' => false],
                'tab bill of materials' => ['show' => false],
                'tab purchase order' => ['show' => false],
                'tab po summary' => ['show' => false],
                'tab check list' => ['show' => false],
                'tab vergola standard' => ['edit' => false],
                'tab statutory approval' => ['edit' => false],
                'tab contract cancellation' => ['edit' => true],
                'tab sales' => ['save' => false, 'delete' => false],
                'tab correspondence' => ['save' => false, 'delete' => false],
                'tab statutory' => ['save' => false, 'delete' => false],
                'tab photos' => ['save' => false, 'delete' => false],
                'tab drawings' => ['save' => false, 'delete' => false],
                'tab general' => ['save' => false, 'delete' => false],
                'record action' => ['update' => false, 'cancel contract' => false]
            ],
            'add-quote-vic > contract_bom' => [
                'button bill of materials' => ['show' => false],
                'button purchase order' => ['show' => false],
                'button po summary' => ['show' => false],
                'button check list' => ['show' => false],
                'record action' => ['remove' => false, 'save' => false, 'process order' => false, 'cancel order' => false, 'add vr items' => false]
            ],
            'contract-po-vic' => [
                'record action' => ['cancel po' => false, 'save and process po' => false]
            ]
        ]
        /* end Victoria Users */
    ]
];
/* ===== end custom configs user ===== */
?>





<?php
/* ===== ===== ===== ===== ===== ===== ===== ===== ===== ===== */
/* ===== begin custom functions user ===== */
/* ===== ===== ===== ===== ===== ===== ===== ===== ===== ===== */
class CustomFunctionsUser {
    function getUserGroupKey($user_group_info) {
        $user_group_key = '';

        foreach ($user_group_info as $key1 => $value1) {
            $user_group_key = $key1;
        }

        return $user_group_key;
    }
}
/* ===== end custom functions user ===== */
?>





<?php
/* ===== ===== ===== ===== ===== ===== ===== ===== ===== ===== */
/* ===== begin custom processes user ===== */
/* ===== ===== ===== ===== ===== ===== ===== ===== ===== ===== */
$current_signed_in_user_info = JFactory::getUser();

$custom_functions_user = new CustomFunctionsUser();
$current_signed_in_user_group_key = $custom_functions_user->getUserGroupKey($current_signed_in_user_info->groups);
/* ===== end custom processes user ===== */
?>
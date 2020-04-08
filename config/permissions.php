<?php

return [
    'data' => [

        [
            'name' => 'Dash Board',
            'subs' => [
                [
                    'name' => 'Dash Board',
                    'subs' => false,
                    'route_name' => 'dashboard',
                    'role' => 'dashboard',
                    'icon' => 'pe-7s-rocket'
                ],

            ]

        ],
        [
            'name' => 'Admin',
            'subs' => [
                [
                    'name' => 'User',
                    'icon' => 'pe-7s-users',
                    'role' => 'user',
                    'subs' => [
                        [
                            'name' => 'User Add',
                            'subs' => false,
                            'route_name' => 'users.create',
                        ],
                        [
                            'name' => 'User Manager',
                            'sub' => false,
                            'route_name' => 'users.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Machine Type',
                    'icon' => 'pe-7s-car',
                    'role' => 'machine',
                    'subs' => [
                        [
                            'name' => 'Machine Add',
                            'subs' => false,
                            'route_name' => 'machines.create',
                        ],
                        [
                            'name' => 'Machine Manager',
                            'sub' => false,
                            'route_name' => 'machines.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Units',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'unit',
                    'subs' => [
                        [
                            'name' => 'Units Add',
                            'subs' => false,
                            'route_name' => 'units.create',
                        ],
                        [
                            'name' => 'Units Manager',
                            'sub' => false,
                            'route_name' => 'units.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Countries',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'country',
                    'subs' => [
                        [
                            'name' => 'Countries Add',
                            'subs' => false,
                            'route_name' => 'countries.create',

                        ],
                        [
                            'name' => 'Countries Manager',
                            'sub' => false,
                            'route_name' => 'countries.index',

                        ],
                    ],
                ],
                [
                    'name' => 'Brands',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'brand',
                    'subs' => [
                        [
                            'name' => 'Brand Add',
                            'subs' => false,
                            'route_name' => 'brands.create',

                        ],
                        [
                            'name' => 'Brand Manager',
                            'sub' => false,
                            'route_name' => 'brands.index',

                        ],
                    ],
                ],
                [
                    'name' => 'Currency',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'currency',
                    'subs' => [
                        [
                            'name' => 'Currencies Add',
                            'subs' => false,
                            'route_name' => 'currencies.create',

                        ],
                        [
                            'name' => 'Currency Manager',
                            'sub' => false,
                            'route_name' => 'currencies.index',

                        ],
                    ],
                ],
                [
                    'name' => 'Model',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'brand_models',
                    'subs' => [
                        [
                            'name' => 'Model Add',
                            'subs' => false,
                            'route_name' => 'brand_models.create',

                        ],
                        [
                            'name' => 'Model Manager',
                            'sub' => false,
                            'route_name' => 'brand_models.index',

                        ],
                    ],
                ],
                [
                    'name' => 'Spare Parts',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'spare_part',
                    'subs' => [
                        [
                            'name' => 'Spare Parts Add',
                            'subs' => false,
                            'route_name' => 'spare_parts.create',
                        ],
                        [
                            'name' => 'Spare Parts Manager',
                            'sub' => false,
                            'route_name' => 'spare_parts.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Suplier',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'supplier',
                    'subs' => [
                        [
                            'name' => 'Suplier Add',
                            'subs' => false,
                            'route_name' => 'suppliers.create',
                        ],
                        [
                            'name' => 'Suplier Manager',
                            'sub' => false,
                            'route_name' => 'suppliers.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Material',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'material',
                    'subs' => [
                        [
                            'name' => 'Material Add',
                            'subs' => false,
                            'route_name' => 'materials.create',
                        ],
                        [
                            'name' => 'Material Manager',
                            'sub' => false,
                            'route_name' => 'materials.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Machinery',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'machinerie',
                    'subs' => [
                        [
                            'name' => 'Machinery Add',
                            'subs' => false,
                            'route_name' => 'machineries.create',
                        ],
                        [
                            'name' => 'Machinery Manager',
                            'sub' => false,
                            'route_name' => 'machineries.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Customer',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'customer',
                    'subs' => [
                        [
                            'name' => 'Customer Add',
                            'subs' => false,
                            'route_name' => 'customers.create',
                        ],
                        [
                            'name' => 'Customer Manager',
                            'sub' => false,
                            'route_name' => 'customers.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Employee Category',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'employee_categorie',
                    'subs' => [
                        [
                            'name' => 'Category Add',
                            'subs' => false,
                            'route_name' => 'employee_categories.create',
                        ],
                        [
                            'name' => 'Category Manager',
                            'sub' => false,
                            'route_name' => 'employee_categories.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Employee',
                    'icon' => 'pe-7s-bandaid',
                    'role' => 'employee',
                    'subs' => [
                        [
                            'name' => 'Employee Add',
                            'subs' => false,
                            'route_name' => 'employees.create',
                        ],
                        [
                            'name' => 'Employee Manager',
                            'sub' => false,
                            'route_name' => 'employees.index',
                        ],
                    ],
                ],


            ],
        ],
        [
            'name' => 'Spare Parts',
            'subs' => [
                [
                    'name' => 'PO',
                    'icon' => 'pe-7s-users',
                    'role' => 'po',
                    'subs' => [
                        [
                            'name' => 'PO Add',
                            'subs' => false,
                            'route_name' => 'spare_po.create',
                        ],
                        [
                            'name' => 'PO Manager',
                            'sub' => false,
                            'route_name' => 'spare_po.index',
                        ],
                    ],
                ],           
                [
                    'name' => 'GRN',
                    'icon' => 'pe-7s-users',
                    'role' => 'grn',
                    'subs' => [
                        [
                            'name' => 'GRN Add',
                            'subs' => false,
                            'route_name' => 'spare_grn.create',
                        ],
                        [
                            'name' => 'GRN Manager',
                            'sub' => false,
                            'route_name' => 'spare_grn.index',
                        ],
                    ],
                ],    
                [
                    'name' => 'Customer PO',
                    'icon' => 'pe-7s-users',
                    'role' => 'customer_po',
                    'subs' => [
                        [
                            'name' => 'Customer PO Add',
                            'subs' => false,
                            'route_name' => 'customer_pos.create',
                        ],
                        [
                            'name' => 'Customer PO Manager',
                            'sub' => false,
                            'route_name' => 'customer_pos.index',
                        ],
                    ],
                ],   
                [
                    'name' => 'Invoice',
                    'icon' => 'pe-7s-users',
                    'role' => 'invoice',
                    'subs' => [
                        [
                            'name' => 'Invoice Add',
                            'subs' => false,
                            'route_name' => 'spare_invoice.create',
                        ],
                        [
                            'name' => 'Invoice Manager',
                            'sub' => false,
                            'route_name' => 'spare_invoice.index',
                        ],
                    ],
                ],
                [
                    'name' => 'GIN',
                    'icon' => 'pe-7s-users',
                    'role' => 'gin',
                    'subs' => [
                        [
                            'name' => 'GIN Add',
                            'subs' => false,
                            'route_name' => 'spare_gin.create',
                        ],
                        [
                            'name' => 'GIN Manager',
                            'sub' => false,
                            'route_name' => 'spare_gin.index',
                        ],
                    ],
                ],
                [
                    'name' => 'DN',
                    'icon' => 'pe-7s-users',
                    'role' => 'gin',
                    'subs' => [
                        [
                            'name' => 'DN Add',
                            'subs' => false,
                            'route_name' => 'spare_dn.create',
                        ],
                        [
                            'name' => 'DN Manager',
                            'sub' => false,
                            'route_name' => 'spare_dn.index',
                        ],
                    ],
                ],
                [
                    'name' => 'GRF',
                    'icon' => 'pe-7s-users',
                    'role' => 'gin',
                    'subs' => [
                        [
                            'name' => 'GRF Add',
                            'subs' => false,
                            'route_name' => 'spare_grf.create',
                        ],
                        [
                            'name' => 'GRF Manager',
                            'sub' => false,
                            'route_name' => 'spare_grf.index',
                        ],
                    ],
                ],             
             ]
        ],
            
        [
            'name' => 'Account & Overhead',
            'subs' => [
                [
                    'name' => 'Account',
                    'icon' => 'pe-7s-users',
                    'role' => 'account',
                    'subs' => [
                        [
                            'name' => 'Account Add',
                            'subs' => false,
                            'route_name' => 'accounts.create',
                        ],
                        [
                            'name' => 'Account Manager',
                            'sub' => false,
                            'route_name' => 'accounts.index',
                        ],
                    ],
                ],
                [
                    'name' => 'Sub Account',
                    'icon' => 'pe-7s-users',
                    'role' => 'sub_account',
                    'subs' => [
                        [
                            'name' => 'Sub Account Add',
                            'subs' => false,
                            'route_name' => 'sub_accounts.create',
                        ],
                        [
                            'name' => 'Sub Account Manager',
                            'sub' => false,
                            'route_name' => 'sub_accounts.index',
                        ],
                    ],
                ], /*  
                [
                    'name' => 'Sub Account level 2',
                    'icon' => 'pe-7s-users',
                    'role' => 'user',
                    'subs' => [
                        [
                            'name' => 'Account level 2 Add',
                            'subs' => false,
                            'route_name' => 'users.create',
                        ],
                        [
                            'name' => 'Account level 2 Manager',
                            'sub' => false,
                            'route_name' => 'users.index',
                        ],
                    ],
                ],*/

                [
                    'name' => 'Add Account',
                    'icon' => 'pe-7s-users',
                    'role' => 'user',
                    'subs' => [
                        [
                            'name' => 'Add Account Add',
                            'subs' => false,
                            'route_name' => 'users.create',
                        ],
                        [
                            'name' => 'Add Account Manager',
                            'sub' => false,
                            'route_name' => 'users.index',
                        ],
                    ],
                ],
            ]
        ]

    ],
];
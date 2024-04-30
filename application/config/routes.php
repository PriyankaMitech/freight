<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['test'] = 'welcome/test';
$route['login_auth'] = 'login/login_auth';
$route['Logout'] = 'login/Logout';
$route['dashboard'] = 'home/dashboard';
$route['transcred'] = 'home/transcred';
$route['transportal'] = 'transport/transportal';
$route['get_sales'] = 'Transport/get_sales';

$route['transHistory'] = 'transport/transHistory';
$route['transport_master'] = 'home/transport_master';
$route['vehicle_master'] = 'Home/vehicle_master';

$route['contract_master'] = 'Home/contract_master';
$route['test_query'] = 'Home/test_query';
$route['contractupload'] = 'Phpspreadsheet/contractupload';

$route['zone_master'] = 'Home/zone_master';
$route['diesel_master'] = 'Home/diesel_master';
$route['kilometer_master'] = 'Home/kilometer_master';

$route['add-kilometer'] = 'Home/add_kilometer';
$route['save_kilometer'] = 'Home/save_kilometer';
$route['edit_kilometer/(:any)'] = 'Home/edit_kilometer/$1';
$route['delete_kilometer/(:any)'] = 'Home/delete_kilometer/$1';

$route['add-transporter'] = 'Home/add_transporter';
$route['save_transporter'] = 'Home/save_transporter';
$route['edit_transporter/(:any)'] = 'Home/edit_transporter/$1';
$route['delete_transporter/(:any)'] = 'Home/delete_transporter/$1';

$route['add_vehicle'] = 'Home/add_vehicle';
$route['save_vehicle'] = 'Home/save_vehicle';
$route['edit_vehicle/(:any)'] = 'Home/edit_vehicle/$1';
$route['delete_vehicle/(:any)'] = 'Home/delete_vehicle/$1';

$route['add_dieselrate'] = 'Home/add_dieselrate';
$route['save_dieselrate'] = 'Home/save_dieselrate';
$route['edit_dieselrate/(:any)'] = 'Home/edit_dieselrate/$1';

$route['add_zone'] = 'Home/add_zone';
$route['save_zone'] = 'Home/save_zone';
$route['edit_zone/(:any)'] = 'Home/edit_zone/$1';

$route['sales_register'] = 'Home/sales_register';
$route['salesregisterupload'] = 'Phpspreadsheet/salesregisterupload';

$route['reports'] = 'Report';
$route['reports/detention_report'] = 'Home/detention_report';

$route['budget_up'] = 'Home/budget_up';
$route['budgetupload'] = 'Phpspreadsheet/budgetupload';
$route['cost_statement'] = 'Home/cost_statement';

$route['excel'] = 'Home/excel';
$route['export_excel/(:any)'] = 'Report/export_excel/$1';

$route['save_trans_knowoff'] = 'Transport/save_trans_knowoff';
$route['save_trans/(:any)'] = 'Transport/save_trans/$1';
$route['edit_trans/(:any)'] = 'Transport/edit_trans/$1';
$route['TransView'] = 'Transport/TransView';
$route['download/(:any)'] = 'Transport/download/$1';

$route['ChangePassword'] = 'home/ChangePassword';
$route['save_password'] = 'home/save_password';

$route['delete_lr'] = 'Home/Master_LR';
$route['delete_LR_NO/(:any)'] = 'Home/delete_LR_NO/$1';



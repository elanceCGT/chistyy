<?php

/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */
/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 * 		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 * 		'MyCacheFilter' => array('prefix' => 'my_cache_'), //  will use MyCacheFilter class from the Routing/Filter package in your app with settings array.
 * 		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 * 		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'File',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'File',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

Configure::write('LocationType', array(
    '1' => 'Facility',
    '2' => 'Event',
    '3' => 'Shop'
));

Configure::write('CountriesList', array(
    array('id' => '1', 'country_code' => 'US', 'country_name' => 'United States', 'country_code_no' => '0'),
    array('id' => '2', 'country_code' => 'CA', 'country_name' => 'Canada', 'country_code_no' => '0'),
    array('id' => '3', 'country_code' => 'AF', 'country_name' => 'Afghanistan', 'country_code_no' => '0'),
    array('id' => '4', 'country_code' => 'AL', 'country_name' => 'Albania', 'country_code_no' => '0'),
    array('id' => '5', 'country_code' => 'DZ', 'country_name' => 'Algeria', 'country_code_no' => '0'),
    array('id' => '6', 'country_code' => 'DS', 'country_name' => 'American Samoa', 'country_code_no' => '0'),
    array('id' => '7', 'country_code' => 'AD', 'country_name' => 'Andorra', 'country_code_no' => '0'),
    array('id' => '8', 'country_code' => 'AO', 'country_name' => 'Angola', 'country_code_no' => '0'),
    array('id' => '9', 'country_code' => 'AI', 'country_name' => 'Anguilla', 'country_code_no' => '0'),
    array('id' => '10', 'country_code' => 'AQ', 'country_name' => 'Antarctica', 'country_code_no' => '0'),
    array('id' => '11', 'country_code' => 'AG', 'country_name' => 'Antigua and/or Barbuda', 'country_code_no' => '0'),
    array('id' => '12', 'country_code' => 'AR', 'country_name' => 'Argentina', 'country_code_no' => '0'),
    array('id' => '13', 'country_code' => 'AM', 'country_name' => 'Armenia', 'country_code_no' => '0'),
    array('id' => '14', 'country_code' => 'AW', 'country_name' => 'Aruba', 'country_code_no' => '0'),
    array('id' => '15', 'country_code' => 'AU', 'country_name' => 'Australia', 'country_code_no' => '0'),
    array('id' => '16', 'country_code' => 'AT', 'country_name' => 'Austria', 'country_code_no' => '0'),
    array('id' => '17', 'country_code' => 'AZ', 'country_name' => 'Azerbaijan', 'country_code_no' => '0'),
    array('id' => '18', 'country_code' => 'BS', 'country_name' => 'Bahamas', 'country_code_no' => '0'),
    array('id' => '19', 'country_code' => 'BH', 'country_name' => 'Bahrain', 'country_code_no' => '0'),
    array('id' => '20', 'country_code' => 'BD', 'country_name' => 'Bangladesh', 'country_code_no' => '0'),
    array('id' => '21', 'country_code' => 'BB', 'country_name' => 'Barbados', 'country_code_no' => '0'),
    array('id' => '22', 'country_code' => 'BY', 'country_name' => 'Belarus', 'country_code_no' => '0'),
    array('id' => '23', 'country_code' => 'BE', 'country_name' => 'Belgium', 'country_code_no' => '0'),
    array('id' => '24', 'country_code' => 'BZ', 'country_name' => 'Belize', 'country_code_no' => '0'),
    array('id' => '25', 'country_code' => 'BJ', 'country_name' => 'Benin', 'country_code_no' => '0'),
    array('id' => '26', 'country_code' => 'BM', 'country_name' => 'Bermuda', 'country_code_no' => '0'),
    array('id' => '27', 'country_code' => 'BT', 'country_name' => 'Bhutan', 'country_code_no' => '0'),
    array('id' => '28', 'country_code' => 'BO', 'country_name' => 'Bolivia', 'country_code_no' => '0'),
    array('id' => '29', 'country_code' => 'BA', 'country_name' => 'Bosnia and Herzegovina', 'country_code_no' => '0'),
    array('id' => '30', 'country_code' => 'BW', 'country_name' => 'Botswana', 'country_code_no' => '0'),
    array('id' => '31', 'country_code' => 'BV', 'country_name' => 'Bouvet Island', 'country_code_no' => '0'),
    array('id' => '32', 'country_code' => 'BR', 'country_name' => 'Brazil', 'country_code_no' => '0'),
    array('id' => '33', 'country_code' => 'IO', 'country_name' => 'British lndian Ocean Territory', 'country_code_no' => '0'),
    array('id' => '34', 'country_code' => 'BN', 'country_name' => 'Brunei Darussalam', 'country_code_no' => '0'),
    array('id' => '35', 'country_code' => 'BG', 'country_name' => 'Bulgaria', 'country_code_no' => '0'),
    array('id' => '36', 'country_code' => 'BF', 'country_name' => 'Burkina Faso', 'country_code_no' => '0'),
    array('id' => '37', 'country_code' => 'BI', 'country_name' => 'Burundi', 'country_code_no' => '0'),
    array('id' => '38', 'country_code' => 'KH', 'country_name' => 'Cambodia', 'country_code_no' => '0'),
    array('id' => '39', 'country_code' => 'CM', 'country_name' => 'Cameroon', 'country_code_no' => '0'),
    array('id' => '40', 'country_code' => 'CV', 'country_name' => 'Cape Verde', 'country_code_no' => '0'),
    array('id' => '41', 'country_code' => 'KY', 'country_name' => 'Cayman Islands', 'country_code_no' => '0'),
    array('id' => '42', 'country_code' => 'CF', 'country_name' => 'Central African Republic', 'country_code_no' => '0'),
    array('id' => '43', 'country_code' => 'TD', 'country_name' => 'Chad', 'country_code_no' => '0'),
    array('id' => '44', 'country_code' => 'CL', 'country_name' => 'Chile', 'country_code_no' => '0'),
    array('id' => '45', 'country_code' => 'CN', 'country_name' => 'China', 'country_code_no' => '0'),
    array('id' => '46', 'country_code' => 'CX', 'country_name' => 'Christmas Island', 'country_code_no' => '0'),
    array('id' => '47', 'country_code' => 'CC', 'country_name' => 'Cocos (Keeling) Islands', 'country_code_no' => '0'),
    array('id' => '48', 'country_code' => 'CO', 'country_name' => 'Colombia', 'country_code_no' => '0'),
    array('id' => '49', 'country_code' => 'KM', 'country_name' => 'Comoros', 'country_code_no' => '0'),
    array('id' => '50', 'country_code' => 'CG', 'country_name' => 'Congo', 'country_code_no' => '0'),
    array('id' => '51', 'country_code' => 'CK', 'country_name' => 'Cook Islands', 'country_code_no' => '0'),
    array('id' => '52', 'country_code' => 'CR', 'country_name' => 'Costa Rica', 'country_code_no' => '0'),
    array('id' => '53', 'country_code' => 'HR', 'country_name' => 'Croatia (Hrvatska)', 'country_code_no' => '0'),
    array('id' => '54', 'country_code' => 'CU', 'country_name' => 'Cuba', 'country_code_no' => '0'),
    array('id' => '55', 'country_code' => 'CY', 'country_name' => 'Cyprus', 'country_code_no' => '0'),
    array('id' => '56', 'country_code' => 'CZ', 'country_name' => 'Czech Republic', 'country_code_no' => '0'),
    array('id' => '57', 'country_code' => 'DK', 'country_name' => 'Denmark', 'country_code_no' => '0'),
    array('id' => '58', 'country_code' => 'DJ', 'country_name' => 'Djibouti', 'country_code_no' => '0'),
    array('id' => '59', 'country_code' => 'DM', 'country_name' => 'Dominica', 'country_code_no' => '0'),
    array('id' => '60', 'country_code' => 'DO', 'country_name' => 'Dominican Republic', 'country_code_no' => '0'),
    array('id' => '61', 'country_code' => 'TP', 'country_name' => 'East Timor', 'country_code_no' => '0'),
    array('id' => '62', 'country_code' => 'EC', 'country_name' => 'Ecudaor', 'country_code_no' => '0'),
    array('id' => '63', 'country_code' => 'EG', 'country_name' => 'Egypt', 'country_code_no' => '0'),
    array('id' => '64', 'country_code' => 'SV', 'country_name' => 'El Salvador', 'country_code_no' => '0'),
    array('id' => '65', 'country_code' => 'GQ', 'country_name' => 'Equatorial Guinea', 'country_code_no' => '0'),
    array('id' => '66', 'country_code' => 'ER', 'country_name' => 'Eritrea', 'country_code_no' => '0'),
    array('id' => '67', 'country_code' => 'EE', 'country_name' => 'Estonia', 'country_code_no' => '0'),
    array('id' => '68', 'country_code' => 'ET', 'country_name' => 'Ethiopia', 'country_code_no' => '0'),
    array('id' => '69', 'country_code' => 'FK', 'country_name' => 'Falkland Islands (Malvinas)', 'country_code_no' => '0'),
    array('id' => '70', 'country_code' => 'FO', 'country_name' => 'Faroe Islands', 'country_code_no' => '0'),
    array('id' => '71', 'country_code' => 'FJ', 'country_name' => 'Fiji', 'country_code_no' => '0'),
    array('id' => '72', 'country_code' => 'FI', 'country_name' => 'Finland', 'country_code_no' => '0'),
    array('id' => '73', 'country_code' => 'FR', 'country_name' => 'France', 'country_code_no' => '0'),
    array('id' => '74', 'country_code' => 'FX', 'country_name' => 'France, Metropolitan', 'country_code_no' => '0'),
    array('id' => '75', 'country_code' => 'GF', 'country_name' => 'French Guiana', 'country_code_no' => '0'),
    array('id' => '76', 'country_code' => 'PF', 'country_name' => 'French Polynesia', 'country_code_no' => '0'),
    array('id' => '77', 'country_code' => 'TF', 'country_name' => 'French Southern Territories', 'country_code_no' => '0'),
    array('id' => '78', 'country_code' => 'GA', 'country_name' => 'Gabon', 'country_code_no' => '0'),
    array('id' => '79', 'country_code' => 'GM', 'country_name' => 'Gambia', 'country_code_no' => '0'),
    array('id' => '80', 'country_code' => 'GE', 'country_name' => 'Georgia', 'country_code_no' => '0'),
    array('id' => '81', 'country_code' => 'DE', 'country_name' => 'Germany', 'country_code_no' => '0'),
    array('id' => '82', 'country_code' => 'GH', 'country_name' => 'Ghana', 'country_code_no' => '0'),
    array('id' => '83', 'country_code' => 'GI', 'country_name' => 'Gibraltar', 'country_code_no' => '0'),
    array('id' => '84', 'country_code' => 'GR', 'country_name' => 'Greece', 'country_code_no' => '0'),
    array('id' => '85', 'country_code' => 'GL', 'country_name' => 'Greenland', 'country_code_no' => '0'),
    array('id' => '86', 'country_code' => 'GD', 'country_name' => 'Grenada', 'country_code_no' => '0'),
    array('id' => '87', 'country_code' => 'GP', 'country_name' => 'Guadeloupe', 'country_code_no' => '0'),
    array('id' => '88', 'country_code' => 'GU', 'country_name' => 'Guam', 'country_code_no' => '0'),
    array('id' => '89', 'country_code' => 'GT', 'country_name' => 'Guatemala', 'country_code_no' => '0'),
    array('id' => '90', 'country_code' => 'GN', 'country_name' => 'Guinea', 'country_code_no' => '0'),
    array('id' => '91', 'country_code' => 'GW', 'country_name' => 'Guinea-Bissau', 'country_code_no' => '0'),
    array('id' => '92', 'country_code' => 'GY', 'country_name' => 'Guyana', 'country_code_no' => '0'),
    array('id' => '93', 'country_code' => 'HT', 'country_name' => 'Haiti', 'country_code_no' => '0'),
    array('id' => '94', 'country_code' => 'HM', 'country_name' => 'Heard and Mc Donald Islands', 'country_code_no' => '0'),
    array('id' => '95', 'country_code' => 'HN', 'country_name' => 'Honduras', 'country_code_no' => '0'),
    array('id' => '96', 'country_code' => 'HK', 'country_name' => 'Hong Kong', 'country_code_no' => '0'),
    array('id' => '97', 'country_code' => 'HU', 'country_name' => 'Hungary', 'country_code_no' => '0'),
    array('id' => '98', 'country_code' => 'IS', 'country_name' => 'Iceland', 'country_code_no' => '0'),
    array('id' => '99', 'country_code' => 'IN', 'country_name' => 'India', 'country_code_no' => '91'),
    array('id' => '100', 'country_code' => 'ID', 'country_name' => 'Indonesia', 'country_code_no' => '0'),
    array('id' => '101', 'country_code' => 'IR', 'country_name' => 'Iran (Islamic Republic of)', 'country_code_no' => '0'),
    array('id' => '102', 'country_code' => 'IQ', 'country_name' => 'Iraq', 'country_code_no' => '0'),
    array('id' => '103', 'country_code' => 'IE', 'country_name' => 'Ireland', 'country_code_no' => '0'),
    array('id' => '104', 'country_code' => 'IL', 'country_name' => 'Israel', 'country_code_no' => '0'),
    array('id' => '105', 'country_code' => 'IT', 'country_name' => 'Italy', 'country_code_no' => '39'),
    array('id' => '106', 'country_code' => 'CI', 'country_name' => 'Ivory Coast', 'country_code_no' => '0'),
    array('id' => '107', 'country_code' => 'JM', 'country_name' => 'Jamaica', 'country_code_no' => '0'),
    array('id' => '108', 'country_code' => 'JP', 'country_name' => 'Japan', 'country_code_no' => '0'),
    array('id' => '109', 'country_code' => 'JO', 'country_name' => 'Jordan', 'country_code_no' => '0'),
    array('id' => '110', 'country_code' => 'KZ', 'country_name' => 'Kazakhstan', 'country_code_no' => '0'),
    array('id' => '111', 'country_code' => 'KE', 'country_name' => 'Kenya', 'country_code_no' => '0'),
    array('id' => '112', 'country_code' => 'KI', 'country_name' => 'Kiribati', 'country_code_no' => '0'),
    array('id' => '113', 'country_code' => 'KP', 'country_name' => 'Korea, Democratic People\'s Republic of', 'country_code_no' => '0'),
    array('id' => '114', 'country_code' => 'KR', 'country_name' => 'Korea, Republic of', 'country_code_no' => '0'),
    array('id' => '115', 'country_code' => 'KW', 'country_name' => 'Kuwait', 'country_code_no' => '0'),
    array('id' => '116', 'country_code' => 'KG', 'country_name' => 'Kyrgyzstan', 'country_code_no' => '0'),
    array('id' => '117', 'country_code' => 'LA', 'country_name' => 'Lao People\'s Democratic Republic', 'country_code_no' => '0'),
    array('id' => '118', 'country_code' => 'LV', 'country_name' => 'Latvia', 'country_code_no' => '0'),
    array('id' => '119', 'country_code' => 'LB', 'country_name' => 'Lebanon', 'country_code_no' => '0'),
    array('id' => '120', 'country_code' => 'LS', 'country_name' => 'Lesotho', 'country_code_no' => '0'),
    array('id' => '121', 'country_code' => 'LR', 'country_name' => 'Liberia', 'country_code_no' => '0'),
    array('id' => '122', 'country_code' => 'LY', 'country_name' => 'Libyan Arab Jamahiriya', 'country_code_no' => '0'),
    array('id' => '123', 'country_code' => 'LI', 'country_name' => 'Liechtenstein', 'country_code_no' => '0'),
    array('id' => '124', 'country_code' => 'LT', 'country_name' => 'Lithuania', 'country_code_no' => '0'),
    array('id' => '125', 'country_code' => 'LU', 'country_name' => 'Luxembourg', 'country_code_no' => '0'),
    array('id' => '126', 'country_code' => 'MO', 'country_name' => 'Macau', 'country_code_no' => '0'),
    array('id' => '127', 'country_code' => 'MK', 'country_name' => 'Macedonia', 'country_code_no' => '0'),
    array('id' => '128', 'country_code' => 'MG', 'country_name' => 'Madagascar', 'country_code_no' => '0'),
    array('id' => '129', 'country_code' => 'MW', 'country_name' => 'Malawi', 'country_code_no' => '0'),
    array('id' => '130', 'country_code' => 'MY', 'country_name' => 'Malaysia', 'country_code_no' => '0'),
    array('id' => '131', 'country_code' => 'MV', 'country_name' => 'Maldives', 'country_code_no' => '0'),
    array('id' => '132', 'country_code' => 'ML', 'country_name' => 'Mali', 'country_code_no' => '0'),
    array('id' => '133', 'country_code' => 'MT', 'country_name' => 'Malta', 'country_code_no' => '0'),
    array('id' => '134', 'country_code' => 'MH', 'country_name' => 'Marshall Islands', 'country_code_no' => '0'),
    array('id' => '135', 'country_code' => 'MQ', 'country_name' => 'Martinique', 'country_code_no' => '0'),
    array('id' => '136', 'country_code' => 'MR', 'country_name' => 'Mauritania', 'country_code_no' => '0'),
    array('id' => '137', 'country_code' => 'MU', 'country_name' => 'Mauritius', 'country_code_no' => '0'),
    array('id' => '138', 'country_code' => 'TY', 'country_name' => 'Mayotte', 'country_code_no' => '0'),
    array('id' => '139', 'country_code' => 'MX', 'country_name' => 'Mexico', 'country_code_no' => '0'),
    array('id' => '140', 'country_code' => 'FM', 'country_name' => 'Micronesia, Federated States of', 'country_code_no' => '0'),
    array('id' => '141', 'country_code' => 'MD', 'country_name' => 'Moldova, Republic of', 'country_code_no' => '0'),
    array('id' => '142', 'country_code' => 'MC', 'country_name' => 'Monaco', 'country_code_no' => '0'),
    array('id' => '143', 'country_code' => 'MN', 'country_name' => 'Mongolia', 'country_code_no' => '0'),
    array('id' => '144', 'country_code' => 'MS', 'country_name' => 'Montserrat', 'country_code_no' => '0'),
    array('id' => '145', 'country_code' => 'MA', 'country_name' => 'Morocco', 'country_code_no' => '0'),
    array('id' => '146', 'country_code' => 'MZ', 'country_name' => 'Mozambique', 'country_code_no' => '0'),
    array('id' => '147', 'country_code' => 'MM', 'country_name' => 'Myanmar', 'country_code_no' => '0'),
    array('id' => '148', 'country_code' => 'NA', 'country_name' => 'Namibia', 'country_code_no' => '0'),
    array('id' => '149', 'country_code' => 'NR', 'country_name' => 'Nauru', 'country_code_no' => '0'),
    array('id' => '150', 'country_code' => 'NP', 'country_name' => 'Nepal', 'country_code_no' => '0'),
    array('id' => '151', 'country_code' => 'NL', 'country_name' => 'Netherlands', 'country_code_no' => '0'),
    array('id' => '152', 'country_code' => 'AN', 'country_name' => 'Netherlands Antilles', 'country_code_no' => '0'),
    array('id' => '153', 'country_code' => 'NC', 'country_name' => 'New Caledonia', 'country_code_no' => '0'),
    array('id' => '154', 'country_code' => 'NZ', 'country_name' => 'New Zealand', 'country_code_no' => '0'),
    array('id' => '155', 'country_code' => 'NI', 'country_name' => 'Nicaragua', 'country_code_no' => '0'),
    array('id' => '156', 'country_code' => 'NE', 'country_name' => 'Niger', 'country_code_no' => '0'),
    array('id' => '157', 'country_code' => 'NG', 'country_name' => 'Nigeria', 'country_code_no' => '0'),
    array('id' => '158', 'country_code' => 'NU', 'country_name' => 'Niue', 'country_code_no' => '0'),
    array('id' => '159', 'country_code' => 'NF', 'country_name' => 'Norfork Island', 'country_code_no' => '0'),
    array('id' => '160', 'country_code' => 'MP', 'country_name' => 'Northern Mariana Islands', 'country_code_no' => '0'),
    array('id' => '161', 'country_code' => 'NO', 'country_name' => 'Norway', 'country_code_no' => '0'),
    array('id' => '162', 'country_code' => 'OM', 'country_name' => 'Oman', 'country_code_no' => '0'),
    array('id' => '163', 'country_code' => 'PK', 'country_name' => 'Pakistan', 'country_code_no' => '0'),
    array('id' => '164', 'country_code' => 'PW', 'country_name' => 'Palau', 'country_code_no' => '0'),
    array('id' => '165', 'country_code' => 'PA', 'country_name' => 'Panama', 'country_code_no' => '0'),
    array('id' => '166', 'country_code' => 'PG', 'country_name' => 'Papua New Guinea', 'country_code_no' => '0'),
    array('id' => '167', 'country_code' => 'PY', 'country_name' => 'Paraguay', 'country_code_no' => '0'),
    array('id' => '168', 'country_code' => 'PE', 'country_name' => 'Peru', 'country_code_no' => '0'),
    array('id' => '169', 'country_code' => 'PH', 'country_name' => 'Philippines', 'country_code_no' => '0'),
    array('id' => '170', 'country_code' => 'PN', 'country_name' => 'Pitcairn', 'country_code_no' => '0'),
    array('id' => '171', 'country_code' => 'PL', 'country_name' => 'Poland', 'country_code_no' => '0'),
    array('id' => '172', 'country_code' => 'PT', 'country_name' => 'Portugal', 'country_code_no' => '0'),
    array('id' => '173', 'country_code' => 'PR', 'country_name' => 'Puerto Rico', 'country_code_no' => '0'),
    array('id' => '174', 'country_code' => 'QA', 'country_name' => 'Qatar', 'country_code_no' => '0'),
    array('id' => '175', 'country_code' => 'RE', 'country_name' => 'Reunion', 'country_code_no' => '0'),
    array('id' => '176', 'country_code' => 'RO', 'country_name' => 'Romania', 'country_code_no' => '0'),
    array('id' => '177', 'country_code' => 'RU', 'country_name' => 'Russian Federation', 'country_code_no' => '0'),
    array('id' => '178', 'country_code' => 'RW', 'country_name' => 'Rwanda', 'country_code_no' => '0'),
    array('id' => '179', 'country_code' => 'KN', 'country_name' => 'Saint Kitts and Nevis', 'country_code_no' => '0'),
    array('id' => '180', 'country_code' => 'LC', 'country_name' => 'Saint Lucia', 'country_code_no' => '0'),
    array('id' => '181', 'country_code' => 'VC', 'country_name' => 'Saint Vincent and the Grenadines', 'country_code_no' => '0'),
    array('id' => '182', 'country_code' => 'WS', 'country_name' => 'Samoa', 'country_code_no' => '0'),
    array('id' => '183', 'country_code' => 'SM', 'country_name' => 'San Marino', 'country_code_no' => '0'),
    array('id' => '184', 'country_code' => 'ST', 'country_name' => 'Sao Tome and Principe', 'country_code_no' => '0'),
    array('id' => '185', 'country_code' => 'SA', 'country_name' => 'Saudi Arabia', 'country_code_no' => '0'),
    array('id' => '186', 'country_code' => 'SN', 'country_name' => 'Senegal', 'country_code_no' => '0'),
    array('id' => '187', 'country_code' => 'SC', 'country_name' => 'Seychelles', 'country_code_no' => '0'),
    array('id' => '188', 'country_code' => 'SL', 'country_name' => 'Sierra Leone', 'country_code_no' => '0'),
    array('id' => '189', 'country_code' => 'SG', 'country_name' => 'Singapore', 'country_code_no' => '0'),
    array('id' => '190', 'country_code' => 'SK', 'country_name' => 'Slovakia', 'country_code_no' => '0'),
    array('id' => '191', 'country_code' => 'SI', 'country_name' => 'Slovenia', 'country_code_no' => '0'),
    array('id' => '192', 'country_code' => 'SB', 'country_name' => 'Solomon Islands', 'country_code_no' => '0'),
    array('id' => '193', 'country_code' => 'SO', 'country_name' => 'Somalia', 'country_code_no' => '0'),
    array('id' => '194', 'country_code' => 'ZA', 'country_name' => 'South Africa', 'country_code_no' => '0'),
    array('id' => '195', 'country_code' => 'GS', 'country_name' => 'South Georgia South Sandwich Islands', 'country_code_no' => '0'),
    array('id' => '196', 'country_code' => 'ES', 'country_name' => 'Spain', 'country_code_no' => '0'),
    array('id' => '197', 'country_code' => 'LK', 'country_name' => 'Sri Lanka', 'country_code_no' => '0'),
    array('id' => '198', 'country_code' => 'SH', 'country_name' => 'St. Helena', 'country_code_no' => '0'),
    array('id' => '199', 'country_code' => 'PM', 'country_name' => 'St. Pierre and Miquelon', 'country_code_no' => '0'),
    array('id' => '200', 'country_code' => 'SD', 'country_name' => 'Sudan', 'country_code_no' => '0'),
    array('id' => '201', 'country_code' => 'SR', 'country_name' => 'Suriname', 'country_code_no' => '0'),
    array('id' => '202', 'country_code' => 'SJ', 'country_name' => 'Svalbarn and Jan Mayen Islands', 'country_code_no' => '0'),
    array('id' => '203', 'country_code' => 'SZ', 'country_name' => 'Swaziland', 'country_code_no' => '0'),
    array('id' => '204', 'country_code' => 'SE', 'country_name' => 'Sweden', 'country_code_no' => '0'),
    array('id' => '205', 'country_code' => 'CH', 'country_name' => 'Switzerland', 'country_code_no' => '0'),
    array('id' => '206', 'country_code' => 'SY', 'country_name' => 'Syrian Arab Republic', 'country_code_no' => '0'),
    array('id' => '207', 'country_code' => 'TW', 'country_name' => 'Taiwan', 'country_code_no' => '0'),
    array('id' => '208', 'country_code' => 'TJ', 'country_name' => 'Tajikistan', 'country_code_no' => '0'),
    array('id' => '209', 'country_code' => 'TZ', 'country_name' => 'Tanzania, United Republic of', 'country_code_no' => '0'),
    array('id' => '210', 'country_code' => 'TH', 'country_name' => 'Thailand', 'country_code_no' => '0'),
    array('id' => '211', 'country_code' => 'TG', 'country_name' => 'Togo', 'country_code_no' => '0'),
    array('id' => '212', 'country_code' => 'TK', 'country_name' => 'Tokelau', 'country_code_no' => '0'),
    array('id' => '213', 'country_code' => 'TO', 'country_name' => 'Tonga', 'country_code_no' => '0'),
    array('id' => '214', 'country_code' => 'TT', 'country_name' => 'Trinidad and Tobago', 'country_code_no' => '0'),
    array('id' => '215', 'country_code' => 'TN', 'country_name' => 'Tunisia', 'country_code_no' => '0'),
    array('id' => '216', 'country_code' => 'TR', 'country_name' => 'Turkey', 'country_code_no' => '0'),
    array('id' => '217', 'country_code' => 'TM', 'country_name' => 'Turkmenistan', 'country_code_no' => '0'),
    array('id' => '218', 'country_code' => 'TC', 'country_name' => 'Turks and Caicos Islands', 'country_code_no' => '0'),
    array('id' => '219', 'country_code' => 'TV', 'country_name' => 'Tuvalu', 'country_code_no' => '0'),
    array('id' => '220', 'country_code' => 'UG', 'country_name' => 'Uganda', 'country_code_no' => '0'),
    array('id' => '221', 'country_code' => 'UA', 'country_name' => 'Ukraine', 'country_code_no' => '0'),
    array('id' => '222', 'country_code' => 'AE', 'country_name' => 'United Arab Emirates', 'country_code_no' => '0'),
    array('id' => '223', 'country_code' => 'GB', 'country_name' => 'United Kingdom', 'country_code_no' => '0'),
    array('id' => '224', 'country_code' => 'UM', 'country_name' => 'United States minor outlying islands', 'country_code_no' => '0'),
    array('id' => '225', 'country_code' => 'UY', 'country_name' => 'Uruguay', 'country_code_no' => '0'),
    array('id' => '226', 'country_code' => 'UZ', 'country_name' => 'Uzbekistan', 'country_code_no' => '0'),
    array('id' => '227', 'country_code' => 'VU', 'country_name' => 'Vanuatu', 'country_code_no' => '0'),
    array('id' => '228', 'country_code' => 'VA', 'country_name' => 'Vatican City State', 'country_code_no' => '0'),
    array('id' => '229', 'country_code' => 'VE', 'country_name' => 'Venezuela', 'country_code_no' => '0'),
    array('id' => '230', 'country_code' => 'VN', 'country_name' => 'Vietnam', 'country_code_no' => '0'),
    array('id' => '231', 'country_code' => 'VG', 'country_name' => 'Virigan Islands (British)', 'country_code_no' => '0'),
    array('id' => '232', 'country_code' => 'VI', 'country_name' => 'Virgin Islands (U.S.)', 'country_code_no' => '0'),
    array('id' => '233', 'country_code' => 'WF', 'country_name' => 'Wallis and Futuna Islands', 'country_code_no' => '0'),
    array('id' => '234', 'country_code' => 'EH', 'country_name' => 'Western Sahara', 'country_code_no' => '0'),
    array('id' => '235', 'country_code' => 'YE', 'country_name' => 'Yemen', 'country_code_no' => '0'),
    array('id' => '236', 'country_code' => 'YU', 'country_name' => 'Yugoslavia', 'country_code_no' => '0'),
    array('id' => '237', 'country_code' => 'ZR', 'country_name' => 'Zaire', 'country_code_no' => '0'),
    array('id' => '238', 'country_code' => 'ZM', 'country_name' => 'Zambia', 'country_code_no' => '0'),
    array('id' => '239', 'country_code' => 'ZW', 'country_name' => 'Zimbabwe', 'country_code_no' => '0')
));

Configure::write("MonthsList",  array(
    1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May",
    6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct",
    11 => "Nov", 12 => "Dec"
));


/* * * Facebook secret key *** */
Configure::write('FACEBOOK_APPID', '821483187912562');
Configure::write('FACEBOOK_SECRET', '137017de4375d89ecfe8d5a31a98f70b');

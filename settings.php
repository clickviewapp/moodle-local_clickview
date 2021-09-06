<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Adds admin settings for the plugin.
 *
 * @package     local_clickview
 * @category    admin
 * @copyright   2021 ClickView Pty. Limited <info@clickview.com.au>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $settings = new admin_settingpage('managelocalclickview', new lang_string('settings', 'local_clickview'));

    if ($ADMIN->fulltree) {
        $name = 'local_clickview/hostlocation';
        $displayname = new lang_string('hostlocation', 'local_clickview');
        $description = new lang_string('hostlocation_desc', 'local_clickview');
        $countries = get_string_manager()->get_list_of_countries(false, current_language());
        $locations = [
                'https://online.clickview.com.au' => $countries['AU'],
                'https://online.clickview.co.uk' => $countries['GB'],
                'https://online.clickview.co.nz' => $countries['NZ'],
                'https://online.clickview.us' => $countries['US'],
        ];
        $setting = new admin_setting_configselect($name, $displayname, $description, 1, $locations);
        $settings->add($setting);

        $name = 'local_clickview/consumerkey';
        $displayname = new lang_string('consumerkey', 'local_clickview');
        $description = new lang_string('consumerkey_desc', 'local_clickview');
        $setting = new admin_setting_configpasswordunmask($name, $displayname, $description, '7a71f5b83f13');
        $settings->add($setting);
        $settings->hide_if('local_clickview/consumerkey', 'local_clickview/hostlocation', 'neq', '');

        $name = 'local_clickview/schoolid';
        $displayname = new lang_string('schoolid', 'local_clickview');
        $description = new lang_string('schoolid_desc', 'local_clickview');
        $setting = new admin_setting_configpasswordunmask($name, $displayname, $description, '');
        $settings->add($setting);

        $name = 'local_clickview/eventsapi';
        $displayname = new lang_string('eventsapi', 'local_clickview');
        $description = new lang_string('eventsapi_desc', 'local_clickview');
        $setting = new admin_setting_configtext($name, $displayname, $description,
                'https://static.clickview.com.au/cv-events-api/1.1.1/cv-events-api.min.js');
        $settings->add($setting);
        $settings->hide_if('local_clickview/eventsapi', 'local_clickview/hostlocation', 'neq', '');

        $name = 'local_clickview/shareplayembedurl';
        $displayname = new lang_string('shareplayembedurl', 'local_clickview');
        $description = new lang_string('shareplayembedurl_desc', 'local_clickview');
        $setting = new admin_setting_configtext($name, $displayname, $description, '/Share/PlayEmbed');
        $settings->add($setting);
        $settings->hide_if('local_clickview/shareplayembedurl', 'local_clickview/hostlocation', 'neq', '');

        $name = 'local_clickview/iframeurl';
        $displayname = new lang_string('iframeurl', 'local_clickview');
        $description = new lang_string('iframeurl_desc', 'local_clickview');
        $setting = new admin_setting_configtext($name, $displayname, $description, '/v3/plugins/base');
        $settings->add($setting);
        $settings->hide_if('local_clickview/iframeurl', 'local_clickview/hostlocation', 'neq', '');
    }

    $ADMIN->add('localplugins', $settings);
}

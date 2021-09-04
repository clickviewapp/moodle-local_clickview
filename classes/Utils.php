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

namespace local_clickview;

/**
 * Class with static methods used by the ClickView plugins.
 *
 * @package     local_clickview
 * @category    admin
 * @copyright   2021 ClickView Pty. Limited <info@clickview.com.au>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class Utils {
    /**
     * Returns the ClickView iframe wrapper.
     *
     * @param string $singleselect Remove the "Add" button from the ClickView iframe.
     * @return string
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public static function get_iframe_html(string $singleselect = 'false'): string {
        $config = get_config('local_clickview');

        $params = [
                'consumerKey' => $config->consumerkey,
                'singleSelectMode' => $singleselect
        ];

        if (!empty($schoolid = $config->schoolid)) {
            $params['schoolId'] = $schoolid;
        }

        $url = new \moodle_url($config->hostlocation . $config->iframeurl, $params);

        return '<iframe id="clickview_iframe" src="' . $url . '" width="800" height="494" frameborder="0"></iframe>';
    }
}
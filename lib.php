<?php
/**
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
/**
 * @author Daniel Tome <danieltomefer@gmail.com>
 */

function local_gradebook_extend_settings_navigation(settings_navigation $nav, context $context)
{

    require_once 'classes/local_gradebook_constants.php';

    //Check capability of user
    if (!has_capability('local/gradebook:access', $context)) {
        return false;
    }

    if (!($courseAdminNode = $nav->find('courseadmin', navigation_node::TYPE_COURSE))) {
        return false;
    }
    $courseId = optional_param('id', 0, PARAM_INT);

    $url = new moodle_url('/local/' . Constants::PLUGIN_NAME . '/index.php', ['id' => $courseId]);
    $name = get_string('pluginname', 'local_gradebook');
    $type = navigation_node::TYPE_CONTAINER;
    $node = navigation_node::create($name, $url, $type, null, Constants::PLUGIN_NAME, new pix_icon('t/calc', $name));
    $courseAdminNode->add_node($node);
}

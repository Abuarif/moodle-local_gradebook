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

require_once '../../config.php';

//Id of grades to add into the operation
$operation = required_param('operation', PARAM_TEXT);
$courseid = required_param('courseid', PARAM_TEXT);
$id = required_param('id', PARAM_TEXT); //Where to put the calculation
$grades = optional_param_array('grades', [], PARAM_TEXT);


var_dump($courseid, $grades, $operation);
die;
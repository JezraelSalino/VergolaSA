<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id$
 * @author Harold Prins
 * @copyright (C) 2011-2013 Harold Prins
 * @license GNU/GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 *  
 * Profiler is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *  
 * You should have received a copy of the GNU General Public License
 * along with Profiler.  If not, see <http://www.gnu.org/licenses/gpl-2.0.html>.
*/
defined('_JEXEC') or die;

class JHtmlUsers
{
	public static function image($src)
	{
		$src = preg_replace('#[^A-Z0-9\-_\./]#i', '', $src);
		$file = JPATH_SITE . '/' . $src;

		jimport('joomla.filesystem.path');
		JPath::check($file);

		if (!file_exists($file))
		{
			return '';
		}

		return '<img src="' . JUri::root() . $src . '" alt="" />';
	}

	public static function addNote($userId)
	{
		$title = JText::_('COM_USERS_ADD_NOTE');

		return '<a href="' . JRoute::_('index.php?option=com_users&task=note.add&u_id=' . (int) $userId) . '">'
			. '<span class="label label-info"><i class="icon-vcard"></i>' . $title . '</span></a>';
	}

	public static function filterNotes($count, $userId)
	{
		if (empty($count))
		{
			return '';
		}

		$title = JText::_('COM_USERS_FILTER_NOTES');

		return '<a href="' . JRoute::_('index.php?option=com_users&view=notes&filter_search=uid:' . (int) $userId) . '">'
			. JHtml::_('image', 'admin/filter_16.png', 'COM_USERS_NOTES', array('title' => $title), true) . '</a>';
	}

	public static function notes($count, $userId)
	{
		if (empty($count))
		{
			return '';
		}

		$title = JText::plural('COM_USERS_N_USER_NOTES', $count);

		return '<a class="modal"'
			. ' href="' . JRoute::_('index.php?option=com_users&view=notes&tmpl=component&layout=modal&u_id=' . (int) $userId) . '"'
			. ' rel="{handler: \'iframe\', size: {x: 800, y: 450}}">'
			. '<span class="label label-info"><i class="icon-drawer-2"></i>' . $title . '</span></a>';
	}

	public static function blockStates( $self = false)
	{
		if ($self)
		{
			$states = array(
				1 => array(
					'task'				=> 'unblock',
					'text'				=> '',
					'active_title'		=> 'COM_PROFILER_USER_FIELD_BLOCK_DESC',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'unpublish',
					'inactive_class'	=> 'unpublish'
				),
				0 => array(
					'task'				=> 'block',
					'text'				=> '',
					'active_title'		=> '',
					'inactive_title'	=> 'COM_PROFILER_USERS_ERROR_CANNOT_BLOCK_SELF',
					'tip'				=> true,
					'active_class'		=> 'publish',
					'inactive_class'	=> 'publish'
				)
			);
		}
		else
		{
			$states = array(
				1 => array(
					'task'				=> 'unblock',
					'text'				=> '',
					'active_title'		=> 'COM_PROFILER_TOOLBAR_UNBLOCK',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'unpublish',
					'inactive_class'	=> 'unpublish'
				),
				0 => array(
					'task'				=> 'block',
					'text'				=> '',
					'active_title'		=> 'COM_PROFILER_USER_FIELD_BLOCK_DESC',
					'inactive_title'	=> '',
					'tip'				=> true,
					'active_class'		=> 'publish',
					'inactive_class'	=> 'publish'
				)
			);
		}

		return $states;
	}

	public static function activateStates()
	{
		$states = array(
			1	=> array(
				'task'				=> 'activate',
				'text'				=> '',
				'active_title'		=> 'COM_PROFILER_TOOLBAR_ACTIVATE',
				'inactive_title'	=> '',
				'tip'				=> true,
				'active_class'		=> 'unpublish',
				'inactive_class'	=> 'unpublish'
			),
			0	=> array(
				'task'				=> '',
				'text'				=> '',
				'active_title'		=> '',
				'inactive_title'	=> 'COM_PROFILER_ACTIVATED',
				'tip'				=> true,
				'active_class'		=> 'publish',
				'inactive_class'	=> 'publish'
			)
		);
		return $states;
	}
}

<?php
/**
 * @package Profiler Fields for Joomla! 2.5
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

class JFormFieldRights extends JFormField
{

	public $type = 'Rights';

	
	protected function getInput()
	{
		JHtml::_('behavior.tooltip');

		$fieldid = $this->form->getValue("id");
		if($fieldid > 0) {
			$fieldrights = $this->getFieldRights($fieldid);
		} else {
			$fieldrights = array();
		}
		// Get the available user groups.
		$groups = $this->getUserGroups();

		// Build the form control.
		$curLevel = 0;

		// Prepare output
		$options = array();
		$options[] = JHtml::_('select.option', '0', JText::_("COM_PROFILER_GLOBAL"), 'value', 'text', false);
		$html = array();

		// Description @todo Taalstring
		$html[] = '<p class="rule-desc">' . JText::_('COM_PFFIELDS_VIEW_PERMISSIONSTAB_DESC') . '</p>';

		// Begin tabs
		$html[] = '<div id="permissions-sliders" class="tabbable tabs-left">';

		// Building tab nav
		$html[] = '<ul class="nav nav-tabs">';
		foreach ($groups as $group)
		{
			// Initial Active Tab
			$active = "";
			if ($group->value == 1)
			{
				$active = "active";
			}

			$html[] = '<li class="' . $active . '">';
				$html[] = '<a href="#profile-' . $group->value . '" data-toggle="tab">';
				$html[] = str_repeat('<span class="level">&ndash;</span> ', $curLevel = $group->level) . $group->text;
				$html[] = isset($fieldrights[$group->value]) ? "*" : "";
				$html[] = '</a>';
			$html[] = '</li>';
		}
		$html[] = '</ul>';

		$html[] = '<div class="tab-content">';

		// Start a row for each user group.
		foreach ($groups as $group)
		{
			// Initial Active Pane
			$active = "";
			if ($group->value == 1)
			{
				$active = " active";
			}

			$difLevel = $group->level - $curLevel;

			$html[] = '<div class="tab-pane' . $active . '" id="profile-' . $group->value . '">';
			$html[] = '<table class="table table-striped">';
			$html[] = '<thead>';
			$html[] = '<tr>';

			$html[] = '<th class="actions" id="actions-th' . $group->value . '">';
			$html[] = '<span class="acl-action">' . JText::_('JLIB_RULES_ACTION') . '</span>';
			$html[] = '</th>';
			
			$html[] = '<th class="settings" id="settings-th' . $group->value . '">';
			$html[] = '<span class="acl-action">' . JText::_('JLIB_RULES_SELECT_SETTING') . '</span>';
			$html[] = '</th>';

			$html[] = '<th class="settings" id="settingsprivate-th' . $group->value . '">';
			$html[] = '<span class="acl-action">' . JText::_('') . '</span>';
			$html[] = '</th>';
				
			
			$html[] = '<th id="aclactionth' . $group->value . '">';
			$html[] = '<span class="acl-action">' . JText::_('COM_PFFIELDS_VIEW_PERMISSIONSTAB_PRIVATE_DESC') . '</span>';
			$html[] = '</th>';


			$html[] = '</tr>';
			$html[] = '</thead>';
			$html[] = '<tbody>';

				$html[] = '<tr>';
				$html[] = '<td headers="actions-th' . $group->value . '">';
				$html[] = '<label class="tip" for="cbpublished_' . $group->value .'" title="title">' . JText::_('COM_PROFILER_PROFILE_HEADING_PUBLISHED') . '</label>';
				$html[] = '</td>';
				$html[] = '<td headers="settings-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['published']) ? $fieldrights[$group->value]['published'] : ($group->value == 1 ? 1 : 2);
				$html[] = JHtml::_('select.genericlist', $this->getOptions($group->value), 'rights[' . $group->value .'][published]', array('list.select' => $value,	'id' => 'cbpublished_' . $group->value));
				$html[] = '</td>';
				$html[] = '<td headers="settingsprivate-th' . $group->value . '">';
				$html[] = '';
				$html[] = '</td>';
				$html[] = '<td headers="aclactionth' . $group->value . '">';
				$html[] = '';
				$html[] = '</td>';
				
				$html[] = '<tr>';
				$html[] = '<td headers="actions-th' . $group->value . '">';
				$html[] = '<label class="tip" for="cbregistration_' . $group->value .'" title="title">' . JText::_('COM_PROFILER_PROFILE_HEADING_REGISTERACCESS') . '</label>';
				$html[] = '</td>';
				$html[] = '<td headers="settings-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['registration']) ? $fieldrights[$group->value]['registration'] : ($group->value == 1 ? 1 : 2);
				$html[] = JHtml::_('select.genericlist', $this->getOptions($group->value), 'rights[' . $group->value .'][registration]', array('list.select' => $value,	'id' => 'cbregistration_' . $group->value));
				$html[] = '</td>';
				$html[] = '<td headers="settingsprivate-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['accessreg']) ? $fieldrights[$group->value]['accessreg'] : ($group->value == 1 ? 1 : 0);
				$html[] = JHtml::_('access.level', 'rights[' . $group->value .'][accessreg]', $value, '', $group->value > 1 ? $options : '', 'cbaccessreg_' . $group->value);
				$html[] = '</td>';
				$html[] = '<td headers="aclactionth' . $group->value . '">';
				$html[] = '';
				$html[] = '</td>';
				
				$html[] = '<tr>';
				$html[] = '<td headers="actions-th' . $group->value . '">';
				$html[] = '<label class="tip" for="cbaccessro_' . $group->value .'" title="title">' . JText::_('COM_PROFILER_PROFILE_HEADING_READACCESS') . '</label>';
				$html[] = '</td>';
				$html[] = '<td headers="settings-th' . $group->value . '">';
				$html[] = '';
				$html[] = '</td>';
				$html[] = '<td headers="settingsprivate-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['accessro']) ? $fieldrights[$group->value]['accessro'] : ($group->value == 1 ? 1 : 0);
				$html[] = JHtml::_('access.level', 'rights[' . $group->value .'][accessro]', $value, '', $group->value > 1 ? $options : '', 'cbaccessro_' . $group->value);
				$html[] = '</td>';
				$html[] = '<td headers="aclactionth' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['accessroprivate']) ? $fieldrights[$group->value]['accessroprivate'] : ($group->value == 1 ? 0 : 2);
				$html[] = JHtml::_('select.genericlist', $this->getOptions($group->value), 'rights[' . $group->value .'][accessroprivate]', array('list.select' => $value,	'id' => 'cbaccessroprivate_' . $group->value));
				$html[] = '</td>';
				
				
				$html[] = '<tr>';
				$html[] = '<td headers="actions-th' . $group->value . '">';
				$html[] = '<label class="tip" for="cbaccess_' . $group->value .'" title="title">' . JText::_('COM_PROFILER_PROFILE_HEADING_EDITACCESS') . '</label>';
				$html[] = '</td>';
				$html[] = '';
				$html[] = '<td headers="settings-th' . $group->value . '">';
				$html[] = '</td>';
				$html[] = '<td headers="settingsprivate-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['access']) ? $fieldrights[$group->value]['access'] : ($group->value == 1 ? 1 : 0);
				$html[] = JHtml::_('access.level', 'rights[' . $group->value .'][access]', $value, '', $group->value > 1 ? $options : '', 'cbaccess_' . $group->value);
				$html[] = '</td>';
				$html[] = '<td headers="aclactionth' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['accessprivate']) ? $fieldrights[$group->value]['accessprivate'] : ($group->value == 1 ? 0 : 2);
				$html[] = JHtml::_('select.genericlist', $this->getOptions($group->value), 'rights[' . $group->value .'][accessprivate]', array('list.select' => $value,	'id' => 'cbaccessprivate_' . $group->value));
				$html[] = '</td>';
				
				$html[] = '<tr>';
				$html[] = '<td headers="actions-th' . $group->value . '">';
				$html[] = '<label class="tip" for="cbreadonly_' . $group->value .'" title="title">' . JText::_('COM_PROFILER_PROFILE_HEADING_READONLY') . '</label>';
				$html[] = '</td>';
				$html[] = '<td headers="settings-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['readonly']) ? $fieldrights[$group->value]['readonly'] : ($group->value == 1 ? 0 : 2);
				$html[] = JHtml::_('select.genericlist', $this->getOptions($group->value), 'rights[' . $group->value .'][readonly]', array('list.select' => $value,	'id' => 'cbreadonly_' . $group->value));
				$html[] = '</td>';
				$html[] = '<td headers="settingsprivate-th' . $group->value . '"></td>';
				$html[] = '<td headers="aclactionth' . $group->value . '">';
				$html[] = '';
				$html[] = '</td>';
				
				
				$html[] = '<tr>';
				$html[] = '<td headers="actions-th' . $group->value . '">';
				$html[] = '<label class="tip" for="cbrequired_' . $group->value .'" title="title">' . JText::_('COM_PROFILER_PROFILE_HEADING_REQUIRED') . '</label>';
				$html[] = '</td>';
				$html[] = '<td headers="settings-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['required']) ? $fieldrights[$group->value]['required'] : ($group->value == 1 ? 0 : 2);
				$html[] = JHtml::_('select.genericlist', $this->getOptions($group->value), 'rights[' . $group->value .'][required]', array('list.select' => $value,	'id' => 'cbrequired_' . $group->value));
				$html[] = '</td>';
				$html[] = '<td headers="settingsprivate-th' . $group->value . '">';
				$value = isset($fieldrights[$group->value]['accessrequired']) ? $fieldrights[$group->value]['accessrequired'] : ($group->value == 1 ? 1 : 0);
				$html[] = JHtml::_('access.level', 'rights[' . $group->value .'][accessrequired]', $value, '', $group->value > 1 ? $options : '', 'cbaccessrequired_' . $group->value);
				$html[] = '</td>';
				$html[] = '<td headers="aclactionth' . $group->value . '">';
				$html[] = '';
				$html[] = '</td>';
				

				$html[] = '</tr>';
			$html[] = '</tbody>';
			$value = isset($fieldrights[$group->value]['id']) ? $fieldrights[$group->value]['id'] : 0;
			$html[] = '</table><input type="hidden" name="rights[' . $group->value .'][id]" value="'.$value.'" /></div>';

		}

		$html[] = '</div></div>';

//		$html[] = '<div class="alert">';
//		if ($section == 'component' || $section == null)
//		{
//			$html[] = JText::_('JLIB_RULES_SETTING_NOTES');
//		}
//		else
//		{
//			$html[] = JText::_('JLIB_RULES_SETTING_NOTES_ITEM');
//		}
//		$html[] = '</div>';

		// Get the JInput object
		$input = JFactory::getApplication()->input;

/*		$js = "window.addEvent('domready', function(){ new Fx.Accordion($$('div#permissions-sliders.pane-sliders .panel h3.pane-toggler'),"
			. "$$('div#permissions-sliders.pane-sliders .panel div.pane-slider'), {onActive: function(toggler, i) {toggler.addClass('pane-toggler-down');"
			. "toggler.removeClass('pane-toggler');i.addClass('pane-down');i.removeClass('pane-hide');Cookie.write('jpanesliders_permissions-sliders"
			. $component
			. "',$$('div#permissions-sliders.pane-sliders .panel h3').indexOf(toggler));},"
			. "onBackground: function(toggler, i) {toggler.addClass('pane-toggler');toggler.removeClass('pane-toggler-down');i.addClass('pane-hide');"
			. "i.removeClass('pane-down');}, duration: 300, display: "
			. $input->cookie->get('jpanesliders_permissions-sliders' . $component, 0, 'integer') . ", show: "
			. $input->cookie->get('jpanesliders_permissions-sliders' . $component, 0, 'integer') . ", alwaysHide:true, opacity: false}); });";

		JFactory::getDocument()->addScriptDeclaration($js);
*/
		return implode("\n", $html);
	}

	protected function getFieldRights($fieldid)
	{
		$db = JFactory::getDBO();
		$query	= $db->getQuery(true);
		$query->select('id, profile, published, required, accessrequired, registration, readonly, access, accessro, accessreg, accessroprivate, accessprivate');
		$query->from('#__profiler_fieldprofile');
		$query->where('fieldid = ' . $fieldid);
		$db->setQuery($query);
		return $db->loadAssocList('profile');
		
	}
	
	
	protected function getUserGroups()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('a.id AS value, a.title AS text, COUNT(DISTINCT b.id) AS level, a.parent_id')
			->from('#__usergroups AS a')
			->leftJoin($db->quoteName('#__usergroups') . ' AS b ON a.lft > b.lft AND a.rgt < b.rgt')
			->group('a.id, a.title, a.lft, a.rgt, a.parent_id')
			->order('a.lft ASC');
		$db->setQuery($query);
		$options = $db->loadObjectList();

		return $options;
	}
	
	protected function getOptions($usergroup)
	{
		$publishoptions = array();
		if($usergroup > 1) {
			$publishoptions[] = JHtml::_('select.option', '2', JText::_("COM_PROFILER_GLOBAL"), 'value', 'text', false);
		}
		$publishoptions[] = JHtml::_('select.option', '1', JText::_("JYES"), 'value', 'text', false);
		$publishoptions[] = JHtml::_('select.option', '0', JText::_("JNO"), 'value', 'text', false);
		return $publishoptions;
	}
}

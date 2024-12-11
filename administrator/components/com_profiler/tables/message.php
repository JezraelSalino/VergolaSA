<?php
/**
 * @package Profiler for Joomla! 2.5
 * @version $Id: message.php 31 2013-01-09 22:33:43Z harold $
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
// No direct access.
defined('_JEXEC') or die;

class ProfilerTableMessage extends JTable
{
	
	protected $_email;
	
	protected $subject;
	protected $message;

	public function __construct(&$_db)
	{
		$this->_email = JFactory::getMailer();
		parent::__construct('#__profiler_messages', 'id', $_db);
	}

	public function check()
	{
		if($this->id) {
			$this->setError(JText::_('COM_PROFILER_ERROR_EXISTMESSAGE'));
			return false;	
		}
		
		$this->from = $this->getFrom();
		$this->type = "mail";
		$this->togroup = null;
		$this->touser = $this->getTo();
		$this->toaccess = null;
		$this->textid = null;
		$this->date = JFactory::getDate()->toSql();
		
		
		
		if(!$this->subject) { // || !$this->checkHeaders($this->subject)) {
			$this->setError(JText::_('COM_PROFILER_ERROR_MESSAGE'));
			return false;	
		}
		if(!$this->message) { // || !$this->checkHeaders($this->message)) {
			$this->setError(JText::_('COM_PROFILER_ERROR_MESSAGE'));
			return false;	
		}
		
		$this->_email->setSubject($this->subject);
		$this->_email->setBody($this->message);


		return true;
	}

	
	public function store($updateNulls = false)
	{
		$messagetext = new stdClass();
		$messagetext->subject = $this->subject;
		$messagetext->message = $this->message;
		$messagetext->textid = 0;
		
		$this->_db->insertObject("#__profiler_messagestext", $messagetext, "textid");
		$this->textid = $messagetext->textid;
		return parent::store($updateNulls);
	}
	
	public function mail() {
		if ($user->email->send() !== true)
		{
			JError::raiseNotice(500, JText:: _ ('COM_MAILTO_EMAIL_NOT_SENT'));
			return $this->mailto();
		}
		
	}
	
	private function getFrom() {
		$user = JFactory::getUser();
		$this->_email->setSender(array($user->email, $user->name));
		return $user->id;
		
	}
	
	private function getTo() {
		$userid = JRequest::getCmd('toid');
		$user = JFactory::getUser($userid);
		$this->_email->addRecipient($user->email);
		return $userid;
	}
	
	private function checkHeaders($text) {
		$headers = array (	'Content-Type:',
							'MIME-Version:',
							'Content-Transfer-Encoding:',
							'bcc:',
							'cc:');
		foreach ($headers as $header) {
			if (strpos($text, $header) !== false) {
				JError::raiseError(403, '');
				return false;
			}
		}
		return true;	
	}
	
}

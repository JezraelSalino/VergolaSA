<?php

/**

 * Joomla! 1.5 component Add user Frontend

 *

 * @version $Id: controller.php 2010-08-24 10:48:13 svn $

 * @author Kim Pittoors

 * @package Joomla

 * @subpackage Add user Frontend

 * @license GNU/GPL

 *

 * Add users to Community builder on the frontend

 *

* @Copyright Copyright (C) 2010 - Kim Pittoors
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html 


 *

 */



// no direct access

defined('_JEXEC') or die('Restricted access');



jimport( 'joomla.application.component.controller' );

require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );



/**

 * Add user Frontend Controller

 *

 * @package Joomla

 * @subpackage Add user Frontend

 */

class AdduserfrontendController extends JController {

    /**

     * Constructor

     * @access private

     * @subpackage Add user Frontend

     */

    function __construct() {

        //Get View

        if(JRequest::getCmd('view') == '') {

            JRequest::setVar('view', 'default');

        }

        $this->item_type = 'Default';

        parent::__construct();

    }

}

?>
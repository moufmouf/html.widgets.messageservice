<?php

namespace Mouf\Html\Widgets\MessageService\Service;

use Mouf\Utils\Sesssion\SessionManager\SessionManagerInterface;

/**
 * The SessionMessageService is a class that registers message to be displayed to the user.
 * Using its "setMessage" method, you register a message, and this message will be displayed later to the user.
 * 
 * Since the SessionMessageService relies on the user's session, you can use this class accross redirects.
 * For instance, if a POST goes wrong because some fields is not properly filled, you can redirect to the same page,
 * then display the error message (using "getMessages"). 
 * 
 * @author David Negrier
 * @Component
 */
class SessionMessageService implements MessageProviderInterface {
	
	/**
	 * The SESSION key used to store messages.
	 * 
	 * @Property
	 * @Compulsory
	 * @var string
	 */
	public $sessionKey = "MOUF_USER_MESSAGES";
	
	/**
	 * The session manager used to access the session.
	 * If no session manager is set, the developer will have to ensure itself that the session
	 * is started before calling the session message service.
	 * 
	 * @var SessionManagerInterface
	 */
	public $sessionManager;
	
	/**
	 * Sets a message to be displayed to a user.
	 *
	 * @param string $html The message to be displayed, as a HTML string.
	 * @param string $type The type of the message. Can be one of UserMessageInterface::SUCCESS, UserMessageInterface::INFO, UserMessageInterface::WARNING, UserMessageInterface::ERROR.
	 * @param string $category The category of the message to set. A category is a string. If "null", the global category is used.
	 */
	function setMessage($html, $type, $category = null) {
		if ($category == null) {
			$category = "mouf_usermessageservice_global";
		}
		
		$message = array("message"=>$html,
						 "type"=>$type);
		
		if ($this->sessionManager) {
			$this->sessionManager->start();
		}
		
		$_SESSION[$this->sessionKey][$category][] = $message;
	}
	
	/**
	 * Removes all the messages for a given category.
	 * 
	 * @param string $category
	 */
	function purgeMessages($category = NULL) {
		if ($category == null) {
			$category = "mouf_usermessageservice_global";
		}
		
		if ($this->sessionManager) {
			$this->sessionManager->start();
		}
		
		unset($_SESSION[$this->sessionKey][$category]);
	}
	
	/**
	 * Returns the list of messages to display, as an array of UserMessageInterface objects.
	 *
	 * @param string $category The category of the messages to retrieve, or null for the global category.
	 * @return array<UserMessageInterface>
	 */
	function getMessages($category = NULL) {
		if ($category == null) {
			$category = "mouf_usermessageservice_global";
		}
		
		$messages = array();
		
		if ($this->sessionManager) {
			$this->sessionManager->start();
		}
		
		if (isset($_SESSION[$this->sessionKey][$category])) {
			foreach ($_SESSION[$this->sessionKey][$category] as $messageArray) {
				$messages[] = new UserMessage($messageArray['message'], $messageArray['type'], $category);
			}
			unset($_SESSION[$this->sessionKey][$category]);
		}
		
		return $messages;
	}
}
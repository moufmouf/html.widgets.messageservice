<?php
namespace Mouf\Html\Widgets\MessageService\Widget;
use Mouf\Html\Widgets\MessageService\Service\UserMessage;
use Mouf\Html\HtmlElement\HtmlElementInterface;
use Mouf\Html\Renderer\Renderable;

/**
 * This class represents a message displayed.
 * It is simply an aggregation of a UserMessage with the number of times it has been displayed.
 *
 */
class RenderedMessage implements HtmlElementInterface {
	
	use Renderable;
	
	private $userMessage;
	private $nbMessages;

	public function __construct(UserMessage $userMessage, $nbMessages) {
		$this->userMessage = $userMessage;
		$this->nbMessages = $nbMessages;
	}
	
	/**
	 * @return UserMessage
	 */
	public function getUserMessage() {
		return $this->userMessage;
	}
	
	/**
	 * @return int
	 */
	public function getNbMessages() {
		return $this->nbMessages;
	}
}

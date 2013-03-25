<?php

namespace Mouf\Html\Widgets\MessageService\Widget;

use Mouf\Html\Widgets\MessageService\Service\UserMessageInterface;

/**
 * Classes implementing this interface can display alert/error message
 * @author Marc Teyssier
 */
interface MessageRendererInterface {
	/**
	 * Display alert/error message
	 * @param UserMessageInterface $message
	 * @param int $nbRepeat Nb occurence of message
	 */
	function render(UserMessageInterface $message, $nbRepeat);
}
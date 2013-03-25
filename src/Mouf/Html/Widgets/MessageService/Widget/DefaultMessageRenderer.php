<?php

namespace Mouf\Html\Widgets\MessageService\Widget;

use Mouf\Html\Widgets\MessageService\Service\UserMessageInterface;

/**
 * Default message renderer (render each message as a div)
 * @author Marc Teyssier
 *
 */
class DefaultMessageRenderer implements MessageRendererInterface {
	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Html\Widgets\MessageService\Widget\MessageRendererInterface::render()
	 */
	function render(UserMessageInterface $message, $nbRepeat) {

		$html = $message->getMessage();
		$type = $message->getType();
		
		echo "<div class='".$type."'>";
		echo $html;
		if ($nbRepeat > 1) {
			// TODO: translate this.
			echo " (message repeated ".$nbRepeat." times)";
		}
		echo "</div>";
	}
}
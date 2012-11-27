<?php

use Mouf\MoufManager;

use Mouf\Actions\InstallUtils;

// Let's init Mouf
InstallUtils::init(InstallUtils::$INIT_APP);

// Let's create the instance
$moufManager = MoufManager::getMoufManager();
if (!$moufManager->instanceExists("userMessageService")) {
	$moufManager->declareComponent("userMessageService", "Mouf\Html\Widgets\MessageService\Service\SessionMessageService");
}

if (!$moufManager->instanceExists("messageWidget")) {
	$moufManager->declareComponent("messageWidget", "Mouf\Html\Widgets\MessageService\Widget\MessageWidget");
	$moufManager->bindComponent("messageWidget", "messageProvider", "userMessageService");
}

// Let's rewrite the MoufComponents.php file to save the component
$moufManager->rewriteMouf();

// Finally, let's continue the install
InstallUtils::continueInstall();
?>
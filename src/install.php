<?php
require_once __DIR__."/../../../autoload.php";

use Mouf\MoufManager;

use Mouf\Actions\InstallUtils;

// Let's init Mouf
InstallUtils::init(InstallUtils::$INIT_APP);

// Let's create the instance
$moufManager = MoufManager::getMoufManager();
if (!$moufManager->instanceExists("userMessageService")) {
	$moufManager->declareComponent("userMessageService", "Mouf\\Html\\Widgets\\MessageService\\Service\\SessionMessageService");
}

if (!$moufManager->instanceExists("messageWidget")) {
	$moufManager->declareComponent("messageWidget", "Mouf\\Html\\Widgets\\MessageService\\Widget\MessageWidget");
	$moufManager->bindComponent("messageWidget", "messageProvider", "userMessageService");
}

if (!$moufManager->instanceExists("messageServiceLibrary")) {
	$moufManager->declareComponent("messageServiceLibrary", "Mouf\\Html\\Utils\\WebLibraryManager\\WebLibrary");
	$moufManager->bindComponent("messageWidget", "messageProvider", "userMessageService");
}


//Create a weblibraray for loading message services(s css file, and add it into the defaultWebLibrary Manager
WebLibraryInstaller::installLibrary("messageServiceLibrary",
	array(),
	array('vendor/mouf/html.widgets.messageservice/messages.css'),
	array(),
	true
);

// Let's rewrite the MoufComponents.php file to save the component
$moufManager->rewriteMouf();

// Finally, let's continue the install
InstallUtils::continueInstall();
?>
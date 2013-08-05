<?php
use Mouf\Html\Utils\WebLibraryManager\WebLibraryInstaller;

require_once __DIR__."/../../../autoload.php";

use Mouf\MoufManager;

use Mouf\Actions\InstallUtils;
use Mouf\Html\Renderer\RendererUtils;

// Let's init Mouf
InstallUtils::init(InstallUtils::$INIT_APP);

// Let's create the instance
$moufManager = MoufManager::getMoufManager();

$userMessageService = InstallUtils::getOrCreateInstance("userMessageService", "Mouf\\Html\\Widgets\\MessageService\\Service\\SessionMessageService", $moufManager);

$messageWidget = InstallUtils::getOrCreateInstance("messageWidget", "Mouf\\Html\\Widgets\\MessageService\\Widget\\MessageWidget", $moufManager);
$messageWidget->setName("messageWidget");
$messageWidget->getProperty("messageProvider")->setValue($userMessageService);

// Let's add the widget to the main block if available.
if ($moufManager->instanceExists("block.content")) {
	$contentBlock = $moufManager->getInstanceDescriptor("block.content");
	$arr = $contentBlock->getProperty("children")->getValue();
	$arr[] = $messageWidget;
	$contentBlock->getProperty("children")->setValue($arr);
}

// Let's bind the userMessageService to the sessionManager (if it exists).
if ($moufManager->instanceExists("sessionManager")) {
	$sessionManager = $moufManager->getInstanceDescriptor("sessionManager");
	$userMessageService->getProperty("sessionManager")->setValue($sessionManager);
}

// Create a weblibrary for loading message services css file, and add it into the defaultWebLibrary Manager
WebLibraryInstaller::installLibrary("messageServiceLibrary",
	array(),
	array('vendor/mouf/html.widgets.messageservice/messages.css'),
	array(),
	true
);

RendererUtils::createPackageRenderer($moufManager, "mouf/html.widgets.messageservice");

// Let's rewrite the MoufComponents.php file to save the component
$moufManager->rewriteMouf();

// Finally, let's continue the install
InstallUtils::continueInstall(isset($_REQUEST['selfedit']) && $_REQUEST['selfedit'] == 'true');
?>
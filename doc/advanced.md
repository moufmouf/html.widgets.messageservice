#Displaying status messages to your users: advanced usage

##The long story

What happens when you call the `set_user_message` function?
The `set_user_message` function is a shortcut for:

```php
Mouf::getUserMessageService()->setMessage($html, $type, $category);
```

The "userMessageService" Mouf instance is an instance of the component `SessionMessageService`.

###The `SessionMessageService` class

This class is in charge of storing and providing the messages to be displayed to the user.
Use `SessionMessageService->setMessage` to register a message. Use 
 `SessionMessageService->getMessages` to retrieve the list of messages to display.
The messages will be retrieved as an array of `UserMessage` instances.
A call to the `SessionMessageService->getMessages` function removes the messages from
the instance, so if you perform 2 calls to this method, the second call will return an empty array.

###Writing your own `MessageService`

The `SessionMessageService` is storing the messages in the session. This is a great default
behaviour because it means that the user will not miss a message in the event a message is registered,
but no call is performed to the MessageWidget.

You can however provide your own class instead of the `SessionMessageService`. To do this,
your class must implement the `MessageProviderInterface`.

###Writing your own `MessageWidget`

The `MessageWidget` class is responsible for displaying the error messages.
The default implementation is capable of detecting duplicates in the error messages (it
will display each message only once). You can also develop your own class. All you need to
do is implement the HtmlElementInterface interface, so you can use your component in any template.
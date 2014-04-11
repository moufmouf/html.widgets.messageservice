#Displaying status messages to your users: advanced usage

##The long story

What happens when you call the ```php set_user_message ``` function?
The ```php set_user_message ``` function is a shortcut for:

```php
Mouf::getUserMessageService()->setMessage($html, $type, $category);
```

The "userMessageService" Mouf instance is an instance of the component ```php SessionMessageService ```.

###The ```php SessionMessageService ``` class

This class is in charge of storing and providing the messages to be displayed to the user.
Use ```php SessionMessageService-&gt;setMessage ``` to register a message. Use 
 ```php SessionMessageService-&gt;getMessages ``` to retrieve the list of messages to display.
The messages will be retrieved as an array of ```php UserMessage ``` instances.
A call to the ```php SessionMessageService-&gt;getMessages ``` function removes the messages from
the instance, so if you perform 2 calls to this method, the second call will return an empty array.

###Writing your own ```php MessageService ```

The ```php SessionMessageService ``` is storing the messages in the session. This is a great default
behaviour because it means that the user will not miss a message in the event a message is registered,
but no call is performed to the MessageWidget.

You can however provide your own class instead of the ```php SessionMessageService ```. To do this,
your class must implement the ```php MessageProviderInterface ```.

###Writing your own ```php MessageWidget ```

The ```php MessageWidget ``` class is responsible for displaying the error messages.
The default implementation is capable of detecting duplicates in the error messages (it
will display each message only once). You can also develop your own class. All you need to
do is implement the HtmlElementInterface interface, so you can use your component in any template.
#Displaying status messages to your users

##The short story

If you are a web developer, the only thing you need to know is you can display status messages for your users using the ```php set_user_message ``` function.

```phpfunction set_user_message($html, $type = UserMessageInterface::ERROR, $category = null);```

The function registers a message (an HTML string) that will be displayed to the user.

Example:

```php
set_user_message("This is an &lt;b&gt;error&lt;/b&gt; message", UserMessageInterface::ERROR);
set_user_message("This is a &lt;b&gt;warning&lt;/b&gt; message", UserMessageInterface::WARNING);
set_user_message("This is an &lt;b&gt;info&lt;/b&gt; message", UserMessageInterface::INFO);
set_user_message("This is a &lt;b&gt;success&lt;/b&gt; message", UserMessageInterface::SUCCESS);
```

This will display these error messages:

<div class="error">This is an *error* message</div>
<div class="warning">This is a *warning* message</div>
<div class="info">This is an *info* message</div>
<div class="success">This is a *success* message</div>  

If you want your message to be displayed at the top of the screen, keep the ```php $category ``` parameter to "null". The 
```php $category ``` parameter is reserved for advanced use, if your message applies to a special part of a page (for instance
if your message applies to a field).

##Who is in charge of displaying the error messages?

###If you are using a template
The error messages are displayed by the "MessageWidget" component. If you are using a template (like the 
<a href="http://mouf-php.com/package/html/template/MoufTemplate">Mouf template</a> or 
the <a href="http://mouf-php.com/package/html/template/SplashTemplate">Splash template</a>), the "MessageWidget" component is 
most likely already included in the template. In this case, you have nothing to do. Just use the ```php set_user_message ```
function, display your page using the template... **et voila!**.

###If you are not using a template
On the other end, if you are not using a template, you will have to call the message widget explicitly.
To display the HTML, just call:

```php Mouf::getMessageWidget-&gt;toHtml(); ```

This will display the messages for the user. You might need to import the ```php messages.css ``` file
that contains styles to display the error messages, unless you want to provide your own styles.

###Special case: if you are a Druplash developer

There is one special case. If you are using Druplash, you can use the Message Widget without typing a single line of code.
To do this, in the Mouf UI, create a new "DrupalDynamicBlock" instance. You can give a name to this block (or instance "User messages").
In the content section of the block, click "Add a component", then select "messageWidget".

This new block will contain the messages. Now, you just have to connect to Drupal admin, and place the new block where you want it to be in
your theme's layout.

Want to learn more? <a href="advanced.html">Check the advanced documentation</a>.
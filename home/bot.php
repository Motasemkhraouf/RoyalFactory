
    <style>

        #chatbot-container {
            position: fixed;
            bottom: 20vh;
            left: 20px;
            width: 240px;
            background-color: #FFF6D4;
            border: 1px solid #E2B200;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #chat-messages {
            max-height: 200px;
            overflow-y: auto;
            text-align:left;
        }

        #user-input {
            width: calc(100% - 20px);
            margin-top: 10px;
            padding: 5px;
            font-size:0.9em;
        }

        #send-button {
            width: 100%;
            margin-top: 10px;
            padding: 8px;
            background-color: #E2B200;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>



<div id="chatbot-container">
    <img src="assets/images/chatbot.gif" />
    <div id="chat-messages"></div>
    <input type="text" id="user-input" placeholder="Type your question...">
    <button id="send-button" onclick="sendMessage()">Send</button>
</div>

<script>
    function sendMessage() {
        var userInput = document.getElementById("user-input").value;
        var chatMessages = document.getElementById("chat-messages");

        // Display user message
        chatMessages.innerHTML += '<p><strong style="font-size:1.1em;">User: </strong>' + userInput + '</p>';

        // Simulate bot response (you can replace this with your own logic or connect to an API)
        var botResponse = simpleChatBot(userInput);

        // Display bot response
        chatMessages.innerHTML += '<p><strong  style="font-size:1.1em;">Bot: </strong>' + botResponse + '</p>';

        // Clear user input
        document.getElementById("user-input").value = '';

        // Scroll to the bottom of the chat
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function simpleChatBot(userInput) {
        userInput = userInput.toLowerCase();

        // Define some simple rules
        var responses = {
            'hello': 'Hello! How can I help you?',
            'how are you': 'I am just a simple bot, but thanks for asking!',
            'bye': 'Goodbye! Have a great day!',
            'your name': 'my name nnnnn',
            'my ip': '<?php echo $_SERVER['REMOTE_ADDR'];?>',
            'my browser': '<?php echo $_SERVER['REMOTE_ADDR'];?>',
            'my system': '<?php echo $_SERVER['REMOTE_ADDR'];?>',
            // Add more rules as needed
        };

        // Check if user input matches any rule
        for (var trigger in responses) {
            if (userInput.includes(trigger)) {
                return responses[trigger];
            }
        }

        // If no match, provide a default response
        return 'I did not understand that. Can you please rephrase?';
    }
</script>

<script>
$(document).ready(function(){
  var element_1 = document.getElementById("user-input");
  element_1.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("send-button").click();
    }
  });

});

</script>


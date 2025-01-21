<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduardo's Profile</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Left side - Contact Information -->
        <div class="info-container">
            <h1>Eduardo's Contact Information</h1>
            <div class="contact-list">
                <div class="contact-item">
                    <div class="contact-label">Email</div>
                    <div>376651@guhsd.net</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Instagram</div>
                    <div>eduardovn15</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Phone Number</div>
                    <div>619-368-0481</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Snapchat</div>
                    <div>Eduardo Verdin</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">Replit User</div>
                    <div>@EDUARDOVERDIN1</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">GitHub Email</div>
                    <div>eduardoverdin2008@gmail.com</div>
                </div>
                <div class="contact-item">
                    <div class="contact-label">GitHub User</div>
                    <div>EduardoVN15</div>
                </div>
            </div>
        </div>

        <!-- Right side - Messages -->
        <div class="messages-container">
            <h1>Messages</h1>
            <div class="message-list">
                <div class="message">
                    <p>Hey Eduardo! Just wanted to check if you're available for the group project meeting tomorrow?</p>
                    <div class="message-time">Today, 11:15 AM</div>
                </div>
                <div class="message">
                    <p>Thanks for sharing your GitHub repository. I'll take a look at the code tonight.</p>
                    <div class="message-time">Yesterday, 2:30 PM</div>
                </div>
                <div class="message">
                    <p>Great work on the recent presentation!</p>
                    <div class="message-time">2 days ago</div>
                </div>
            </div>

            <div class="new-message">
                <h2>Send a Message</h2>
                <textarea placeholder="Type your message here..."></textarea>
                <button onclick="sendMessage()">Send Message</button>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            const textarea = document.querySelector('textarea');
            if (textarea.value.trim() === '') return;

            const messageList = document.querySelector('.message-list');
            const newMessage = document.createElement('div');
            newMessage.className = 'message';
            
            const messageText = document.createElement('p');
            messageText.textContent = textarea.value;
            
            const messageTime = document.createElement('div');
            messageTime.className = 'message-time';
            messageTime.textContent = 'Just now';
            
            newMessage.appendChild(messageText);
            newMessage.appendChild(messageTime);
            messageList.insertBefore(newMessage, messageList.firstChild);
            
            textarea.value = '';
        }
    </script>
</body>
</html>
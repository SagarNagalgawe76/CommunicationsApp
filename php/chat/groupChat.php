<?php
require_once ("../common/headerLayout.php");
if (!isset($_SESSION['user_name'])) {
    header('Location: ../auth/loginPage.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
</head>
<style>
    .chat-messages {
        height: 300px;
        overflow-y: auto;
    }

    .chat-messages p {
        font-size: 14px;
        font-family: Helvetica, Arial, sans-serif;
    }
</style>
<script>
    $(document).ready(function () {
        refreshChat();

        $('.chat-form').submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            var message = $('.message-input').val(); // Get the message input value
            console.log(message);
            // Make AJAX request to insertChat.php
            $.ajax({
                url: 'insertChat.php',
                method: 'POST',
                data: { message: message }, // Send message data
                success: function (response) {

                    refreshChat(); // Refresh chat messages after successful submission
                    $('.message-input').val('');
                },
                error: function (xhr, status, error) {
                    console.error('Error inserting chat message:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                }
            });
        });


    });

    function refreshChat() {
        $.ajax({
            url: 'fetchChat.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {

                renderChatMessages(response);
            },
            error: function (xhr, status, error) {
                console.error('Error fetching chat messages:');
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
            }
        });
    }

    function renderChatMessages(messages) {
        $('.chat-messages').empty(); // Clear existing messages

        var colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];

        // Select a random color from the set

        // Append new messages
        messages.forEach(function (message) {
            //console.log(message);
            var randomColor = colors[Math.floor(Math.random() * colors.length)];
            var colorMessage = '<span style="color: ' + randomColor + '">' + message.message + "</span>";
            var messageElement = "[" + message.time + "]" + " " + message.user + ": " + colorMessage;
            $('.chat-messages').append('<p>' + messageElement + '</p>');
        });
    }



</script>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Group Chat</div>
            <div class="card-body chat-messages">

            </div>
            <div class="card-footer">
                <form class="chat-form input-group">
                    <input type="text" class="form-control message-input" name="message-input"
                        placeholder="Type your message..." required>
                    <button type="submit" class="btn btn-primary mx-1">Send</button>
                    <button type="button" class="btn btn-secondary" onclick="refreshChat()">Refresh</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
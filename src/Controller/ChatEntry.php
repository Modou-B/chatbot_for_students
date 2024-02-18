<?php

namespace App\Controller;

class ChatEntry
{
    // Properties
    private string $message = '';
    private string $messages = '';


    
    // Methods

//    public function __construct($message, $messages)
//    {
//        $this->message = $message;
//        $this->messages = $messages;
//    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $messages
     */
    public function setMessages(string $messages): void
    {
        $this->messages = $messages;
    }

    /**
     * @return string
     */
    public function getMessages(): string
    {
        return $this->messages;
    }
}
<?php

namespace Hermer29\Core;

include "ModelSystem.php";

class Messages extends ModelSystem
{
    private const SEND_STATEMENT1 = "INSERT INTO messages ('message-text','sender-id') VALUES (:text, :sender)";
    public function addMessage(string $message) : void
    {

    }
}
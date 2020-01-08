<?php

return [
    /**
     * This can be set to true if you would like Laravel-Trivia to generate
     * a session token when it is first used, this helps prevent any
     * duplicate questions and is valid for 6 hours.
     */
    'using_session_token' => false,

    /**
     * Encoding types can either be urlLegacy, url3986 or base64 are
     * used to format the return data. By default Laravel-Trivia will
     * use base64.
     */
    'encoding_type' => 'base64'
];

<?php

namespace App\Common;

final class ErrorMessages
{
    const USER_NOT_FOUND = "A user with username \"%s\" could not be found!";
    const PASSWORDS_DONT_MATCH = "The password you provided was incorrect!";
    const CSRF_TOKEN_INVALID = "CSRF token invalid!";
}
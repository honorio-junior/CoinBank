<?php

namespace App;

enum UserStatus: int
{
    case AwaitingApproval = 0;
    case Approved = 1;
    case Denied = 2;
}

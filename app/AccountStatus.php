<?php

namespace App;

enum AccountStatus : int
{
    case Blocked = 0;
    case Active = 1;
}

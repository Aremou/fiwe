<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
        Api status codes
        0x00 : ok
        0x10 : not authenticated
        0x11 : authentication failed, invalid data
        0x12: session expired
        0x13 : insufficient rights
        0x14 : invalid identifiers
        0x15 : account not verified
        0x20 : resource not found
        0x21 : invalid data
        0x30 : exception
     */
    public const OK = 0x00;
    public const NOT_AUTHENTICATED = 0x10;
    public const AUTH_FAILED = 0x11;
    public const SESSION_EXPIRED = 0x12;
    public const INSUFFICIENT_RIGHTS = 0x13;
    public const IDENTIFIERS_INVALID = 0x14;
    public const ACCOUNT_NOT_VERIFIED = 0x15;
    public const NOT_FOUND = 0x20;
    public const INVALID_DATA = 0x21;
    public const NOT_ACCESSIBLE = 0x22;
    public const EXCEPTION = 0x30;

}

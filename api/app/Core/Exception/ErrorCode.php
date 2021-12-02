<?php

declare(strict_types=1);

namespace App\Core\Exception;

use App\Core\ValueObject\Enum;

class ErrorCode extends Enum
{
    /** ------------------------------ Internal (1xxx) ------------------------------- */
    public const UNDEFINED = 1001;
    public const INTERNAL_ERROR = 1002;
    public const DECRYPT_ERROR = 1003;
    public const FILE_OR_DIR_NOT_FOUND = 1004;
    public const CONFIG_NOT_FOUND = 1005;
    public const NO_ONE_ROLE_ISSET = 1006;
    public const ROLE_NOT_FOUND = 1007;
    public const RESET_PASSWORD_TOKEN_NOT_FOUND = 1008;
    public const UNAUTHORIZED_REQUEST = 1009;
    public const FORBIDDEN_REQUEST = 1010;
    public const PERMISSION_NOT_GRANTED = 1011;
    public const UNAUTHORIZED_USER = 1012;
    public const ELOQUENT_DUPLICATE_ENTRY_ERROR = 1062;
    /** ------------------------------------------------------------------------------- */

    /** ----------------------------- Validation (2xxx) ------------------------------- */
    public const EMPTY_EMAIL = 2001;
    public const INVALID_EMAIL_FORMAT = 2002;
    public const EMPTY_PHONE = 2003;
    public const INVALID_PHONE_FORMAT = 2004;
    public const ID_LESS_THAN_MIN = 2005;
    public const EMPTY_URL = 2006;
    public const INVALID_URL_FORMAT = 2007;
    public const EMPTY_TOKEN = 2008;
    public const EMPTY_PATH = 2009;
    public const NO_FILE_OR_DIR_FOUND = 2010;
    public const NOT_A_FILE = 2011;
    public const NOT_A_DIRECTORY = 2012;
    public const NOT_ALLOWED_FILE_EXTENSION = 2013;
    public const LIMIT_LESS_THAN_MIN = 2014;
    public const OFFSET_LESS_THAN_MIN = 2015;
    public const EMPTY_ABBREVIATION = 2016;
    public const INVALID_ABBREVIATION_FORMAT = 2017;
    public const EMPTY_ERROR_MESSAGE = 2018;
    public const ERROR_MESSAGE_GREATER_THAN_MAX = 2019;
    public const EMPTY_CONFIG_PARAMETERS = 2020;
    public const EMPTY_CONFIG_RESULT = 2021;
    public const EMPTY_PASSWORD = 2022;
    public const PASSWORD_LESS_THAN_MIN = 2023;
    public const PASSWORD_DOESNT_CONTAIN_UPPER = 2024;
    public const PASSWORD_DOESNT_CONTAIN_LOWER = 2025;
    public const EMPTY_NICKNAME = 2026;
    public const NICKNAME_LESS_THAN_MIN = 2027;
    public const NICKNAME_GREATER_THAN_MAX = 2028;
    public const EMPTY_MESSAGE_TEXT = 2029;
    public const MESSAGE_TEXT_GREATER_THAN_MAX = 2031;
    public const EMPTY_CHAT_ROOM_NAME = 2032;
    public const CHAT_ROOM_NAME_LESS_THAN_MIN = 2033;
    public const CHAT_ROOM_NAME_GREATER_THAN_MAX = 2034;
    /** ------------------------------------------------------------------------------- */

    /** ----------------------------- Business logic (3xxx) --------------------------- */
    public const USER_ALREADY_EXIST = 3001;
    public const USER_NOT_FOUND = 3002;
    public const CHAT_USER_ALREADY_EXIST = 3003;
    public const CHAT_USER_NOT_FOUND = 3004;
    public const CHAT_ROOM_ALREADY_EXIST = 3005;
    public const CHAT_ROOM_NOT_FOUND = 3006;
    /** ------------------------------------------------------------------------------- */

    /** -------------------------- Third party vendor (4xxx) -------------------------- */
    /** ------------------------------------------------------------------------------- */
}

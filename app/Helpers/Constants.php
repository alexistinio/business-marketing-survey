<?php

// response status codes
defined('RESPONSE_SUCCCESS_CODE') || define('RESPONSE_SUCCCESS_CODE', 200);
defined('RESPONSE_ERROR_CODE') || define('RESPONSE_ERROR_CODE', 400);

// status active or inactive
defined('STATUS_ACTIVE') || define('STATUS_ACTIVE', 1);
defined('STATUS_INACTIVE') || define('STATUS_INACTIVE', 2);

// subscription status
defined('SUBS_STATUS_ACTIVE') || define('SUBS_STATUS_ACTIVE', 1);
defined('SUBS_STATUS_EXPIRED') || define('SUBS_STATUS_EXPIRED', 2);
defined('SUBS_STATUS_CANCELLED') || define('SUBS_STATUS_CANCELLED', 3);
defined('SUBS_STATUS_PENDING') || define('SUBS_STATUS_PENDING', 4);

// Roles
defined('ROLE_ADMIN_USER') || define('ROLE_ADMIN_USER', 1);
defined('ROLE_PREMIUM_USER') || define('ROLE_PREMIUM_USER', 2);
defined('ROLE_USER') || define('ROLE_USER', 3);

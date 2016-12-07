<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.11.16
 * Time: 14:48
 */

require INC_ROOT . '/app/routes/home.php';

require INC_ROOT . '/app/routes/auth/register.php';
require INC_ROOT . '/app/routes/auth/login.php';
require INC_ROOT . '/app/routes/auth/activate.php';
require INC_ROOT . '/app/routes/auth/logout.php';

require INC_ROOT . '/app/routes/auth/password/change.php';
require INC_ROOT . '/app/routes/auth/password/recover.php';
require INC_ROOT . '/app/routes/auth/password/reset.php';

require INC_ROOT . '/app/routes/user/profile.php';
require INC_ROOT . '/app/routes/user/all.php';

require INC_ROOT . '/app/routes/tender/list.php';
require INC_ROOT . '/app/routes/tender/tender_view.php';

require INC_ROOT . '/app/routes/account/profile.php';
require INC_ROOT . '/app/routes/account/tenders.php';

require INC_ROOT . '/app/routes/admin/main.php';
require INC_ROOT . '/app/routes/admin/all.php';
require INC_ROOT . '/app/routes/admin/edit.php';

require INC_ROOT . '/app/routes/errors/404.php';
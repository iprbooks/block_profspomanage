<?php

use Profspo\Sdk\Client;
use Profspo\Sdk\collections\UsersCollection;
use Profspo\Sdk\Managers\UserManager;

define('AJAX_SCRIPT', true);
require_once('../../config.php');
require_once($CFG->dirroot . '/blocks/profspomanage/vendor/autoload.php');

require_login();
$action = optional_param('action', "", PARAM_TEXT);
$type = optional_param('type', "", PARAM_TEXT);
$user_id = optional_param('user_id', "", PARAM_TEXT);
$page = optional_param('page', 0, PARAM_INT);

$email = optional_param('email', "", PARAM_TEXT);
$fio = optional_param('fio', "", PARAM_TEXT);
$pass = optional_param('pass', "", PARAM_TEXT);
$user_type = optional_param('user_type', "", PARAM_TEXT);

//user filter
$filter_user_fio = optional_param('filter-user-fio', "", PARAM_TEXT);

$user_types = array(
    2 => 'обучающийся',
    5 => 'преподаватель'
);

$orgId = get_config('profspomanage', 'org_id');
$orgToken = get_config('profspomanage', 'org_token');
$usrEmail = get_config('profspomanage', 'user_email');
$usrPass = get_config('profspomanage', 'user_pass');

//$clientId = 187;
//$token = '5G[Usd=6]~F!b+L<a4I)Ya9S}Pb{McGX';

$content = "";
try {
    $client = new Client($orgId, $orgToken, $usrEmail, $usrPass);
} catch (Exception $e) {
    die();
}

$userManager = new UserManager($client);
switch ($action) {
    case 'getlist':
        $userCollection = new UsersCollection($client);

        //set filters
        $userCollection->setFilter(UsersCollection::FULLNAME, $filter_user_fio);
        $userCollection->setOffset($userCollection->getLimit() * $page);
        $userCollection->get();

        $message = $userCollection->getMessage();

        foreach ($userCollection as $user) {
            $blocked = $user->getIsBlocked() == 0 ? "Нет" : "Да";
            $userType = $user_types[$user->getRole()];
            if ($user->getIsBlocked() != 0) {
                $button = "<a style=\"\" class=\"btn btn-secondary profspomanage-user-unblock\" data-id=\"" . $user->getId() . "\" href=\"#unblock\">Восстановить</a>";
            } else {
                $button = "<a style=\"\" class=\"btn btn-secondary profspomanage-user-block\" data-id=\"" . $user->getId() . "\" href=\"#block\">Заблокировать</a>";
            }
            $content .= "<div class=\"profspomanage-user-item\" data-id=\"" . $user->getId() . "\">
                            <div class=\"\" style='padding: 10px 10px'>
                                <div class=\"\">
                                    <div id='profspomanage-user-id-" . $user->getId() . "'><strong>ID:</strong> " . $user->getId() . " </div>
                                    <div id='profspomanage-user-fullname-" . $user->getId() . "'><strong>ФИО:</strong> " . $user->getName() . " </div>
                                    <div id='profspomanage-user-email-" . $user->getId() . "'><strong>Email:</strong> " . $user->getEmail() . " </div>
                                    <div id='profspomanage-user-blocked-" . $user->getId() . "'><strong>Заблокирован:</strong> " . $blocked . " </div>
                                    <div id='profspomanage-user-user_type-" . $user->getId() . "'><strong>Тип пользователя:</strong> " . $userType . " </div>
                                    <div id='profspomanage-user-org-" . $user->getId() . "'><strong>Организация:</strong> " . $user->getOrganization() . " </div>
                                    <div id='profspomanage-user-registration_date-" . $user->getId() . "'><strong>Дата регистрации:</strong> " . $user->getRegistrationDate() . "</div>
                                    <div id='profspomanage-user-blockedafter-" . $user->getId() . "'><strong>Дата окончания подписки:</strong> " . $user->getBlockAfter() . " </div>
                                </div>
                                <div class=\"\"> " . $button . "</div>
                            </div>
                        </div>";
        }

        $content .= pagination($userCollection->getTotal(), $page + 1);
        break;

    case 'block_user':
        $userManager->editUser($user_id, null, null, null, null, 1);
        break;

    case 'unblock_user':
        $userManager->editUser($user_id, null, null, null, null, 0);
        break;
    case 'register_user':
        $userId = $userManager->registerNewUser($fio, $email, $pass, $user_type);
        if ($userId > 0) {
            $text = "Пользователь успешно зарегистрирован";
        } else {
            $text = "Ошибка";
        }
        break;
}

if (mb_strlen($content) < 200) {
    $content = '<div style="font-size: 150%; text-align: center;">' . $message . '</div>' . $content;
}

echo json_encode(['action' => $action, 'type' => $type, 'html' => $content, 'text' => $text]);

function pagination($count, $page)
{
    $output = '';
    $output .= "<nav aria-label=\"Страница\" class=\"pagination pagination-centered justify-content-center\"><ul class=\"mt-1 pagination \">";
    $pages = ceil($count / 10);


    if ($pages > 1) {

        if ($page > 1) {
            $output .= "<li class=\"page-item\"><a data-page=\"" . ($page - 2) . "\" class=\"page-link profspomanage-page\" ><span>«</span></a></li>";
        }
        if (($page - 3) > 0) {
            $output .= "<li class=\"page-item \"><a data-page=\"0\" class=\"page-link profspomanage-page\">1</a></li>";
        }
        if (($page - 3) > 1) {
            $output .= "<li class=\"page-item disabled\"><span class=\"page-link profspomanage-page\">...</span></li>";
        }


        for ($i = ($page - 2); $i <= ($page + 2); $i++) {
            if ($i < 1) continue;
            if ($i > $pages) break;
            if ($page == $i)
                $output .= "<li class=\"page-item active\"><a data-page=\"" . ($i - 1) . "\" class=\"page-link profspomanage-page\" >" . $i . "</a ></li > ";
            else
                $output .= "<li class=\"page-item \"><a data-page=\"" . ($i - 1) . "\" class=\"page-link profspomanage-page\">" . $i . "</a></li>";
        }


        if (($pages - ($page + 2)) > 1) {
            $output .= "<li class=\"page-item disabled\"><span class=\"page-link profspomanage-page\">...</span></li>";
        }
        if (($pages - ($page + 2)) > 0) {
            if ($page == $pages)
                $output .= "<li class=\"page-item active\"><a data-page=\"" . ($pages - 1) . "\" class=\"page-link profspomanage-page\" >" . $pages . "</a ></li > ";
            else
                $output .= "<li class=\"page-item \"><a data-page=\"" . ($pages - 1) . "\" class=\"page-link profspomanage-page\">" . $pages . "</a></li>";
        }
        if ($page < $pages) {
            $output .= "<li class=\"page-item\"><a data-page=\"" . $page . "\" class=\"page-link profspomanage-page\"><span>»</span></a></li>";
        }

    }

    $output .= "</ul></nav>";
    return $output;
}

die();

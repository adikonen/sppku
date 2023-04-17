<?php

/**
 * import the model
 * @param array $models
 */
function importModel(...$models)
{
    $db = new Database;
    foreach ($models as $model) {
        require_once "../app/models/$model.php";
        call_user_func([$model,'init'], $db);
    }
}

function importHelper(...$helpers)
{
    foreach ($helpers as $helper) {
    }
}

/**
 * dump and die
 * @param mixed $vars
 */
function dd($vars)
{
    var_dump($vars);
    die;
}

/**
 * redirect user to location
 * @param string $path
 */
function redirect($path)
{
    $path = trim($path, '/');
    header('Location: '.BASE_URL.'/'.$path);
    die;
}

/**
 * render view component in views/components directory 
 * @param string $component
 * @param array $data
 */
function component($component, $data = [])
{
    include "../app/views/components/$component.php";
}

/**
 * hash password with bcrypt algorithm
 * @param string $pass
 * @return string
 */
function bcrypt($pass) 
{
    return password_hash($pass, PASSWORD_BCRYPT);
}

/**
 * set $_SESSION['user'] with $data
 * also removing password in $data
 * @param array $data
 */
function login($data)
{
    if (isset($data['password'])) {
        unset($data['password']);
    }

    $_SESSION['user'] = $data;
}

/**
 * get auth user
 * @return array|null
 */
function getLoginAccount()
{
    return $_SESSION['user'] ?? null;
}

/**
 * if user is guest, user will redirected to redirector page
 */
function login_required()
{
    $user = getLoginAccount();
    if ($user == null) {
        return redirect('redirector');
    }
}

/**
 * if user is not siswa, user will redirected to redirector page
 */
function siswa_only()
{
    login_required();
    $user = getLoginAccount();
    if ($user['role'] != Role::SISWA) {
        return redirect('redirector');
    }
}

/**
 * if user is not admin or petugas, user will redirected to redirector page
 */
function staff_only()
{
    login_required();
    $user = getLoginAccount();
    if ($user['role'] == Role::SISWA) {
        return redirect('redirector');
    }
}


/**
 * if user is not admin, user will redirected to redirector page
 */
function admin_only()
{
    login_required();
    $user = getLoginAccount();
    if ($user['role'] != Role::ADMIN) {
        return redirect('redirector');
    }
}

/**
 * convert year to year/year+1 
 * example: 2022 -> 2022/2023
 * 
 * @param int $tahun_ajaran
 * @return string
 */
function printYearSpp($tahun_ajaran)
{
    $nextyear = $tahun_ajaran + 1;
    return "$tahun_ajaran / $nextyear";
}

function http_post_only()
{
    if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
        http_response_code(405);
        Flasher::set('warning','Maaf anda tidak dapat mengunjungi halaman tersebut.');
        return redirect('redirector');
    }
}
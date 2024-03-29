<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Auth;
use App\Filters\AuthCheckAdminPegawai;
use App\Filters\AuthCheckFilter;
use App\Filters\AuthCheckFilterAdmin;
use App\Filters\Noauth;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'authcheck'     => AuthCheckFilter::class,
        'noauth'        => NoAuth::class,
        'authadmin'        => AuthCheckFilterAdmin::class,
        'authadminpegawai' => AuthCheckAdminPegawai::class
        // 'login'      => \Myth\Auth\Filters\LoginFilter::class,
        // 'role'       => \Myth\Auth\Filters\RoleFilter::class,
        // 'permission' => \Myth\Auth\Filters\PermissionFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'authcheck'
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
            // login ini untuk mecek pada semua bagian apakah sudah login atau belum
            // 'login',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}

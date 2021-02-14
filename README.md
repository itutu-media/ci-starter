# cistarter

CodeIgniter 4 starter kit by [ITUTU Media](https://itutu-media.id).

## Setup

1. Disable auth route
2. Register global filter
```bash
    'global'     => \IM\CI\Filters\GlobalFilter::class,
```
3. Register auth filter
```bash
    'login'      => \Myth\Auth\Filters\LoginFilter::class,
    'role'       => \Myth\Auth\Filters\RoleFilter::class,
    'permission' => \Myth\Auth\Filters\PermissionFilter::class,
```
4. Config auth

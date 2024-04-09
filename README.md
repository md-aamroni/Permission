```shell

   _______    _______   _______   ___      ___   __      ________  ________  __      ______    _____  ___   
  |   __ "\  /"     "| /"      \ |"  \    /"  | |" \    /"       )/"       )|" \    /    " \  (\"   \|"  \  
  (. |__) :)(: ______)|:        | \   \  //   | ||  |  (:   \___/(:   \___/ ||  |  // ____  \ |.\\   \    | 
  |:  ____/  \/    |  |_____/   ) /\\  \/.    | |:  |   \___  \   \___  \   |:  | /  /    ) :)|: \.   \\  | 
  (|  /      // ___)_  //      / |: \.        | |.  |    __/  \\   __/  \\  |.  |(: (____/ // |.  \    \. | 
 /|__/ \    (:      "||:  __   \ |.  \    /:  | /\  |\  /" \   :) /" \   :) /\  |\\        /  |    \    \ | 
(_______)    \_______)|__|  \___)|___|\__/|___|(__\_|_)(_______/ (_______/ (__\_|_)\"_____/    \___|\____\) 
                                                                                                            
                                                                 
```


<p align="center">
<a href="https://github.com/md-aamroni/Permission/actions"><img src="https://github.com/md-aamroni/Permission/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/aamroni/permission"><img src="https://img.shields.io/packagist/dt/aamroni/permission" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/aamroni/permission"><img src="https://img.shields.io/packagist/v/aamroni/permission" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/aamroni/permission"><img src="https://img.shields.io/packagist/l/aamroni/permission" alt="License"></a>
</p>


# Permission
Generating RSA key pairs for microservice authentication in Laravel


### Composer Install
```shell
composer require aamroni/permission
```

### Publish Config
```shell
php artisan vendor:publish --tag=aamroni-permission
```

### Artisan Command
```shell
# Create or Update JWT secret
php artisan aamroni:permission-secret

# Create or Update OpenSSL keys
php artisan aamroni:permission-install
```

### Usage Example

```php
use Aamroni\Permission\PermissionManager;
use Aamroni\Permission\Facades\Permission;

$object = PermissionManager::instance();
$encode = $object->encode();
$decode = $object->decode(jwtToken: $encode);

// Or using facade

$encode = Permission::encode();
$decode = Permission::decode(jwtToken: $encode);
dd($decode, $encode);
```

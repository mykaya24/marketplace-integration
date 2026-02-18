## proje açıklaması

## db kurulum

## token oluşturma 

Eğer ilk defa kullanıyorsak önce kullanıcı oluşturmamuız lazım
bununla ilgili seeder oluşturdum

```
php artisan db:seed
```

dbye user oluşturucaktır.


token oluşturup manual kullanacağız
```
php artisan tinker
$user = User::where('email', 'integration@internal.local')->first();
$user->createToken('order-service', ['orders:read','orders:write'])->plainTextToken;
```


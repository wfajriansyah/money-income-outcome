<p align="center"><img src="https://rawcdn.githack.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Information
Disini saya menggunakan rumus saya sendiri yaitu jika perorangan diitung maksimal tabungan perbulan 1 Juta, untuk keseluruhan saya menggunakan rumus 
```php
$rata_rata_tabungan = 0;
$rata_rata_tabungans = 0;
foreach($catatans as $cats) {
    $rata_rata_tabungan += ($cats->nominals_masuk + $cats->nominals_keluar);
    $rata_rata_tabungans += $cats->nominals_keluar;
}
$rata_rata_tabungan = $rata_rata_tabungan / count($catatans);
$rata_rata_tabungans = $rata_rata_tabungans / count($catatans);

$isProfit = "Tidak";
if($total_menabung > $total_pengeluaran) {
    $isProfit = "Ya";
}

$isRugi = "Tidak";
if(($total_menabung < $total_pengeluaran) || $total_menabung == 0) {
    $isRugi = "Ya";
}

$isBalance = "Tidak";
if(($total_menabung + $total_pengeluaran) == $rata_rata_tabungan) {
    $isBalance = "Ya";
}

$isKekurangan = "Tidak";
if(($rata_rata_tabungan - $total_menabung) < 0) {
    $isKekurangan = "Tidak";
} else {
    $isKekurangan = convertRupiah($rata_rata_tabungan - $total_menabung);
}
```

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# ci-laravel
Code Igniter Or Laravel ? Why not Both !!!

#Features
* Query Builder dari Laravel
* 95% ajax ( load page , proses , dll)
* FatLess Controller
* Notification System
* Login Level
* Dynamic load JS and CSS files

#Update 31 August 2017
* Penambahan Fitur API
* Session di ganti dari Session dengan file jadi menggunakan session yang di simpan di cookie (Encrypt,Encode,Hash) dari CI Version 2

# Installation
Ekstrak file zip yang di download dari repository ini di htdocs .

Dan buatlah database baru di phpmyadmin anda atau menggunakan command dengan nama : prototype_si .<br>
Kemudian import file sql yg ada di folder prorotype ke database yang baru dibuat tadi.

Selesai , sekarang anda bisa meliat hasil nya dari url berikut : <br>
<a href="http://localhost/prototype/">http://localhost/prototype/</a> <br>
Default data login : <br>
Administrator ===> HeL password : 1 <br>
Member ===> mEmber : 1 <br>

#Usage
Ini adalah prototype sistem informasi yang biasa nya suatu sistem informasi membutuhkan login system dan level login.<br>
Prototype SI ini dibuat menggunakan framework Code igniter tetapi sudah menggunakan konsep namespace .<br>
Prototype ini juga menggunakan query builder dari Laravel , jadi anda bisa menggunakan Eloquent ORM nya laravel untuk read/write database <br>
Alasan saya tidak menggunakan query builder bawaan CI karena bind query dari query builder ny CI tidak melakukan bind param atau pun value di query yang di eksekusi.<br>
<p></p>
Jadi yang biasa ny anda load database seperti berikut <br>

```php
$this->load->database();
```

Sekarang anda menggunakan use terlebih dahulu untuk mempersingkat kode ataupun tidak , contoh
```PHP
use Saya\DB ;
```
<p></p>
Biasa ny untuk membaca tabel menggunakan CI anda melakukan nya seperti berikut : <br>

```php
$this->db->get('table_saya');
```
menggunakan Query builder dari laravel ini seperti berikut : <br>

```php
DB::table('table_saya')->get();
// Jika tidak menggunakan use anda tetap bisa membaca / write ke table database seperti berikut:
Saya\DB::table('table_saya')->get();
```
 <br>

<p></p>
Untuk lebih detail penggunaan query builder ny laravel silahkan baca-baca di dokumentasi nya laravel bagian queries ataupun eloquent.
<br> Anda juga bisa melihat contoh nya di source code dari prototype system informasi ini untuk penggunaan nya.

#Penggunan API
Api dari Prototype Sistem Informasi ini Bisa diakses di <a href="http://localhost/prototype/api/">http://localhost/prototype/api/</a> jika anda sudah berhasil melakukan instalasi prototype ini ke komputer anda.<br>
Api ini membutuhkan config file , di Folder Config/my/config_api.php<br>
Semua settingan API yang digunakan prototype ini ada di file itu.<br>
API prototype ini juga support versi default nya seperti <a href="http://localhost/prototype/api/">http://localhost/prototype/api/</a> ini untuk akses API, jika ingin menggunakan versi tertentu misal versi developer yang tentu nya harus di set di file config yang saya sebutkan diatas <a href="http://localhost/prototype/api/v.developer/">http://localhost/prototype/api/v.developer/</a> <br>
Untuk generate access token <a href="http://localhost/prototype/api/accesstoken?email=username_atau_email_terdaftar&password=password_nya">http://localhost/prototype/api/accesstoken?email=username_atau_email_terdaftar&password=password_nya</a> <br>
Diprototype ini saya tambahkan contoh akses User di access list nya, fitur sederhana saja untuk nambahkan user dan baca user , tentu nya untuk production harus lebih detail lagi .<a href="http://localhost/prototype/api/user">http://localhost/prototype/api/user</a>
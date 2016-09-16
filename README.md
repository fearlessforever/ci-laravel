# ci-laravel
Code Igniter Or Laravel ? Why not Both !!!

#Features
* Query Builder dari Laravel
* 95% ajax ( load page , proses , dll)
* FatLess Controller
* Notification System
* Login Level
* Dynamic load JS and CSS files


# Installation
Ekstrak file zip yang di download dari repository ini di htdocs .

Dan buatlah database baru di phpmyadmin anda atau menggunakan command dengan nama : prototype_si .<br>
Kemudian import file sql yg ada di folder prorotype ke database yang baru dibuat tadi.

Selesai , sekarang anda bisa meliat hasil nya dari url berikut : <a href="http://localhost/prototype/">http://localhost/prototype/</a> <br>
Default data login : <br>
Administrator ===> HeL password : 1 <br>
Member ===> mEmber : 1 <br>

#Usage
Ini adalah prototype sistem informasi yang biasa nya suatu sistem informasi membutuhkan login system dan level login.<br>
Prototype SI ini dibuat menggunakan framework Code igniter tetapi sudah menggunakan konsep namespace .<br>
Prototype ini juga menggunakan query builder dari Laravel , jadi anda bisa menggunakan Eloquent ORM nya laravel untuk read/write database <br>
Alasan saya tidak menggunakan query builder bawaan CI karena bind query dari query builder ny CI tidak melakukan bind param atau pun value di query yang di eksekusi.<br>
<p></p>
Jadi yang biasa ny anda load database seperti berikut
```PHP
 $this->load->database();
```

Sekarang anda menggunakan use terlebih dahulu untuk mempersingkat kode ataupun tidak , contoh
```PHP
use Saya\DB ;
```
<p></p>
Biasa ny untuk membaca tabel menggunakan CI anda melakukan nya seperti berikut :
```PHP
  $this->db->get('table_saya');
```
menggunakan Query builder dari laravel ini seperti berikut :
```PHP
  DB::table('table_saya')->get();
  // Jika tidak menggunakan use anda tetap bisa membaca / write ke table database seperti berikut:
  Saya\DB::table('table_saya')->get();
```
<p></p>
Untuk lebih detail penggunaan query builder ny laravel silahkan baca-baca di dokumentasi nya laravel bagian queries ataupun eloquent.
<br> Anda juga bisa melihat contoh nya di source code dari prototype system informasi ini untuk penggunaan nya.

<p></p>
Demo :
<a href="http://demo-saya.esy.es/">http://demo-saya.esy.es/</a> <br>
Default data login : <br>
Administrator ===> HeL password : 1 <br>
Member ===> mEmber : 1 <br>

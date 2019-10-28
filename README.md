# LARACI
Laraci adalah sebuah template Codeigniter yang 'mungkin' dapat memudahkan seseorang dalam mengembangkan aplikasi tanpa harus menulis kode lagi. Beberapa bagian akan terus dikembangkan dan tentu sangat butuh kontributor dalam mengembangkan ini.

Maksud dari template ini adalah misalnya ketika kita ingin membuat halaman login dan register, kita tidak perlu lagi menulis kode untuk menyusun halaman login dan register, tinggal gunakan template (berupa controller, view, dan model) yang sudah ada dan siap dijalankan.

Selain itu misalnya membuat sistem CRUD tidak perlu repot lagi membuatnya dari 0, cukup modivikasi tampilan saja. Hehehe.

#### Loh kok gak pake Laravel?
Aku sukanya Codeigniter, maaf ya. Hahaha


# Inside files
Di sini menggunakan Codeigniter versi 3.1.11 dan Bootstrap via cdn, jadi dalam mode development harus online. Menggunakan fonts dari google yaitu Roboto.

# Docs
Dokumentasi dari projek ini menyusul ya seiring berjalannya waktu. Semua dokumentasi akan tersampaikan di folder docs atau wiki.

# Struktur file
Tidak ada yang berubah, hanya saja menambahkan folder baru untuk menyimpan `assets` dan `docs` untuk kumpulan dokumentasi projek.

# Install

### Add table
Pertama tambahkan tabel ini ke dalam database kalian.

```sql
CREATE TABLE `oppia`.`user` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(250) NOT NULL , `email` VARCHAR(250) NOT NULL , `password` VARCHAR(250) NOT NULL , `is_delete` BOOLEAN NOT NULL , `date` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
```

### Clone
Silahkan clone repo ini

```
$ git clone https://github.com/sahmura/laraci.git nama-projek
```

### Set Up
Atur database dan config di file `application/config/database.php` dan `application/config/config.php`

# Pengembangan
Bagi yang ingin mengembangkan, silahkan. KIta bersama-sama mengembangkan Codeigniter Template ini supaya memudahkan para developer dalam membangun sebuah web. Aku yakin akan berguna suatu saat, hehehe.

# Loh kok namanya LARACI?
Terserah aku dong. Terima kasih

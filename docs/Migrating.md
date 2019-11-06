# Migrating

Migrating dilakukan untuk memindahkan data ke dalam database atau bisa dikatakan untuk memasang tabel di database. Sebelum menggunakan Laraci, pastikan sudah migrating tabel user dan admin karena tabel tersebut akan menyimpan data user dan admin supaya fungsi login dan register berjalan dengan lancar. Jika tidak ada fungsi login dan register abaikan tidak masalah.

Untuk migrating tabel user dan admin, pertama harus buat terlebih dahulu file nya dengan menggunakan command berikut:

```
$ php index.php laraci migration "user"
$ php index.php laraci migration "admin"
```

Kemudian gunakan command ini untuk mulai melakukan proses migrate

```
$ php index.php laraci migrate
```

Jika ingin mengeditnya ada di folder `application/database/migrations/`

### Untuk menambahkan tabel sendiri

Jika ingin menambahkan tabel sendiri, gunakan command di bawah ini

```
$ php index.php laraci migration "nama_file"
```

Kemudian edit file di dalam folder `application/database/migrations/`

Lalu migrate kembali dengan command

```
$ php index.php laraci migrate
```

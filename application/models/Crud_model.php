<?php

/*
    Ini adalah model untuk mengatur seluruh aktifitas CRUD. Akan dimodifikasi lebih baik supaya mudah digunakan.
*/

class Crud_model extends CI_Model
{
    /*
    
    Ini adalah fungsi untuk memasukkan data ke dalam tabel di database.

    @parameter
    $data berupa array dari controllers. Gunakan array dengan key dan value dimana key sebagai nama kolom di dalam tabel, dan value sebagai nilainya.
    $table adalah nama table yang menjadi tempat dimasukkannya data.

    @return
    Fungsi akan mengembalikan nilai true jika berhail dan false jika gagal dalam memasukkan data.
    
    */

    public function insertData($data, $table)
    {
        $insert = $this->db->insert($table, $data);
        return $insert ? true : false;
    }

    /*
    
    Ini adalah fungsi untuk membaca data dari sebuah table. 

    @parameter
    $func berisi array asosiatif yang bisa diset untuk melakukan berbagai konfigurasi dalam pengambilan data. Fungsi yang ada.
    $table adalah nama table yang menjadi target untuk pengambilan data

    @return
    Fungsi akan mengembalikan data dalam bentuk array jika berhasil dan mengembalikan false jika gagal
    
    */

    public function getData($func, $table, $row)
    {

        if ($func != null) {
            if (array_key_exists('select', $func)) {
                $this->db->select($func['select']);
            }

            if (array_key_exists('identifier', $func)) {
                $this->db->where($func['identifier']);
            }

            if (array_key_exists('limit', $func)) {
                if (array_key_exists('start', $func)) {
                    $this->db->limit($func['limit'], $func['start']);
                } else {
                    $this->db->limit($func['limit']);
                }
            }

            if (array_key_exists('like', $func)) {
                $this->db->like($func['like'][0], $func['like'][1], $func['like'][2]);
            }

            if (array_key_exists('or_like', $func)) {
                $this->db->like($func['or_like'][0], $func['or_like'][1]);
            }

            if (array_key_exists('order_by', $func)) {
                $this->db->order_by($func['order_by'][0], $func['order_by'][1]);
            }
        }

        $data = $this->db->get($table);

        if ($row == true) {
            return $data ? $data->row_array() : false;
        } else {
            return $data ? $data->result_array() : false;
        }
    }

    /*
    
    Ini adalah fungsi untuk mengupdate data yang sudah ada dalam database. Dapat digunakan untuk softDelete dari sebuah data

    @parameter
    $data adalah data baru yang akan dimasukkan
    $func berisi array assosiative untuk menentukan spesifikasi value mana dan id berapa kolom akan diubah
    $table adalah nama table yang akan diubah

    @return
    Fungsi akan mengembalikan nilai true jika berhasil dan false jika gagal
    
    */

    public function updateData($data, $func = array(), $table)
    {
        if ($func != null) {
            if (array_key_exists('identifier', $func)) {
                $this->db->where($func['identifier']);
            }
        }

        $update = $this->db->update($table, $data);
        return $update ? true : false;
    }

    /*
    
    Ini adalah fungsi untuk join data

    @parameter
    $select (string) untuk menyeleksi apa saja data yang akan diambil
    $table1 (string) nama tabel pertama yang akan dijoin
    $table2 (strung) nama tabel kedua yang akan dijoin
    $identifier (string) identifikasi apa saja yang dapat memenuhi untuk pengambilan data
    $type (string: both, left, right) untuk menentukan jenis join apa yang akan digunakan

    @return
    Akan mengembalikan array berupa data jika ada datanya dan false jika ada kesalahan

    */

    public function joinData($select, $table1, $table2, $identifier, $type)
    {
        if ($select != null) {
            $this->db->select('*');
        }

        $this->db->from($table1);

        if ($type == null) {
            $this->db->join($table2, $identifier);
        } else if ($type != null) {
            $this->db->join($table2, $identifier, $type);
        }

        $query = $this->db->get();

        return $query ? $query : false;
    }
}

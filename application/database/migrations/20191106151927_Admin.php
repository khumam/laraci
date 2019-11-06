<?php

class Migration_Admin extends CI_Migration
{
    public function up()
    {

        // Bisa ditambah jika diperlukan 

        $data = [
            'id_admin' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],
            'is_delete' => [
                'type' => 'BOOLEAN',
                'null' => true,
            ],
            'date' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
        ];

        $this->dbforge->add_field($data);
        $this->dbforge->add_key('id_admin', TRUE);
        $this->dbforge->create_table('admin');
    }

    public function down()
    {
        $this->dbforge->drop_table('admin');
    }
}

<?php

class Migration_User extends CI_Migration
{
    public function up()
    {

        // Bisa ditambah jika diperlukan 

        $data = [
            'id_user' => [
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
        $this->dbforge->add_key('id_user', TRUE);
        $this->dbforge->create_table('user');
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}

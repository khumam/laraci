<?php

class Laraci extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // can only be called from the command line
        if (!$this->input->is_cli_request()) {
            exit('Gunakan terminal, tidak dapat diakses langsung.');
        }

        $this->load->dbforge();

        // initiate faker
        $this->faker = Faker\Factory::create();
    }

    public function message($to = 'World')
    {
        echo "Hello {$to}!" . PHP_EOL;
    }

    public function help()
    {
        $result = "Beberapa perintah yang dapat digunakan\n\n";
        $result .= "php index.php laraci migration \"file_name\"         Create new migration file\n";
        $result .= "php index.php laraci migrate [\"version_number\"]    Run all migrations. The version number is optional.\n";
        $result .= "php index.php laraci seeder \"file_name\"            Creates a new seed file.\n";
        $result .= "php index.php laraci seed \"file_name\"              Run the specified seed file.\n";
        $result .= "php index.php laraci controller \"file_name\"        Create new Controller.\n";

        echo $result . PHP_EOL;
    }

    public function migration($name)
    {
        if ($name == 'user') {
            $this->make_migration_user();
        } else if ($name == 'admin') {
            $this->make_migration_admin();
        } else {
            $this->make_migration_file($name);
        }
    }

    public function migrate($version = null)
    {
        $this->load->library('migration');

        if ($version != null) {
            if ($this->migration->version($version) === FALSE) {
                show_error($this->migration->error_string());
            } else {
                echo "Migrations run successfully" . PHP_EOL;
            }

            return;
        }

        if ($this->migration->latest() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo "Migrations run successfully" . PHP_EOL;
        }
    }

    public function seeder($name)
    {
        $this->make_seed_file($name);
    }

    public function seed($name)
    {
        $seeder = new Seeder();

        $seeder->call($name);
    }

    protected function make_migration_file($name)
    {
        $date = new DateTime();
        $timestamp = $date->format('YmdHis');
        $table_name = strtolower($name);
        $path = APPPATH . "database/migrations/$timestamp" . "_" . "$name.php";
        $my_migration = fopen($path, "w") or die("Unable to create migration file!");

        $migration_template = "<?php

class Migration_$name extends CI_Migration {

    public function up() {
        \$this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            )
        ));
        \$this->dbforge->add_key('id', TRUE);
        \$this->dbforge->create_table('$table_name');
    }

    public function down() {
        \$this->dbforge->drop_table('$table_name');
    }

}";

        fwrite($my_migration, $migration_template);

        fclose($my_migration);

        echo "$path migration has successfully been created." . PHP_EOL;
    }

    protected function make_migration_admin()
    {
        $date = new DateTime();
        $timestamp = $date->format('YmdHis');
        $path = APPPATH . "database/migrations/$timestamp" . "_" . "Admin.php";
        $my_migration = fopen($path, "w") or die("Unable to create migration file!");

        $migration_template = "<?php

        class Migration_Admin extends CI_Migration {
            public function up() {

                // Bisa ditambah jika diperlukan 

                \$data = [
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

                \$this->dbforge->add_field(\$data);
                \$this->dbforge->add_key('id_admin', TRUE);
                \$this->dbforge->create_table('admin');
            }

            public function down()
            {
                \$this->dbforge->drop_table('admin');
            }
        }";

        fwrite($my_migration, $migration_template);
        fclose($my_migration);
        echo "$path migration has successfully been created." . PHP_EOL;
    }

    protected function make_migration_user()
    {
        $date = new DateTime();
        $timestamp = $date->format('YmdHis');
        $path = APPPATH . "database/migrations/$timestamp" . "_" . "User.php";
        $my_migration = fopen($path, "w") or die("Unable to create migration file!");

        $migration_template = "<?php

        class Migration_User extends CI_Migration {
            public function up() {

                // Bisa ditambah jika diperlukan 

                \$data = [
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

                \$this->dbforge->add_field(\$data);
                \$this->dbforge->add_key('id_user', TRUE);
                \$this->dbforge->create_table('user');
            }

            public function down()
            {
                \$this->dbforge->drop_table('user');
            }
        }";

        fwrite($my_migration, $migration_template);
        fclose($my_migration);
        echo "$path migration has successfully been created." . PHP_EOL;
    }

    protected function make_seed_file($name)
    {
        $path = APPPATH . "database/seeds/$name.php";

        $my_seed = fopen($path, "w") or die("Unable to create seed file!");

        $seed_template = "<?php

class $name extends Seeder {

    private \$table = 'users';

    public function run() {
        \$this->db->truncate(\$this->table);

        //seed records manually
        \$data = [
            'user_name' => 'admin',
            'password' => '9871'
        ];
        \$this->db->insert(\$this->table, \$data);

        //seed many records using faker
        \$limit = 33;
        echo \"seeding \$limit user accounts\";

        for (\$i = 0; \$i < \$limit; \$i++) {
            echo \".\";

            \$data = array(
                'user_name' => \$this->faker->unique()->userName,
                'password' => '1234',
            );

            \$this->db->insert(\$this->table, \$data);
        }

        echo PHP_EOL;
    }
}
";

        fwrite($my_seed, $seed_template);

        fclose($my_seed);

        echo "$path seeder has successfully been created." . PHP_EOL;
    }
}

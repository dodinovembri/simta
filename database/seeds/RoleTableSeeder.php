<?php



use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class RoleTableSeeder extends Seeder{

    public function run()
    {

        if (App::environment() === 'production') {
            exit('I just stopped you getting fired. Love, Amo.');
        }

        DB::table('roles')->truncate();

        Role::create([
            'id'            => 1,
            'name'          => 'Admin',
            'description'   => ''
        ]);

        Role::create([
            'id'            => 2,
            'name'          => 'Pengelola',
            'description'   => ''
        ]);

        Role::create([
            'id'            => 3,
            'name'          => 'Dosen',
            'description'   => ''
        ]);

        Role::create([
            'id'            => 4,
            'name'          => 'Mahasiswa',
            'description'   => ''
        ]);
    }

}
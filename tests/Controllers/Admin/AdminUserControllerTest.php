<?PHP

namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var    \App\Http\Controllers\Admin\AdminUserController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AdminUserController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = factory(\App\Models\AdminUser::class)->create();
        $authUserRole = factory(\App\Models\AdminUserRole::class)->create([
            'admin_user_id' => $authUser->id,
            'role' => \App\Models\AdminUserRole::ROLE_SUPER_USER,
        ]);
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\AdminUserController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AdminUserController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $adminUser = factory(\App\Models\AdminUser::class)->make();
        $this->action('POST', 'Admin\AdminUserController@store', [
                '_token' => csrf_token(),
            ] + $adminUser->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $adminUser = factory(\App\Models\AdminUser::class)->create();
        $this->action('GET', 'Admin\AdminUserController@show', [$adminUser->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $adminUser = factory(\App\Models\AdminUser::class)->create();

        $testData = str_random(10);
        $id = $adminUser->id;

        $adminUser->name = $testData;

        $this->action('PUT', 'Admin\AdminUserController@update', [$id], [
                '_token' => csrf_token(),
            ] + $adminUser->toArray());
        $this->assertResponseStatus(302);

        $newAdminUser = \App\Models\AdminUser::find($id);
        $this->assertEquals($testData, $newAdminUser->name);
    }

    public function testDeleteModel()
    {
        $adminUser = factory(\App\Models\AdminUser::class)->create();

        $id = $adminUser->id;

        $this->action('DELETE', 'Admin\AdminUserController@destroy', [$id], [
            '_token' => csrf_token(),
        ]);
        $this->assertResponseStatus(302);

        $checkAdminUser = \App\Models\AdminUser::find($id);
        $this->assertNull($checkAdminUser);
    }

}

<?php
namespace Tests\Unit;
use App\UseCase\cart\CreateCartUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;
use App\Sale;
use App\Item;
use App\User;
use Tests\TestCase;
class CreateCartUseCaseTest extends TestCase
{    
    use RefreshDatabase;
   
    public function testStoreFunctionTest()
    {   
        User::create(['name'=>'test','email'=>'test1@example.com','password'=>bcrypt(32310901)]);
        $testUser = User::query()->first();
        Auth::loginUsingId($testUser->id);
        Item::create(['name'=>'hoge','caption'=>'test','user_id'=>$testUser->id,'file_name'=>'test','price'=>300]);
        Item::create(['name'=>'hoge2','caption'=>'test','user_id'=>$testUser->id,'file_name'=>'test','price'=>100]);
        $item1 = Item::latest()->get()[0];
        $item2 = Item::latest()->get()[1];
        
        Sale::create(['amount'=>1,'user_id'=>$testUser->id,'price'=>$item1->price,'item_id'=>$item1->id]);
        Sale::create(['amount'=>2,'user_id'=>$testUser->id,'price'=>$item2->price,'item_id'=>$item2->id]);
        $useCase = new CreateCartUseCase();
        $useCase->handle(['comment'=>'test']);
        Auth::logout();

        $this->assertDatabaseHas('carts', [
            'comment'=>'test',
            'count'=>3,
            'sum'=>500
        ]);
        $this->assertDatabaseMissing('sales', [
            'user_id'=>$testUser->id,
            'cart_id'=>null
        ]);
    }

}
<?php
namespace Tests\Unit;
use App\UseCase\sale\CreateSaleUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;
use App\Sale;
use App\Item;
use App\User;
use Tests\TestCase;
class CreateSaleUseCaseTest extends TestCase
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
        $useCase = new CreateSaleUseCase();
       
        
        $useCase->handle(['user_id'=>$testUser->id,'item_id'=>$item1->id]);
        $useCase->handle(['user_id'=>$testUser->id,'item_id'=>$item2->id]);
        $useCase->handle(['user_id'=>$testUser->id,'item_id'=>$item2->id]);
        Auth::logout();

        $this->assertDatabaseHas('sales', [
           'item_id'=>$item1->id,
           'amount'=>1
        ]);
        $this->assertDatabaseHas('sales', [
            'item_id'=>$item2->id,
           'amount'=>2
        ]);
       
    }

}
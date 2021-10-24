<?php
use App\cart\CreateCartUseCase;
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use Auth;
use App\Sale;
use App\Item;
class CreateCartUseCaseTest extends TestCase
{   
    public function testStoreFunction()
    {   Sale::create(['name'=>'hoge','caption'=>'test','user_id'=>1,'file_name'=>'test','price'=>300]);
        Item::create(['item_id'=>1,'amount'=>1,'user_id'=>1,'price'=>20]);
        $testUser = User::query()->first();
        Auth::loginUsingId($testUser->id);
        $useCase = new CreateCartUseCase(['comment'=>'test']);
        $useCase->handle();
        Auth::logout();
    }

}
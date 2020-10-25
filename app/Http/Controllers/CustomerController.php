<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Transformers\CustomerTransformer;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\ProductTransformer;

class CustomerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();  
    }

    public function index(Request $request)
    {
        $perPage = isset($request->per_page) ? $request->per_page : 10;

        $paginator = Customer::paginate($perPage);

        // retrieve collection and use CustomerTransformer to provide correct json response structure
        $customersCollection = $paginator->getCollection();
        $resource = new Collection($customersCollection, new CustomerTransformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        
        return $this->fractal->createData($resource)->toArray();
    }
}

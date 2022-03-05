<?php

namespace App\Http\Controllers;

use App\Brand as AppBrand;
use App\Product;
use Illuminate\Http\Request;
// use App\Providers\User;
// use App\Providers\Brand;
use App\Category;
use App\Unit;
use App\Inventory;
use App\Brand;
use App\Position;
use App\Transacted_item;
use App\User as AppUser;
use Dotenv\Validator as DotenvValidator;
use App\Rules\Uppercase;
use App\Rules\Notselect;
use App\Store;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Rules\ImageRequired;
use App\User;
use App\Role;
use App\Access;
use App\Brand_color;
use App\Color;
use App\Location_name;
use App\Notification;
use App\Receipt;
use App\Repair;
use App\Return_to_supplier;
use App\Return_to_supplier_item;
use App\Supplier;
use App\Transaction;
use App\Transaction_cancelation;
use App\Transaction_comment;
use App\Transaction_type;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OfficesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('office');
    }

    public function index()
    {
        $brands = AppBrand::all();
        $inventories = Inventory::all();
        $stores = Store::where('name', '!=', 'Office')
            ->where('name', '!=', 'Warehouse')
            ->get();
        $daily_sales_transactions = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transactions.transaction_date', '=', date("Y-m-d"))
            ->where('transaction_types.type_name', '=', 'Sales')
            ->get();

        $store_datas = [];

        foreach ($stores as $store) {
            $store_daily_sale = 0;
            foreach ($daily_sales_transactions as $daily_sales_transaction) {
                if ($daily_sales_transaction->transaction->store_id == $store->id) {
                    $store_daily_sale = $store_daily_sale + $daily_sales_transaction->total_price;
                }
            }
            $store_datas[$store->name . ' - ' . $store->street . ' ' . $store->city] = $store_daily_sale;
        }

        arsort($store_datas);

        $data = [
            'brands' => $brands,
            'inventories' => $inventories,
            'daily_sales_transactions' => $daily_sales_transactions,
            'stores' => $stores,
            'store_datas' => $store_datas
        ];
        return view('office.dashboard', compact('data'));
    }

    public function chart_data()
    {
        $date = date("Y-m-d");
        $explode_date = explode('-', $date);
        $this_year = $explode_date[0];

        $sales_transactions = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.type_name', '=', 'Sales')
            ->get();


        $monthly_sales = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0];

        for ($i = 1; $i < count($monthly_sales) + 1; $i++) {
            $price = 0.00;
            foreach ($sales_transactions as $sales_transaction) {
                $transaction_date = explode('-', $sales_transaction->transaction->transaction_date);
                if ($transaction_date[0] == $this_year) {
                    if (strval($i) == $transaction_date[1]) {
                        $price = $price + $sales_transaction->total_price;
                    }
                }
            }
            $monthly_sales[$i] = $price;
            // $price = 0.00;
        }

        return response()->json(['monthly_sales' =>  $monthly_sales]);
    }

    public function fetch_store_sales_data(Request $request)
    {
        if ($request->ajax()) {
            $stores = Store::where('name', '!=', 'Office')
                ->where('name', '!=', 'Warehouse')
                ->get();

            $daily_sales_transactions = Transacted_item::select('transacted_items.*')
                ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
                ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                ->where('transactions.transaction_date', '=', date("Y-m-d"))
                ->where('transaction_types.type_name', '=', 'Sales')
                ->get();

            $store_datas = [];

            foreach ($stores as $store) {
                $store_daily_sale = 0;
                foreach ($daily_sales_transactions as $daily_sales_transaction) {
                    if ($daily_sales_transaction->transaction->store_id == $store->id) {
                        $store_daily_sale = $store_daily_sale + $daily_sales_transaction->total_price;
                    }
                }
                $store_datas[$store->name . ' - ' . $store->street . ' ' . $store->city] = $store_daily_sale;
            }

            arsort($store_datas);

            $daily_sales_rank = 1;
            $data = '';
            foreach ($store_datas as $store_name => $store_data) {
                $data .= '<div class="card my-2 mx-0 bg-dark">';
                $data .= '<div class="card-body text-white p-0">';
                $data .= '<div class="row">';
                $data .= '<div class="col-2">';
                $data .= '<div class="bg-white text-dark p-1 rounded text-center">';
                $data .= '<h5 class="card-title mt-2">' . $daily_sales_rank . '</h5>';
                $data .= '</div>';
                $data .= '</div>';
                $data .= '<div class="col-10 my-3 p-0">';
                $data .= '<h5 class="card-title">' . $store_name . '</h5>';
                $data .= '<h5 class="mb-0"><i class=" fas fa-wallet" aria-hidden="true"></i>  ' . number_format($store_data, 2, '.', ',') . '</h5>';
                $data .= '</div>';
                $data .= '</div>';
                $data .= '</div>';
                $data .= '</div>';
                $daily_sales_rank = $daily_sales_rank + 1;
            }

            return response()->json(['data' => $data]);
        }
    }

    public function fetch_stocks_data(Request $request)
    {
        if ($request->ajax()) {
            $brands = AppBrand::all();
            $inventories = Inventory::all();

            $data = '';
            $data .= '<div class="row">';
            foreach ($brands as $brand) {
                $data .= '<div class="col-lg-4 col-md-6">';
                $data .= '<div class="card bg-c-' . $brand->brand_color->brand_color . '">';
                $data .= '<div class="card-body text-' . $brand->brand_color->text_color . '">';
                $data .= '<h5 class="card-title">' . $brand->name . '</h5>';
                $product_count = 0;
                $product_total_price = 0.00;
                foreach ($inventories as $inventory) {
                    if ($brand->name === $inventory->product->brand->name) {
                        $product_count = $product_count + $inventory->quantity;
                        $product_price = $inventory->quantity * minusPercentage($inventory->product->price, $inventory->product->discount);
                        $product_total_price = $product_total_price + $product_price;
                    }
                }
                $data .= '<h5 class=""><i class=" fas fa-boxes" aria-hidden="true"></i> Total Stocks  ' . $product_count . '</h5>';
                $data .= '<h5 class=""><i class=" fas fa-tag" aria-hidden="true"></i> Stocks Price  ' . number_format($product_total_price, 2, '.', ',') . '</h5>';
                $data .= '</div>';
                $data .= '</div>';
                $data .= '</div>';
            }
            $data .= '</div>';

            return response()->json(['data' => $data]);
        }
    }

    public function product()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $brands = Brand::all();
        $data = [
            'products' => $products,
            'brands' => $brands
        ];
        return view('office.product', compact('data'));
    }

    public function fetch_product_data(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $brand = $request->get('brand');
            if ($brand === 'All') {
                $products = Product::where([['code', 'like', '%' . $query . '%']])
                    ->orWhere([['name', 'like', '%' . $query . '%']])
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            } else {
                $products = Product::where([['code', 'like', '%' . $query . '%'], ['brand_id', '=', $brand]])
                    ->orWhere([['name', 'like', '%' . $query . '%'], ['brand_id', '=', $brand]])
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            }

            $data = [
                'products' => $products
            ];
            return view('office.product-data', compact('data'))->render();
        }
    }

    public function create_product()
    {
        $brands = AppBrand::all();
        $categories = Category::all();
        $units = Unit::all();

        $data = [
            'brands' => $brands,
            'categories' => $categories,
            'units' => $units
        ];

        return view('office.create-product', compact('data'));
    }

    public function product_info($product_id)
    {
        $brands = AppBrand::all();
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        $units = Unit::all();
        $data = [
            'brands' => $brands,
            'categories' => $categories,
            'product' => $product,
            'product_id' => $product_id,
            'units' => $units
        ];

        return view('office.product-info', compact('data'));
    }

    public function store_product(Request $request)
    {

        $validatedProduct = $request->validate([
            'product_code' => ['required', new Uppercase, 'unique:products,code'],
            'product_name' => 'required',
            'product_description' => 'required|max:1000',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_unit' => [new Notselect],
            'product_brand' => [new Notselect],
            'product_category' => [new Notselect],
        ]);

        $product = new Product();

        $product->code = $request->input('product_code');
        $product->name = $request->input('product_name');
        $product->description = preg_replace('/\s+/', ' ', $request->input('product_description'));
        $product->price = $request->input('product_price');
        $product->discount = $request->input('product_discount');
        $product->brand_id = $request->input('product_brand');
        $product->category_id = $request->input('product_category');
        $product->image = $request->input('image_name');
        $product->unit_id = $request->input('product_unit');
        $is_saved = $product->save();

        if ($is_saved) {
            return redirect()->back()->with('store-success', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function update_Product(Request $request, $product_id)
    {
        $validatedProduct = $request->validate([
            'product_code' => ['required', new Uppercase],
            'product_name' => 'required',
            'product_description' => 'required|max:1000',
            'product_price' => 'required',
            'product_discount' => 'required',
            'product_unit' => [new Notselect],
            'product_brand' => [new Notselect],
            'product_category' => [new Notselect],
        ]);

        $product = Product::findOrFail($product_id);
        $product->code = $request->input('product_code');
        $product->name = $request->input('product_name');
        $product->description = $request->input('product_description');
        $product->price = $request->input('product_price');
        $product->discount = $request->input('product_discount');
        $product->brand_id = $request->input('product_brand');
        $product->category_id = $request->input('product_category');
        $product->image = $request->input('image_name');
        $product->unit_id = $request->input('product_unit');
        $is_saved = $product->save();

        if ($is_saved) {
            return redirect()->back()->with('store-success', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function delete_product($product_id)
    {
        $product = Product::findOrFail($product_id);
        $is_deleted = $product->delete();

        if ($is_deleted) {
            return redirect()->back()->with('delete-success', 'success');
        } else {
            return redirect()->back();
        }
    }

    public function inventory(Request $request)
    {
        $storage_locations = Store::where('name', '!=', 'Office')
            ->get();

        $inventories = Inventory::select('inventories.*')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('stores', 'inventories.store_id', '=', 'stores.id')
            ->where('stores.name', '!=', Auth::user()->store->name)
            ->orderBy('products.code')
            ->paginate(10);

        $data = [
            'inventories' => $inventories,
            'storage_locations' => $storage_locations
        ];
        return view('office.inventory', compact('data'));
    }

    public function fetch_inventory_data(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $location = $request->get('location');
            if ($location === 'All') {
                $inventories = Inventory::select('inventories.*')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->join('stores', 'inventories.store_id', '=', 'stores.id')
                    ->where([['products.code', 'like', '%' . $query . '%'], ['stores.name', '!=', Auth::user()->store->name]])
                    ->orWhere([['products.name', 'like', '%' . $query . '%'], ['stores.name', '!=', Auth::user()->store->name]])
                    ->orderBy('products.code')
                    ->paginate(10);
            } else {
                $inventories = Inventory::select('inventories.*')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->join('stores', 'inventories.store_id', '=', 'stores.id')
                    ->where([['products.code', 'like', '%' . $query . '%'], ['inventories.store_id', '=', $location], ['stores.name', '!=', Auth::user()->store->name]])
                    ->orWhere([['products.name', 'like', '%' . $query . '%'], ['inventories.store_id', '=', $location], ['stores.name', '!=', Auth::user()->store->name]])
                    ->orderBy('products.code')
                    ->paginate(10);
            }

            $data = [
                'inventories' => $inventories
            ];
            return view('office.inventory-data', compact('data'))->render();
        }
    }

    public function upload_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customFile' => 'required|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json(['image' => '', 'imagePath' => '', 'errors' => $validator->errors()]);
        } else {
            $image = $request->file('customFile');
            $newImage = uniqid('acc-') . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/uploads/products';
            $cropted = Image::make($image)->fit(800, 800);
            $cropted->save($imagePath . '/' . $newImage);
            // $image->move(public_path($imagePath), $newImage);
            return response()->json(['image' => $newImage, 'imagePath' => $imagePath, 'errors' => '']);
        }
    }

    public function profile()
    {
        return view('office.profile');
    }

    public function profile_photo()
    {
        return view('office.profile-photo');
    }

    public function upload_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customFile' => 'required|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json(['image' => '', 'imagePath' => '', 'errors' => $validator->errors()]);
        } else {
            $image = $request->file('customFile');
            $newImage = uniqid('profile-') . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/uploads/profiles';
            $cropted = Image::make($image)->fit(800, 800);
            $cropted->save($imagePath . '/' . $newImage);
            // $image->move(public_path($imagePath), $newImage);
            return response()->json(['image' => $newImage, 'imagePath' => $imagePath, 'errors' => '']);
        }
    }

    public function save_image(Request $request)
    {
        $validatedImage = $request->validate([
            'image_name' => [new ImageRequired]
        ]);

        $user = User::find(Auth::user()->id);
        $user->image = $request->image_name;
        $user->save();

        return redirect()->back()->with('store-success', 'success');
    }

    public function user_info()
    {
        return view('office.user-info');
    }


    public function save_username(Request $request)
    {
        $request->validate(
            [
                'user_name' => 'required|exists:users,username',
                'new_user_name' => 'required|unique:users,username'
            ],
            [
                'user_name.exists' => 'Your user name is incorrect',
                'new_user_name.unique' => 'User name is already taken'
            ]
        );

        $user = User::find(Auth::user()->id);
        $user->username = $request->new_user_name;
        $user->save();

        return redirect()->back()->with('store-success-username', 'success');
    }

    public function save_password(Request $request)
    {
        $validate_password = $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]
        );

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('store-success-password', 'success');
        } else {
            return redirect()->back()->with('store-error-username', 'success');
        }
    }

    public function users(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->search_item === '') {
                $users = User::all();
            } else {
                $users = User::where('first_name', 'like', '%' . $request->search_item . '%')
                    ->get();
            }
        } else {
            $users = User::all();
        }

        $data = [
            'users' => $users
        ];
        return view('office.users', compact('data'));
    }

    public function submit_activateDeactivate(Request $request)
    {
        if ($request->ajax()) {
            $user_id = $request->get('id');
            $is_active = 0;
            $message = 'Active';
            $user = User::find(intval($user_id));
            if ($user->is_active == 0) {
                $is_active = 1;
                $message = 'Inactive';
            }
            $user->is_active = $is_active;
            $user->save();

            return response()->json(['success' => true, 'message' =>  $message]);
        }
    }

    public function edit_user($user_id)
    {
        $user = User::where('id', '=', intval($user_id))
            ->first();
        $stores = Store::all();
        $positions = Position::all();
        $roles = Role::all();
        $accesses = Access::all();

        $data = [
            'user' => $user,
            'stores' => $stores,
            'positions' => $positions,
            'roles' => $roles,
            'accesses' => $accesses
        ];
        return view('office/edit-user', compact('data'));
    }

    public function update_user(Request $request)
    {
        $validate_user = $request->validate(
            [
                'user_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'middle_name' => 'required',
                'user_position' => [new NotSelect],
                'work_location' => [new NotSelect],
                'user_role' => [new NotSelect],
                'user_access' => [new NotSelect]
            ]
        );
        $user = User::find(intval($request->user_id));
        $user->position_id = $request->user_position;
        $user->store_id = $request->work_location;
        $user->role_id = $request->user_role;
        $user->access_id = $request->user_access;
        $user->first_name =  $request->first_name;
        $user->last_name =  $request->last_name;
        $user->middle_name =  $request->middle_name;
        $user->save();
        return redirect()->back()->with('update-user', 'success');
    }

    public function new_user()
    {
        $stores = Store::all();
        $positions = Position::all();
        $roles = Role::all();
        $accesses = Access::all();

        $data = [
            'stores' => $stores,
            'positions' => $positions,
            'roles' => $roles,
            'accesses' => $accesses
        ];
        return view('office.new-user', compact('data'));
    }

    public function save_user(Request $request)
    {
        $validate_user = $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'middle_name' => 'required',
                'user_position' => [new NotSelect],
                'work_location' => [new NotSelect],
                'user_role' => [new NotSelect],
                'user_access' => [new NotSelect]
            ]
        );
        $user = new User();
        $user->position_id = $request->user_position;
        $user->store_id = $request->work_location;
        $user->role_id = $request->user_role;
        $user->access_id = $request->user_access;
        $user->first_name =  $request->first_name;
        $user->last_name =  $request->last_name;
        $user->middle_name =  $request->middle_name;
        $user->username = strtolower($request->first_name);
        $user_trim_to_lower = strtolower(trim($request->last_name));
        $user->password = Hash::make($user_trim_to_lower);
        $user->is_active = 0;
        $user->image = 'default-profile-pic.jpg';
        $user->save();
        return redirect()->back()->with('create-user', 'success');
    }

    public function recovery($user_id)
    {
        $user = User::where('id', '=', intval($user_id))
            ->first();
        $data = [
            'user' => $user
        ];
        return view('office.recovery', compact('data'));
    }

    public function recover_user(Request $request)
    {
        $user = User::find(intval($request->user_id));
        $user->username = strtolower($request->first_name);
        $user_trim_to_lower = strtolower(trim($request->last_name));
        $user->password = Hash::make($user_trim_to_lower);
        $user->save();
        return redirect()->back()->with('recover-user', 'success');
    }

    public function locations()
    {
        $stores = Store::paginate(10);
        $accesses = Access::all();
        $data = [
            'stores' => $stores,
            'accesses' => $accesses
        ];
        return view('office.location', compact('data'));
    }

    public function fetch_store_data(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->get('type');
            // $query = str_replace(" ", "%", $type);
            // $location = $request->get('location');
            if ($type === 'All') {
                $stores = Store::paginate(10);
            } else {
                $inventories = $stores = Store::where('access_id', '=', $type)
                    ->paginate(10);
            }

            $data = [
                'stores' => $stores
            ];
            return view('office.store-data', compact('data'))->render();
        }
    }

    public function edit_store($store_id)
    {
        $store = Store::where('id', '=', intval($store_id))
            ->first();
        $accesses = Access::all();
        $location_names = Location_name::all();
        $data = [
            'store' => $store,
            'accesses' => $accesses,
            'location_names' => $location_names
        ];
        return view('office.edit-store', compact('data'));
    }

    public function update_locations(Request $request)
    {
        $validate_location = $request->validate(
            [
                'store_id' => 'required',
                'location_name' => [new NotSelect],
                'street_name' => 'required',
                'city_name' => 'required',
                'province_name' => 'required',
                'access_name' => [new NotSelect]
            ]
        );

        $store = Store::find(intval($request->store_id));
        $store->name = $request->location_name;
        $store->street = $request->street_name;
        $store->city = $request->city_name;
        $store->province = $request->province_name;
        $store->access_id = $request->access_name;
        $store->save();
        return redirect()->back()->with('update-store', 'success');
    }

    public function new_location()
    {
        $accesses = Access::all();
        $location_names = Location_name::all();
        $data = [
            'accesses' => $accesses,
            'location_names' => $location_names
        ];
        return view('office.new-location', compact('data'));
    }

    public function save_location(Request $request)
    {
        $validate_location = $request->validate(
            [
                'location_name' => [new NotSelect],
                'street_name' => 'required',
                'city_name' => 'required',
                'province_name' => 'required',
                'access_name' => [new NotSelect]
            ]
        );

        $store = new Store();
        $store->name = $request->location_name;
        $store->street = $request->street_name;
        $store->city = $request->city_name;
        $store->province = $request->province_name;
        $store->access_id = $request->access_name;
        $store->save();
        return redirect()->back()->with('new-store', 'success');
    }

    public function brands(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->search_item === '') {
                $brands = Brand::all();
            } else {
                $brands = Brand::where('name', 'like', '%' . $request->search_item . '%')
                    ->get();
            }
        } else {
            $brands = Brand::all();
        }

        $data = [
            'brands' => $brands
        ];
        return view('office.brands', compact('data'));
    }

    public function edit_brand($brand_id)
    {
        $brand = Brand::where('id', '=', intval($brand_id))
            ->first();
        $suppliers = Supplier::all();
        $colors = Color::all();
        $data = [
            'brand' => $brand,
            'suppliers' => $suppliers,
            'colors' => $colors
        ];
        return view('office.edit-brand', compact('data'));
    }

    public function update_brands(Request $request)
    {
        $validate_brand = $request->validate(
            [
                'brand_id' => 'required',
                'brand_name' => 'required',
                'supplier_name' => [new NotSelect],
                'color_name' => [new NotSelect],
                'text_color' => [new NotSelect]

            ]
        );

        $brand = Brand::find(intval($request->brand_id));
        $brand->name = $request->brand_name;
        $brand->supplier_id = $request->supplier_name;
        $brand->save();

        $brand_color = Brand_color::where('brand_id', '=', intval($request->brand_id))
            ->first();
        $brand_color->brand_color = $request->color_name;
        $brand_color->text_color = $request->text_color;
        $brand_color->save();


        return redirect()->back()->with('update-brand', 'success');
    }

    public function new_brand()
    {
        $suppliers = Supplier::all();
        $colors = Color::all();
        $data = [
            'suppliers' => $suppliers,
            'colors' => $colors
        ];
        return view('office.new-brand', compact('data'));
    }

    public function save_brand(Request $request)
    {
        $validate_brand = $request->validate(
            [
                'brand_name' => 'required',
                'supplier_name' => [new NotSelect],
                'color_name' => [new NotSelect],
                'text_color' => [new NotSelect]
            ]
        );

        $brand = new Brand();
        $brand->name = $request->brand_name;
        $brand->supplier_id = $request->supplier_name;
        $brand->save();

        $brand_color = new Brand_color();
        $brand_color->brand_id = $brand->id;
        $brand_color->brand_color = $request->color_name;
        $brand_color->text_color = $request->text_color;
        $brand_color->save();

        return redirect()->back()->with('save-brand', 'success');
    }

    public function suppliers(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->search_item === '') {
                $suppliers = Supplier::All();
            } else {
                $suppliers = Supplier::where('name', 'like', '%' . $request->search_item . '%')
                    ->get();
            }
        } else {
            $suppliers = Supplier::All();
        }
        $data = [
            'suppliers' => $suppliers
        ];
        return view('office.suppliers', compact('data'));
    }

    public function edit_supplier($supplier_id)
    {
        $supplier = Supplier::where('id', '=', intval($supplier_id))
            ->first();
        $data = [
            'supplier' => $supplier
        ];
        return view('office.edit-supplier', compact('data'));
    }

    public function update_supplier(Request $request)
    {
        $validate_supplier = $request->validate(
            [
                'supplier_id' => 'required',
                'supplier_name' => 'required',
                'supplier_address' => 'required'
            ]
        );

        $supplier = Supplier::find(intval($request->supplier_id));
        $supplier->name = $request->supplier_name;
        $supplier->address = $request->supplier_address;
        $supplier->save();

        return redirect()->back()->with('update-supplier', 'success');
    }

    public function new_supplier()
    {
        $data = [];
        return view('office.new-supplier', compact('data'));
    }

    public function save_supplier(Request $request)
    {
        $validate_supplier = $request->validate(
            [
                'supplier_name' => 'required',
                'supplier_address' => 'required'
            ]
        );

        $supplier = new Supplier();
        $supplier->name = $request->supplier_name;
        $supplier->address = $request->supplier_address;
        $supplier->save();

        return redirect()->back()->with('new-supplier', 'success');
    }

    public function repairs()
    {
        $repairs = Repair::orderBy('id', 'desc')->paginate(10);
        $data = [
            'repairs' => $repairs
        ];
        return view('office.repairs', compact('data'));
    }

    public function submit_status(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $repair_id = intval($request->get('id'));

            $repair = Repair::find($repair_id);
            $repair->status =  $status;
            $repair->save();

            return response()->json(['update_status' => true]);
        }
    }

    public function fetch_data_for_repair(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $status = $request->get('status');
            $filter = $request->get('filter');
            if ($filter === 'Name') {
                if ($status === 'All') {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['products.code', 'like', '%' . $query . '%']])
                        ->orWhere([['products.name', 'like', '%' . $query . '%']])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                } else {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['products.code', 'like', '%' . $query . '%'], ['repairs.status', '=', $status]])
                        ->orWhere([['products.name', 'like', '%' . $query . '%'], ['repairs.status', '=', $status]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                }
            } else {
                if ($status === 'All') {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['repairs.serial', '=', $query]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                } else {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['repairs.serial', '=', $query], ['repairs.status', '=', $status]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                }
            }

            $data = [
                'repairs' => $repairs
            ];
            return view('office.repair-data', compact('data'))->render();
        }
    }

    public function transaction()
    {
        $transactions = Transaction::orderBY('id', 'desc')->orderBy('transaction_date', 'desc')->paginate(10);
        $stores = Store::all();
        $transaction_types = Transaction_type::all();
        $data = [
            'transactions' => $transactions,
            'stores' => $stores,
            'transaction_types' => $transaction_types
        ];
        return view('office.transactions', compact('data'));
    }

    public function fetch_data_for_transaction(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $location = $request->get('location');
            $type = $request->get('type');
            $query_dates = explode('/', $query);
            if ($type === 'All') {
                if ($location === 'All') {
                    if (empty($query_dates[0]) && empty($query_dates[1])) {
                        $transactions = Transaction::orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    } else {
                        $transactions = Transaction::whereBetween('transaction_date', [$query_dates[0], $query_dates[1]])
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    }
                } else {
                    if (empty($query_dates[0]) && empty($query_dates[1])) {
                        $transactions = Transaction::where('store_id', '=', $location)
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    } else {
                        $transactions = Transaction::whereBetween('transaction_date', [$query_dates[0], $query_dates[1]])
                            ->where('store_id', '=', $location)
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    }
                }
            } else {
                if ($location === 'All') {
                    if (empty($query_dates[0]) && empty($query_dates[1])) {
                        $transactions = Transaction::where('transaction_type_id', '=', $type)
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    } else {
                        $transactions = Transaction::whereBetween('transaction_date', [$query_dates[0], $query_dates[1]])
                            ->where('transaction_type_id', '=', $type)
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    }
                } else {
                    if (empty($query_dates[0]) && empty($query_dates[1])) {
                        $transactions = Transaction::where('store_id', '=', $location)
                            ->where('transaction_type_id', '=', $type)
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    } else {
                        $transactions = Transaction::whereBetween('transaction_date', [$query_dates[0], $query_dates[1]])
                            ->where('transaction_type_id', '=', $type)
                            ->where('store_id', '=', $location)
                            ->orderBy('transaction_date', 'desc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
                    }
                }
            }

            $data = [
                'transactions' => $transactions
            ];
            return view('office.transactions-data', compact('data'))->render();
        }
    }

    public function transacted_items($transaction_id)
    {
        $transacted_items = Transacted_item::where('transaction_id', '=', intval($transaction_id))
            ->get();
        $transaction = Transaction::where('id', '=', intval($transaction_id))->first();
        $data = [
            'transacted_items' => $transacted_items,
            'transaction' => $transaction
        ];
        return view('office.transacted-items', compact('data'));
    }

    public function generate_transaction_pdf($transaction_id)
    {
        $transaction = Transaction::where('id', '=', $transaction_id)
            ->first();

        $transacted_items = Transacted_item::where('transaction_id', '=', $transaction_id)
            ->get();

        $return_output = '<div class="" style="width:100%; text-align:center; font-family: Arial, Helvetica, sans-serif;">';
        $return_output .= '<h2 style="padding:0px; margin:0px">' . $transaction->store->name . ' Trading</h2>';
        $return_output .= '<h5 style="margin-top:2px">' . $transaction->store->street . ' ' . $transaction->store->city . ', ' . $transaction->store->province . '</h5>';
        $return_output .= '</div>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">From: ' . $transaction->from . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Date: ' . $transaction->transaction_date . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">To: ' . $transaction->to . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Receipt: ' . $transaction->transaction_receipt . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">Transacted by: ' . $transaction->user->first_name . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Transaction type: ' . $transaction->transaction_type->type_name . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';

        $return_output .= '<div class="table-responsive">';
        $return_output .= '<table class="table" id="inventory_tables" style="width: 100%; border: solid 1px #DDEEEE; border-collapse: collapse; border-spacing: 0; font: normal 13px Arial, sans-serif;">';
        $return_output .= '<thead style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">';
        $return_output .= '<tr style="">';

        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Qty</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Unit</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:40%;">Product Name</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:10%;">Serial</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Unit Price</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Total Price</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Note</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">';

        $total_transaction_price = 0.00;

        foreach ($transacted_items as $transacted_item) {
            $return_output .= '<tr>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->quantity . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . ($transacted_item->quantity < 2 ? $transacted_item->inventory->product->unit->name : $transacted_item->inventory->product->unit->name . 's') . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->inventory->product->name . ' (' . $transacted_item->inventory->product->code . ')</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->serial . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->inventory->product->price . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . number_format($transacted_item->total_price, 2, '.', '') . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->note . '</td>';
            $return_output .= '</tr>';

            $total_price = $transacted_item->total_price;
            $total_transaction_price = $total_transaction_price + $total_price;
        }
        $return_output .= '<tr>';
        $return_output .= '<td colspan="5" style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;">Total</td>';
        $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; font-weight: bold;">' . number_format($total_transaction_price, 2, '.', '') . '</td>';
        $return_output .= '<td></td>';
        $return_output .= '</tr>';
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($return_output);
        return $pdf->stream();
    }

    public function stock_receive()
    {
        $transfer_transactions = Transaction::select('transactions.*')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.type_name', '=', 'Transfer') //or delivery
            ->where('transactions.status', '=', 'Pending')
            ->where('transactions.to', '=', Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city)
            ->paginate(10);

        $data = [
            'transfer_transactions' => $transfer_transactions,
        ];
        return view('office.stock-receive', compact('data'));
    }

    public function fetch_data_for_receive(Request $request)
    {
        if ($request->ajax()) {
            $transaction_id = $request->get('id');

            $pending_transfer_lists = Transacted_item::select('transacted_items.*')
                ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
                ->join('inventories', 'transacted_items.inventory_id', 'inventories.id')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->where('transacted_items.transaction_id', '=', intval($transaction_id))
                ->get();

            $return_output = '<div class="table-responsive">';
            $return_output .= '<table class="table" id="inventory_tables">';
            $return_output .= '<thead>';
            $return_output .= '<tr>';
            $return_output .= '<th class="border-top-0">Product Name</th>';
            $return_output .= '<th class="border-top-0">Qty</th>';
            $return_output .= '</tr>';
            $return_output .= '</thead>';
            $return_output .= '<tbody>';

            foreach ($pending_transfer_lists as $pending_transfer_list) {
                $return_output .= '<tr class="border-top-0">';
                $return_output .= '<td class="border-top-0">' . $pending_transfer_list->inventory->product->code . ' ' . $pending_transfer_list->inventory->product->name . '</td>';
                $return_output .= '<td class="border-top-0">' . $pending_transfer_list->quantity . '</td>';
                $return_output .= '</tr>';
            }
            $return_output .= '</tbody>';
            $return_output .= '</table>';
            $return_output .= '</div>';

            return response()->json(['pending_transfer' => $return_output]);
        }
    }

    public function receive_stocks($transaction_id)
    {
        $transacted_items = Transacted_item::select('transacted_items.*')
            ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->where('transacted_items.transaction_id', '=', $transaction_id)
            ->get();
        $transaction_from = Transaction::where('id', '=', $transaction_id)->first();
        $data = [
            'transacted_items' => $transacted_items,
            'transaction_from' => $transaction_from
        ];
        return view('office.to-receive-list', compact('data'));
    }

    public function recieved_items(Request $request)
    {
        for ($i = 0; $i < count($request->table_sale_list['transacted_item_id']); $i++) {
            $transacted_item_id = trim($request->table_sale_list['transacted_item_id'][$i]);
            $inventory_id = trim($request->table_sale_list['inventory_id'][$i]);
            $transaction_id = $request->table_sale_list['transaction_id'][$i];
            $note = $request->table_sale_list['note'][$i];
            $product_qty =  trim($request->table_sale_list['product_qty'][$i]);

            $original_transacted_item_qty_str = explode("-", $note);
            $original_transacted_item_qty = intval($original_transacted_item_qty_str[0]);

            //if destination store change quantity
            if ($original_transacted_item_qty != intval($product_qty)) {
                $updated_transacted_items = Transacted_item::find(intval($transacted_item_id));
                $current_product_price = $updated_transacted_items->total_price / $original_transacted_item_qty;
                $updated_transacted_items->quantity = intval($product_qty);
                $updated_transacted_items->total_price = $current_product_price * intval($product_qty);
                $updated_transacted_items->note = $product_qty . '-pcs has been transfered';
                $updated_transacted_items->save();
            } else {
                $updated_transacted_items = Transacted_item::find(intval($transacted_item_id));
                // $updated_transacted_items->quantity = intval($product_qty);
                $updated_transacted_items->note = $product_qty . '-pcs has been transfered';
                $updated_transacted_items->save();
            }

            //Update origin inventory
            //With errors
            $from_inventory = Inventory::find(intval($inventory_id));
            $current_inventory_qty = $from_inventory->quantity;
            $from_inventory->quantity = $current_inventory_qty - intval($product_qty);
            $from_inventory->save();
        }

        $create_transaction_receipt = Transacted_item::where('id', '=', $request->table_sale_list['transacted_item_id'][0])
            ->first();
        $assign_receipt = Transaction::find($create_transaction_receipt->transaction_id);
        $assign_receipt->transaction_receipt = strval($create_transaction_receipt->transaction_id);
        $assign_receipt->status = 'Transfered';
        $assign_receipt->save();

        $destination_transaction = new Transaction();
        $transaction_type = Transaction_type::where('type_name', '=', 'Transfer')->first();
        $transaction_comment_id = Transaction_comment::where('name', '=', 'Stock in')->first();
        $destination_transaction->transaction_type_id = $transaction_type->id;
        $destination_transaction->transaction_date = date("Y-m-d");
        $destination_transaction->transaction_comment_id = $transaction_comment_id->id;
        $destination_transaction->transaction_receipt = strval($create_transaction_receipt->transaction_id);
        $destination_transaction->status = 'Received';
        $destination_transaction->user_id = Auth::user()->id;
        $destination_transaction->from = $assign_receipt->from;
        $destination_transaction->to = $assign_receipt->to;
        $destination_transaction->store_id = Auth::user()->store_id;
        $destination_transaction->save();

        $current_transaction_id = $destination_transaction->id;

        for ($i = 0; $i < count($request->table_sale_list['transacted_item_id']); $i++) {
            $transacted_item_id = trim($request->table_sale_list['transacted_item_id'][$i]);
            $inventory_id = trim($request->table_sale_list['inventory_id'][$i]);
            $transaction_id = $request->table_sale_list['transaction_id'][$i];
            $note = $request->table_sale_list['note'][$i];
            $product_qty =  trim($request->table_sale_list['product_qty'][$i]);

            //check if there are same product on destination store
            $from_inventory = Inventory::find(intval($inventory_id));
            $count_product_availability = Inventory::where('product_id', '=', $from_inventory->product_id)
                ->where('store_id', '=', Auth::user()->store_id)
                ->get();

            if ($count_product_availability->count() < 1) {
                $inventory = new Inventory();
                $inventory->product_id = $from_inventory->product_id;
                $inventory->quantity = intval($product_qty);
                $inventory->store_id = Auth::user()->store_id;
                $inventory->save();

                $new_inventory_id = $inventory->id;

                $destination_transacted_item = new Transacted_item();
                $get_product_price = Product::where('id', '=', $from_inventory->product_id)->first();
                $destination_transacted_item->inventory_id = $new_inventory_id;
                $destination_transacted_item->transaction_id = $current_transaction_id;
                $destination_transacted_item->quantity = intval($product_qty);
                $destination_transacted_item->total_price = $get_product_price->price * intval($product_qty);
                $destination_transacted_item->note = $product_qty . '-pcs has been recieved';
                $destination_transacted_item->save();
            } else {
                $get_product = Inventory::where('product_id', '=', $from_inventory->product_id)
                    ->where('store_id', '=', Auth::user()->store_id)
                    ->first();
                //with errors
                $inventory = Inventory::find($get_product->id);
                $current_inventory_qty = $inventory->quantity;
                $inventory->quantity = $current_inventory_qty + intval($product_qty);
                $inventory->save();

                $destination_transacted_item = new Transacted_item();
                $get_product_price = Product::where('id', '=', $from_inventory->product_id)->first();
                $destination_transacted_item->inventory_id = $get_product->id;
                $destination_transacted_item->transaction_id = $current_transaction_id;
                $destination_transacted_item->quantity = intval($product_qty);
                $destination_transacted_item->total_price = $get_product_price->price * intval($product_qty);
                $destination_transacted_item->note = $product_qty . '-pcs has been recieved';
                $destination_transacted_item->save();
            }
        }

        $notification = Notification::where('transaction_id', '=', $create_transaction_receipt->transaction_id)
            ->update(array('is_read' => 0));


        return response()->json(['success' => true]);
    }

    public function factory_defect()
    {
        $return_to_suppliers = Return_to_supplier::orderBy('id', 'desc')
            ->paginate(10);

        $data = [
            'return_to_suppliers' => $return_to_suppliers,
        ];
        return view('office.factory-defect', compact('data'));
    }

    public function create_factory_defect()
    {
        $inventories = Inventory::where('store_id', '=', Auth::user()->store_id)
            ->where('quantity', '>', 0)
            ->paginate(10);
        $suppliers = Supplier::all();
        $data = [
            'inventories' => $inventories,
            'suppliers' => $suppliers
        ];
        return view('office.create-factory-defect', compact('data'));
    }

    public function fetch_data_for_defect_return(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $inventories = Inventory::where('store_id', '=', Auth::user()->store_id)
                ->where('quantity', '>', 0)
                ->paginate(10);

            // $repairs = Repair::select('repairs.*')
            //     ->join('products', 'repairs.product_id', '=', 'products.id')
            //     ->join('customers', 'repairs.customer_id', '=', 'customers.id')
            //     ->where([['products.code', 'like', '%' . $query . '%']])
            //     ->orWhere([['products.name', 'like', '%' . $query . '%']])
            //     ->orderBy('repairs.id', 'desc')
            //     ->paginate(10);

            $data = [
                'inventories' => $inventories
            ];
            return view('office.factory-defect-data', compact('data'))->render();
        }
    }

    public function save_return(Request $request)
    {
        $return_to_suppliers = new Return_to_supplier();
        $return_to_suppliers->return_date = date("Y-m-d");
        $return_to_suppliers->supplier_id = $request->transfer_location;
        $return_to_suppliers->status = 'Pending';
        $return_to_suppliers->save();

        $return_to_suppliers_id =  $return_to_suppliers->id;

        // $transaction_type_id = Transaction_type::where('type_name', '=', 'Transfer')->first();
        // $transaction_comment_id = Transaction_comment::where('name', '=', 'Stock out')->first();

        for ($i = 0; $i < count($request->table_sale_list['inventory_id']); $i++) {
            $inventory_id = $request->table_sale_list['inventory_id'][$i];
            $product_qty =  $request->table_sale_list['product_qty'][$i];
            $product_price = $request->table_sale_list['product_price'][$i];
            $product_tot_price = $request->table_sale_list['product_tot_price'][$i];

            $get_product = Inventory::where('id', '=', intval($inventory_id))
                ->first();

            $return_to_supplier_item = new Return_to_supplier_item();
            $return_to_supplier_item->return_to_supplier_id =  $return_to_suppliers_id;
            $return_to_supplier_item->product_id = $get_product->product_id;
            $return_to_supplier_item->quantity = $product_qty;
            $return_to_supplier_item->total_price = $product_tot_price;
            $return_to_supplier_item->save();

            $inventory = Inventory::find(intval($inventory_id));
            $new_qty = $inventory->quantity - $product_qty;
            $inventory->quantity = $new_qty;
            $inventory->save();
        }

        return response()->json(['success' => true]);
    }

    public function return_to_supplier_pdf($return_to_supplier_id)
    {
        $return_to_supplier = Return_to_supplier::where('id', '=', intval($return_to_supplier_id))
            ->first();

        $return_to_supplier_items = Return_to_supplier_item::where('return_to_supplier_id', '=', intval($return_to_supplier_id))
            ->get();

        $office_aadress = Store::where('name', '=', 'Office')->first();

        $return_output = '<div class="" style="width:100%; text-align:center; font-family: Arial, Helvetica, sans-serif;">';
        $return_output .= '<h2 style="padding:0px; margin:0px">Prime Ledtric Trading</h2>';
        $return_output .= '<h5 style="margin-top:2px">' . $office_aadress->street . ' ' . $office_aadress->city . ', ' . $office_aadress->province . '</h5>';
        $return_output .= '</div>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">Return to: ' . $return_to_supplier->supplier->name . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Id: ' . $return_to_supplier->id . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">Prepared by: ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Date: ' . $return_to_supplier->return_date . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';

        $return_output .= '<div class="table-responsive">';
        $return_output .= '<table class="table" id="inventory_tables" style="width: 100%; border: solid 1px #DDEEEE; border-collapse: collapse; border-spacing: 0; font: normal 13px Arial, sans-serif;">';
        $return_output .= '<thead style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">';
        $return_output .= '<tr style="">';

        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Qty</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Unit</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:40%;">Product Name</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:10%;">Serial</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Unit Price</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Total Price</th>';

        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">';

        $total_transaction_price = 0.00;

        foreach ($return_to_supplier_items as $return_to_supplier_item) {
            $return_output .= '<tr>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $return_to_supplier_item->quantity . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . ($return_to_supplier_item->quantity < 2 ? $return_to_supplier_item->product->unit->name : $return_to_supplier_item->product->unit->name . 's') . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $return_to_supplier_item->product->name . ' (' . $return_to_supplier_item->product->code . ')</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $return_to_supplier_item->serial . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $return_to_supplier_item->product->price . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . number_format($return_to_supplier_item->total_price, 2, '.', '') . '</td>';

            $return_output .= '</tr>';

            $total_price = $return_to_supplier_item->total_price;
            $total_transaction_price = $total_transaction_price + $total_price;
        }
        $return_output .= '<tr>';
        $return_output .= '<td colspan="5" style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;">Total</td>';
        $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; font-weight: bold;">' . number_format($total_transaction_price, 2, '.', '') . '</td>';

        $return_output .= '</tr>';
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($return_output);
        return $pdf->stream();
    }

    public function update_return_to_supplier(Request $request)
    {
        if ($request->ajax()) {
            $return_id = $request->get('return_id');

            $return_to_supplier = Return_to_supplier::find(intval($return_id));
            $return_to_supplier->return_date = date("Y-m-d");
            $return_to_supplier->status = 'Ready';
            $return_to_supplier->save();

            return response()->json(['success' => true]);
        }
    }

    public function others()
    {
        $positions = Position::orderBy('id', 'desc')->paginate(5);
        $units = Unit::orderBy('id', 'desc')->paginate(5);
        $receipts = Receipt::orderBy('id', 'desc')->paginate(5);
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        $location_names = Location_name::orderBy('id', 'desc')->paginate(5);
        $data = [
            'positions' => $positions,
            'units' => $units,
            'receipts' => $receipts,
            'categories' => $categories,
            'location_names' => $location_names
        ];
        return view('office.others', compact('data'));
    }

    public function save_position(Request $request)
    {
        $validate_position = $request->validate(
            [
                'position_name' => 'required'
            ]
        );

        $position = new Position();
        $position->name = $request->position_name;
        $position->save();

        return redirect()->back()->with('save-position', 'success');
    }

    public function save_unit(Request $request)
    {
        $validate_unit = $request->validate(
            [
                'unit_name' => 'required'
            ]
        );

        $unit = new Unit();
        $unit->name = $request->unit_name;
        $unit->save();

        return redirect()->back()->with('save-unit', 'success');
    }

    public function save_receipt(Request $request)
    {
        $validate_receipt = $request->validate(
            [
                'receipt_type' => 'required',
                'abbreviation_name' => 'required'
            ]
        );

        $receipt = new Receipt();
        $receipt->type = $request->receipt_type;
        $receipt->abbreviation = $request->abbreviation_name;
        $receipt->save();

        return redirect()->back()->with('save-receipt', 'success');
    }

    public function save_category(Request $request)
    {
        $validate_category = $request->validate(
            [
                'category_name' => 'required'
            ]
        );

        $category = new Category();
        $category->name = $request->category_name;
        $category->save();

        return redirect()->back()->with('save-category', 'success');
    }

    public function save_location_type(Request $request)
    {
        $validate_location = $request->validate(
            [
                'location_type' => 'required'
            ]
        );

        $location_name = new Location_name();
        $location_name->name = $request->location_type;
        $location_name->save();

        return redirect()->back()->with('save-location', 'success');
    }

    public function deliveries()
    {
        $transactions = Transaction::select('transactions.*')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.type_name', '=', 'Delivery')
            ->where('transactions.transaction_receipt', '!=', '')
            ->where('store_id', '=', Auth::user()->store_id)
            ->orderBy('transactions.id', 'desc')
            ->paginate(5);

        $stores = Store::where('name', '!=', 'Office')
            ->where('name', '!=', 'Warehouse')
            ->get();
        $data = [
            'transactions' => $transactions,
            'stores' => $stores
        ];
        return view('office.deliveries', compact('data'));
    }

    public function create_deliveries()
    {
        $inventories = Inventory::where('store_id', '=', Auth::user()->store->id)
            ->paginate(5);
        $brands = Brand::all();
        $stores = Store::where('name', '!=', 'Office')
            ->where('name', '!=', 'Warehouse')
            ->get();
        $data = [
            'inventories' => $inventories,
            'stores' => $stores,
            'brands' => $brands
        ];
        return view('office.create-deliveries', compact('data'));
    }

    public function delivery_request(Request $request)
    {
        $transaction_type_id = Transaction_type::where('type_name', '=', 'Delivery')->first(); //Deliver
        $transaction_comment_id = Transaction_comment::where('name', '=', 'Stock out')->first();

        $transaction = new Transaction();
        $transaction->transaction_type_id = $transaction_type_id->id;
        $transaction->transaction_date = date("Y-m-d");
        $transaction->transaction_comment_id = $transaction_comment_id->id;
        $transaction->transaction_receipt = $request->packing_list;
        $transaction->status = 'Pending';
        $transaction->user_id = Auth::user()->id;
        $transaction->from = Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
        $transaction->to = $request->transfer_location;
        $transaction->store_id = Auth::user()->store_id;
        $transaction->save();

        $transaction_id = $transaction->id;

        for ($i = 0; $i < count($request->table_sale_list['inventory_id']); $i++) {
            $inventory_id = $request->table_sale_list['inventory_id'][$i];
            $product_qty =  $request->table_sale_list['product_qty'][$i];
            $product_price = $request->table_sale_list['product_price'][$i];
            $product_tot_price = $request->table_sale_list['product_tot_price'][$i];

            $transacted_item = new Transacted_item();
            $transacted_item->inventory_id =  $inventory_id;
            $transacted_item->transaction_id = $transaction_id;
            $transacted_item->quantity = $product_qty;
            $transacted_item->total_price = $product_tot_price;
            $transacted_item->note = (string)$product_qty . '-pcs has been trying to trying to deliver';
            $transacted_item->save();
        }

        $store = Store::where(DB::raw("CONCAT(stores.name, ' - ', stores.street, ' ', stores.city)"), '=', $request->transfer_location)
            ->first();

        $notification = new Notification();
        $notification->message = 'New delivery from ' . Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
        $notification->link = 'recieve_delivery';
        $notification->transaction_id = $transaction_id;
        $notification->store_id = $store->id;
        $notification->is_read = 1;
        $notification->save();
        return response()->json(['success' => true]);
    }

    public function delivery_items($transaction_id)
    {
        $transacted_items = Transacted_item::where('transaction_id', '=', intval($transaction_id))
            ->get();
        $transaction = Transaction::where('id', '=', intval($transaction_id))->first();
        $data = [
            'transacted_items' => $transacted_items,
            'transaction' => $transaction
        ];
        return view('office.delivery-items', compact('data'));
    }

    public function delivery_product_data(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $brand = $request->get('brand');
            if ($brand === 'All') {
                $inventories = Inventory::select('inventories.*')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->where([['products.code', 'like', '%' . $query . '%'], ['inventories.store_id', '=', Auth::user()->store_id]])
                    ->orWhere([['products.name', 'like', '%' . $query . '%'], ['inventories.store_id', '=', Auth::user()->store_id]])
                    ->paginate(5);
            } else {
                $inventories = Inventory::select('inventories.*')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->where([['products.code', 'like', '%' . $query . '%'], ['products.brand_id', '=', $brand], ['inventories.store_id', '=', Auth::user()->store_id]])
                    ->orWhere([['products.name', 'like', '%' . $query . '%'], ['products.brand_id', '=', $brand], ['inventories.store_id', '=', Auth::user()->store_id]])
                    ->paginate(5);
            }

            $data = [
                'inventories' => $inventories
            ];
            return view('office.new_deliveries-data', compact('data'))->render();
        }
    }

    public function fetch_delivery_transactions(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $brand = $request->get('brand');
            if ($brand === 'All') {
                $transactions = Transaction::select('transactions.*')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->where([['transactions.transaction_receipt', 'like', '%' . $query . '%'], ['transactions.store_id', '=', Auth::user()->store_id], ['transaction_types.type_name', '=', 'Delivery'], ['transactions.transaction_receipt', '!=', '']])
                    ->orderBy('transactions.id', 'desc')
                    ->paginate(5);
            } else {
                $transactions = Transaction::select('transactions.*')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->where([['transactions.transaction_receipt', 'like', '%' . $query . '%'], ['transactions.store_id', '=', Auth::user()->store_id], ['transaction_types.type_name', '=', 'Delivery'], ['transactions.transaction_receipt', '!=', ''], ['transactions.to', '=', $brand]])
                    ->orderBy('transactions.id', 'desc')
                    ->paginate(5);
            }

            $data = [
                'transactions' => $transactions
            ];
            return view('office.deliveries-data', compact('data'))->render();
        }
    }

    public function generate_delivery_pdf($transaction_id)
    {
        $transaction = Transaction::where('id', '=', $transaction_id)
            ->first();

        $transacted_items = Transacted_item::where('transaction_id', '=', $transaction_id)
            ->get();

        $approver = User::select('users.*')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->where('positions.name', '=', 'President')
            ->first();

        $return_output = '<div class="" style="width:100%; text-align:center; font-family: Arial, Helvetica, sans-serif;">';
        $return_output .= '<h1 style="padding:0px; margin:0px">PRIME LEDTRIC TRADING</h1>';

        $return_output .= '<ul style="padding:0px; margin:0px; list-style:none; font-size: 20px; font-weight: bold;">';
        $return_output .= '<li style="padding:0px; margin:0px;">Address: 003 New Public Market Road, Brgy. Plaza Aldea Tanay, Rizal</li>';
        $return_output .= '<li style="padding:0px; margin:0px">Email: haxprime8@gmail.com</li>';
        $return_output .= '<li style="padding:0px; margin:0px">Tel No: (02) 655-51-81</li>';
        $return_output .= '<li style="padding:0px; margin:0px">Cellphone No.: 0917-301-0435</li>';
        $return_output .= '</ul';
        $return_output .= '</div>';




        $return_output .= '<table style="width:100%; font: Arial, sans-serif; margin-left:16px; margin-right:16px;margin-top:50px; font-size: 20px; font-weight: bold;">';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">From: ' . $transaction->from . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Date: ' . $transaction->transaction_date . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<table style="width:100%; font: Arial, sans-serif; margin-left:16px; margin-right:16px; font-size: 20px>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">To: ' . $transaction->to . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Packing List: ' . $transaction->transaction_receipt . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';


        $return_output .= '<div class="table-responsive" style="margin-left:16px; margin-right:16px; margin-top: 20px; font-size: 20px; font-weight: bold;">';
        $return_output .= '<table class="table" id="inventory_tables" style="width: 100%; border: solid 1px #DDEEEE; border-collapse: collapse; border-spacing: 0; font: Arial, sans-serif;">';
        $return_output .= '<thead style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: Black; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">';
        $return_output .= '<tr style="">';

        $return_output .= '<th class="border-top-0" style="background-color: #FFFFFF; border: solid 1px #FFFFFF; color: Black; padding: 10px; text-align: center; text-shadow: 1px 1px 1px #fff; width:6%;">Qty</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #FFFFFF; border: solid 1px #FFFFFF; color: Black; padding: 10px; text-align: center; text-shadow: 1px 1px 1px #fff; width:10%;">Unit</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #FFFFFF; border: solid 1px #FFFFFF; color: Black; padding: 10px; text-align: center; text-shadow: 1px 1px 1px #fff; width:60%;">Product Name</th>';

        $return_output .= '<th class="border-top-0" style="background-color: #FFFFFF; border: solid 1px #FFFFFF; color: Black; padding: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:12%;">Unit Price</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #FFFFFF; border: solid 1px #FFFFFF; color: Black; padding: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:12%">Total Price</th>';

        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">';

        $total_transaction_price = 0.00;

        foreach ($transacted_items as $transacted_item) {
            $return_output .= '<tr>';
            $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 3px 2px 3px 2px; text-shadow: 1px 1px 1px #fff; text-align: center;">' . $transacted_item->quantity . '</td>';
            $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 3px 2px 3px 2px;; text-shadow: 1px 1px 1px #fff; text-align: center;">' . ($transacted_item->quantity < 2 ? $transacted_item->inventory->product->unit->name : $transacted_item->inventory->product->unit->name . 's') . '</td>';
            $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 3px 2px 3px 2px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->inventory->product->name . ' (' . $transacted_item->inventory->product->code . ')</td>';

            $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 3px 2px 3px 5px; text-shadow: 1px 1px 1px #fff; text-align: right;">' . number_format($transacted_item->inventory->product->price, 2, '.', ',') . '</td>';
            $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 3px 2px 3px 5px; text-shadow: 1px 1px 1px #fff; text-align: right;">' . number_format($transacted_item->total_price, 2, '.', ',') . '</td>';

            $return_output .= '</tr>';

            $total_price = $transacted_item->total_price;
            $total_transaction_price = $total_transaction_price + $total_price;
        }
        $return_output .= '<tr>';
        $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 10px 2px 10px 2px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;"></td>';
        $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 10px 2px 10px 2px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;"></td>';
        $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 10px 2px 10px 2px; text-shadow: 1px 1px 1px #fff; text-align:center; padding-right:15px; font-weight: bold; font-style: italic">**Nothing follows**</td>';
        $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 10px 2px 10px 2px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;">Total</td>';
        $return_output .= '<td style="border: solid 1px #FFFFFF; color: Black; padding: 10px 2px 10px 5px; text-shadow: 1px 1px 1px #fff; font-weight: bold; text-align: right;">' . number_format($total_transaction_price, 2, '.', ',') . '</td>';

        $return_output .= '</tr>';
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        $return_output .= '<div  style="position: fixed; bottom: 20px; left: 0px; right: 0px; height: 100px; line-height: 35px;">';

        $return_output .= '<table style="width:100%; font: Arial, sans-serif; margin-left:20px; margin-right:20px; font-size: 20px>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:30%; text-align: center; color: Black;">' . $transaction->user->first_name . ' ' . $transaction->user->last_name . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: right; text-shadow: 1px 1px 1px #fff; width:5%; text-align: center; color: Black;"></th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:30%; text-align: center; color: Black;">' .  $approver->first_name . ' ' .  $approver->last_name . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: right; text-shadow: 1px 1px 1px #fff; width:5%; text-align: center; color: Black;"></th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%; color: color: Black;"></th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';

        $return_output .= '<table style="width:100%; font: Arial, sans-serif; margin-left:16px; margin-right:16px; font-size: 20px>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: left; text-shadow: 1px 1px 1px #fff; width:30%; text-align: center; border-top: solid 1px black; color: Black;">Prepared by:</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: right; text-shadow: 1px 1px 1px #fff; width:5%; text-align: center; color: Black;"></th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%; text-align: center; border-top: solid 1px black; color: Black;">Approved By:</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: right; text-shadow: 1px 1px 1px #fff; width:5%; text-align: center; color: Black;"></th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; padding-top: 0px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%; text-align: center; border-top: solid 1px black; color: Black;">Received By:</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';

        $return_output .= '</div>';

        $pdf = App::make('dompdf.wrapper');
        // $customPaper = array(0, 0, 360, 360);
        $pdf->setPaper(array(0, 0, 907.09, 1058.2677165), 'Portrait');
        $pdf->loadHTML($return_output);
        return $pdf->stream();
    }

    public function cancel_delivery_transaction($transaction_id)
    {
        $transaction = Transaction::where('id', '=', $transaction_id)
            ->first();

        $data = [
            'transaction' => $transaction
        ];
        return view('office.cancel-delivery-transaction', compact('data'));
    }

    public function cancel(Request $request)
    {
        $validatedProduct = $request->validate([
            'cancelation_reason' => 'required'
        ]);

        Transacted_item::where('transaction_id', '=', intval($request->transaction_id))->delete();
        $tansaction = Transaction::find(intval($request->transaction_id));
        $tansaction->status = 'Cancelled';
        $tansaction->save();

        $transaction_cacelation = new Transaction_cancelation();
        $transaction_cacelation->transaction_id = intval($request->transaction_id);
        $transaction_cacelation->reason = $request->cancelation_reason;
        $transaction_cacelation->cancelation_date = date("Y-m-d");
        $transaction_cacelation->user_id = Auth::user()->id;
        $transaction_cacelation->save();

        $notification = Notification::where('transaction_id', '=', intval($request->transaction_id))
            ->update(array('is_read' => 0));

        return redirect()->back()->with('store-success', 'success');
    }

    public function fetch_data_for_reason(Request $request)
    {
        if ($request->ajax()) {
            $transaction_id = $request->get('transaction_id');

            $transaction_cancelation = Transaction_cancelation::where('transaction_id', '=', $transaction_id)
                ->first();

            $cancelation_data = '<div class="row">';
            $cancelation_data .= '<div class="col-12">';
            $cancelation_data .= '<h5>Cancelation Date: ' . $transaction_cancelation->cancelation_date . '</h5>';
            $cancelation_data .= '</div>';
            $cancelation_data .= '</div>';
            $cancelation_data .= '<div class="row">';
            $cancelation_data .= '<div class="col-12">';
            $cancelation_data .= '<h5>Cancelled By: ' . $transaction_cancelation->user->first_name . ' ' . $transaction_cancelation->user->last_name . '</h5>';
            $cancelation_data .= '</div>';
            $cancelation_data .= '</div>';
            $cancelation_data .= '<div class="row">';
            $cancelation_data .= '<div class="col-12">';
            $cancelation_data .= '<h5>Cancelation reason:</h5>';
            $cancelation_data .= '<div class="pl-3 pr-3">';
            $cancelation_data .= '<p>' . $transaction_cancelation->reason . '</p>';
            $cancelation_data .= '</div>';
            $cancelation_data .= '</div>';
            $cancelation_data .= '</div>';

            return response()->json(['cancelation_data' => $cancelation_data]);
        }
    }
}

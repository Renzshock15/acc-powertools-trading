<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Rules\Quantity;
use App\Rules\Notselect;
use App\Transaction_comment;
use App\Transaction_type;
use App\Receipt;
use App\Store;
use App\Temp_transfer_list;
use App\Transacted_item;
use App\Brand;
use App\Customer;
use App\Notification;
use App\Repair;
use App\User;
use App\Transaction_cancelation;
use App\Transfer_list;
use Egulias\EmailValidator\Result\Result;
use Illuminate\Support\Facades\App;
use Nexmo\Call\Transfer;
use PDF;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Rules\ImageRequired;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('store');
    }

    public function index()
    {
        $brands = Brand::all();
        $inventories = Inventory::select('inventories.*')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->where('inventories.store_id', '=', Auth::user()->store_id)
            ->get();
        $notifications = Notification::where('store_id', '=', Auth::user()->store_id)
            ->where('is_read', '=', 1)
            ->get();

        $data = [
            'brands' => $brands,
            'inventories' =>  $inventories,
            'notifications' => $notifications
        ];
        return view('store.dashboard', compact('data'));
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
            ->where('transactions.store_id', '=', Auth::user()->store_id)
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

    public function product()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $data = [
            'products' => $products
        ];
        return view('store.product', compact('data'));
    }

    public function get_product_list_data(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = Product::where([['code', 'like', '%' . $query . '%']])
                ->orWhere([['name', 'like', '%' . $query . '%']])
                ->orderBy('id', 'desc')
                ->paginate(10);

            $data = [
                'products' => $products
            ];
            return view('store.product-list-data', compact('data'))->render();
        }
    }

    public function add_inventory(Request $request)
    {
        $validatedProduct = $request->validate([
            'product_qty' => 'not_in:0'
        ]);

        $inventory_count = Inventory::where('product_id', '=', $request->product_id)
            ->where('store_id', '=', Auth::user()->store_id)
            ->count();
        // dd($request->product_id);

        if ($inventory_count > 0) {
            return redirect()->back()->with('store-error', 'error');
        } else {
            $inventory = new Inventory();
            $inventory->product_id = intval($request->product_id);
            $inventory->store_id = Auth::user()->store_id;
            $inventory->quantity = $request->product_qty;
            $inventory->save();

            $inventory_id = $inventory->id;

            $from_location = Store::where('name', '=', 'Office')->first();

            $transaction = new Transaction();
            $transaction->transaction_type_id = 1;
            $transaction->transaction_date = date("Y-m-d");
            $transaction->transaction_comment_id = 1;
            $transaction->user_id = Auth::user()->id;
            $transaction->status = "Received";
            $transaction->from = $from_location->name . ' - ' . $from_location->street . ' ' . $from_location->city;
            $transaction->to = Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
            $transaction->store_id = Auth::user()->store_id;
            $transaction->save();

            $transaction_id = $transaction->id;

            $product = Inventory::where('id', '=', $inventory_id)
                ->first();

            $transacted_item = new Transacted_item();
            $transacted_item->inventory_id = $inventory_id;
            $transacted_item->transaction_id = $transaction_id;
            $transacted_item->quantity = $request->product_qty;
            $transacted_item->total_price = $product->product->price * $request->product_qty;
            $transacted_item->save();

            return redirect()->back()->with('store-success', 'success');
        }
    }

    public function is_product_exist(Request $request)
    {
        $product_count = Inventory::where('product_id', '=', $request->product_id)
            ->where('store_id', '=', Auth::user()->store_id)
            ->count();

        if ($product_count > 0) {
            $product_exist = true;
            return response()->json(['product_exist' => $product_exist]);
        } else {
            $product_exist = false;
            return response()->json(['product_exist' => $product_exist]);
        }
    }

    public function new_inventory($product_id)
    {
        $product = Product::where('id', '=', intval($product_id))->first();
        $product_info = [
            'product_id' => $product->id,
            'product_name' => $product->name
        ];
        return view('store.new-inventory', compact('product_info'));
    }

    public function inventory(Request $request)
    {
        $inventories = Inventory::where('store_id', '=', Auth::user()->store_id)
            ->paginate(10);
        $brands = Brand::all();
        $data = [
            'inventories' => $inventories,
            'brands' => $brands
        ];
        return view('store.inventory', compact('data'));
    }

    public function get_inventory_list_data(Request $request)
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
                    ->paginate(10);
            } else {
                $inventories = Inventory::select('inventories.*')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->where([['products.code', 'like', '%' . $query . '%'], ['products.brand_id', '=', $brand], ['inventories.store_id', '=', Auth::user()->store_id]])
                    ->orWhere([['products.name', 'like', '%' . $query . '%'], ['products.brand_id', '=', $brand], ['inventories.store_id', '=', Auth::user()->store_id]])
                    ->paginate(10);
            }


            $data = [
                'inventories' => $inventories
            ];
            return view('store.inventory-list-data', compact('data'))->render();
        }
    }

    public function add_new_inventory($product_id)
    {
        $inventory = Inventory::where('id', '=', intval($product_id))->first();
        $product_info = [
            'product_id' => $inventory->id,
            'product_name' => $inventory->product->name
        ];
        return view('store.add-new-inventory', compact('product_info'));
    }

    public function update_inventory(Request $request)
    {
        $validatedProduct = $request->validate([
            'inventory_qty' => 'not_in:0',
            'transaction_form' => [new Notselect]
        ]);

        $inventory = Inventory::find($request->inventory_id);
        $inventory_current_quantity = $inventory->quantity;
        $inventory->quantity = $inventory_current_quantity + $request->inventory_qty;
        $inventory->save();

        $from_location = Store::where('name', '=', 'Office')->first();

        $transaction = new Transaction();
        $transaction->transaction_type_id = 1;
        $transaction->transaction_date = date("Y-m-d");
        $transaction->transaction_comment_id = 1;
        $transaction->user_id = Auth::user()->id;
        $transaction->status = "Received";
        $transaction->from = $from_location->name . ' - ' . $from_location->street . ' ' . $from_location->city;
        $transaction->to = Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
        $transaction->store_id = Auth::user()->store_id;
        $transaction->save();

        $transaction_id = $transaction->id;

        $product = Inventory::where('id', '=', $request->inventory_id)
            ->first();

        $transacted_item = new Transacted_item();
        $transacted_item->inventory_id = $request->inventory_id;
        $transacted_item->transaction_id = $transaction_id;
        $transacted_item->quantity = $request->inventory_qty;
        $transacted_item->total_price = $product->product->price * $request->inventory_qty;
        $transacted_item->save();

        return redirect()->back()->with('store-success', 'success');
    }

    public function sales(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->date_pick == null) {
                $daily_sales = Transaction::select('transactions.transaction_date')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->where('transactions.store_id', '=', Auth::user()->store_id)
                    ->where('transaction_types.type_name', '=', 'Sales')
                    ->orderBy('transactions.transaction_date', 'desc')
                    ->groupBy('transactions.transaction_date')
                    ->paginate(6);

                $sales_by_date = Transacted_item::select('transacted_items.*')
                    ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
                    ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->where('inventories.store_id', '=', Auth::user()->store_id)
                    ->where('transaction_types.type_name', '=', 'Sales')
                    ->get();

                $data = [
                    'daily_sales' => $daily_sales,
                    'sales_by_date' => $sales_by_date
                ];

                return view('store.sales', compact('data'));
            } else {
                $daily_sales = Transaction::select('transactions.transaction_date')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->where('transactions.store_id', '=', Auth::user()->store_id)
                    ->where('transaction_types.type_name', '=', 'Sales')
                    ->where('transactions.transaction_date', '=', $request->date_pick)
                    ->orderBy('transactions.transaction_date', 'desc')
                    ->groupBy('transactions.transaction_date')
                    ->paginate(6);

                $sales_by_date = Transacted_item::select('transacted_items.*')
                    ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
                    ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->where('inventories.store_id', '=', Auth::user()->store_id)
                    ->where('transaction_types.type_name', '=', 'Sales')
                    ->get();

                $data = [
                    'daily_sales' => $daily_sales,
                    'sales_by_date' => $sales_by_date
                ];

                return view('store.sales', compact('data'));
            }
        } else {
            $daily_sales = Transaction::select('transactions.transaction_date')
                ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                ->where('transactions.store_id', '=', Auth::user()->store_id)
                ->where('transaction_types.type_name', '=', 'Sales')
                ->orderBy('transactions.transaction_date', 'desc')
                ->groupBy('transactions.transaction_date')
                ->paginate(6);

            $sales_by_date = Transacted_item::select('transacted_items.*')
                ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
                ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                ->where('inventories.store_id', '=', Auth::user()->store_id)
                ->where('transaction_types.type_name', '=', 'Sales')
                ->get();

            $data = [
                'daily_sales' => $daily_sales,
                'sales_by_date' => $sales_by_date
            ];

            return view('store.sales', compact('data'));
        }
    }

    public function add_sales(Request $request)
    {
        $receipts = Receipt::all();

        $transactions = Transaction::select('transactions.*')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->where('transaction_types.type_name', '=', 'Sales')
            ->where('transactions.transaction_date', '=', date("Y-m-d"))
            ->orderBy('transactions.transaction_date', 'desc')
            ->get();

        $transacted_items = Transacted_item::select('transacted_items.*')
            ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->where('inventories.store_id', '=', Auth::user()->store_id)
            ->get();

        $inventories = Inventory::where('store_id', '=', Auth::user()->store_id)
            ->paginate(5);
        $data = [
            'receipts' => $receipts,
            'inventories' => $inventories,
            'transactions' => $transactions,
            'transacted_items' => $transacted_items
        ];

        return view('store.add-sales', compact('data'));
    }

    public function transact_sales(Request $request)
    {
        $store_codes = explode(' ', Auth::user()->store->name);
        $trans = Transaction::where('transaction_receipt', '=', $store_codes[0] . '-' . Auth::user()->store_id . '-' . $request->transaction_receipt . $request->receipt_no . '-' . date("Y-m-d"))->get();
        if ($trans->count() > 0) {
            for ($i = 0; $i < count($request->table_sale_list['inventory_id']); $i++) {
                $inventory_id = $request->table_sale_list['inventory_id'][$i];
                $product_serial = $request->table_sale_list['product_serial'][$i];
                $product_qty =  $request->table_sale_list['product_qty'][$i];
                $product_tot_price = $request->table_sale_list['product_tot_price'][$i];

                $inventory = Inventory::find($inventory_id);
                $current_inventory_qty = $inventory->quantity;
                $inventory->quantity = $current_inventory_qty - $product_qty;
                $inventory->save();


                $transacted_item = new Transacted_item();
                $transacted_item->inventory_id = $inventory_id;
                $transacted_item->transaction_id = $trans[0]->id;
                $transacted_item->serial = $product_serial;
                $transacted_item->quantity = $product_qty;
                $transacted_item->total_price = $product_tot_price;
                $payment = '';
                if ($product_tot_price == 0.00) {
                    $payment = 'Free';
                }
                $transacted_item->note = $payment;
                $transacted_item->save();
            }

            return response()->json(['success' => true]);
        } else {
            $store_code = explode(' ', Auth::user()->store->name);
            $transaction = new Transaction();
            $transaction->transaction_type_id = 3;
            $transaction->transaction_date = date("Y-m-d");
            $transaction->transaction_comment_id = 2;
            $transaction->transaction_receipt = $store_code[0] . '-' . Auth::user()->store_id . '-' . $request->transaction_receipt . $request->receipt_no . '-' . date("Y-m-d");
            $transaction->status = "Sold";
            $transaction->user_id = Auth::user()->id;
            $transaction->from = Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
            $transaction->to = "Customer";
            $transaction->store_id = Auth::user()->store_id;
            $transaction->save();

            $transaction_id = $transaction->id;

            for ($i = 0; $i < count($request->table_sale_list['inventory_id']); $i++) {
                $inventory_id = $request->table_sale_list['inventory_id'][$i];
                $product_serial = $request->table_sale_list['product_serial'][$i];
                $product_qty =  $request->table_sale_list['product_qty'][$i];
                $product_tot_price = $request->table_sale_list['product_tot_price'][$i];

                $inventory = Inventory::find($inventory_id);
                $current_inventory_qty = $inventory->quantity;
                $inventory->quantity = $current_inventory_qty - $product_qty;
                $inventory->save();


                $transacted_item = new Transacted_item();
                $transacted_item->inventory_id = $inventory_id;
                $transacted_item->transaction_id = $transaction_id;
                $transacted_item->serial = $product_serial;
                $transacted_item->quantity = $product_qty;
                $transacted_item->total_price = $product_tot_price;
                $payment = '';
                if ($product_tot_price == 0.00) {
                    $payment = 'Free';
                }
                $transacted_item->note = $payment;
                $transacted_item->save();
            }

            return response()->json(['success' => true]);
        }
    }

    public function show_item_list(Request $request)
    {
        $transacted_items = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transactions.transaction_date', '=', $request->transaction_date)
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->where('transaction_types.type_name', '=', 'Sales')
            ->orderBy('transactions.transaction_receipt')
            ->get();

        $return_output = '<div class="table-responsive">';
        $return_output .= '<table class="table" id="inventory_tables">';
        $return_output .= '<thead>';
        $return_output .= '<tr>';
        $return_output .= '<th class="border-top-0">Receipt</th>';
        $return_output .= '<th class="border-top-0">Product Name</th>';
        $return_output .= '<th class="border-top-0">Qty</th>';
        $return_output .= '<th class="border-top-0">Total Price</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody>';

        foreach ($transacted_items as $transacted_item) {
            $return_output .= '<tr class="border-top-0">';
            $return_output .= '<td class="border-top-0">' . $transacted_item->transaction->transaction_receipt . '</td>';
            $return_output .= '<td class="border-top-0">' . $transacted_item->inventory->product->code . ' ' . $transacted_item->inventory->product->name . '</td>';
            $return_output .= '<td class="border-top-0">' . $transacted_item->quantity . '</td>';
            $return_output .= '<td class="border-top-0">' . $transacted_item->total_price . '</td>';
            $return_output .= '</tr>';
        }
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        return response()->json(['inv_data' => $return_output]);
    }

    public function generate_sales_pdf($transaction_date)
    {
        $transactions = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transactions.transaction_date', '=', $transaction_date)
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->where('transaction_types.type_name', '=', 'Sales')
            ->orderBy('transactions.transaction_receipt')
            ->get();

        $return_output = '<div class="" style="width:100%; text-align:center; font-family: Arial, Helvetica, sans-serif;">';
        $return_output .= '<h2 style="padding:0px; margin:0px">' . (Auth::user()->store->name === 'Acc Powertools' ? 'ACC Power Tools Trading' : 'Prime Ledtric Trading') . '</h2>';
        $return_output .= '<h5 style="margin-top:2px">' . Auth::user()->store->street . ' ' . Auth::user()->store->city . ', ' . Auth::user()->store->province . '</h5>';
        $return_output .= '</div>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:50% ">Daily Sale</th>';
        $return_output .= '<th class="border-top-0" style="padding: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:50%">Date: ' . $transaction_date . '</th>';

        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<div class="table-responsive">';
        $return_output .= '<table class="table" id="inventory_tables" style="width: 100%; border: solid 1px #DDEEEE; border-collapse: collapse; border-spacing: 0; font: normal 13px Arial, sans-serif;">';
        $return_output .= '<thead style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Qty</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Unit</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:10%;">Receipt</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:40%;">Product Name</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Serial</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">%</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Total Price</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">';

        $total_transaction_price = 0.00;

        foreach ($transactions as $transaction) {
            $return_output .= '<tr>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transaction->quantity . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . ($transaction->quantity < 2 ? $transaction->inventory->product->unit->name : $transaction->inventory->product->unit->name . 's') . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transaction->transaction->transaction_receipt . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transaction->inventory->product->name . ' (' . $transaction->inventory->product->code . ')</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transaction->serial . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transaction->inventory->product->discount . '%</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transaction->total_price . '</td>';
            $return_output .= '</tr>';

            $total_transaction_price = $total_transaction_price + $transaction->total_price;
        }
        $return_output .= '<tr>';
        $return_output .= '<td colspan="6" style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;">Total</td>';
        $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; font-weight: bold;">' . number_format($total_transaction_price, 2, '.', '') . '</td>';
        $return_output .= '</tr>';
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($return_output);
        return $pdf->stream();
    }

    public function transfer(Request $request)
    {
        if ($request->method() == 'POST') {
            if ($request->date_pick == null) {
                $transfer_transactions = Transaction::select('transactions.*')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->join('transaction_comments', 'transactions.transaction_comment_id', '=', 'transaction_comments.id')
                    ->where('transaction_types.type_name', '=', 'Transfer')
                    ->where('transaction_comments.name', '=', 'Stock out')
                    ->where('transactions.store_id', '=', Auth::user()->store_id)
                    ->orderBy('transactions.id', 'desc')
                    ->paginate(10);

                $data = [
                    'transfer_transactions' => $transfer_transactions,
                ];
                return view('store.transfer', compact('data'));
            } else {
                $transfer_transactions = Transaction::select('transactions.*')
                    ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                    ->join('transaction_comments', 'transactions.transaction_comment_id', '=', 'transaction_comments.id')
                    ->where('transaction_types.type_name', '=', 'Transfer')
                    ->where('transaction_comments.name', '=', 'Stock out')
                    ->where('transactions.transaction_date', '=', $request->date_pick)
                    ->where('transactions.store_id', '=', Auth::user()->store_id)
                    ->orderBy('transactions.id', 'desc')
                    ->paginate(10);

                $data = [
                    'transfer_transactions' => $transfer_transactions,
                ];
                return view('store.transfer', compact('data'));
            }
        } else {
            $transfer_transactions = Transaction::select('transactions.*')
                ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
                ->join('transaction_comments', 'transactions.transaction_comment_id', '=', 'transaction_comments.id')
                ->where('transaction_types.type_name', '=', 'Transfer')
                ->where('transaction_comments.name', '=', 'Stock out')
                ->where('transactions.store_id', '=', Auth::user()->store_id)
                ->orderBy('transactions.id', 'desc')
                ->paginate(10);

            $data = [
                'transfer_transactions' => $transfer_transactions,
            ];
            return view('store.transfer', compact('data'));
        }
    }

    public function show_pending_list(Request $request)
    {
        $pending_transfer_lists = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('inventories', 'transacted_items.inventory_id', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->where('transacted_items.transaction_id', '=', intval($request->transaction_id))
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

    public function create_transfer()
    {
        $stores = Store::where('id', '!=', Auth::user()->store_id)
            ->where('name', '!=', 'Warehouse')
            ->get();

        $inventories = Inventory::where('store_id', '=', Auth::user()->store_id)
            ->paginate(5);
        $data = [
            'stores' => $stores,
            'inventories' => $inventories

        ];
        return view('store.create-transfer', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $inventories = Inventory::select('inventories.*')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->where([['products.code', 'like', '%' . $query . '%'], ['inventories.store_id', '=', Auth::user()->store_id]])
                ->orWhere([['products.name', 'like', '%' . $query . '%'], ['inventories.store_id', '=', Auth::user()->store_id]])
                ->paginate(5);

            $data = [
                'inventories' => $inventories
            ];
            return view('store.inventory-data', compact('data'))->render();
        }
    }

    public function fetch_data_for_transfer(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $inventories = Inventory::select('inventories.*')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->where([['products.code', 'like', '%' . $query . '%'], ['inventories.store_id', '=', Auth::user()->store_id]])
                ->orWhere([['products.name', 'like', '%' . $query . '%'], ['inventories.store_id', '=', Auth::user()->store_id]])
                ->paginate(5);

            $data = [
                'inventories' => $inventories
            ];
            return view('store.transfer-inventory-data', compact('data'))->render();
        }
    }

    public function transfer_request(Request $request)
    {
        $transaction_type_id = Transaction_type::where('type_name', '=', 'Transfer')->first();
        $transaction_comment_id = Transaction_comment::where('name', '=', 'Stock out')->first();

        $transaction = new Transaction();
        $transaction->transaction_type_id = $transaction_type_id->id;
        $transaction->transaction_date = date("Y-m-d");
        $transaction->transaction_comment_id = $transaction_comment_id->id;
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
            $transacted_item->note = (string)$product_qty . '-pcs has been trying to trying to transfer';
            $transacted_item->save();
        }

        $store = Store::where(DB::raw("CONCAT(stores.name, ' - ', stores.street, ' ', stores.city)"), '=', $request->transfer_location)
            ->first();

        $notification = new Notification();
        $notification->message = 'New transfer from ' . Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
        $notification->link = 'recieve_stocks';
        $notification->transaction_id = $transaction_id;
        $notification->store_id = $store->id;
        $notification->is_read = 1;
        $notification->save();
        return response()->json(['success' => true]);
    }

    public function recieve()
    {
        $transfer_transactions = Transaction::select('transactions.*')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where([['transaction_types.type_name', '=', 'Transfer'], ['transactions.status', '=', 'Pending'], ['transactions.to', '=', Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city]])
            ->orWhere([['transaction_types.type_name', '=', 'Delivery'], ['transactions.status', '=', 'Pending'], ['transactions.to', '=', Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city]])
            ->paginate(10);

        $data = [
            'transfer_transactions' => $transfer_transactions,
        ];
        return view('store.recieve', compact('data'));
    }

    public function recieve_stocks($transaction_id)
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
        return view('store.recieve-stocks', compact('data'));
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

    public function recieve_delivery($transaction_id)
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
        return view('store.recieve-delivery', compact('data'));
    }

    public function from_office(Request $request)
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
                $updated_transacted_items->note = $product_qty . '-pcs has been delivered';
                $updated_transacted_items->save();
            } else {
                $updated_transacted_items = Transacted_item::find(intval($transacted_item_id));
                // $updated_transacted_items->quantity = intval($product_qty);
                $updated_transacted_items->note = $product_qty . '-pcs has been delivered';
                $updated_transacted_items->save();
            }

            //Update origin inventory
            //With errors
            $from_inventory = Inventory::find(intval($inventory_id));
            $current_inventory_qty = $from_inventory->quantity;
            $from_inventory->quantity = $current_inventory_qty - intval($product_qty);
            $from_inventory->save();
        }

        $create_transaction_receipt = Transaction::where('id', '=', $request->table_sale_list['transaction_id'][0])
            ->first();
        $assign_receipt = Transaction::find($create_transaction_receipt->id);
        $assign_receipt->status = 'Delivered';
        $assign_receipt->save();

        $destination_transaction = new Transaction();
        $transaction_type = Transaction_type::where('type_name', '=', 'Delivery')->first();
        $transaction_comment_id = Transaction_comment::where('name', '=', 'Stock in')->first();
        $destination_transaction->transaction_type_id = $transaction_type->id;
        $destination_transaction->transaction_date = date("Y-m-d");
        $destination_transaction->transaction_comment_id = $transaction_comment_id->id;
        $destination_transaction->transaction_receipt = strval($create_transaction_receipt->transaction_receipt);
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

        $notification = Notification::where('transaction_id', '=', $create_transaction_receipt->id)
            ->update(array('is_read' => 0));


        return response()->json(['success' => true]);
    }

    public function generate_transfers_pdf($transaction_id)
    {
        $transactions = Transaction::where('id', '=', $transaction_id)
            ->first();

        $transacted_items = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->where('transacted_items.transaction_id', '=', $transaction_id)
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->where('transaction_types.type_name', '=', 'Transfer')
            ->orderBy('transactions.transaction_receipt')
            ->get();

        $return_output = '<div class="" style="width:100%; text-align:center; font-family: Arial, Helvetica, sans-serif;">';
        $return_output .= '<h2 style="padding:0px; margin:0px">' .  $transactions->store->name . ' Trading</h2>';
        $return_output .= '<h5 style="margin-top:2px">' .  $transactions->store->street . ' ' .  $transactions->store->city . ', ' .  $transactions->store->province . '</h5>';
        $return_output .= '</div>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">From: ' . $transactions->from . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Date: ' . $transactions->transaction_date . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">To: ' . $transactions->to . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">Receipt: ' . $transactions->transaction_receipt . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';
        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:100% ">Prepared by: ' . $transactions->user->first_name . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '</table>';

        $return_output .= '<div class="table-responsive">';
        $return_output .= '<table class="table" id="inventory_tables" style="width: 100%; border: solid 1px #DDEEEE; border-collapse: collapse; border-spacing: 0; font: normal 13px Arial, sans-serif;">';
        $return_output .= '<thead style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">';
        $return_output .= '<tr style="">';

        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Qty</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Unit</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:60%;">Product Name</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Unit Price</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Total Price</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">';

        $total_transaction_price = 0.00;

        foreach ($transacted_items as $transacted_item) {
            $return_output .= '<tr>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->quantity . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . ($transacted_item->quantity < 2 ? $transacted_item->inventory->product->unit->name : $transacted_item->inventory->product->unit->name . 's') . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->inventory->product->name . ' (' . $transacted_item->inventory->product->code . ')</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $transacted_item->total_price . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . number_format($transacted_item->quantity * $transacted_item->total_price, 2, '.', '') . '</td>';
            $return_output .= '</tr>';

            $total_price = $transacted_item->quantity * $transacted_item->total_price;
            $total_transaction_price = $total_transaction_price + $total_price;
        }
        $return_output .= '<tr>';
        $return_output .= '<td colspan="4" style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; text-align:right; padding-right:15px; font-weight: bold;">Total</td>';
        $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff; font-weight: bold;">' . number_format($total_transaction_price, 2, '.', '') . '</td>';
        $return_output .= '</tr>';
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($return_output);
        return $pdf->stream();
    }

    public function transaction()
    {
        $transactions = Transaction::select('transactions.*')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->orderBy('transactions.transaction_date', 'desc')
            ->orderBy('transactions.id', 'desc')
            ->paginate(10);

        $data = [
            'transactions' => $transactions
        ];
        return view('store.transaction', compact('data'));
    }

    public function fetch_data_for_rtransaction(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $search_by = $request->get('type');
            // $query_dates = explode('/', $query);

            if ($search_by === 'Transaction No.') {
                $transactions = Transaction::Where([['store_id', '=', Auth::user()->store_id], ['id', 'like', '%' . $query . '%']])
                    ->orderBy('transaction_date', 'desc')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

                $data = [
                    'transactions' => $transactions
                ];
                return view('store.transaction-data', compact('data'))->render();
            } elseif ($search_by === 'Product_code') {
                $transacted_items = Transacted_item::select('transacted_items.*')
                    ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->where('products.code', 'like', '%' . $query . '%')
                    ->get();

                $transaction_ids = array();

                foreach ($transacted_items as $transacted_item) {
                    array_push($transaction_ids, $transacted_item->transaction_id);
                }

                // $transaction_ids = (array) $transacted_items->transaction_id;

                $transactions = Transaction::Where('store_id', '=', Auth::user()->store_id)
                    ->whereIn('id',  $transaction_ids)
                    ->orderBy('transaction_date', 'desc')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

                $data = [
                    'transactions' => $transactions
                ];
                return view('store.transaction-data', compact('data'))->render();
            } elseif ($search_by === 'Product_name') {
                $transacted_items = Transacted_item::select('transacted_items.*')
                    ->join('inventories', 'transacted_items.inventory_id', '=', 'inventories.id')
                    ->join('products', 'inventories.product_id', '=', 'products.id')
                    ->where('products.name', 'like', '%' . $query . '%')
                    ->get();

                $transaction_ids = array();

                foreach ($transacted_items as $transacted_item) {
                    array_push($transaction_ids, $transacted_item->transaction_id);
                }

                // $transaction_ids = (array) $transacted_items->transaction_id;

                $transactions = Transaction::Where('store_id', '=', Auth::user()->store_id)
                    ->whereIn('id',  $transaction_ids)
                    ->orderBy('transaction_date', 'desc')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

                $data = [
                    'transactions' => $transactions
                ];
                return view('store.transaction-data', compact('data'))->render();
            } elseif ($search_by === 'Receipt') {
                $transactions = Transaction::Where('store_id', '=', Auth::user()->store_id)
                    ->where('transaction_receipt',  'like', '%' . $query . '%')
                    ->orderBy('transaction_date', 'desc')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

                $data = [
                    'transactions' => $transactions
                ];
                return view('store.transaction-data', compact('data'))->render();
            }
        }
    }

    public function transacted_items($transaction_id)
    {
        $transaction = Transaction::where('id', '=', $transaction_id)
            ->first();

        $transacted_items = Transacted_item::where('transaction_id', '=', $transaction_id)
            ->get();

        $data = [
            'transaction' => $transaction,
            'transacted_items' => $transacted_items
        ];
        return view('store.transacted-items', compact('data'));
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

    public function sales_returns()
    {
        $sales_receipts = Transaction::select('transactions.*')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.type_name', '=', 'Sales')
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->where('transactions.transaction_date', '=', date("Y-m-d"))
            ->orderBy('transactions.transaction_receipt', 'desc')
            ->get();

        $data = [
            'sales_receipts' => $sales_receipts
        ];

        return view('store.sales-returns', compact('data'));
    }

    public function show_item_returns(Request $request)
    {
        $store_code = explode(' ', Auth::user()->store->name);
        $transacted_items = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->join('inventories', 'transacted_items.inventory_id', 'inventories.id')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->where('transactions.transaction_receipt', '=', $store_code[0] . '-' . Auth::user()->store_id . '-' . $request->reciept_no . '-' . $request->receipt_date)
            ->where('transaction_types.type_name', '=', 'Sales')
            ->where('transacted_items.is_changed', '=', 1)
            ->where('transactions.store_id', '=', Auth::user()->store_id)
            ->get();

        $return_output = '<div class="table-responsive">';
        $return_output .= '<table class="table" id="sales_table">';
        $return_output .= '<thead>';
        $return_output .= '<tr>';
        $return_output .= '<th class="border-top-0 for-hide">Id</th>';
        $return_output .= '<th class="border-top-0" width="50%">Product Name</th>';
        $return_output .= '<th class="border-top-0" width="15%">Qty</th>';
        $return_output .= '<th class="border-top-0" width="25%">Total Price</th>';
        $return_output .= '<th class="border-top-0 for-hide">Serial</th>';
        $return_output .= '<th class="border-top-0 for-hide">Tid</th>';
        $return_output .= '<th class="border-top-0 text-center" width="10%">Select</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';
        $return_output .= '<tbody>';

        foreach ($transacted_items as $transacted_item) {
            $return_output .= '<tr class="border-top-0">';
            $return_output .= '<td class="border-top-0 for-hide">' . $transacted_item->inventory->id . '</td>';
            $return_output .= '<td class="border-top-0">' . $transacted_item->inventory->product->code . ' ' . $transacted_item->inventory->product->name . '</td>';
            $return_output .= '<td class="border-top-0">' . $transacted_item->quantity . '</td>';
            $return_output .= '<td class="border-top-0">' . $transacted_item->total_price . '</td>';
            $return_output .= '<td class="border-top-0 for-hide">' . $transacted_item->serial . '</td>';
            $return_output .= '<td class="border-top-0 for-hide">' . $transacted_item->id . '</td>';
            $return_output .= '<td class="border-top-0 text-center"><button class="btn btn-warning text-white select-items"><i class="fas fa-plus"></i></button></td>';
            $return_output .= '</tr>';
        }
        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        return response()->json(['transacted_item' => $return_output]);
    }

    public function transact_change_item(Request $request)
    {
        $transaction = Transaction::where('id', '=', $request->transaction_receipt)
            ->first();
        $store_code = explode(' ', Auth::user()->store->name);
        for ($i = 0; $i < count($request->table_sale_list['inventory_id']); $i++) {
            $inventory_id = $request->table_sale_list['inventory_id'][$i];
            $product_serial = $request->table_sale_list['product_serial'][$i];
            $product_qty =  $request->table_sale_list['product_qty'][$i];
            $product_tot_price = $request->table_sale_list['product_tot_price'][$i];
            $transacted_item_id = $request->table_sale_list['transacted_item_id'][$i];

            $inventory = Inventory::find($inventory_id);
            $current_inventory_qty = $inventory->quantity;
            $inventory->quantity = $current_inventory_qty + $product_qty;
            $inventory->save();

            $transacted_item = new Transacted_item();
            $transacted_item->inventory_id = $inventory_id;
            $transacted_item->transaction_id = $request->transaction_receipt;
            $transacted_item->serial = $product_serial;
            $transacted_item->quantity = $product_qty;
            $transacted_item->total_price = $product_tot_price;
            $payment = 'Change from ' . $store_code[0] . '-' . Auth::user()->store_id . '-' . $request->receipt_no;
            if ($product_tot_price == 0.00) {
                $payment = $payment . ' - Free';
            }
            $transacted_item->note = $payment;
            $transacted_item->is_changed = 0;
            $transacted_item->save();

            $change_transacted_item = Transacted_item::find(intval(trim($transacted_item_id)));
            $note = 'Change to ' . $store_code[0] . '-' . Auth::user()->store_id . '-' . $transaction->transaction_date;
            if ($product_tot_price == 0.00) {
                $note = $note . ' - Free';
            }
            $change_transacted_item->note = $note;
            $change_transacted_item->is_changed = 0;
            $change_transacted_item->save();
        }

        return response()->json(['success' => true]);
    }

    public function cancel_transaction($transaction_id)
    {
        $transaction = Transaction::where('id', '=', $transaction_id)
            ->first();

        $data = [
            'transaction' => $transaction
        ];
        return view('store.cancel-transaction', compact('data'));
    }

    public function cancel(Request $request)
    {
        $validatedProduct = $request->validate([
            'cancelation_reason' => 'required'
        ]);

        $transacted_items = Transacted_item::select('transacted_items.*')
            ->join('transactions', 'transacted_items.transaction_id', '=', 'transactions.id')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transacted_items.transaction_id', '=', intval($request->transaction_id))
            ->get();

        // dd($transacted_items->transaction->status);

        foreach ($transacted_items as $transacted_item) {
            if ($transacted_item->transaction->status === 'Transfered') {
                //No action
            } elseif ($transacted_item->transaction->status === 'Received') {
                $inventory = Inventory::where('id', '=', intval($transacted_item->inventory_id))
                    ->first();
                $new_inventory = Inventory::find(intval($transacted_item->inventory_id));
                $new_inventory->quantity = $inventory->quantity - $transacted_item->quantity;
                $new_inventory->save();
            } elseif ($transacted_item->transaction->status === 'Sold') {
                if ($transacted_item->total_price < 0) {
                    $inventory = Inventory::where('id', '=', intval($transacted_item->inventory_id))
                        ->first();
                    $new_inventory = Inventory::find(intval($transacted_item->inventory_id));
                    $new_inventory->quantity = $inventory->quantity - $transacted_item->quantity;
                    $new_inventory->save();
                } else {
                    $inventory = Inventory::where('id', '=', intval($transacted_item->inventory_id))
                        ->first();
                    $new_inventory = Inventory::find(intval($transacted_item->inventory_id));
                    $new_inventory->quantity = $inventory->quantity + $transacted_item->quantity;
                    $new_inventory->save();
                }
            }
        }

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
            $cancelation_data .= '<h5>Cancelled By: ' . $transaction_cancelation->user->first_name . '</h5>';
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

    public function profile()
    {
        return view('store.profile');
    }

    public function profile_photo()
    {
        return view('store.profile-photo');
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
        return view('store.user-info');
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

    public function repairs()
    {
        $repairs = Repair::where('store_id', '=', Auth::user()->store_id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        $data = [
            'repairs' => $repairs
        ];
        return view('store.repairs', compact('data'));
    }

    public function add_manually()
    {
        $receipts = Receipt::all();
        $products = Product::orderBy('id', 'desc')->paginate(5);
        $data = [
            'products' => $products,
            'receipts' => $receipts
        ];
        return view('store.add-manually', compact('data'));
    }

    public function fetch_data_for_products(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = Product::where([['code', 'like', '%' . $query . '%']])
                ->orWhere([['name', 'like', '%' . $query . '%']])
                ->orderBy('id', 'desc')
                ->paginate(5);

            $data = [
                'products' => $products
            ];
            return view('store.product-data', compact('data'))->render();
        }
    }

    public function save_repair(Request $request)
    {
        $validate_produuct = $request->validate(
            [
                'receipt_type' => [new Notselect],
                'reciept_date' => 'date',
                'receipt_no' => 'required',
                'product_id' => 'required',
                'product_name' => 'required',
                'product_serial' => 'required',
                'customer_name' => 'required',
                'customer_number' => 'required|numeric'
            ]
        );

        $customer = new Customer();
        $customer->name = $request->customer_name;
        $customer->number = $request->customer_number;
        $customer->save();

        $repair = new Repair();
        $repair->product_id = intval($request->product_id);
        $repair->serial = $request->product_serial;
        $store_codes = explode(' ', Auth::user()->store->name);
        $repair->receipt = $store_codes[0] . '-' . Auth::user()->store_id . '-' . $request->receipt_type . $request->receipt_no . '-' . $request->reciept_date;
        $repair->entry_date = date("Y-m-d");
        $repair->status = 'To receive';
        $repair->store_id = Auth::user()->store_id;
        $repair->customer_id = $customer->id;
        $repair->user_id = Auth::user()->id;
        $repair->save();

        return redirect()->back()->with('new-repair', 'success');
    }

    public function edit_repair($repair_id)
    {
        $repair = Repair::where('id', '=', intval($repair_id))
            ->first();
        $receipts = Receipt::all();
        $actual_receipt = explode('-', $repair->receipt);
        // $customer = Customer::find($repair->customer_id)
        $data = [
            'repair' => $repair,
            'actual_receipt_no' => substr($actual_receipt[2], 2),
            'receipts' => $receipts,
            'actual_receipt_type' => substr($actual_receipt[2], 0, 2),
            'actual_receipt_date' => $actual_receipt[3] . '-' . $actual_receipt[4] . '-' . $actual_receipt[5]
        ];
        return view('store.edit-repair', compact('data'));
    }

    public function update_repair(Request $request)
    {
        $validate_produuct = $request->validate(
            [
                'receipt_type' => [new Notselect],
                'reciept_date' => 'date',
                'receipt_no' => 'required',
                'product_id' => 'required',
                'product_name' => 'required',
                'product_serial' => 'required',
                'customer_name' => 'required',
                'customer_number' => 'required|numeric'
            ]
        );

        $customer = Customer::find(intval($request->customer_id));
        $customer->name = $request->customer_name;
        $customer->number = $request->customer_number;
        $customer->save();

        $repair = Repair::find(intval($request->repair_id));
        $repair->serial = $request->product_serial;
        $store_codes = explode(' ', Auth::user()->store->name);
        $repair->receipt = $store_codes[0] . '-' . Auth::user()->store_id . '-' . $request->receipt_type . $request->receipt_no . '-' . $request->reciept_date;
        $repair->store_id = Auth::user()->store_id;
        $repair->save();
        return redirect()->back()->with('update-repair', 'success');
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
                        ->where([['products.code', 'like', '%' . $query . '%'], ['repairs.store_id', '=', Auth::user()->store_id]])
                        ->orWhere([['products.name', 'like', '%' . $query . '%'], ['repairs.store_id', '=', Auth::user()->store_id]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                } else {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['products.code', 'like', '%' . $query . '%'], ['repairs.status', '=', $status], ['repairs.store_id', '=', Auth::user()->store_id]])
                        ->orWhere([['products.name', 'like', '%' . $query . '%'], ['repairs.status', '=', $status], ['repairs.store_id', '=', Auth::user()->store_id]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                }
            } else {
                if ($status === 'All') {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['repairs.serial', '=', $query], ['repairs.store_id', '=', Auth::user()->store_id]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                } else {
                    $repairs = Repair::select('repairs.*')
                        ->join('products', 'repairs.product_id', '=', 'products.id')
                        ->join('customers', 'repairs.customer_id', '=', 'customers.id')
                        ->where([['repairs.serial', '=', $query], ['repairs.status', '=', $status], ['repairs.store_id', '=', Auth::user()->store_id]])
                        ->orderBy('repairs.id', 'desc')
                        ->paginate(10);
                }
            }

            $data = [
                'repairs' => $repairs
            ];
            return view('store.repair-data', compact('data'))->render();
        }
    }

    public function submit_status(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $repair_id = intval($request->get('id'));

            $repair = Repair::find($repair_id);
            $repair->status = $status;
            $repair->save();

            return response()->json(['update_status' => true]);
        }
    }

    public function repack_inventory($inventory_id)
    {
        $inventory = Inventory::where('id', '=', intval($inventory_id))
            ->first();
        $data = [
            'inventory' => $inventory
        ];
        return view('store.repack-inventory', compact('data'));
    }

    public function explode_inventory(Request $request)
    {
        $validate_inventory = $request->validate(
            [
                'inventory_qty' => 'not_in:0'
            ]
        );

        $inventory = Inventory::find(intval($request->inventory_id));
        $new_inventory_qty = $inventory->quantity - $request->inventory_qty;
        $inventory->quantity = $new_inventory_qty;
        $inventory->save();

        $transaction_type = Transaction_type::where('type_name', '=', 'Unbox')->first();
        $transaction_comment = Transaction_comment::where('name', '=', 'Stock In')->first();

        $transaction = new Transaction();
        $transaction->transaction_type_id = $transaction_type->id;
        $transaction->transaction_date = date("Y-m-d");
        $transaction->transaction_comment_id = $transaction_comment->id;
        $transaction->user_id = Auth::user()->id;
        $transaction->status = "Unboxed";
        $transaction->from = Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
        $transaction->to = Auth::user()->store->name . ' - ' . Auth::user()->store->street . ' ' . Auth::user()->store->city;
        $transaction->store_id = Auth::user()->store_id;
        $transaction->save();

        $transaction_id = $transaction->id;

        $product = Inventory::where('id', '=', intval($request->inventory_id))
            ->first();

        $transacted_item = new Transacted_item();
        $transacted_item->inventory_id = $request->inventory_id;
        $transacted_item->transaction_id = $transaction_id;
        $transacted_item->quantity = $request->inventory_qty;
        $transacted_item->total_price = $product->product->price * $request->inventory_qty;
        $transacted_item->save();

        return redirect()->back()->with('explode-success', 'success');
    }

    public function stocks_pdf($brand_id)
    {
        set_time_limit(0);
        ini_set("memory_limit", -1);
        ini_set('max_execution_time', 0);

        if ($brand_id === 'All') {
            $inventories = Inventory::select('inventories.*')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->where('inventories.store_id', '=', Auth::user()->store_id)
                ->orderBy('brands.name', 'asc')
                ->get();
        } else {
            $inventories = Inventory::select('inventories.*')
                ->join('products', 'inventories.product_id', '=', 'products.id')
                ->where('products.brand_id', '=', intval($brand_id))
                ->where('inventories.store_id', '=', Auth::user()->store_id)
                ->orderBy('products.code', 'asc')
                ->get();
        }


        $return_output = '<div class="" style="width:100%; text-align:center; font-family: Arial, Helvetica, sans-serif;">';
        $return_output .= '<h2 style="padding:0px; margin:0px">' . Auth::user()->store->name . ' Trading</h2>';
        $return_output .= '<h5 style="margin-top:2px">' . Auth::user()->store->street . ' ' . Auth::user()->store->city . ', ' . Auth::user()->store->province . '</h5>';
        $return_output .= '</div>';

        $return_output .= '<table style="width:100%; font: normal 13px Arial, sans-serif;>';
        $return_output .= '<thead>';
        $return_output .= '<tr style="">';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:70% ">Generate By: ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . '</th>';
        $return_output .= '<th class="border-top-0" style="padding-left: 10px; padding-right: 10px; text-align: right; text-shadow: 1px 1px 1px #fff; width:30%">As of: ' . date("Y-m-d") . '</th>';
        $return_output .= '</tr>';
        $return_output .= '</thead>';



        $return_output .= '<div class="table-responsive">';
        $return_output .= '<table class="table" id="inventory_tables" style="width: 100%; border: solid 1px #DDEEEE; border-collapse: collapse; border-spacing: 0; font: normal 13px Arial, sans-serif;">';
        $return_output .= '<thead style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">';
        $return_output .= '<tr style="">';

        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:15%;">Code</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:40%;">Product Name</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff; width:5%;">Qty</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Unit Price</th>';
        $return_output .= '<th class="border-top-0" style="background-color: #DDEFEF; border: solid 1px #DDEEEE; color: #336B6B; padding: 10px; text-align: left; text-shadow: 1px 1px 1px #fff;">Brand</th>';

        $return_output .= '</tr>';
        $return_output .= '</thead>';

        foreach ($inventories as $inventory) {
            $return_output .= '<tr>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $inventory->product->code . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $inventory->product->name . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $inventory->quantity . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $inventory->product->price . '</td>';
            $return_output .= '<td style="border: solid 1px #DDEEEE; color: #333; padding: 10px; text-shadow: 1px 1px 1px #fff;">' . $inventory->product->brand->name . '</td>';
            $return_output .= '</tr>';
        }

        $return_output .= '</tbody>';
        $return_output .= '</table>';
        $return_output .= '</div>';

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($return_output);
        return $pdf->stream();
    }

    public function generate_tags_pdf($product_ids)
    {
        $product_id_array = explode(',', $product_ids);

        $price_tags = ['0', '1', '2', '3'];

        for ($i = 0; $i < count($product_id_array); $i++) {
            $product = Product::where('id', '=', $product_id_array[$i])->first();
            $price_tags[$i] = $product;
        }


        // dd($price_tags);
        $return_output = '<div style="background-color: white; width: 100vh; height: 350px; font: normal 13px Arial, sans-serif;">';
        //1st
        $return_output .= '<div style="background-color: white; width: 340px; height: 340px; border: solid 1px; float: left;">';
        $return_output .= '<div style="background-color: #DDEFEF; width: 340px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute">';
        $return_output .= '<h3 style="margin-top: 10px; color: #333; margin-left: 5px; margin-right: 5px"><b>' . $price_tags[0]->name . '</b></h3>';
        $return_output .= '</div>';
        $return_output .= '<div style="background-color: orange; margin-top: 51px; width: 340px; height: 50px; border-bottom: solid 1px;">';
        $return_output .= '<div style="background-color: white; width: 169px; height: 50px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
        $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[0]->brand->name . '</h3>';
        $return_output .= '</div>';
        $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute">';
        $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[0]->code . '</h3>';
        $return_output .= '</div>';
        $return_output .= '</div>';

        $return_output .= '<div style="background-color: white; margin-top: 0px; width: 340px; height: 238px;">';
        $return_output .= '<div style="background-color: white; width: 169px; height: 238px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
        $return_output .= '<div style="background-color: red; margin-left: 5px; margin-top: 100px; width: 130px; height: 130px; text-align: center; position: absolute; border-radius: 65px; transform: rotate(-20deg);">';
        $return_output .= '<h1 style="margin-top: 25px; color: white; font: normal 60px">' . $price_tags[0]->discount . '%</h1>';
        $return_output .= '</div>';

        $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/store-logos/' . Auth::user()->store->name . '.jpg" style="white; width: 168px; height: 100px;">';

        $return_output .= '</div>';
        $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 238px; border-bottom: solid 1px; text-align: center; position: absolute">';
        $return_output .= '<div style="background-color: white; width: 170px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
        $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Before</h3>';
        $return_output .= '</div>';
        $return_output .= '<div style="background-color: white; width: 170px; margin-top: 41px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
        $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . $price_tags[0]->price . '</h1>';
        $return_output .= '</div>';
        $return_output .= '<div style="background-color: white; width: 170px; margin-top: 102px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
        $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Now</h3>';
        $return_output .= '</div>';
        $return_output .= '<div style="background-color: white; width: 170px; margin-top: 143px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
        $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . minusPercentage($price_tags[0]->price, $price_tags[0]->discount) . '</h1>';
        $return_output .= '</div>';
        $return_output .= '<div style="background-color: white; width: 170px; margin-top: 204px; height: 34px; text-align: center; position: absolute">';
        $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/brands/' . $price_tags[0]->brand->name . '-small.jpg" style="white; width: 169px; height: 34px;">';
        $return_output .= '</div>';
        $return_output .= '</div>';
        $return_output .= '</div>';

        $return_output .= '</div>';

        //2nd
        if ($price_tags[1] === '1') {
        } else {
            $return_output .= '<div style="background-color: yellow; width: 340px; height: 340px; float: right">';
            $return_output .= '<div style="background-color: white; width: 340px; height: 340px; border: solid 1px; float: left;">';
            $return_output .= '<div style="background-color: #DDEFEF; width: 340px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute;">';
            $return_output .= '<h3 style="margin-top: 10px; color: #333; margin-left: 5px; margin-right: 5px"><b>' . $price_tags[1]->name . '</b></h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: orange; margin-top: 51px; width: 340px; height: 50px; border-bottom: solid 1px;">';
            $return_output .= '<div style="background-color: white; width: 169px; height: 50px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
            $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[1]->brand->name . '</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[1]->code . '</h3>';
            $return_output .= '</div>';
            $return_output .= '</div>';

            $return_output .= '<div style="background-color: white; margin-top: 0px; width: 340px; height: 238px;">';
            $return_output .= '<div style="background-color: white; width: 169px; height: 238px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
            $return_output .= '<div style="background-color: red; margin-left: 5px; margin-top: 100px; width: 130px; height: 130px; text-align: center; position: absolute; border-radius: 65px; transform: rotate(-20deg);">';
            $return_output .= '<h1 style="margin-top: 25px; color: white; font: normal 60px">' . $price_tags[1]->discount . '%</h1>';
            $return_output .= '</div>';

            $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/store-logos/' . Auth::user()->store->name . '.jpg" style="white; width: 168px; height: 100px;">';

            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 238px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<div style="background-color: white; width: 170px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Before</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 41px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . $price_tags[1]->price . '</h1>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 102px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Now</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 143px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . minusPercentage($price_tags[1]->price, $price_tags[1]->discount) . '</h1>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 204px; height: 34px; text-align: center; position: absolute">';
            $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/brands/' . $price_tags[1]->brand->name . '-small.jpg" style="white; width: 169px; height: 34px;">';
            $return_output .= '</div>';
            $return_output .= '</div>';
            $return_output .= '</div>';

            $return_output .= '</div>';
            $return_output .= '</div>';
        }

        $return_output .= '</div>';



        $return_output .= '<div style="background-color: white; font: normal 13px Arial, sans-serif; margin-top: 50px">';
        //1st
        if ($price_tags[2] === '2') {
        } else {
            $return_output .= '<div style="background-color: white; width: 340px; height: 340px; border: solid 1px; float: left;">';
            $return_output .= '<div style="background-color: #DDEFEF; width: 340px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; color: #333; margin-left: 5px; margin-right: 5px"><b>' . $price_tags[2]->name . '</b></h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: orange; margin-top: 51px; width: 340px; height: 50px; border-bottom: solid 1px;">';
            $return_output .= '<div style="background-color: white; width: 169px; height: 50px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
            $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[2]->brand->name . '</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[2]->code . '</h3>';
            $return_output .= '</div>';
            $return_output .= '</div>';

            $return_output .= '<div style="background-color: white; margin-top: 0px; width: 340px; height: 238px;">';
            $return_output .= '<div style="background-color: white; width: 169px; height: 238px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
            $return_output .= '<div style="background-color: red; margin-left: 5px; margin-top: 100px; width: 130px; height: 130px; text-align: center; position: absolute; border-radius: 65px; transform: rotate(-20deg);">';
            $return_output .= '<h1 style="margin-top: 25px; color: white; font: normal 60px">' . $price_tags[2]->discount . '%</h1>';
            $return_output .= '</div>';

            $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/store-logos/' . Auth::user()->store->name . '.jpg" style="white; width: 168px; height: 100px;">';

            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 238px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<div style="background-color: white; width: 170px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Before</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 41px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . $price_tags[2]->price . '</h1>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 102px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Now</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 143px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . minusPercentage($price_tags[2]->price, $price_tags[2]->discount) . '</h1>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 204px; height: 34px; text-align: center; position: absolute">';
            $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/brands/' . $price_tags[2]->brand->name . '-small.jpg" style="white; width: 169px; height: 34px;">';
            $return_output .= '</div>';
            $return_output .= '</div>';
            $return_output .= '</div>';

            $return_output .= '</div>';
        }

        //2nd
        if ($price_tags[3] === '3') {
        } else {
            $return_output .= '<div style="background-color: yellow; width: 340px; height: 340px; float: right">';
            $return_output .= '<div style="background-color: white; width: 340px; height: 340px; border: solid 1px; float: left;">';
            $return_output .= '<div style="background-color: #DDEFEF; width: 340px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute;">';
            $return_output .= '<h3 style="margin-top: 10px; color: #333; margin-left: 5px; margin-right: 5px"><b>' . $price_tags[3]->name . '</b></h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: orange; margin-top: 51px; width: 340px; height: 50px; border-bottom: solid 1px;">';
            $return_output .= '<div style="background-color: white; width: 169px; height: 50px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
            $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[3]->brand->name . '</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 50px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h3 style="margin-top: 15px; color: #333;">' . $price_tags[3]->code . '</h3>';
            $return_output .= '</div>';
            $return_output .= '</div>';

            $return_output .= '<div style="background-color: white; margin-top: 0px; width: 340px; height: 238px;">';
            $return_output .= '<div style="background-color: white; width: 169px; height: 238px; border-bottom: solid 1px; text-align: center; border-right: solid 1px; position: absolute">';
            $return_output .= '<div style="background-color: red; margin-left: 5px; margin-top: 100px; width: 130px; height: 130px; text-align: center; position: absolute; border-radius: 65px; transform: rotate(-20deg);">';
            $return_output .= '<h1 style="margin-top: 25px; color: white; font: normal 60px">' . $price_tags[3]->discount . '%</h1>';
            $return_output .= '</div>';

            $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/store-logos/' . Auth::user()->store->name . '.jpg" style="white; width: 168px; height: 100px;">';

            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; margin-left: 170px; width: 170px; height: 238px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<div style="background-color: white; width: 170px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Before</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 41px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . $price_tags[3]->price . '</h1>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 102px; height: 40px; border-bottom: solid 1px; text-align: left; position: absolute">';
            $return_output .= '<h3 style="margin-top: 10px; margin-left: 10px color: #333;">Now</h3>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 143px; height: 60px; border-bottom: solid 1px; text-align: center; position: absolute">';
            $return_output .= '<h1 style="margin-top: 8px; color: #333; font: normal 35px">' . minusPercentage($price_tags[3]->price, $price_tags[3]->discount) . '</h1>';
            $return_output .= '</div>';
            $return_output .= '<div style="background-color: white; width: 170px; margin-top: 204px; height: 34px; text-align: center; position: absolute">';
            $return_output .= '<img src="http://www.acc-powertools.com/images/uploads/brands/' . $price_tags[3]->brand->name . '-small.jpg" style="white; width: 169px; height: 34px;">';
            $return_output .= '</div>';
            $return_output .= '</div>';
            $return_output .= '</div>';

            $return_output .= '</div>';
            $return_output .= '</div>';
        }



        $return_output .= '</div>';


        $pdf = App::make('dompdf.wrapper');
        $options = new \Dompdf\Options();
        // set options indvidiually
        $options->set('isRemoteEnabled', true);


        $pdf->loadHTML($return_output);



        return $pdf->stream();
    }
}

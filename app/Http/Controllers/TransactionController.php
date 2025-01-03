<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('item')->latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $items = Item::all();
        return view('transactions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $item = Item::findOrFail($request->item_id);
            
            if ($request->type == 'out' && $item->stock < $request->quantity) {
                throw new \Exception('Stock tidak mencukupi');
            }

            Transaction::create($request->all());

            // Update stock
            $item->stock += $request->type == 'in' ? $request->quantity : -$request->quantity;
            $item->save();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan');
    }
}
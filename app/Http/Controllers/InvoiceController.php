<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    public function InvoicePDF($id)
    {
        $invoice = Invoice::find($id);
        $item = Item::find($id);
    
        $pdf = Pdf::loadView('invoice', compact('invoice', 'item'));
        return $pdf->stream($invoice->invoice_number . '.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'invoice_date' => 'required|date',
            'description' => 'nullable|string',
            'item_id.*' => 'required',
            'quantity.*' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {

            $image_path = '';

            if ($request->hasFile('image')) {
                $image_path = $request->file('image')->store('logos', 'public');
            }
            $invoice = Invoice::create([
                'customer_id' => $request->input('customer_id'),
                'invoice_number' => $this->createRef(),
                'invoice_date' => $request->date('invoice_date'),
                'amount' => 0,
                'description' => $request->input('description'),
                'image' => $image_path,
            ]);

            $item_id = $request->input('item_id');
            $quantity = $request->input('quantity');
            $rate = $request->get('rate');
            $num = count($quantity);

            for($i=0;$i<$num;$i++){
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_id' => $item_id[$i],
                    'rate' => $rate[$i],
                    'amount' => $quantity[$i] * $rate[$i],
                ]);
            }

            $invoice->amount = $invoice->invoiceItems->sum('amount');
            $invoice->save();

        });

        return redirect('invoices')->with('success', 'Invoice created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        DB::transaction(function () use ($invoice) {
            foreach ($invoice->invoiceItems as $item) {
                $item->delete();
            }
            $invoice->delete();
        });
        return back()->with('success', 'Invoice deleted.');
    }

    public function rate(Request $request)
    {
        $rate = Item::find($request->get('id'));
        return response()->json($rate->sale_rate);;
    }

    private function createRef()
    {
        $offset = 5 * 60 * 60;
        $timeNdate = gmdate("d-m-Y:H:i", (time() + $offset));

        $inv = "";
        $last = Invoice::latest()->first();
        $expNum = [];
        if ($last)
        {
            $expNum = explode('/', $last->invoice_number);
        }
        $dateInfo = date_parse_from_format('d-m-Y:H:i', $timeNdate);

        if (!$last) {
            $inv = 'CO/INV/' . $dateInfo['year'] . '/' . $dateInfo['month'] . '/1';
        } else {
            $inv = 'CO/INV/' . $dateInfo['year'] . '/' . $dateInfo['month'] . '/' . ($expNum[4] + 1);
        }
        return $inv;
    }
}

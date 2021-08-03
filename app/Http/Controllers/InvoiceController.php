<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function challengeOne($invoiceId)
    {
        /*     Obtener precio total de la factura.
                Obtener todos id de las facturas que tengan productos con cantidad mayor a 100.
                Obtener todos los nombres de los productos cuyo valor final sea superior a $1.000.000 CLP. */
        try {
            $invoice = Invoice::findOrFail($invoiceId);
            $data['total'] = null;
            $data['idInvoices'] = [];
            $data['nameInvoices'] = null;
            if ( isset($invoice->products)) {
                $products = $invoice->products;
                foreach ($products as $product) {
                    $data['total'] += $product->quertity * $product->price;
                    $data['nameInvoices'][] = $product->name;
                    if ($product->quertity > 100) {
                        $data['idInvoices'][] = $product->invoice->id;
                    }
                }
                if ($data['total'] > 1000000) {
                    $data['nameInvoicesTop'] = $data['nameInvoices'];
                }
            }

            return response()->json($data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

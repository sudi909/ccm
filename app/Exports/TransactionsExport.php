<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $firstDate;
    protected $lastDate;
    protected $status;

    function __construct($firstDate, $lastDate, $status) {
        $this->firstDate = $firstDate;
        $this->lastDate = $lastDate;
        $this->status = $status;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->status == '0') {
            return Transaction::whereBetween('date', [$this->firstDate, $this->lastDate])->get();
        } else {
            return Transaction::whereBetween('date', [$this->firstDate, $this->lastDate])->where('status', $this->status)->get();
        }
    }

    public function map($transaction): array
    {
        return [
            $transaction->code,
            $transaction->date,
            $transaction->customer_name,
            $transaction->address,
            $transaction->phone_number,
            $transaction->resi,
            $transaction->shipping_price,
            $transaction->total_price,
            $transaction->grand_total,
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Tanggal',
            'Nama Penerima',
            'Alamat',
            'Nomor Telefon',
            'Nomor Resi',
            'Biaya Ongkir',
            'Harga Barang',
            'Grand Total',
        ];
    }
}

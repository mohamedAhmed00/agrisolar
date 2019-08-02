<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        ini_set('max_execution_time', 4180000);
        $data = Customer::where('id' , '<' , 280000)->where('id','>=',200000)->get();
        $data2 = array();
        $data3 = collect();
        foreach ($data as $d)
        {

            $json = json_decode($d->data);
            $data2['customer_name'] = $json->customer_name;
            $data2['firstname'] = $json->firstname;
            $data2['lastname'] = $json->lastname;
            $data2['email'] = $json->email;
            $data2['telephone'] = $json->telephone;
            $data2['fax'] = $json->fax;
            $data2['payment_address_1'] = $json->payment_address_1;
            $data2['payment_address_2'] = $json->payment_address_2;
            $data2['payment_city'] = $json->payment_city;
            $data2['payment_method'] = $json->payment_method;
            $data2['total'] = $json->total;
            $data2['date_added'] = $json->date_added;

            $data3->prepend($data2);
        }
        return $data3;
    }
}

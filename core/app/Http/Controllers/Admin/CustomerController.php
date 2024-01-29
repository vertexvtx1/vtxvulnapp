<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Customer;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    protected $pageTitle;

    public function __construct()
    {
        $this->pageTitle = 'All Customers';
    }
    protected function getCustomers()
    {
        return Customer::searchable(['name', 'mobile', 'email', 'address'], false)->with('sale', 'saleReturns')->orderBy('id', 'desc');
    }
    public function index()
    {
        $pageTitle = $this->pageTitle;
        $customers = $this->getCustomers()->paginate(getPaginate());
        return view('admin.customer.list', compact('pageTitle', 'customers'));
    }

    public function customerPDF()
    {
        $pageTitle = $this->pageTitle;
        $customers = $this->getCustomers()->get();
        return downloadPDF('pdf.customer.list', compact('pageTitle', 'customers'));
    }
    public function customerCSV()
    {
        $pageTitle = $this->pageTitle;
        $filename  = $this->downloadCsv($pageTitle, $this->getCustomers()->get());
        return response()->download(...$filename);
    }

    protected function downloadCsv($pageTitle, $data)
    {
        $filename = "assets/files/csv/example.csv";
        $myFile = fopen($filename, 'w');
        $column = "Name,Mobile,E-mail,Receivable,Payable, Address,\n";
        $curSym = gs('cur_sym');
        foreach ($data as $customer) {
            $receivable = $curSym . getAmount($customer->totalReceivableAmount());
            $payable = $curSym . getAmount($customer->totalPayableAmount());
            $address = $customer->address;

            $column .= "$customer->name,$customer->mobile,$customer->email,$receivable,$payable,$address\n";
        }
        fwrite($myFile, $column);
        $headers = [
            'Content-Type' => 'application/csv',
        ];
        $name = $pageTitle . time() . '.csv';
        $array = [$filename, $name, $headers];
        return $array;
    }

    public function store(Request $request, $id = 0)
    {
        $this->validation($request, $id);
        if ($id) {
            $notification = 'Customer updated successfully';
            $customer =  Customer::findOrFail($id);
        } else {
            $exist = Customer::where('mobile', $request->mobile)->first();
            if ($exist) {
                $notify[] = ['error', 'The mobile number already exists'];
                return back()->withNotify($notify);
            }
            $notification = 'Customer added successfully';
            $customer =  new Customer();
        }

        $customer->name    = $request->name;
        $customer->email   = strtolower(trim($request->email));
        $customer->mobile  = $request->mobile;
        $customer->address = $request->address;
        $customer->save();

        Action::newEntry($customer, $id ? 'UPDATED' : 'CREATED');

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    protected function validation($request, $id = 0)
    {
        $request->validate([
            'name'     => 'required|string|max:40',
            'email'    => 'string|email|unique:suppliers,email,' . $id,
            'mobile'   => 'required|regex:/^([0-9]*)$/|unique:suppliers,mobile,' . $id,
            'address'  => 'string|max:500',
        ]);
    }

    //Notification
    public function showNotificationSingleForm($id)
    {
        $customer = Customer::findOrFail($id);
        $general = gs();
        $pageTitle = 'Send Notification to ' . $customer->name;
        return view('admin.customer.notification_single', compact('pageTitle', 'customer'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $customer = Customer::findOrFail($id);
        notify($customer, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return back()->withNotify($notify);
    }

    public function showNotificationAllForm()
    {
        $general = gs();
        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }
        $customers = Customer::count();
        $pageTitle = 'Notification to All Customers';
        return view('admin.customer.notification_all', compact('pageTitle', 'customers'));
    }

    public function sendNotificationAll(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start'   => 'required',
            'batch'   => 'required',
        ]);
        if ($validator->fails()) return response()->json(['error' => $validator->errors()->all()]);
        $customers = Customer::oldest()->skip($request->start)->limit($request->batch)->get();
        foreach ($customers as $customer) {
            notify($customer, 'DEFAULT', [
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
        }
        return response()->json([
            'total_sent' => $customers->count(),
        ]);
    }


    public function notificationLog($id)
    {
        $customer = Customer::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $customer->name;
        $logs = NotificationLog::where('customer_id', $id)->with('customer')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.customer.notification_history', compact('pageTitle', 'logs', 'customer'));
    }

    public function emailDetails($id)
    {
        $pageTitle = 'Email Details';
        $email = NotificationLog::findOrFail($id);
        return view('admin.customer.email_details', compact('pageTitle', 'email'));
    }

    public function import(Request $request)
    {
        $reqHeader = ['name', 'email', 'mobile', 'address'];
        $importResult = importCSV($request, Customer::class, $reqHeader, $unique = "mobile");

        if ($importResult['data']) {
            $notify[] = ['success', $importResult['notify']];
        } else {
            $notify[] = ['error', 'No new data imported'];
        }
        return back()->withNotify($notify);
    }
}

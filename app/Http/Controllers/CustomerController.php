<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class CustomerController extends Controller
{
    private $title = "Customer";
    private $subtitle = "Pengelolaan Customer";
    private $path = 'customer/search';

    public function index() {
        Session::forget('q');   
        return redirect()->route('customer.search');
    }

    public function search()
    {
        $q = Session::get('q');   
        $data['q'] = $q;
        
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
       
        $page = request()->has('page') ? request('page') : 1;
        $perPage = request()->has('per_page') ? request('per_page') : 10;
        $offset = ($page * $perPage) - $perPage;

        $uri = Curl::endpoint();
        $url = $uri .'/'.'customer';
        $param = array(
            'limit'   => $perPage,
            'offset'  => $offset,
            'search'    => (($q == null)?"":$q),
        );

        $res = Curl::postRequest($url, $param);

        if($res->status == 200) {
            $newCollection = collect($res->data->customersData);
            $results =  new LengthAwarePaginator(
                $newCollection,
                count($newCollection),
                $perPage,
                $page,
                ['path' => url($this->path)]
            );
        }
        else {
            $newCollection = array();
            $results =  new LengthAwarePaginator(
                $newCollection,
                0,
                $perPage,
                $page,
                ['path' => url($this->path)]
            );
        }
        return view('customer.index', $data, compact('results'));
    }

    public function filter(Request $request)
    {
        if($request->has('_token')) {
            $q = $request->q;
            Session::put('q', $q); 
            
            return redirect()->route('customer.search');
        } else {
            return redirect()->route('customer.index');
        }
    }

    public function create()
    {
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;

        return view('customer.create', $data);
    }

    public function store(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'customer/create';

        $name  = $request->name;
        $phoneNumber  = $request->phoneNumber;
        $email  = $request->email;
        $address  = $request->address;

        $param = array(
            'name'   => $name,
            'phoneNumber'   => $phoneNumber,
            'email'   => $email,
            'address'   => $address,
            'status'   => true,
        );

        $res = Curl::requestPost($url, $param);

        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('customer.index');
    }
    public function show($id)
    {
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
       
        $uri = Curl::endpoint();

        $url = $uri .'/'.'customer';
        $res = Curl::requestGet($url.'/'.$id);
       
        if($res->status == 200) {
            $data['info'] = $res->data; 
        }
        else {
            return redirect()->route('error.index');  
        }

        return view('customer.edit', $data);
    }
    public function update(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'customer';

        $id        = $request->id;
        $name  = $request->name;
        $phoneNumber  = $request->phoneNumber;
        $email  = $request->email;
        $address  = $request->address;
        $status  = $request->status;

        $param = array(
            'name'   => $name,
            'phoneNumber'   => $phoneNumber,
            'email'   => $email,
            'address'   => $address,
            'status'   => $status,
        );

        $res = Curl::requestPut($url.'/'.$id, $param);
        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('customer.search');
    }

    public function destroy($id)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'customer';
        $res = Curl::requestDelete($url.'/'.$id);

        Session::flash('alrt', (($res->status == 200)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('customer.search');
    }
}

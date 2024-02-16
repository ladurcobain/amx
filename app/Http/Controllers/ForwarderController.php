<?php

namespace App\Http\Controllers;

use App\Helpers\Curl;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class ForwarderController extends Controller
{
    private $title = "Forwarder";
    private $subtitle = "Pengelolaan Forwarder";
    private $path = 'forwarder/search';

    public function index() 
    {
        Session::forget('q');   
        return redirect()->route('forwarder.search');
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
        $url = $uri .'/'.'forwarder';
        $param = array(
            'limit'   => $perPage,
            'offset'  => $offset,
            'search'  => (($q == null) ? "" : $q),
        );

        $res = Curl::postRequest($url, $param);

        if ($res->status == 200) {
            $newCollection = collect($res->data->forwardersData);
            $results =  new LengthAwarePaginator(
                $newCollection,
                count($newCollection),
                $perPage,
                $page,
                ['path' => url($this->path)]
            );
        } else {
            $newCollection = array();
            $results =  new LengthAwarePaginator(
                $newCollection,
                0,
                $perPage,
                $page,
                ['path' => url($this->path)]
            );
        }

        return view('forwarder.index', $data, compact('results'));
    }

    public function filter(Request $request)
    {
        if ($request->has('_token')) {
            $q = $request->q;
            Session::put('q', $q); 
            
            return redirect()->route('forwarder.search');
        } else {
            return redirect()->route('forwarder.index');
        }
    }

    public function create()
    {
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;

        $uri = Curl::endpoint();

        $urlProvinsi = $uri .'/'.'province';
        $param = array(
            "name"   => null,
            "status" => null
        );

        $data['resProvinsi'] = Curl::requestPost($urlProvinsi, $param)->data->provincesData;

        return view('forwarder.create', $data);
    }

    public function store(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'forwarder/create';

        $name  = $request->name;
        $originProvince  = $request->originProvince;
        $destinationProvince  = $request->destinationProvince;

        $param = array(
            'name'                => $name,
            'originProvince'      => $originProvince,
            'destinationProvince' => $destinationProvince,
            'status'              => true
        );

        $res = Curl::requestPost($url, $param);

        Session::flash('alrt', (($res->status == 201) ? 'success' : 'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('forwarder.index');
    }

    public function show($id)
    {
        return redirect()->route('forwarder.index');
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
       
        $uri = Curl::endpoint();

        $urlProvinsi = $uri .'/'.'province';
        $param = array(
            "name" => null,
            "status" => null
        );

        $data['resProvinsi'] = Curl::requestPost($urlProvinsi, $param)->data->provincesData;

        $url = $uri .'/'.'forwarder';
        $res = Curl::requestGet($url.'/'.$id);
       
        if ($res->status == 200) {
            $data['info'] = $res->data; 
        } else {
            return redirect()->route('error.index');  
        }

        return view('forwarder.edit', $data);
    }

    public function update(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'forwarder';

        $id = $request->id;
        $name  = $request->name;
        $originProvince  = $request->originProvince;
        $destinationProvince  = $request->destinationProvince;
        $status = $request->status;

        $param = array(
            'name'                => $name,
            'originProvince'      => $originProvince,
            'destinationProvince' => $destinationProvince,
            'status'              => $status
        );

        $res = Curl::requestPut($url.'/'.$id, $param);
        Session::flash('alrt', (($res->status == 201) ? 'success' : 'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('forwarder.search');
    }

    public function destroy($id)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'forwarder';
        $res = Curl::requestDelete($url.'/'.$id);

        Session::flash('alrt', (($res->status == 200) ? 'success' : 'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('forwarder.search');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class KotaController extends Controller
{
    private $title = "Kota";
    private $subtitle = "Pengelolaan Kota";
    private $path = 'kota/search';

    public function index() {
        Session::forget('q');   
        return redirect()->route('kota.search');
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
        $url = $uri .'/'.'city';
        $param = array(
            'limit'   => $perPage,
            'offset'  => $offset,
            'search'    => (($q == null)?"":$q),
        );

        $res = Curl::postRequest($url, $param);

        if($res->status == 200) {
            $newCollection = collect($res->data->citiesData);
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
        return view('kota.index', $data, compact('results'));
    }

    public function filter(Request $request)
    {
        if($request->has('_token')) {
            $q = $request->q;
            Session::put('q', $q); 
            
            return redirect()->route('kota.search');
        } else {
            return redirect()->route('kota.index');
        }
    }

    public function create()
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

        return view('kota.create', $data);
    }

    public function store(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'city/create';

        $name  = $request->name;
        $provinceId  = $request->provinceId;

        $param = array(
            'name'   => $name,
            'provinceId'   => $provinceId,
            'status'   => true
        );

        $res = Curl::requestPost($url, $param);


        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('kota.index');
    }
    public function show($id)
    {
        return redirect()->route('kota.index');
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

        $url = $uri .'/'.'city';
        $res = Curl::requestGet($url.'/'.$id);
       
        if($res->status == 200) {
            $data['info'] = $res->data; 
        }
        else {
            return redirect()->route('error.index');  
        }

        return view('kota.edit', $data);
    }
    public function update(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'city';

        $id        = $request->id;
        $name  = $request->name;
        $provinceId  = $request->provinceId;
        $status  = $request->status;

        $param = array(
            'name'   => $name,
            'provinceId'   => $provinceId,
            'status'   => $status,
        );

        $res = Curl::requestPut($url.'/'.$id, $param);
        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('kota.search');
    }

    public function destroy($id)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'city';
        $res = Curl::requestDelete($url.'/'.$id);

        Session::flash('alrt', (($res->status == 200)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('kota.search');
    }
}

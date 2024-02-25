<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class ServiceController extends Controller
{
    private $title = "Layanan";
    private $subtitle = "Pengelolaan Layanan";
    private $path = 'layanan/search';

    public function index() {
        Session::forget('q');   
        return redirect()->route('layanan.search');
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
        $url = $uri .'/'.'service';
        $param = array(
            'limit'   => $perPage,
            'offset'  => $offset,
            'search'    => (($q == null)?"":$q),
        );

        $res = Curl::postRequest($url, $param);

        if($res->status == 200) {
            $newCollection = collect($res->data->ServicesData);
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
        return view('layanan.index', $data, compact('results'));
    }

    public function filter(Request $request)
    {
        if($request->has('_token')) {
            $q = $request->q;
            Session::put('q', $q); 
            
            return redirect()->route('layanan.search');
        } else {
            return redirect()->route('layanan.index');
        }
    }

    public function create()
    {
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;

        return view('layanan.create', $data);
    }

    public function store(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'service/create';

        $deskripsi  = $request->deskripsi;

        $param = array(
            'description'   => $deskripsi
        );

        $res = Curl::requestPost($url, $param);

        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('layanan.index');
    }
    public function show($id)
    {
        return redirect()->route('layanan.index');
    }

    public function edit($id)
    {
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
       
        $uri = Curl::endpoint();

        $url = $uri .'/'.'service';
        $res = Curl::requestGet($url.'/'.$id);
       
        if($res->status == 200) {
            $data['info'] = $res->data; 
        }
        else {
            return redirect()->route('error.index');  
        }

        return view('layanan.edit', $data);
    }
    public function update(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'service';

        $id        = $request->id;
        $deskripsi  = $request->deskripsi;

        $param = array(
            'description'   => $deskripsi,
        );

        $res = Curl::requestPut($url.'/'.$id, $param);
        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('layanan.search');
    }

    public function destroy($id)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'service';
        $res = Curl::requestDelete($url.'/'.$id);

        Session::flash('alrt', (($res->status == 200)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('layanan.search');
    }
}

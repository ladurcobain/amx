<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Module;
use App\Helpers\Curl;
use App\Helpers\Status;
use GuzzleHttp\Client;
use Session;

class UserController extends Controller
{
    private $title = "Pengguna";
    private $subtitle = "Pengelolaan Pengguna";
    private $path = 'user/search';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        // unset session
		Session::forget('q');   
        return redirect()->route('user.search');
	}

    public function search()
    {
        // $arrmenu = Session::get('access');
        // if (!in_array($this->module, $arrmenu)) {
        //      return redirect()->route('error.index');
        // }

        $q = Session::get('q');   
        $data['q'] = $q;
        
        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
       
        $page = request()->has('page') ? request('page') : 1;
        $perPage = request()->has('per_page') ? request('per_page') : 10;
        $offset = ($page * $perPage) - $perPage;

        $uri = Curl::endpoint();
        $url = $uri .'/'.'user';
        $param = array(
            'limit'   => $perPage,
            'offset'  => $offset,
            'search'    => (($q == null)?"":$q),
        );

        $res = Curl::postRequest($url, $param);

        if($res->status == 200) {
            $newCollection = collect($res->data->usersData);
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
        
        
        return view('user.index', $data, compact('results'));
    }

    public function filter(Request $request)
    {
        if($request->has('_token')) {
            $q = $request->q;
            Session::put('q', $q); 
            
            return redirect()->route('user.search');
        } else {
            return redirect()->route('user.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $arrModule = Session::get('access');
        // if (!in_array($this->module, $arrModule)) {
        //      return redirect()->route('error.index');
        // }

        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
        
        // $data['roles']   = Module::getActiveRole();
        // $data['satkers'] = Module::getActiveSatker();

        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'user/create';

        $username  = $request->username;
        $password  = $request->password;


        $fullname  = $username;
        $param = array(
            'username'   => $username,
            'password'   => $password
        );

        $res = Curl::requestPost($url, $param);

        // if($request->hasFile('userfile')) {
        //     $file = request('userfile');
        //     $file_path = $file->getPathName();
        //     $file_mime = $file->getClientMimeType();
        //     $file_uploaded_name = $file->getClientOriginalName('');

        //     $client = new Client();
        //     $response = $client->request('POST', $url, [
        //         'connect_timeout' => 10,
        //         'multipart' => [
        //             [
        //                 'name'      => 'userfile',
        //                 'filename'  => $file_uploaded_name,
        //                 'mime-type' => $file_mime,
        //                 'contents'  => fopen($file_path, 'r'),
        //             ],
        //             [
        //                 'name'      => 'username',
        //                 'contents'  => $request->account,
        //             ],
        //             [
        //                 'name'      => 'password',
        //                 'contents'  => $request->password,
        //             ],
        //             [
        //                 'name'      => 'code',
        //                 'contents'  => $request->code,
        //             ],
        //             [
        //                 'name'      => 'fullname',
        //                 'contents'  => $request->fullname,
        //             ],
        //             [
        //                 'name'      => 'email',
        //                 'contents'  => $request->email,
        //             ],
        //             [
        //                 'name'      => 'status',
        //                 'contents'  => (($request->status == 1)? 1:0),
        //             ],
        //             [
        //                 'name'      => 'type',
        //                 'contents'  => $request->type,
        //             ],
        //             [
        //                 'name'      => 'role_id',
        //                 'contents'  => (($request->type == 1)? $request->role:null),
        //             ],
        //             [
        //                 'name'      => 'satker_id',
        //                 'contents'  => (($request->type == 2)? $request->satker:null),
        //             ],
        //             [
        //                 'name'      => 'last_user',
        //                 'contents'  => Session::get('user_id'),
        //             ]
        //         ]
        //     ]);
            
        //     if($response->getStatusCode() == 200) {
        //         $body = json_decode($response->getBody());
        //         if($body != "") {
        //             $res = $body;
        //         }
        //         else {
        //             $res = json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
        //         }
        //     }
        //     else {
        //         $res = json_decode('{"status": false, "message": "Kesalahan respon server", "data": "[]"}');
        //     }
        // }
        // else {
        //     $param = array(
        //         'username'   => $request->account,
        //         'password'   => $request->password,
        //         'code'       => $request->code,
        //         'fullname'   => $request->fullname,
        //         'email'      => $request->email,
        //         'type'       => $request->type,
        //         'role_id'    => (($request->type == 1)? $request->role:null),
        //         'satker_id'  => (($request->type == 2)? $request->satker:null),
        //         'last_user'  => Session::get('user_id')
        //     );
    
        //     $res = Curl::requestPost($url, $param);
        // }

        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $arrModule = Session::get('access');
        // if (!in_array($this->module, $arrModule)) {
        //      return redirect()->route('error.index');
        // }

        $data['title'] = $this->title;
        $data['subtitle'] = $this->subtitle;
       
        $uri = Curl::endpoint();
        $url = $uri .'/'.'user';
        $res = Curl::requestGet($url.'/'.$id);

        if($res->status == 200) {
            $data['info'] = $res->data; 
        }
        else {
            return redirect()->route('error.index');  
        }

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'user';

        $id        = $request->id;
        $username  = $request->fullname;
        //$password  = $request->password;


        $fullname  = $username;
        $param = array(
            'username'   => $username,
            //'password'   => $password
        );

        $res = Curl::requestPut($url.'/'.$id, $param);

        // $uri = Curl::endpoint();
        // $url = $uri .'/'.'user/update-data';
     
        // if($request->hasFile('userfile')) {
        //     $file = request('userfile');
        //     $file_path = $file->getPathName();
        //     $file_mime = $file->getClientMimeType();
        //     $file_uploaded_name = $file->getClientOriginalName('');

        //     $client = new Client();
        //     $response = $client->request('POST', $url, [
        //         'connect_timeout' => 10,
        //         'multipart' => [
        //             [
        //                 'name'      => 'userfile',
        //                 'filename'  => $file_uploaded_name,
        //                 'mime-type' => $file_mime,
        //                 'contents'  => fopen($file_path, 'r'),
        //             ],
        //             [
        //                 'name'      => 'user_id',
        //                 'contents'  => $request->user_id,
        //             ],
        //             [
        //                 'name'      => 'fullname',
        //                 'contents'  => $request->fullname,
        //             ],
        //             [
        //                 'name'      => 'email',
        //                 'contents'  => $request->email,
        //             ],
        //             [
        //                 'name'      => 'status',
        //                 'contents'  => (($request->status == 1)? 1:0),
        //             ],
        //             [
        //                 'name'      => 'user_image',
        //                 'contents'  => $request->user_image,
        //             ],
        //             [
        //                 'name'      => 'last_user',
        //                 'contents'  => Session::get('user_id'),
        //             ]
        //         ]
        //     ]);
            
        //     if($response->getStatusCode() == 200) {
        //         $body = json_decode($response->getBody());
        //         if($body != "") {
        //             $res = $body;
        //         }
        //         else {
        //             $res = json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
        //         }
        //     }
        //     else {
        //         $res = json_decode('{"status": false, "message": "Kesalahan respon server", "data": "[]"}');
        //     }
        // }
        // else {
        //     $param = array(
        //         'user_id'       => $request->user_id,
        //         'user_image'    => $request->user_image,
        //         'status'        => (($request->status == 1)? 1:0),
        //         'fullname'      => $request->fullname,
        //         'email'         => $request->email,
        //         'last_user'     => Session::get('user_id')
        //     );
            
        //     $res = Curl::requestPost($url, $param);
        // }
        
        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('user.search');
    }

    public function password(Request $request)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'user';

        $id        = $request->id;
        $password  = $request->password;

        $param = array(
            'password'   => $password
        );

        $res = Curl::requestPut($url.'/'.$id, $param);

        Session::flash('alrt', (($res->status == 201)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('user.search');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uri = Curl::endpoint();
        $url = $uri .'/'.'user';
        $res = Curl::requestDelete($url.'/'.$id);

        Session::flash('alrt', (($res->status == 200)?'success':'error'));    
        Session::flash('msgs', $res->message);  

        return redirect()->route('user.search');
    }
}
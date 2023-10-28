<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $helpers = ['Form'];

    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new KelasModel();
    }

    public function show($id){
        $user = $this->userModel->getUser($id);

        $data = [
            'title' => 'Profile',
            'user'  => $user,
        ];
        return view('profile', $data);
    }

    public function index()
    {
        $data = [
            'title' => 'List User',
            'user' => $this->userModel->getUser(),
        ];
        return view('list_user', $data);
    }
    public function profile($nama = "", $kelas = "", $npm = "")
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm,
        ];
        return view('profile', $data);
    }
    public function create()
    {
        $kelas = $this->kelasModel->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
    }

    public function store()
    {

        //validasi input
        if (
            !$this->validate([
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong'
                    ]
                ],
                'npm' => [
                    'rules' => 'required|is_unique[user.npm]',
                    'errors' => [
                        'required' => 'Tidak Boleh Kosong',
                        'is_unique' => 'NPM Sudah Terpakai'
                    ]
                ]
            ])
        ) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $path = 'assets/uploads/img/';

        $foto = $this->request->getFile('foto');

        $name = $foto->getRandomName();

        if ($foto->move($path, $name)) {
            $foto = base_url($path . $name);
        }

        $this->userModel->saveUser([
            'nama'     => $this->request->getVar('nama'),
            'id_kelas' => $this->request->getVar('kelas'),
            'npm'      => $this->request->getVar('npm'),
            'foto'     => $foto
        ]);

        $data = [
            'title' => 'Create User',
            'nama' => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'npm' => $this->request->getVar('npm'),
        ];
        return redirect()->to('/user');
    }

    public function edit($id){
        $user = $this->userModel->getUser($id);
        $kelas = $this->kelasModel->getKelas();

        $data = [
            'title' => 'Edit User',
            'user'  => $user,
            'kelas' => $kelas,
        ];
        return view('edit_user', $data);
    }

    public function update($id){
        $path = 'assets/uploads/img/';

        $foto = $this->request->getFile('foto');

        $data = [
            'nama'      => $this->request->getVar('nama'),
            'id_kelas'  => $this->request->getVar('kelas'),
            'npm'       => $this->request->getVar('npm'),
            'foto'      => $foto_path,
        ];

        if ($foto->isValid()){
            $name = $foto->getRandomName();;

            if ($foto->move ($path, $name)){
                $foto_path = base_url($path . $name);
            }
        }

        $result = $this->userModel->updateUser($data, $id);

        if(!$result){
            return redirect()->back()->withInput()
            ->with('error', 'Gagal Menyimpan Data');
        }

        return redirect()->to('/user');
    }

    /**
     * @return mixed
     */
    public function getHelpers()
    {
        return $this->helpers;
    }

    /**
     * @param mixed $helpers 
     * @return self
     */
    public function setHelpers($helpers): self
    {
        $this->helpers = $helpers;
        return $this;
    }
}
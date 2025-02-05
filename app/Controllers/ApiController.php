<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    protected $modelName = 'App\Models\UsuarioModel';
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $usuario = $this->model->find($id);
        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado.');
        }
        return $this->respond($usuario);
    }

    public function create()
    {
        $data = $this->request->getJSON(true); // Obtiene los datos en JSON como array asociativo

        if (empty($data)) {
            return $this->fail('No se recibieron datos.', 400);
        }

        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }

        return $this->respondCreated(['message' => 'Usuario creado correctamente']);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $usuario = $this->model->find($id);

        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado.');
        }

        $this->model->update($id, $data);
        return $this->respond(['message' => 'Usuario actualizado correctamente.']);
    }


    public function delete($id = null)
    {
        $usuario = $this->model->find($id);

        if (!$usuario) {
            return $this->failNotFound('Usuario no encontrado.');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Usuario eliminado correctamente.']);
    }
}

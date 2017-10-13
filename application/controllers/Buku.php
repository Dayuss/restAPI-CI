<?php

require APPPATH . '/libraries/REST_Controller.php';

class Buku extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get() {
        $id = $this->get('id');
        if (!isset($id)) {
            $buku = $this->db->get('buku')->result();
        } else {
            $this->db->where('id', $id);
            $buku = $this->db->get('buku')->result();
        }
        $this->response($buku, 200);
    }

    function index_post() {
        $data   =  $this->post();
        $insert = $this->db->insert('buku', $data);
        if ($insert) {
            $this->response(array('status' => 'Berhasil masuk'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = $this->put();
        unset($data['id']);
        $this->db->where('id', $id);
        $update = $this->db->update('buku', $data);
        if ($update) {
            $this->response(array('status' => 'Berhasil diupdate.'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('buku');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}

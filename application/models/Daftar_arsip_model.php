<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_arsip_model extends CI_Model
{

    public $table = 'daftar_arsip';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,no_berkas,no_item_arsip,kode_klasifikasi,uraian,tgl_registrasi,jumlah,keterangan');
        $this->datatables->from('daftar_arsip');
        //add this line for join
        //$this->datatables->join('table2', 'daftar_arsip.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('daftar_arsip/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm'))." 
                ".anchor(site_url('daftar_arsip/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-warning btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('no_berkas', $q);
	$this->db->or_like('no_item_arsip', $q);
	$this->db->or_like('kode_klasifikasi', $q);
	$this->db->or_like('uraian', $q);
	$this->db->or_like('tgl_registrasi', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('no_berkas', $q);
	$this->db->or_like('no_item_arsip', $q);
	$this->db->or_like('kode_klasifikasi', $q);
	$this->db->or_like('uraian', $q);
	$this->db->or_like('tgl_registrasi', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Daftar_arsip_model.php */
/* Location: ./application/models/Daftar_arsip_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-09-06 05:08:41 */
/* http://harviacode.com */
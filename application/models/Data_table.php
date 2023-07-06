<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_table extends CI_MOdel {
    var $column = array('CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country');
    public function __construct(){
        parent::__construct();
       
    }
    public function fetchcity(){
        // $this->db->select('*');
        // $this->db->from('product');
        // $query = $this->db->get();
        // return $query->result();
        $sql="SELECT DISTINCT Country FROM tbl_customer ORDER BY Country ASC";    
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_all()
    {
        $this->db->from('tbl_customer');
        
        return $this->db->count_all_results();
    }
    private function _get_datatables_query()
    {
        //echo $Property_type_group;die;filter_country
            $value =1;
           
           $gender = (isset($_POST['filter_gender']))? $_POST['filter_gender']:'';
           $country = (isset($_POST['filter_country']))? $_POST['filter_country']:'';
          
        $this->db->select('*');
        $this->db->from('tbl_customer');
        // $this->db->join('area AS a', 'p.area = a.area_id', 'left');
        // $this->db->join('location AS l', 'p.location = l.location_id', 'left');
        // $this->db->join('city AS c', 'p.city_name = c.city_id', 'left');
        // $this->db->join('all_states as al', 'al.state_code=p.state','left');
        // $this->db->join('tenants AS t', 't.id = p.tanantId', 'left');
        // $this->db->join('hundi AS h', 'h.id = p.agent', 'left');
        if (!empty($gender)) {
            $this->db->where_in('Gender', $gender);
        }
        if (!empty($country)) {
            $this->db->where('Country', $country);
        }
        
        //$this->db->order_by('p.id','DESC');
        $this->db->order_by("CustomerID","DESC");
        $i = 0;
    
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        //echo  $this->db->last_query();die;
        $query = $this->db->get();
        //echo "sql". $this->db->last_query();die;
        //echo $query
        return $query->result_array();
    }

    
}

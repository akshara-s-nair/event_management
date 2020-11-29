<?php
require('findallModel.php');
class customerModel implements JsonSerializable{
    private $fname;
    private $lname;
    private $aadhar;
    private $phone;
    private $city;
    private $address;
    protected $cust_id;

    function __construct($id=false)
    {
        if($id){
            $data = getrow($id);
            if($data){
            $this->fname=$data['FIRST_NAME'];
            $this->lname=$data['LAST_NAME'];
            $this->aadhar = $data['AADHAR_NUM'];
            $this->city = $data['CITY_NAME'];
            $this->phone = $data['CUST_PHONE'];
            $this->address = $fata['HOUSE_NAME'];
            $this->cust_id = $id;
            }
            
        }

    }
    function register($fname,$lname,$aadhar,$city,$phone,$address,$con)
    {
        $this->fname=$fname;
        $this->lname=$lname;
        $this->aadhar = $aadhar;
        $this->city = $city;
        $this->phone = $phone;
        $this->address = $address;
        $this->addCustomer($con);
    }

        private function addCustomer($con){
        $stmp = $con->prepare("INSERT into customer( FIRST_NAME, LAST_NAME, AADHAR_NUM, HOUSE_NAME, CITY_NAME, CUST_PHONE) VALUES (?,?,?,?,?,?)");
        $stmp->bind_param("ssssss",$fname,$lname,$aadhar,$address,$city,$phone);
        $fname = $this->fname;
        $lname = $this->lname;
        $aadhar = $this->aadhar;
        $address = $this->address;
        $city = $this->city;
        $phone = $this->phone;
        if ($stmp->execute()){
            $this->$usr_id = $this->returnId($con);
        }
        else{
            return 'false';
        }
        $stmp->close();

    }

    private function returnId($con){
        $s = $con->prepare("SELECT CUST_ID FROM customer WHERE AADHAR_NUM = ?");
        $s->bind_param("s",$this->aadhar);
        $s->execute();
        $res = $s->get_result();
        $s->close();
        $res_array = $res->fetch_assoc();
        return $res_array['CUST_ID'];
        
        
    }
    
    public function jsonSerialize()
    {
        return 
        [
            'FIRST_NAME' $this->fname;
            'LAST_NAME' => $this->lname;
            'AADHAR_NUM' => $this->aadhar;
            'CUST_PHONE' => $this->phone;
            'CITY_NAME' => $this->city;
            'HOUSE_NAME' => $this->address;
            'CUST_ID' => $this->usr_id;
            
        ];
    }
    

}

?>
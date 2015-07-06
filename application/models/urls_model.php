<?php
/**
 * Created by PhpStorm.
 * User: jairo
 * Date: 05/07/15
 * Time: 22:57
 */

 if ( ! defined('BASEPATH')) exit('No direct script access
allowed');

  class Urls_model extends CI_Model{

      function __construct(){
          parent::__construct();
      }

      function  save_url($data){
          /*
           *
Vamos ver se o código único já existe no
a base de dados. Se existir, em seguida, fazer uma nova
uma e vamos verificar se que existe também.
Mantenha fazer novos até que ele é único.
Quando fazemos um que é original, usá-lo para o nosso url*/

        do{
            $url_code = random_string('alnum',8);
            $this->db->where('url_code = ', $url_code);
            $this->db->from('urls');
            $num = $this->db->count_all_results();
        }while($num >=1);
          $query = "INSERT INTO `urls` (`url_code`, `url_address`) VALUES (?,?)";
          $result = $this->db->query($query, array($url_code, $data['url_address']));
          if($result){
          return $url_code;
          }else{
              return false;
          }
      }

      function fetch_url($url_code){
          $query = "SELECT * FROM `url` WHERE `urls_code` = ?";
          $result = $this->db->query($query, array($url_code));
          if($result){
              return $result;
          }else{
              return false;
          }
      }
  }

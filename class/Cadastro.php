<?php
date_default_timezone_set('America/Sao_Paulo');
class Cadastro{
	private $db;
	
	public function __construct(){
		$file = file_get_contents('class/config.json');
		$options = json_decode($file, true);

		$config = array();

		$config['db'] = $options['db'];
		$config['host'] = $options['localhost'];
		$config['user'] = $options['user'];
		$config['pass'] = $options['pass'];

		try {
			$this->db = new PDO("mysql:dbname=".$config['db'].";host=".$config['host']."", "".$config['user']."", "".$config['pass']."");
		} catch(PDOException $e) {
			echo "FALHA: ".$e->getMessage();
		}
	}

	

	//INSERIR AGENDA
	public function setAgenda($lembrete, $data){		
		$sql = $this->db->prepare("
			INSERT INTO agenda 
			SET lembrete = :lembrete,
			data = :data");
		$sql->bindValue(':lembrete', $lembrete);
		$sql->bindValue(':data', $data);
		$sql->execute();

		return true;
	}

	//RETORNAR AGENDA
	public function getAgendas(){
		$sql = $this->db->prepare('SELECT * FROM agenda WHERE MONTH(data) = :mes AND YEAR(data) = :ano');
		$sql->bindValue(':mes', date('m'));
		$sql->bindValue(':ano', date('Y'));
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAgendasData($data){
		$sql = $this->db->prepare('SELECT * FROM agenda WHERE data = :data');
		$sql->bindValue(':data', $data);
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	
}
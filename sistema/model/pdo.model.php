<?php
	class Conexao {
		private $host = 'localhost';
		private $dbname = 'imobi065_fettine';
		private $user = 'root';
		private $pass = 'alvaro01021998';

		public function conectar() {
			try {
				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->dbname",
					"$this->user",
					"$this->pass"				
				);

				return $conexao;
				
			} catch (PDOException $e) {
				// echo '<p>'.$e->getMessege().'</p>';
			}
		}
	}
?>
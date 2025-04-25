<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Page extends Model
	{
		public function getById($id)
		{
			return $this->findOne("SELECT * FROM Page WHERE id=$id");
		}
		
		public function getByRange($from, $to)
		{
			return $this->findMany("SELECT * FROM Page WHERE id>=$from AND id<=$to");
		}
	}
?>
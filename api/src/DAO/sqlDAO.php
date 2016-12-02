<?php

namespace Manager\DAO;

use Doctrine\DBAL\Connection;
use Manager\Model\Emotion;

class sqlDAO
{
	private $db;

	public function __construct(Connection $db)
	{
		$this->db = $db;
	}
    public function insertDomain($name)
    {
         $sql = "insert into Domain(name,savedOn) value (?,NOW());";
          $result = $this->db->executeQuery($sql,[$name]);
          return (int)$this->db->fetchArray("SELECT LAST_INSERT_ID();")[0];
    }
	

        public function insertMat($idDom,$name)
    {
         $sql = "insert into matiere(refDom,name,savedOn) value (?,?,NOW())";
          $result = $this->db->executeQuery($sql,[$idDom,$name]);
           return (int)$this->db->fetchArray("SELECT LAST_INSERT_ID();")[0];
    }

         public function insertChap($idMat,$name)
    {
         $sql = "insert into chapitre(refMat,name,savedOn) value (?,?,NOW())";
          $result = $this->db->executeQuery($sql,[$idMat,$name]);
           return (int)$this->db->fetchArray("SELECT LAST_INSERT_ID();")[0];
    }

    public function getAll()
    {
         $sql ="select domain.id as idDom,domain.name as nameDom,matiere.id as idMat,matiere.name as nameMat,chapitre.id as idChap,chapitre.name as nameChap from domain RIGHT join matiere on domain.id=matiere.refDom RIGHT join chapitre on matiere.id = chapitre.refMat UNION
select domain.id as idDom,domain.name as nameDom,matiere.id as idMat,matiere.name as nameMat,chapitre.id as idChap,chapitre.name as nameChap from domain LEFT join matiere on domain.id=matiere.refDom LEFT join chapitre on matiere.id = chapitre.refMat ORDER BY idDom, idMat,idChap";
          return $this->db->fetchAll($sql);
    }

}
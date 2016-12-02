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
         $sql = "insert into Matiere(refDom,name,savedOn) value (?,?,NOW())";
          $result = $this->db->executeQuery($sql,[$idDom,$name]);
           return (int)$this->db->fetchArray("SELECT LAST_INSERT_ID();")[0];
    }

         public function insertChap($idMat,$name)
    {
         $sql = "insert into Chapitre(refMat,name,savedOn) value (?,?,NOW())";
          $result = $this->db->executeQuery($sql,[$idMat,$name]);
           return (int)$this->db->fetchArray("SELECT LAST_INSERT_ID();")[0];
    }

    public function getAll()
    {
         $sql ="select Domain.id as idDom,Domain.name as nameDom,Matiere.id as idMat,Matiere.name as nameMat,Chapitre.id as idChap,Chapitre.name as nameChap from Domain RIGHT join Matiere on Domain.id=Matiere.refDom RIGHT join Chapitre on Matiere.id = Chapitre.refMat UNION
select Domain.id as idDom,Domain.name as nameDom,Matiere.id as idMat,Matiere.name as nameMat,Chapitre.id as idChap,Chapitre.name as nameChap from Domain LEFT join Matiere on Domain.id=Matiere.refDom LEFT join Chapitre on Matiere.id = Chapitre.refMat ORDER BY idDom, idMat,idChap";
          return $this->db->fetchAll($sql);
    }

}
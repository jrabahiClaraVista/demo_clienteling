<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

use Application\Sonata\UserBundle\Entity\User;

/**
 * KpiCaptureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class KpiCaptureRepository extends EntityRepository
{
	//KPI OF THE MONTH
	public function getUserKpisBetweenDatesSiege($niveau, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
			->where('k.niveau = :niveau')
		  	->setParameter('niveau', $niveau)
		  	->leftJoin('k.user', 'u')
		  	->addSelect('u')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')		  	
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		;

		return $qb
			->getQuery()
			//->getOneOrNullResult();
			->getResult();
	}
	
	//MAUVAIS : RECUPERE PLUSIEURS RESULTATS
	public function getUserKpisBetweenDatesRM($niveau, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
			->where('k.niveau = :niveau')
		  	->setParameter('niveau', $niveau)
		  	->leftJoin('k.user', 'u')
		  	->addSelect('u')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')		  	
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		;

		return $qb
			->getQuery()
			//->getOneOrNullResult();
			->getResult();
	}
	public function getUserKpisBetweenDatesSiegeBtq($btq, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
			->where('k.libelle = :libelle')
		  	->setParameter('libelle', $btq)
		  	->leftJoin('k.user', 'u')
		  	->addSelect('u')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')		  	
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		;

		return $qb
			->getQuery()
			//->getOneOrNullResult();
			->getResult();
	}

	public function getUserKpisBetweenDates(User $user, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
			->where('k.niveau = :niveau')
		  	->setParameter('niveau', $niveau)
		  	->leftJoin('k.user', 'u')
		  	->addSelect('u')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		;

		return $qb
			->getQuery()
			//->getOneOrNullResult();
			->getResult();
	}

	public function getUserKpisBetweenDatesBtq( $date1, $date2, $btq){
		$qb = $this
			->createQueryBuilder('k')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->andWhere('k.libelle = :libelle')
		  	->setParameter('libelle', $btq)
		  	->orderBy('k.date', 'DESC')
		;

		return $qb
			->getQuery()
			//->getOneOrNullResult();
			->getResult();
	}


	// KPI OF THE YEAR
	public function getUserKpiYtdSiege($codeBoutiqueVendeur, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
		  	->where('k.codeBoutiqueVendeur = :codeBoutiqueVendeur')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')
		  	->setParameter('codeBoutiqueVendeur', $codeBoutiqueVendeur)
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		  	->setMaxResults(1);
		;

		return $qb
			->getQuery()
			->getOneOrNullResult();
	}

	//MAUVAIS : RECUPERE PLUSIEURS RESULTATS
	public function getUserKpiYtdRM($codeBoutiqueVendeur, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
		  	->where('k.codeBoutiqueVendeur = :codeBoutiqueVendeur')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')
		  	->setParameter('codeBoutiqueVendeur', $codeBoutiqueVendeur)
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		  	->setMaxResults(1);
		;

		return $qb
			->getQuery()
			->getOneOrNullResult();
	}
	public function getUserKpiYtd($point_vente_desc, $date1, $date2){
		$qb = $this
			->createQueryBuilder('k')
		  	->where('k.libelle = :libelle')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')
		  	->setParameter('libelle', $point_vente_desc)
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		  	->setMaxResults(1);
		;

		return $qb
			->getQuery()
			->getOneOrNullResult();
	}

	public function getUserKpiLastYear($date1, $date2, $codeBoutiqueVendeur){
		$qb = $this
			->createQueryBuilder('k')
		  	->where('k.codeBoutiqueVendeur = :codeBoutiqueVendeur')
		  	->andWhere('k.date BETWEEN :date1 AND :date2')
		  	->setParameter('codeBoutiqueVendeur', $codeBoutiqueVendeur)
		  	->setParameter('date1', $date1)
		  	->setParameter('date2', $date2)
		  	->orderBy('k.date', 'DESC')
		  	->setMaxResults(1);
		;

		return $qb
			->getQuery()
			->getOneOrNullResult();
	}

	public function getKpiTopBoutiqueNative($month, $year, $canal, $order, $container, $niveau = null, $libelle = null){
		
		if($month < 12 ){
			$monthp1 = $month + 1 ;
			$yearp1 = $year;
		}
		else{
			$monthp1 = "01" ;
			$yearp1 = $year + 1;
		}

		$pdo = $container->get('app.pdo_connect');
        $pdo = $pdo->initPdoClienteling();       
		
		switch ($canal) {
			case 'Email':
				$sql = 'SELECT k.pct_cli_email_valid_m as pct, GROUP_CONCAT(k.point_vente_desc) as list 
						FROM app_kpi_capture k
						LEFT JOIN fos_user_user u on k.point_vente_desc = u.libelle
						WHERE (k.date BETWEEN "'. $year.'-'.$month.'-01'.'" AND "'. $yearp1.'-'.$monthp1.'-01'.'")
						AND k.niveau = "BTQ"
						AND k.user_id IS NOT NULL';

				if($niveau == "RM"){
					$sql .= ' AND u.retail_manager = "'.$libelle.'"';
				}
				elseif($niveau == "DR"){
					$sql .= ' AND u.directeur = "'.$libelle.'"';
				}
				elseif($niveau == "BTQ"){
					$sql .= ' AND u.store = "'.$libelle.'"';
				}

				$sql .=	' GROUP BY k.pct_cli_email_valid_m
						  ORDER BY pct_cli_email_valid_m '.$order;
				break;
			case 'Mail':
				$sql = 'SELECT k.pct_cli_mail_valid_m as pct, GROUP_CONCAT(k.point_vente_desc) as list 
						FROM app_kpi_capture k
						LEFT JOIN fos_user_user u on k.point_vente_desc = u.libelle
						WHERE (k.date BETWEEN "'. $year.'-'.$month.'-01'.'" AND "'. $yearp1.'-'.$monthp1.'-01'.'")
						AND k.niveau = "BTQ"
						AND k.user_id IS NOT NULL';

				if($niveau == "RM"){
					$sql .= ' AND u.retail_manager = "'.$libelle.'"';
				}
				elseif($niveau == "DR"){
					$sql .= ' AND u.directeur = "'.$libelle.'"';
				}
				elseif($niveau == "BTQ"){
					$sql .= ' AND k.point_vente_desc = "'.$libelle.'"';
				}

				$sql .=	' GROUP BY k.pct_cli_mail_valid_m
						  ORDER BY pct_cli_mail_valid_m '.$order;
				break;
			case 'Phone':
				$sql = 'SELECT k.pct_cli_tel_valid_m as pct, GROUP_CONCAT(k.point_vente_desc) as list 
						FROM app_kpi_capture k
						LEFT JOIN fos_user_user u on k.point_vente_desc = u.libelle
						WHERE (k.date BETWEEN "'. $year.'-'.$month.'-01'.'" AND "'. $yearp1.'-'.$monthp1.'-01'.'")
						AND k.niveau = "BTQ"
						AND k.user_id IS NOT NULL';

				if($niveau == "RM"){
					$sql .= ' AND u.retail_manager = "'.$libelle.'"';
				}
				elseif($niveau == "DR"){
					$sql .= ' AND u.directeur = "'.$libelle.'"';
				}
				elseif($niveau == "BTQ"){
					$sql .= ' AND k.point_vente_desc = "'.$libelle.'"';
				}

				$sql .=	' GROUP BY k.pct_cli_tel_valid_m
						  ORDER BY pct_cli_tel_valid_m '.$order;
				break;
			
			default:
				$sql = 'SELECT k.pct_cli_coord_valid_m as pct, GROUP_CONCAT(k.point_vente_desc) as list 
						FROM app_kpi_capture k
						LEFT JOIN fos_user_user u on k.point_vente_desc = u.libelle
						WHERE (k.date BETWEEN "'. $year.'-'.$month.'-01'.'" AND "'. $yearp1.'-'.$monthp1.'-01'.'") 
						AND k.niveau = "BTQ"
						AND k.user_id IS NOT NULL';

				if($niveau == "RM"){
					$sql .= ' AND u.retail_manager = "'.$libelle.'"';
				}
				elseif($niveau == "DR"){
					$sql .= ' AND u.directeur = "'.$libelle.'"';
				}
				elseif($niveau == "BTQ"){
					$sql .= ' AND k.point_vente_desc = "'.$libelle.'"';
				}

				$sql .=	' GROUP BY k.pct_cli_coord_valid_m
						  ORDER BY pct_cli_coord_valid_m '.$order;
				break;
		}


        $stmt = $pdo->prepare($sql);
        

		$stmt->execute();

		//var_dump($sql); die();

		return $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}

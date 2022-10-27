<?php 

function countdatauser($jobdesk){
	$db = \Config\Database::connect();
	return $db->table('user')
	->where(['jobdesk' => $jobdesk])
	->countAllResults();
}
function countdatauserfakultas(){
	$where = 'fakultas != '. null;
	$db = \Config\Database::connect();
	return $db->table('user')
	->where($where)
	->countAllResults();
}
?>
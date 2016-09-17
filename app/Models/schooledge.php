<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schooledge extends Model {


	public static function getRows( $args )
	{
		$table = with(new static)->table;
		$key = with(new static)->primaryKey;

		extract( array_merge( array(
			'page' 		=> '0' ,
			'limit'  	=> '0' ,
			'sort' 		=> '' ,
			'order' 	=> '' ,
			'params' 	=> '' ,
			'joins'		=>'',
			'global'	=> 1
		), $args ));

		$offset = ($page-1) * $limit ;
		$limitConditional = ($page !=0 && $limit !=0) ? "LIMIT  $offset , $limit" : '';
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';

		// Update permission global / own access new ver 1.1
		$table = with(new static)->table;
		if($global == 0 )
			$params .= " AND {$table}.entry_by ='".\Session::get('uid')."'";
		$rows = array();
		$result = \DB::select(self::querySelect(). self::queryJoin() . self::queryWhere(). "
				{$params} ". self::queryGroup() ." {$orderConditional}  {$limitConditional} ");
		//var_dump($result);
		//exit;

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$total = count($result);


		return $results = array('rows'=> $result , 'total' => $total);
	}	

	public static function getRow( $id )
	{
       $table = with(new static)->table;
	   $key = with(new static)->primaryKey;

		$result = \DB::select( 
				self::querySelect() .
				self::queryJoin() .
				self::queryWhere().
				" AND ".$table.".".$key." = '{$id}' ".
				self::queryGroup()
			);	
		if(count($result) <= 0){
			$result = array();		
		} else {

			$result = $result[0];
		}
		return $result;		
	}	

	public  function insertRow( $data , $id)
	{
       $table = with(new static)->table;
	   $key = with(new static)->primaryKey;
	    if($id == NULL )
        {
			// Insert Here
			if(isset($data['_token'])) unset($data['_token']);
			$data['created_by'] = \Session::get('uid');
			if(isset($data['updated_at'])) unset($data['updated_at']);
			if(isset($data['created_at'])) $data['created_at'] = date("Y-m-d H:i:s");
			if($table!='tb_division' && $table!='tb_class' && $table!='tb_teachers' && $table!='tb_parent' && $table!='tb_students' && $table!='tb_users' && $table!='tb_school'){
				$data['year_id'] = \Session::get('selected_year');
			}
			$id = \DB::table( $table)->insertGetId($data);
            
        } else {
            // Update here
			// updated_by field keep track user id
			$data['updated_by'] = \Session::get('uid');
			// update created field if any
			if(isset($data['_token'])) unset($data['_token']);
			if(isset($data['created_at'])) unset($data['created_at']);
			if(isset($data['updated_at'])) $data['updated_at'] = date("Y-m-d H:i:s");
			if($table!='tb_division' && $table!='tb_class' && $table!='tb_teachers' && $table!='tb_parent' && $table!='tb_students' && $table!='tb_users' && $table!='tb_school'){
				$data['year_id'] = \Session::get('selected_year');
			}
			\DB::table($table)->where($key,$id)->update($data);
        }

        return $id;    
	}			

	static function makeInfo( $id )
	{
		$row =  \DB::table('tb_module')->where('name', $id)->get();
		$data = array(
			'id' => $row[0]->id
		);
		return $data;
		/*
		$data = array();
		foreach($row as $r)
		{
			$langs = (json_decode($r->module_lang,true));
			$data['id']		= $r->module_id; 
			$data['title'] 	= \SiteHelpers::infoLang($r->module_title,$langs,'title'); 
			$data['note'] 	= \SiteHelpers::infoLang($r->module_note,$langs,'note'); 
			$data['table'] 	= $r->module_db; 
			$data['key'] 	= $r->module_db_key;
			$data['config'] = \SiteHelpers::CF_decode_json($r->module_config);
			$field = array();	
			foreach($data['config']['grid'] as $fs)
			{
				foreach($fs as $f)
					$field[] = $fs['field']; 	
									
			}
			$data['field'] = $field;	
			$data['setting'] = array(
				'gridtype'		=> (isset($data['config']['setting']['gridtype']) ? $data['config']['setting']['gridtype'] : 'native'  ),
				'orderby'		=> (isset($data['config']['setting']['orderby']) ? $data['config']['setting']['orderby'] : $r->module_db_key),
				'ordertype'		=> (isset($data['config']['setting']['ordertype']) ? $data['config']['setting']['ordertype'] : 'asc'  ),
				'perpage'		=> (isset($data['config']['setting']['perpage']) ? $data['config']['setting']['perpage'] : '10'  ),
				'frozen'		=> (isset($data['config']['setting']['frozen']) ? $data['config']['setting']['frozen'] : 'false'  ),
	            'form-method'   => (isset($data['config']['setting']['form-method'])  ? $data['config']['setting']['form-method'] : 'native'  ),
	            'view-method'   => (isset($data['config']['setting']['view-method'])  ? $data['config']['setting']['view-method'] : 'native'  ),
	            'inline'        => (isset($data['config']['setting']['inline'])  ? $data['config']['setting']['inline'] : 'false'  ),				
				
			);			
					
		}
		return $data;
		*/
	
	} 

    static function getComboselect( $params , $limit =null, $parent = null)
    {   
        $limit = explode(':',$limit);
        $parent = explode(':',$parent);

        if(count($limit) >=3)
        {
            $table = $params[0]; 
            $condition = $limit[0]." `".$limit[1]."` ".$limit[2]." ".$limit[3]." "; 
            if(count($parent)>=2 )
            {
            	$row =  \DB::table($table)->where($parent[0],$parent[1])->where('year_id', '=', \Session::get('selected_year'))->get();
            	 $row =  \DB::where('year_id', '=', \Session::get('selected_year'))->select( "SELECT * FROM ".$table." ".$condition ." AND ".$parent[0]." = '".$parent[1]."'");
            } else  {
	           $row =  \DB::where('year_id', '=', \Session::get('selected_year'))->select( "SELECT * FROM ".$table." ".$condition);
            }        
        }else{

            $table = $params[0]; 
            if(count($parent)>=2 )
            {
            	$row =  \DB::table($table)->where($parent[0],$parent[1])->where('year_id', '=', \Session::get('selected_year'))->get();
            } else  {
	            $row =  \DB::table($table)->where('year_id', '=', \Session::get('selected_year'))->get();
            }	           
        }

        return $row;
    }	

	public static function getColoumnInfo( $result )
	{
		$pdo = \DB::getPdo();
		$res = $pdo->query($result);
		$i =0;	$coll=array();	
		while ($i < $res->columnCount()) 
		{
			$info = $res->getColumnMeta($i);			
			$coll[] = $info;
			$i++;
		}
		return $coll;	
	
	}	


	function validAccess( $id)
	{

		$row = \DB::table('tb_group_access')->where('module_id','=', $id)
				->where('group_id','=', \Session::get('gid'))
				->get();
		
		if(count($row) >= 1)
		{
			$row = $row[0];
			if($row->data_access !='')
			{
				$data = json_decode($row->data_access,true);
			} else {
				$data = array();
			}	
			return $data;		
			
		} else {
			return false;
		}			
	
	}	

	static function getColumnTable( $table )
	{	  
        $columns = array();
	    foreach(\DB::select("SHOW COLUMNS FROM $table") as $column)
        {
           //print_r($column);
		    $columns[$column->Field] = '';
        }
	  

        return $columns;
	}	

	static function getTableList( $db ) 
	{
	 	$t = array(); 
		$dbname = 'Tables_in_'.$db ; 
		foreach(\DB::select("SHOW TABLES FROM {$db}") as $table)
        {
		    $t[$table->$dbname] = $table->$dbname;
        }	
		return $t;
	}	
	
	static function getTableField( $table ) 
	{
        $columns = array();
	    foreach(\DB::select("SHOW COLUMNS FROM $table") as $column)
		    $columns[$column->Field] = $column->Field;
        return $columns;
	}

	public static function getRecords( $args )
	{
		$table = with(new static)->table;
		$key = with(new static)->primaryKey;

		extract( array_merge( array(
			'page' 		=> '0' ,
			'limit'  	=> '0' ,
			'sort' 		=> '' ,
			'order' 	=> '' ,
			'params' 	=> '' ,
			'joins'		=>'',
			'global'	=> 1
		), $args ));

		$offset = ($page-1) * $limit ;
		$limitConditional = ($page !=0 && $limit !=0) ? "LIMIT  $offset , $limit" : '';
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';

		// Update permission global / own access new ver 1.1
		$table = with(new static)->table;
		if($global == 0 )
			$params .= " AND {$table}.entry_by ='".\Session::get('uid')."'";
		$rows = array();
		$result = \DB::select(self::querySelect(). self::queryJoin() . self::queryWhere(). "
				{$params} ". self::queryGroup() ." {$orderConditional}  {$limitConditional} ");
		//var_dump($result);
		//exit;

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$total = count($result);


		return $results = array('rows'=> $result , 'total' => $total);


	}
}

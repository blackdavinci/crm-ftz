$id = DB::table('societes')->select('id')->orderBy('id', 'desc')->first();
		foreach ($id as $value) {
			$id = $value;
		}
	
		$params['body']  = ['nom'=>$request->input('nom_clt'),'pays'=>$request->input('pays_clt')];

		$params['index'] = 'ftz';
		$params['type']  = 'societes';
		$params['id']    = $id;

		$indexes = $client->index($params);
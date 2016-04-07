<?php
	function file_get_contents_curl($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	function is_conf($str) {
		$result = array();
		preg_match_all("/(?:\[)(.*)(?:\])/i",$str, $result);
		return $result[1][0];
	}
	
	function parse_config($content,$server) {
		$proxy_res = $server['proxy'];
		$group_res = $server['group'];
		$res = [];
		$is_inProxy = false;
		$is_inProxyGroup = false;

		foreach(preg_split("/((\r?\n)|(\r\n?))/", $content) as $line){
			$c = is_conf($line);
			if($c){
				// Replace [Proxy]
				if($c == 'Proxy') {
					array_push($res, $line);
					foreach ($proxy_res as  $proxy) {
						array_push($res, $proxy);
					}
					array_push($res, "");
					$is_inProxy = true;
					continue;
				} else {
					$is_inProxy = false;
				}
				// Replace [Proxy Group]
				if ($c == 'Proxy Group') {
					array_push($res, $line);
					array_push($res, $group_res);
					array_push($res, "");
					$is_inProxyGroup = true;
					continue;
				} else {
					$is_inProxyGroup = false;
				}
			}
		
			if($is_inProxy || $is_inProxyGroup) {
				continue;
			}
			
			array_push($res, $line);
		}
		
		return $res;
	}

?>
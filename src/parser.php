<?php

class Parser
{
	private $url;
	private $ch;
	
	public function __construct( $url )
	{
		if (filter_var($url , FILTER_VALIDATE_URL)) {
			$this->url = $url;
			$this->ch = curl_init($this->url);
		}
	} 
	
	public function curl_setopt_array( array $opt_curl_arr )
	{
	    if ( is_array($opt_curl_arr) ) {
            curl_setopt_array($this->ch, $opt_curl_arr);
        }
	}

	public function curl_setopt( $opt, $opt_value )
    {
        if ( isset($opt) & !empty($opt) & isset($opt_value) ) {
            curl_setopt($this->ch, $opt, $opt_value);
        }
    }


//    Requires improvements
//	  public function parsing( $tag, array $id = null)
//    {
//        $match = false;
//        if ( isset($tag) & !empty($tag) & !isset($id) ) {
/*            preg_match_all("~<{$tag}[^>]*?>(.*?)</{$tag}>~su", $this->curl_exec(), $match);*/
//        }
//
//        if ( isset($tag) & !empty($tag) & isset($id) & !empty($id) ) {
/*            preg_match_all("~<{$tag}[^>]+?{$id[0]}\s*?=\s*?(['\"]){$id[1]}".'\1'."[^>]*?>(.+?)</{$tag}>~su",*/
//                $this->curl_exec(), $match);
//        }
//
//        if ( empty($tag) & isset($id) & !empty($id) ) {
/*            preg_match_all('~<[^>]+?'.$id[0].'\s*?=\s*?(["\'])'.$id[1].'\1[^>]*?>(.+?)</[^>]+?>~su',*/
//                $this->curl_exec(), $match);
//        }
//
//        if ($match){
//            $result = array_pop($match);
//            unset($match);
//            return $result;
//        }
//    }

	// Simple Parser
    public function parsing( $tag, array $id = null)
    {
        $match = false;
        if ( isset($tag) & !empty($tag) & !isset($id) ) {
            preg_match_all("~<{$tag}[^>]*?>(.*?)</{$tag}>~su", $this->curl_exec(), $match);
        }

        if (is_array($match)){
            $result = array_pop($match);
            unset($match);
            return $result;
        } else {
            return ['Nothing found'];
        }
    }

	private function curl_exec()
	{
		return curl_exec($this->ch);
	}
	
	public function __destruct()
    {
		curl_close($this->ch);
	}
	
}


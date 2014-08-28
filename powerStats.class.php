<?php

class PowerStats {

	protected $db;
	protected $table_prefix;
	protected $post;
	protected $sql_time;
	
	protected $ip;
	protected $country;
	protected $device;
	protected $referer;
	protected $browser;
	protected $search_engine;
	
	protected $mobile_detect;
	protected $browser_detect;
	
	const HTML_ENCODING_QUOTE_STYLE = ENT_QUOTES;

	function __construct($wpdb, $table_prefix, $post) {
			
		$this->db = $wpdb;
		$this->table_prefix = $table_prefix;
		$this->post = $post;
		$this->sql_time = current_time('mysql', 1); // Store in UTC
		$this->mobile_detect = new Mobile_Detect();
		$this->browser_detect = new Browser();
		
		if (get_option('wp_power_stats_ignore_bots') && $this->is_bot()) return true;
		
		$this->read_client_info();
		$this->log_pageviews();
	
		if ($this->is_new_visitor()) {
		
			$this->log_visits();
			$this->log_browsers();
			$this->log_os();
			$this->log_keywords();
			$this->log_referers();
			
		}
		
		if (is_single($post)) $this->log_post_visits();
		
		$this->set_visit_logged();

	}
	
	public function is_new_visitor() {

		if (isset($_SESSION['wp-power-stats']) && $_SESSION['wp-power-stats'] == 1) return false;
		return true;

	}
	
	public function set_visit_logged() {
	
		$_SESSION['wp-power-stats'] = '1';
	
	}
	
	public function log_browsers() {
		
		if (!$this->is_bot()) {
		
			$table = $this->get_table_prefix() . 'power_stats_browsers';
			$rows_updated = $this->db->query( $this->db->prepare("UPDATE $table SET `count` = count + 1 WHERE `browser` = '%s'", $this->get_client_browser()) );
		
			if ($rows_updated === 0 && $rows_updated !== false) { 
	
				$this->db->insert($table, array(
				
					'browser' => $this->get_client_browser(),
					'count' => 1
				
				), array('%s','%d'));
			
			}
		}	
	}

	public function log_os() {
		
		if (!$this->is_bot()) {
		
			$table = $this->get_table_prefix() . 'power_stats_os';
			$rows_updated = $this->db->query( $this->db->prepare("UPDATE $table SET `count` = count + 1 WHERE `os` = '%s'", $this->get_os(false)) );
		
			if ($rows_updated === 0 && $rows_updated !== false) { 
	
				$this->db->insert($table, array(
				
					'os' => $this->get_os(false),
					'count' => 1
				
				), array('%s','%d'));
			
			}
		}	
	}
		
	public function log_referers() {
		
		$table = $this->get_table_prefix() . 'power_stats_referers';
		$referer = $this->get_referer();
		
		if ( !empty($referer) ) {
		
			if ($this->is_bot()) {
				$referer = parse_url($referer, PHP_URL_HOST);
			}
		
			$rows_updated = $this->db->query( $this->db->prepare("UPDATE $table SET `count` = count + 1 WHERE `referer` = '%s'", $referer) );
		
			if ($rows_updated === 0 && $rows_updated !== false) { 
	
				$this->db->insert($table, array(
				
					'referer' => $referer,
					'count' => 1
				
				), array('%s','%d'));
			
			}
		
		}
		
	}
	
	public function log_keywords() {
		
		$table = $this->get_table_prefix() . 'power_stats_searches';
		$search_terms = $this->get_search_terms();
		
		if ($search_terms) {
		
			$rows_updated = $this->db->query( $this->db->prepare("UPDATE $table SET `count` = count + 1 WHERE `terms` = '%s'", $search_terms) );
	
			if ($rows_updated === 0 && $rows_updated !== false) { 
	
				$this->db->insert($table, array(
				
					'terms' => $search_terms,
					'count' => 1
				
				), array('%s','%d'));
			
			}
		
		}
		
	}

	public function log_visits() {
		
		$table = $this->get_table_prefix() . 'power_stats_visits';
		$duplicate = $this->db->get_row( $this->db->prepare("SELECT 1 FROM $table WHERE `date` = '%s' AND `ip` = '%s'", $this->get_date(), $this->get_ip()) );
		
		if ($duplicate === null) {
			$this->db->insert($table, array(
			
				'date' => $this->get_date(),
				'time' => $this->get_time(),
				'ip' => $this->get_ip(),
				'country' => $this->get_country(),
				'device' => $this->get_device(),
				'referer' => $this->get_referer(),
				'browser' => $this->get_client_browser(),
				'browser_version' => $this->get_client_browser_version(),
				'is_search_engine' => $this->is_search_engine(),
				'user_agent' => $this->get_user_agent(),
				'is_bot' => $this->is_bot(),
				'os' => $this->get_os()
			
			), array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'));
		}
		
	}

	public function log_post_visits() {
		
		$table = $this->get_table_prefix() . 'power_stats_posts';
		$rows_updated = $this->db->query( $this->db->prepare("UPDATE $table SET `hits` = `hits` + 1 WHERE `date` = '%s' AND `post_id` = '%d'", $this->get_date(), $this->get_post_id()) );
		
		if ($rows_updated === 0 && $rows_updated !== false) { 
		
			$this->db->insert($table, array(
			
				'post_id' => $this->get_post_id(),
				'date' => $this->get_date(),
				'hits' => 1
			
			), array('%d','%s','%d'));
		
		}
		
	}
	
	public function log_pageviews() {
		
		$table = $this->get_table_prefix() . 'power_stats_pageviews';
		$rows_updated = $this->db->query( $this->db->prepare("UPDATE $table SET `hits` = `hits` + 1 WHERE `date` = '%s'", $this->get_date()) );
		
		if ($rows_updated === 0 && $rows_updated !== false) { 
		
			$this->db->insert($table, array(
			
				'date' => $this->get_date(),
				'hits' => 1
			
			), array('%s','%d'));
		
		}
		
	}
	
	protected function read_client_info() {
		
		$this->set_ip();
		$this->set_country();
		$this->set_device();
		$this->set_referer();
		$this->set_search_engine();
		
	}
	
	// * * * * * * * * * * * *
	// Set client information
	// * * * * * * * * * * * *
	
	protected function set_referer() {
		
		if (wp_get_referer()) {
			
			$this->referer = filter_var(wp_get_referer(), FILTER_SANITIZE_URL);
			
		}
		
	}
	
	protected function set_device() {
		
		if ($this->mobile_detect->isTablet()) {
			$this->device = 'tablet';
		} else if ($this->mobile_detect->isMobile()) {
			$this->device = 'mobile';
		} else {
			$this->device = 'desktop';
		}
		
		
		
	}
	
	protected function set_ip() {
	
	    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

	    foreach ($ip_keys as $key) {
	    
	        if (array_key_exists($key, $_SERVER) === true) {
	        
	            foreach (explode(',', $_SERVER[$key]) as $ip) {
	                $ip = $this->filter_ip(trim($ip));
	            }
	        }
	        
	    }
	    
	    if (!empty($ip)) $this->ip = $ip;
	    
	}
	 
	protected function filter_ip($ip) {
	
	    return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);

	}
	
	protected function set_country() {
		
		require_once WP_POWER_STATS_PLUGIN_DIR . '/vendor/geoip/geoip.inc';

		$gi = geoip_open(WP_POWER_STATS_PLUGIN_DIR . '/vendor/geoip/GeoIP.dat', GEOIP_STANDARD);
		$this->country = geoip_country_code_by_addr($gi, $this->get_ip());
		
		geoip_close($gi);
		
	}
	
	protected function set_search_engine() {
		
		$this->search_engine = $this->parse_search_engine($this->get_referer());
		
	}
	
	
	// * * * * * * * * * * * *
	// Getters
	// * * * * * * * * * * * *
	
	protected function get_referer() {
	
		return $this->referer;
		
	}
	
	protected function get_device() {
	
		return $this->device;
		
	}
	
	protected function get_post_id() {
	
		return $this->post->ID;
		
	}
	
	protected function get_table_prefix() {
		
		return $this->table_prefix;
		
	}
	
	protected function get_time() {
		
		return $this->sql_time;
		
	}
	
	protected function get_date() {
	
		return substr($this->get_time(), 0, strpos($this->get_time(), " "));
	}
	
	protected function get_country() {
		
		return $this->country;
		
	}
	
	protected function get_ip() {
		
		return $this->ip;
		
	}
	
	protected function get_search_engine() {
		
		return $this->search_engine;
		
	}
	
	protected function get_search_terms() {
		
		$engine_meta = $this->get_search_engine();
		
		if ($engine_meta) return $engine_meta['keywords'];
		else return false;
		
	}
	
	protected function get_client_browser() {
		
		return $this->browser_detect->getBrowser();
		
	}
	
	protected function get_client_browser_version() {
		
		$response = $this->browser_detect->getVersion();
		return (empty($response) || $response == 'unknown') ? '' : $this->browser_detect->getVersion();
		
	}
	
	protected function get_user_agent() {
		
		return $this->browser_detect->getUserAgent();
		
	}
	
	protected function get_os($unknown_is_empty = true) {
		
		$user_agent = $this->get_user_agent();
		$os_list = array(
			'windows' => 'Windows',
			'mac' => 'Mac',
			'linux|sun|bsd|beos' => 'Linux'
		);
		
		$matched = 0;
		
		foreach($os_list as $match => $os) {
	        if (preg_match("/$match/i", $user_agent)) {
				$matched = 1;
				break;
	        }
		}
		
		return (($matched && !empty($os)) ? $os : (($unknown_is_empty) ? '' : 'Unknown'));
		
	}
	
	
	protected function is_search_engine() {
		
		return (int) (is_array($this->get_search_engine())) ? true : false;
		
	}
	
	protected function stripos_array($haystack, $needles=array(), $offset=0) {
	
        $chr = array();
        foreach($needles as $needle) {
                $res = stripos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        
        if(empty($chr)) return false;
        return min($chr);
	}
	
	protected function is_bot() {
		
		$haystack = $this->browser_detect->getUserAgent();
		$needles = array('Googlebot','DoCoMo','YandexBot','bingbot','ia_archiver','AhrefsBot','Ezooms','GSLFbot','WBSearchBot','Twitterbot','TweetmemeBot','Twikle','PaperLiBot','Wotbox','UnwindFetchor','facebookexternalhit');
		
		return ($this->stripos_array($haystack, $needles)) ? true : false;
		
	}
	
	
	
    /**
     * Returns list of valid country codes
     *
     * @see vendor/search-terms/Countries.php
     *
     * @param bool $includeInternalCodes
     * @return array  Array of (2 letter ISO codes => 3 letter continent code)
     */
    public static function getCountriesList($includeInternalCodes = false) {
    
        require_once WP_POWER_STATS_PLUGIN_DIR . '/vendor/search-terms/Countries.php';

        $countriesList = $GLOBALS['PowerStats_CountryList'];
        $extras = $GLOBALS['PowerStats_CountryList_Extras'];

        if ($includeInternalCodes) {
            return array_merge($countriesList, $extras);
        }
        
        return $countriesList;
    }	
	
	
	/**
     * Reduce URL to more minimal form.  2 letter country codes are
     * replaced by '{}', while other parts are simply removed.
     *
     * Examples:
     *   www.example.com -> example.com
     *   search.example.com -> example.com
     *   m.example.com -> example.com
     *   de.example.com -> {}.example.com
     *   example.de -> example.{}
     *   example.co.uk -> example.{}
     *
     * @param string $url
     * @return string
     */
    public static function getLossyUrl($url) {
        static $countries;
        if (!isset($countries)) {
            $countries = implode('|', array_keys(self::getCountriesList(true)));
        }

        return preg_replace(
            array(
                 '/^(w+[0-9]*|search)\./',
                 '/(^|\.)m\./',
                 '/(\.(com|org|net|co|it|edu))?\.(' . $countries . ')(\/|$)/',
                 '/(^|\.)(' . $countries . ')\./',
            ),
            array(
                 '',
                 '$1',
                 '.{}$4',
                 '$1{}.',
            ),
            $url);
    }
	
	/**
     * Returns the value of a GET parameter $parameter in an URL query $urlQuery
     *
     * @param string $urlQuery  result of parse_url()['query'] and htmlentitied (& is &amp;) eg. module=test&amp;action=toto or ?page=test
     * @param string $parameter
     * @return string|bool  Parameter value if found (can be the empty string!), null if not found
     */
    public static function getParameterFromQueryString($urlQuery, $parameter) {
        $nameToValue = self::getArrayFromQueryString($urlQuery);
        if (isset($nameToValue[$parameter])) {
            return $nameToValue[$parameter];
        }
        return null;
    }

    /**
     * Sanitize a single input value
     *
     * @param string $value
     * @return string  sanitized input
     */
    public static function sanitizeInputValue($value) {
    
        // $_GET and $_REQUEST already urldecode()'d
        // decode
        // note: before php 5.2.7, htmlspecialchars() double encodes &#x hex items
        $value = html_entity_decode($value, self::HTML_ENCODING_QUOTE_STYLE, 'UTF-8');

        // filter
        $value = str_replace(array("\n", "\r", "\0"), '', $value);

        // escape
        $tmp = @htmlspecialchars($value, self::HTML_ENCODING_QUOTE_STYLE, 'UTF-8');

        // note: php 5.2.5 and above, htmlspecialchars is destructive if input is not UTF-8
        if ($value != '' && $tmp == '') {
            // convert and escape
            $value = utf8_encode($value);
            $tmp = htmlspecialchars($value, self::HTML_ENCODING_QUOTE_STYLE, 'UTF-8');
        }
        return $tmp;
    }

    /**
     * Returns an URL query string in an array format
     *
     * @param string $urlQuery
     * @return array  array( param1=> value1, param2=>value2)
     */
    public static function getArrayFromQueryString($urlQuery) {
    
        if (strlen($urlQuery) == 0) {
            return array();
        }
        if ($urlQuery[0] == '?') {
            $urlQuery = substr($urlQuery, 1);
        }
        $separator = '&';

        $urlQuery = $separator . $urlQuery;
        //		$urlQuery = str_replace(array('%20'), ' ', $urlQuery);
        $refererQuery = trim($urlQuery);

        $values = explode($separator, $refererQuery);

        $nameToValue = array();

        foreach ($values as $value) {
            $pos = strpos($value, '=');
            if ($pos !== false) {
                $name = substr($value, 0, $pos);
                $value = substr($value, $pos + 1);
                if ($value === false) {
                    $value = '';
                }
            } else {
                $name = $value;
                $value = false;
            }
            if (!empty($name)) {
                $name = self::sanitizeInputValue($name);
            }
            if (!empty($value)) {
                $value = self::sanitizeInputValue($value);
            }

            // if array without indexes
            $count = 0;
            $tmp = preg_replace('/(\[|%5b)(]|%5d)$/i', '', $name, -1, $count);
            if (!empty($tmp) && $count) {
                $name = $tmp;
                if (isset($nameToValue[$name]) == false || is_array($nameToValue[$name]) == false) {
                    $nameToValue[$name] = array();
                }
                array_push($nameToValue[$name], $value);
            } else if (!empty($name)) {
                $nameToValue[$name] = $value;
            }
        }
        return $nameToValue;
    }
    
    /**
     * multi-byte strtolower() - UTF-8
     *
     * @param string $string
     * @return string
     */
    public static function mb_strtolower($string) {
    
        if (function_exists('mb_strtolower')) {
            return mb_strtolower($string, 'UTF-8');
        }

        return strtolower($string);
    }
	
	/**
     * Extracts a keyword from a raw not encoded URL.
     * Will only extract keyword if a known search engine has been detected.
     * Returns the keyword:
     * - in UTF8: automatically converted from other charsets when applicable
     * - strtolowered: "QUErY test!" will return "query test!"
     * - trimmed: extra spaces before and after are removed
     *
     * Lists of supported search engines can be found in /core/DataFiles/SearchEngines.php
     * The function returns false when a keyword couldn't be found.
     *     eg. if the url is "http://www.google.com/partners.html" this will return false,
     *       as the google keyword parameter couldn't be found.
     *
     * @see unit tests in /tests/core/Common.test.php
     * @param string $referrerUrl  URL referer URL, eg. $_SERVER['HTTP_REFERER']
     * @return array|false false if a keyword couldn't be extracted,
     *                        or array(
     *                            'name' => 'Google',
     *                            'keywords' => 'my searched keywords')
     */
	protected function parse_search_engine($referrerUrl) {
	
		global $PowerStats_SearchEngines, $PowerStats_SearchEngines_NameToUrl;
	
        $refererParsed = @parse_url($referrerUrl);
        $refererHost = '';
        if (isset($refererParsed['host'])) {
            $refererHost = $refererParsed['host'];
        }
        if (empty($refererHost)) {
            return false;
        }
        // some search engines (eg. Bing Images) use the same domain
        // as an existing search engine (eg. Bing), we must also use the url path
        $refererPath = '';
        if (isset($refererParsed['path'])) {
            $refererPath = $refererParsed['path'];
        }

        // no search query
        if (!isset($refererParsed['query'])) {
            $refererParsed['query'] = '';
        }
        $query = $refererParsed['query'];

        // Google Referrers URLs sometimes have the fragment which contains the keyword
        if (!empty($refererParsed['fragment'])) {
            $query .= '&' . $refererParsed['fragment'];
        }

        $searchEngines = $PowerStats_SearchEngines;

        $hostPattern = self::getLossyUrl($refererHost);
        if (array_key_exists($refererHost . $refererPath, $searchEngines)) {
            $refererHost = $refererHost . $refererPath;
        } elseif (array_key_exists($hostPattern . $refererPath, $searchEngines)) {
            $refererHost = $hostPattern . $refererPath;
        } elseif (array_key_exists($hostPattern, $searchEngines)) {
            $refererHost = $hostPattern;
        } elseif (!array_key_exists($refererHost, $searchEngines)) {
            if (!strncmp($query, 'cx=partner-pub-', 15)) {
                // Google custom search engine
                $refererHost = 'google.com/cse';
            } elseif (!strncmp($refererPath, '/pemonitorhosted/ws/results/', 28)) {
                // private-label search powered by InfoSpace Metasearch
                $refererHost = 'wsdsold.infospace.com';
            } elseif (strpos($refererHost, '.images.search.yahoo.com') != false) {
                // Yahoo! Images
                $refererHost = 'images.search.yahoo.com';
            } elseif (strpos($refererHost, '.search.yahoo.com') != false) {
                // Yahoo!
                $refererHost = 'search.yahoo.com';
            } else {
                return false;
            }
        }
        $searchEngineName = $searchEngines[$refererHost][0];
        $variableNames = null;
        if (isset($searchEngines[$refererHost][1])) {
            $variableNames = $searchEngines[$refererHost][1];
        }
        if (!$variableNames) {
            $searchEngineNames = $PowerStats_SearchEngines_NameToUrl;
            $url = $searchEngineNames[$searchEngineName];
            $variableNames = $searchEngines[$url][1];
        }
        if (!is_array($variableNames)) {
            $variableNames = array($variableNames);
        }

        $key = null;
        if ($searchEngineName === 'Google Images'
            || ($searchEngineName === 'Google' && strpos($referrerUrl, '/imgres') !== false)
        ) {
            if (strpos($query, '&prev') !== false) {
                $query = urldecode(trim(self::getParameterFromQueryString($query, 'prev')));
                $query = str_replace('&', '&amp;', strstr($query, '?'));
            }
            $searchEngineName = 'Google Images';
        } else if ($searchEngineName === 'Google'
            && (strpos($query, '&as_') !== false || strpos($query, 'as_') === 0)
        ) {
            $keys = array();
            $key = self::getParameterFromQueryString($query, 'as_q');
            if (!empty($key)) {
                array_push($keys, $key);
            }
            $key = self::getParameterFromQueryString($query, 'as_oq');
            if (!empty($key)) {
                array_push($keys, str_replace('+', ' OR ', $key));
            }
            $key = self::getParameterFromQueryString($query, 'as_epq');
            if (!empty($key)) {
                array_push($keys, "\"$key\"");
            }
            $key = self::getParameterFromQueryString($query, 'as_eq');
            if (!empty($key)) {
                array_push($keys, "-$key");
            }
            $key = trim(urldecode(implode(' ', $keys)));
        }

        if ($searchEngineName === 'Google') {
            // top bar menu
            $tbm = self::getParameterFromQueryString($query, 'tbm');
            switch ($tbm) {
                case 'isch':
                    $searchEngineName = 'Google Images';
                    break;
                case 'vid':
                    $searchEngineName = 'Google Video';
                    break;
                case 'shop':
                    $searchEngineName = 'Google Shopping';
                    break;
            }
        }

        if (empty($key)) {
            foreach ($variableNames as $variableName) {
                if ($variableName[0] == '/') {
                    // regular expression match
                    if (preg_match($variableName, $referrerUrl, $matches)) {
                        $key = trim(urldecode($matches[1]));
                        break;
                    }
                } else {
                    // search for keywords now &vname=keyword
                    $key = self::getParameterFromQueryString($query, $variableName);
                    $key = trim(urldecode($key));

                    // Special case: Google & empty q parameter
                    if (empty($key)
                        && $variableName == 'q'

                        && (
                            // Google search with no keyword
                            ($searchEngineName == 'Google'
                                && ( // First, they started putting an empty q= parameter
                                    strpos($query, '&q=') !== false
                                        || strpos($query, '?q=') !== false
                                        // then they started sending the full host only (no path/query string)
                                        || (empty($query) && (empty($refererPath) || $refererPath == '/') && empty($refererParsed['fragment']))
                                )
                            )
                                // search engines with no keyword
                                || $searchEngineName == 'Google Images'
                                || $searchEngineName == 'DuckDuckGo')
                    ) {
                        $key = false;
                    }
                    if (!empty($key)
                        || $key === false
                    ) {
                        break;
                    }
                }
            }
        }

        // $key === false is the special case "No keyword provided" which is a Search engine match
        if ($key === null
            || $key === ''
        ) {
            return false;
        }

        if (!empty($key)) {
            if (function_exists('iconv')
                && isset($searchEngines[$refererHost][3])
            ) {
                // accepts string, array, or comma-separated list string in preferred order
                $charsets = $searchEngines[$refererHost][3];
                if (!is_array($charsets)) {
                    $charsets = explode(',', $charsets);
                }

                if (!empty($charsets)) {
                    $charset = $charsets[0];
                    if (count($charsets) > 1
                        && function_exists('mb_detect_encoding')
                    ) {
                        $charset = mb_detect_encoding($key, $charsets);
                        if ($charset === false) {
                            $charset = $charsets[0];
                        }
                    }

                    $newkey = @iconv($charset, 'UTF-8//IGNORE', $key);
                    if (!empty($newkey)) {
                        $key = $newkey;
                    }
                }
            }

            $key = self::mb_strtolower($key);
        }

        return array(
            'name'     => $searchEngineName,
            'keywords' => $key,
        );
    }
    

}